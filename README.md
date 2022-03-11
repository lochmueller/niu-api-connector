# NIU API Connector

Easy to handle PHP based NIU API connector. 
Idea based on https://github.com/volkerschulz/NIU-API.

## todo

- Phar building: https://github.com/shopwareLabs/psh#installation
- Guzzle:
- Documentation DotEnv Drop index.php?!?! (Box configuration)
- Smaller package

## Build phar by yourself

NIU API Connector can build itself. You need to clone the repository and install the composer dependencies.

    git clone https://github.com/lochmueller/niu-api-connector.git
    cd niu-api-connector
    composer install # assuming you have composer installed globally
    composer niu:build

This will create the phar file in the current dir. The project itself requires PHP 7.4+.
