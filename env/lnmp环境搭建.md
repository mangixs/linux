安装必要的支持库
yum -y install gcc gcc-c++ wget make automake autoconf libtool libxml2-devel libxslt-devel perl-devel perl-ExtUtils-Embed pcre-devel openssl-devel
下载对应当前系统版本的nginx包(package)
wget  http://nginx.org/packages/centos/7/noarch/RPMS/nginx-release-centos-7-0.el7.ngx.noarch.rpm
建立nginx的yum仓库
rpm -ivh nginx-release-centos-7-0.el7.ngx.noarch.rpm
下载并安装nginx
yum install nginx
启动nginx服务
systemctl start nginx.service
开机启动
systemctl enable nginx.service


PHP7.0
执行下面的命令升级软件仓库
rpm -Uvh https://dl.fedoraproject.org/pub/epel/epel-release-latest-7.noarch.rpm
rpm -Uvh https://mirror.webtatic.com/yum/el7/webtatic-release.rpm
yum install php70w-common php70w-fpm php70w-opcache php70w-gd php70w-mysqlnd php70w-mbstring php70w-pecl-redis php70w-pecl-memcached php70w-devel

systemctl enable php-fpm.service 
开机启动
systemctl stat php-fpm.service
查看一下php拓展：
php -m
查看php版本
启动php-fpm
/usr/sbin/php-fpm

nginx解析php
在service中加入{
	location ~* \.(jpg|jpeg|gif|png|css|js|ico|xml)$ {
	    access_log        off;
	    log_not_found     off;
	    expires           360d;
	}
	location ~ \.php$ {
	        root           /usr/share/nginx/html;
	        fastcgi_pass   127.0.0.1:9000;
	        fastcgi_index  index.php;
	        fastcgi_param  SCRIPT_FILENAME $document_root$fastcgi_script_name;
	        include        fastcgi_params;
	    }
	location ~ /\. {
	    access_log off;
	    log_not_found off;
	    deny all;
	}
}

MYSQL
CentOS7以上的版本采用mariadb替代了MySQL，因此安装mariadb。 
安装mariadb服务 
yum install mariadb mariadb-server mariadb-devel 
systemctl enable mariadb.service 
开机启动
systemctl start mariadb.service 
启动mysql
mysql_secure_installation 

mysql 开启远程连接
 
mysql -uusername -ppwd
use mysql 
update mysql.user set Host='%' where HOST='localhost' and User='root';
flush privileges;

修改root密码
mysql> use mysql; 
mysql> update user set password=password('root') where user='root'; 


重启防火墙
systemctl restart firewalld.service 
开启80端口
firewall-cmd --zone=public --add-port=80/tcp --permanent 

启动：# systemctl start  firewalld
firewall-cmd --add-service=ftp 开放ftp服务

查看状态：# systemctl status firewalld 或者 firewall-cmd --state

停止：# systemctl disable firewalld

禁用：# systemctl stop firewalld

查看所有打开的端口： firewall-cmd --zone=public --list-ports
更新防火墙规则：# firewall-cmd --reload
centost@QWE123 ftpuser