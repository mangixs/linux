1） 安装编译器gcc、gcc-c++

yum install -y gcc gcc-c++

2） 安装依赖包expat-devel、zlib-devel、openssl-devel

yum install -y expat-devel zlib-devel openssl-devel

yum -y install httpd
systemctl enable httpd.service
systemctl start httpd.service

php
yum -y install libjpeg libjpeg-devel libpng libpng-devel freetype freetype-devel libxml2 libxml2-devel zlib zlib-devel curl curl-devel 
yum -y install libxslt-devel* 
yum -y install httpd-devel
find / -name apxs 得到的路径是:/usr/bin/apxs
wget http://cn.php.net/distributions/php-7.1.10.tar.gz
tar zxvf php-7.1.10.tar.gz
cd php-7.1.10
./configure --prefix=/usr/local/php7 --with-curl --with-freetype-dir --with-gd --with-gettext --with-iconv-dir --with-kerberos --with-libdir=lib64 --with-libxml-dir --with-mysqli --with-openssl --with-pcre-regex --with-pdo-mysql --with-pdo-sqlite --with-pear --with-png-dir --with-xmlrpc --with-xsl --with-zlib --enable-fpm --enable-bcmath -enable-inline-optimization --enable-gd-native-ttf --enable-mbregex --enable-mbstring --enable-opcache --enable-pcntl --enable-shmop --enable-soap --enable-sockets --enable-sysvsem --enable-xml --enable-zip --enable-pcntl --with-curl --with-fpm-user=nginx --enable-ftp --enable-session --enable-xml --with-apxs2=/usr/bin/apxs
make && make install
cp php.ini-* /usr/local/server/php/
cp php.ini-development /usr/local/server/php/php.ini

添加全局php命令
修改/etc/profile文件使其永久性生效，并对所有系统用户生效，在文件末尾加上如下两行代码

PATH=$PATH:/usr/local/php7/bin  为php安装路径 
export PATH
最后：执行 命令source /etc/profile或 执行点命令 ./profile使其修改生效，执行完可通过echo $PATH命令查看是否添加成功
Linux下全局安装composer方法
//下载composer
curl -sS https://getcomposer.org/installer | php

//将composer.phar文件移动到bin目录以便全局使用composer命令
mv composer.phar /usr/local/bin/composer

中国镜像
composer config -g repo.packagist composer https://packagist.phpcomposer.com

修改httpd.conf

载入PHP模块，如httpd.conf中有下列代码则直接去掉前面#即可，没有则加入

LoadModule php7_module modules/libphp7.so
在底部加入以下代码使得Apache可以解析php文件

<IfModule mod_php7.c>
	AddType application/x-httpd-php .php
</IfModule>
找到如下代码，在index.html后面加入index.php

<IfModule dir_module>
    DirectoryIndex index.php index.html
</IfModule>
重启Apache

mysql
CentOS7以上的版本采用mariadb替代了MySQL，因此安装mariadb。 
安装mariadb服务 
yum -y install mariadb mariadb-server mariadb-devel 
systemctl enable mariadb.service 
开机启动
systemctl start mariadb.service 
启动mysql
mysql_secure_installation 

mysql 开启远程连接
 
mysql -u username -p pwd
use mysql 
grant all privileges on *.* to username @'%' identified by 'password';
flush privileges;