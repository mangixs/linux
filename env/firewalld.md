contos 7的防火墙
开启80端口
 

firewall-cmd --zone=public --add-port=80/tcp --permanent 


出现success表明添加成功

 

命令含义：

--zone #作用域

--add-port=80/tcp  #添加端口，格式为：端口/通讯协议

--permanent   #永久生效，没有此参数重启后失效

重启防火墙
 

systemctl restart firewalld.service 


1、运行、停止、禁用firewalld

启动：# systemctl start  firewalld

查看状态：# systemctl status firewalld 或者 firewall-cmd --state

停止：# systemctl disable firewalld

禁用：# systemctl stop firewalld

 查看所有打开的端口： firewall-cmd--zone=public --list-ports

2、配置firewalld

查看版本：$ firewall-cmd --version

查看帮助：$ firewall-cmd --help

查看设置：

显示状态：$ firewall-cmd --state

查看区域信息: $ firewall-cmd --get-active-zones

查看指定接口所属区域：$ firewall-cmd --get-zone-of-interface=eth0

拒绝所有包：# firewall-cmd --panic-on

取消拒绝状态：# firewall-cmd --panic-off

查看是否拒绝：$ firewall-cmd --query-panic

 

更新防火墙规则：# firewall-cmd --reload

# firewall-cmd --complete-reload

两者的区别就是第一个无需断开连接，就是firewalld特性之一动态添加规则，第二个需要断开连接，类似重启服务

 

将接口添加到区域，默认接口都在public

# firewall-cmd --zone=public --add-interface=eth0

永久生效再加上 --permanent 然后reload防火墙

 

设置默认接口区域

# firewall-cmd --set-default-zone=public

立即生效无需重启

 

打开端口（貌似这个才最常用）

查看所有打开的端口：

# firewall-cmd --zone=dmz --list-ports

加入一个端口到区域：

# firewall-cmd --zone=dmz --add-port=8080/tcp

若要永久生效方法同上

 

打开一个服务，类似于将端口可视化，服务需要在配置文件中添加，/etc/firewalld 目录下有services文件夹，这个不详细说了，详情参考文档

# firewall-cmd --zone=work --add-service=smtp

 

移除服务

# firewall-cmd --zone=work --remove-service=smtp



linux开启80端口
查看已经开启的端口netstat -anp

修改/etc/sysconfig/iptables文件，增加如下一行：　　

-A INPUT -m state –state NEW -m tcp -p tcp –dport 22 -j ACCEPT 
-A INPUT -m state –state NEW -m tcp -p tcp –dport 80 -j ACCEPT 
-A INPUT -m state –state NEW -m tcp -p tcp –dport 3306 -j ACCEPT 

重启 iptables

service iptables restart