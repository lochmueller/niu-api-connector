#!/bin/bash
echo "Content-type: application/json"
echo ""
php  /usr/local/apache2/cgi-bin/niu-api-connector.phar niu:vehicles -f json