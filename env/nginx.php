<?php
// 下载对应当前系统版本的nginx包(package)
// wget  http://nginx.org/packages/centos/7/noarch/RPMS/nginx-release-centos-7-0.el7.ngx.noarch.rpm
// 建立nginx的yum仓库
// rpm -ivh nginx-release-centos-7-0.el7.ngx.noarch.rpm
// 下载并安装nginx
// yum install nginx
// 启动nginx服务
// systemctl start nginx
#
#新建文件夹，复制下载window版nginx文件到文件夹，双击nginx.exe就安装成功了
#访问loaclhost出现欢迎页就表示安装成功了；

#nginx.conf配置
// location / {
//        root   D:\www; //web站点目录
//        index  index.html index.htm index.php;
//    }
// location ~ \.php$ { //接入php解析
//        root           D:\www;
//        fastcgi_pass   127.0.0.1:9000;
//        fastcgi_index  index.php;
//        fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
//        include        fastcgi_params;
//    }

#隐藏index.php
#location / {
#      if (!-e $request_filename) {
#一级目录
# rewrite ^/(.*)$ /index.php/$1 last;
#二级目录
#               rewrite ^/MYAPP/(.*)$ /MYAPP/index.php/$1 last;
#         }
#}
#该应用在ci框架中无效

#复制RunHiddenConsole.exe到C:\php和C:\nginx下，在C:下新建两文本文档，并分别命名start_nginx.bat和stop_nginx.bat。
#双击start_nginx.bat启动服务进程；双击stop_nginx.bat 文件为关闭服务进程。

#start_nginx_php-cgi.bat

#@echo off
#set php_home=C:/php  php 和 nginx 安装路径
#set nginx_home=C:/nginx

#REM Windows 下无效
#REM set PHP_FCGI_CHILDREN=5

#REM 每个进程处理的最大请求数，或设置为 Windows 环境变量
#set PHP_FCGI_MAX_REQUESTS=1000

#echo Starting PHP FastCGI...
#RunHiddenConsole %php_home%/php-cgi.exe -b 127.0.0.1:9000 -c %php_home%/php.ini

#echo Starting nginx...
#RunHiddenConsole %nginx_home%/nginx.exe -p %nginx_home%

#stop_nginx_php-cgi.bat

#@echo off
#echo Stopping nginx...
#taskkill /F /IM nginx.exe > nul
#echo Stopping PHP FastCGI...
#taskkill /F /IM php-cgi.exe > nul
#exit

#nginx -t
#如果返回ok,用  -s reload 重新加载配置文件
#
#
#
#---------------------------------------------------------------------------------
# yum -y install gcc zlib zlib-devel pcre-devel openssl openssl-devel
# cd /usr/local
# mkdir nginx
# cd nginx
# wget http://nginx.org/download/nginx-1.14.0.tar.gz //去nginx网站上看最新的稳定版地址
# tar -xvf nginx-1.13.7.tar.g
/*
cd /usr/local/nginx
./configure
make && make install
启动
cd nignx/sbin
sudo ./nginx
-------------------------------------------------------------------------------------

centos 7以上是用Systemd进行系统初始化的，Systemd 是 Linux 系统中最新的初始化系统（init），它主要的设计目标是克服 sysvinit 固有的缺点，提高系统的启动速度。关于Systemd的详情介绍在这里。

Systemd服务文件以.service结尾，比如现在要建立nginx为开机启动，如果用yum install命令安装的，yum命令会自动创建nginx.service文件，直接用命令

1
systemcel enable nginx.service
设置开机启动即可。
在这里我是用源码编译安装的，所以要手动创建nginx.service服务文件。
开机没有登陆情况下就能运行的程序，存在系统服务（system）里，即：

1
/lib/systemd/system/
1.在系统服务目录里创建nginx.service文件
1
vi /lib/systemd/system/nginx.service
内容如下

[Unit]
Description=nginx
After=network.target

[Service]
Type=forking
ExecStart=/usr/local/nginx/sbin/nginx
ExecReload=/usr/local/nginx/sbin/nginx -s reload
ExecStop=/usr/local/nginx/sbin/nginx -s quit
PrivateTmp=true

[Install]
WantedBy=multi-user.target

[Unit]:服务的说明
Description:描述服务
After:描述服务类别
[Service]服务运行参数的设置
Type=forking是后台运行的形式
ExecStart为服务的具体运行命令
ExecReload为重启命令
ExecStop为停止命令
PrivateTmp=True表示给服务分配独立的临时空间
注意：[Service]的启动、重启、停止命令全部要求使用绝对路径
[Install]运行级别下服务安装的相关设置，可设置为多用户，即系统运行级别为3

保存退出。

2.设置开机启动
1
systemctl enable nginx.service
3.其他命令
启动nginx服务

1
systemctl start nginx.service
设置开机自启动

1
systemctl enable nginx.service
停止开机自启动

1
systemctl disable nginx.service
查看服务当前状态

1
systemctl status nginx.service
重新启动服务

1
systemctl restart nginx.service
查看所有已启动的服务

1
systemctl list-units --type=service
 */
