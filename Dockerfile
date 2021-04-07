FROM debian:latest

ENV APACHE_DOCUMENT_ROOT /usr/share/ce-phoenix/
ENV DEBIAN_FRONTEND=noninteractive

RUN apt update ; apt install -y wget libapache2-mod-php; echo "deb http://repo.vitexsoftware.cz buster main backports" | tee /etc/apt/sources.list.d/vitexsoftware.list ; wget -O /etc/apt/trusted.gpg.d/vitexsoftware.gpg http://repo.vitexsoftware.cz/keyring.gpg
RUN apt-get update && apt-get install -y locales php-pdo-sqlite apache2 aptitude  cron locales-all && rm -rf /var/lib/apt/lists/* \
    && localedef -i cs_CZ -c -f UTF-8 -A /usr/share/locale/locale.alias cs_CZ.UTF-8
ENV LANG cs_CZ.utf8

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

ADD deb/* /var/deb/

RUN echo "deb [trusted=yes] file:///var/deb ./" > /etc/apt/sources.list.d/local.list
RUN ls -la /var/deb ; apt update

RUN aptitude -y install mariadb-server

RUN aptitude -y install ce-phoenix-admin ce-phoenix-installer ; a2enconf ce-phoenix


CMD /usr/sbin/cron
CMD [ "/usr/sbin/apache2ctl", "-D", "FOREGROUND" ]
