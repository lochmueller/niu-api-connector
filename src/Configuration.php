<?php

declare(strict_types=1);

namespace Lochmueller\NiuApiConnector;

use Symfony\Component\Dotenv\Dotenv;

class Configuration
{
    protected $configurationOptions = [
        'NIU_EMAIL' => null,
        'NIU_PASSWORD' => null,
        'NIU_COUNTRY_CODE' => null,
        'NIU_TOKEN_FILE' => null,
    ];

    public function get(): array
    {
        $dotEnvPaths = [
            getcwd().'/.env',
            \dirname(\Phar::running(false)).'/.env',
        ];
        foreach ($dotEnvPaths as $dotEnvPath) {
            if (file_exists($dotEnvPath)) {
                (new Dotenv())->load($dotEnvPath);
            }
        }

        foreach (array_keys($this->configurationOptions) as $key) {
            if (isset($_ENV[$key])) {
                $this->configurationOptions[$key] = $_ENV[$key];
            }
        }

        return $this->configurationOptions;
    }
}
