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



配置MariaDB的字符集
设置客户端：

vim /etc/my.cnf.d/mysql-clients.cnf

[mysql]
default-character-set=utf8
1
2
3
4
5
设置服务端：

vim /etc/my.cnf.d/server.cnf

[mysqld]
init_connect='SET collation_connection = utf8_general_ci'
init_connect='SET NAMES utf8'
character-set-server=utf8
collation-server=utf8_general_ci
skip-character-set-client-handshake

#开启慢查询
slow_query_log = ON
slow_query_log_file = /usr/local/mysql/data/slow.log
long_query_time = 1
