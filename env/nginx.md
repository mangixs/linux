安装必要的支持库
yum -y install gcc gcc-c++ wget
yum -y install gcc wget automake autoconf libtool libxml2-devel libxslt-devel perl-devel perl-ExtUtils-Embed pcre-devel openssl-devel
yum -y install nginx

systemctl start nginx.service  开机启动
查看是否可用 netstat –tap | grep nginx 

用ps aux来查看nginx是否启动
ps aux|grep nginx

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