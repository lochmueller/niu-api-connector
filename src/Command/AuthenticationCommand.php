<?php

declare(strict_types=1);

namespace Lochmueller\NiuApiConnector\Command;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'niu:authentication')]
class AuthenticationCommand extends AbstractNiuCommand
{
    protected function configure(): void
    {
        parent::configure();
        $this->setDescription('Authentication against the NIU API');

        $this->addOption('email', 'e', InputOption::VALUE_REQUIRED, 'Your account email address');
        $this->addOption('password', 'p', InputOption::VALUE_REQUIRED, 'Your account password. It is recommended to store this in the .env file or _ENV in general!!');
        $this->addOption('countryCode', 'c', InputOption::VALUE_REQUIRED, 'Your country code');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $email = $this->getOptionInclFallback($input, 'email', 'NIU_EMAIL');
        $password = $this->getOptionInclFallback($input, 'password', 'NIU_PASSWORD');
        $countryCode = $this->getOptionInclFallback($input, 'countryCode', 'NIU_COUNTRY_CODE');
        $tokenFile = $this->getTokenFile($input);

        if (empty($email)) {
            $output->writeln('E-Mail is required');

            return self::FAILURE;
        }
        if (empty($password)) {
            $output->writeln('Password is required');

            return self::FAILURE;
        }
        if (empty($countryCode)) {
            $output->writeln('Country code is required');

            return self::FAILURE;
        }

        $arguments = json_encode([
            'grant_type' => 'password',
            'scope' => 'base',
            'account' => $email,
            'password' => md5($password),
            'app_id' => 'niu_ktdrr960',
        ]);
        $request = new Request(
            'POST',
            'https://account-fk.niu.com/v3/api/oauth2/token',

            array_merge($this->getDefaultHeaders(), [
                'Content-Type' => 'application/json; charset=UTF-8',
            ]),
            $arguments
        );

        $client = new Client();
        $response = $client->sendRequest($request);

        $result = json_decode($response->getBody()->getContents());

        $formatter = $this->getFormatter($input);

        if (!isset($result->data->token->access_token)) {
            $formatter->output($output, [['status' => 'error', 'message' => 'Login not successfully']]);

            return self::FAILURE;
        }

        file_put_contents($tokenFile, $result->data->token->access_token);

        $formatter->output($output, [['status' => 'ok', 'message' => 'Login successfully. Token stored to ' . $tokenFile]]);

        return self::SUCCESS;
    }
}
