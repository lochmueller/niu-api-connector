FROM httpd:2.4-alpine

LABEL author="Tim Lochmüller"

COPY conf/httpd.conf /usr/local/apache2/conf/httpd.conf
COPY niu /usr/local/apache2/niu

# @todo

# Benötigte Tools installieren (curl)
#RUN apt-get update && apt-get install -y curl && \
#    rm -rf /var/lib/apt/lists/*

# Lade eine .phar-Datei herunter (z.B. PHP-CS-Fixer)
#RUN curl -L https://cs.symfony.com/download/php-cs-fixer-v3.phar -o php-cs-fixer.phar && \
#    chmod +x php-cs-fixer.phar && \
#    mv php-cs-fixer.phar /usr/local/bin/php-cs-fixer
