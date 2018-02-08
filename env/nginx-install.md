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
