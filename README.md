# NIU API Connector

Easy to handle PHP based NIU API connector. 

Idea based on https://github.com/volkerschulz/NIU-API & https://github.com/BlueAndi/niu-cloud-connector

## Configuration

Options for your Env variables (e.g. ".env" file in the same directory).

    NIU_EMAIL=
    NIU_PASSWORD=
    NIU_COUNTRY_CODE=
    NIU_TOKEN_FILE=

## Usage

Install PHP (at least 7.4) on your machine and download the niu-api-connector.phar. Execute the file and follow the
console instruction. Start executing `./niu-api-connector.phar` and follow the help instructions. Example `./niu-api-connector.phar help niu:authentication`.

## Build phar by yourself

NIU API Connector can build itself. You need to clone the repository and install the composer dependencies.

    git clone https://github.com/lochmueller/niu-api-connector.git && cd niu-api-connector
    composer install && composer niu:build 

This will create the phar file in the current dir. The project itself requires PHP 7.4+.

## Usage the docker image

@todo

echo "Open http://localhost:8080/cgi-bin/test.cgi"

docker run --rm -it --name niu -p 8080:80 \
-v "$PWD/cgi-bin/":/usr/local/apache2/cgi-bin/ \
httpd:2.4-alpine