# NIU API Connector

Easy to handle PHP based NIU API connecter. Idea based on https://github.com/volkerschulz/NIU-API.




todo:
Phar building: https://github.com/shopwareLabs/psh#installation
Guzzle: 
Documentation
DotEnv



## Bild phar by yourself

NIU API Connector can build itself. You need to clone the repository and install the composer dependencies.

    git clone https://github.com/lochmueller/niu-api-connector.git
    cd niu-api-connector
    composer install # assuming you have composer installed globally
    composer bin box install # box is needed to build phar file

./psh unit # verify your installation by executing the test suite.
./psh build

This will create a release phar in the build/psh.phar directory. The project itself requires PHP 7.2+.
