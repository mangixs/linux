

PHP7.0
执行下面的命令升级软件仓库
rpm -Uvh https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm
rpm -Uvh https://mirror.webtatic.com/yum/el7/webtatic-release.rpm
yum install php70w-common php70w-fpm php70w-opcache php70w-gd php70w-mysqlnd php70w-mbstring php70w-pecl-redis php70w-pecl-memcached php70w-devel

systemctl start php-fpm.service 开机启动
查看一下php拓展：
php -m
查看php版本
启动php-fpm
/usr/sbin/php-fpm

MYSQL
CentOS7以上的版本采用mariadb替代了MySQL，因此安装mariadb。 
安装mariadb服务 yum install mariadb mariadb-server mariadb-devel 
systemctl start mariadb.service 
mysql_secure_installation 

mysql 开启远程连接
 
mysql -uusername -ppwd
use mysql 
update mysql.user set Host='%' where HOST='localhost' and User='root';
flush privileges;

修改root密码
mysql> use mysql; 
mysql> update user set password=password('new_password') where user='root'; 