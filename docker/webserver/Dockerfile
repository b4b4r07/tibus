FROM centos:centos6
MAINTAINER Kyoichi Ozaki <kyoichi@gmail.com>

RUN yum update -y
RUN yum install wget -y
RUN wget http://rpms.famillecollet.com/enterprise/remi-release-6.rpm ;\
    wget http://dl.fedoraproject.org/pub/epel/6/x86_64/epel-release-6-8.noarch.rpm ;\
    rpm -ivh epel-release-6-8.noarch.rpm remi-release-6.rpm
RUN yum --enablerepo=remi-php55 install httpd httpd-devel php php-devel php-pear php-mysql php-gd php-mbstring php-pecl-imagick php-pecl-memcache php-intl -y

# /var/www に symfony app をマウントすることによって /var/www/web が
# DocumentRoot になるため、修正する
RUN sed -ri "s|/var/www/html|/var/www/web|" /etc/httpd/conf/httpd.conf
RUN sed -ri "s|AllowOverride None|AllowOverride All|" /etc/httpd/conf/httpd.conf

# php の設定を更新
RUN sed -ri "s|;date.timezone =|date.timezone = Asia/Tokyo|" /etc/php.ini

# symfony用
RUN mkdir -p /tmp/var/www/var/cache
RUN mkdir -p /tmp/var/www/var/logs

# phpコマンドをapache権限で実行できるようにapacheユーザのシェルを変更
RUN chsh -s /bin/bash apache

EXPOSE 80

RUN mkdir -p /usr/local/bin/

COPY httpd-foreground /usr/local/bin/

CMD ["httpd-foreground"]
