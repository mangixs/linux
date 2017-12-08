

PHP7.0
执行下面的命令升级软件仓库
rpm -Uvh https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm
rpm -Uvh https://mirror.webtatic.com/yum/el7/webtatic-release.rpm
yum install php70w-common php70w-fpm php70w-opcache php70w-gd php70w-mysqlnd php70w-mbstring php70w-pecl-redis php70w-pecl-memcached php70w-devel

systemctl start php-fpm.service 开机启动
查看一下php拓展：
php -m
查看php版本

MYSQL
CentOS7以上的版本采用mariadb替代了MySQL，因此安装mariadb。 
安装mariadb服务 yum install mariadb mariadb-server mariadb-devel 
systemctl start mariadb.service 
mysql_secure_installation 

