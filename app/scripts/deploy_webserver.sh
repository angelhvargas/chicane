adduser sidelab

#install php 7.2
sudo yum-config-manager --enable remi-php72
sudo yum -y install epel-release 
sudo yum -y install yum-utils
sudo yum -y install php
sudo yum -y install http://rpms.remirepo.net/enterprise/remi-release-7.rpm
sudo yum-config-manager --enable remi-php72
sudo yum -y install php72-php-fpm php72-php-gd php72-php-json php72-php-mbstring php72-php-mysqlnd php72-php-xml php72-php-xmlrpc php72-php-opcache

#install mysql 8.0
rpm -Uvh https://repo.mysql.com/mysql57-community-release-el7-11.noarch.rpm
yum --enablerepo=mysql80-community install mysql-community-server  

#mysql pss sidelabCa6010cc!! ===> oyuaq0Mrdj#%  