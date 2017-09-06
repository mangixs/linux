yum update 更新yum库
nginx不是一个CentOS基础库的一部分。因此安装EPEL库来获得nginx: 
1、yum install epel-release 
2、yum install nginx 
3、systemctl start nginx.service  开机启动
4、查看是否可用 netstat –tap | grep nginx 

PHP
执行下面的命令升级软件仓库
rpm -Uvh https://mirror.webtatic.com/yum/el7/epel-release.rpm
rpm -Uvh https://mirror.webtatic.com/yum/el7/webtatic-release.rpm
安装php 5.6版本（php56w-devel这个不是必需的）
yum install -y php56w php56w-opcache php56w-xml php56w-mcrypt php56w-gd php56w-devel php56w-MySQL php56w-intl php56w-mbstring php56w-curl php56w-pdo php56w-fpm
systemctl start php-fpm.service 开机启动

MYSQL
CentOS7以上的版本采用mariadb替代了MySQL，因此安装mariadb。 
安装mariadb服务 yum install mariadb mariadb-server mariadb-devel 
systemctl start mariadb.service 
mysql_secure_installation 

linux开启80端口
查看已经开启的端口netstat -anp

修改/etc/sysconfig/iptables文件，增加如下一行：　　

-A INPUT -m state –state NEW -m tcp -p tcp –dport 22 -j ACCEPT 
-A INPUT -m state –state NEW -m tcp -p tcp –dport 80 -j ACCEPT 
-A INPUT -m state –state NEW -m tcp -p tcp –dport 3306 -j ACCEPT 

重启 iptables

service iptables restart

