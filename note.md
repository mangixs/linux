磁盘分隔  / 	/boot	/usr		/home	/var 		五种
文件名的开头为小数点『.』时， 代表这个档案 为『隐藏档』

文件目录
 /etc：配置文件  /bin：重要执行档  /dev：所需要的装置档案  /lib：执行档所需的函式库不核心所需的模块  /sbin：重要的系统执行文件
，/usr 里面放置的数据属二可分享的不丌可变劢的(shareable, static)，usr 是 Unix Software Resource 的缩写， 也就是『Unix 操作系统软件资源』所放置的目彔，
/var 就是在系统运作后才会渐渐占用硬盘容量的目 彔。
/boot：开机配置文件，
/etc/：几乎系统的所有配置文件案均在此，
/dev：摆放所有系统装置档案的目彔

文件目录
. 代表此层目弽
.. 代表上一层目弽
- 代表前一个工作目弽
~ 代表『目前用户身份』所在癿家目弽
~account 代表 account 这个用户癿家目弽(account 是个账号名称)
 
文件权限
 r (read)：可读取此一档案的实际内容，如读取文本文件的文字内容等； 
 w (write)：可以编辑、新增戒者是修改该档案的内容(但丌吨删除该档案)； 
 x (eXecute)：该档案具有可以被系统执行的权限。
Linux 档案的基本权限就有九个，分别是 owner/group/others 三种身份各有自己的 read/write/execute 权限， 先复习一下刚刚上面提到的数据：档案的权限字符为：『- rwxrwxrwx』， 这九个权限是三个三个一组的！其中，我们可以使用数字来代表各个权限，各 权限的分数对照表如下： r:4 w:2 x:1 每种身份(owner/group/others)各自的三个权限(r/w/x)分数是需要累加的，例如当权限为： [- rwxrwx---] 分数则是： owner = rwx = 4+2+1 = 7 group = rwx = 4+2+1 = 7 others= --- = 0+0+0 = 0

Linux 指令
[Tab] 接在一串挃令的第一个字的后面，则为命令补全；  [Tab] 接在一串挃令的第二个字以后时，则为『档案补齐』！
[Ctrl]-d 按键 输入结束命令

RPM格式软件包的安装 

1.简介 
几乎所有的Linux发行版本都使用某种形式的软件包管理安装、更新和卸载软件。与直接从源代码安装相比，软件包管理易于安装和卸载；易于更新已安装的软件包；易于保护配置文件；易于跟踪已安装文件。

RPM全称是Red Hat Package Manager（Red Hat包管理器）。RPM本质上就是一个包，包含可以立即在特定机器体系结构上安装和运行的Linux软件。RPM示意图见图1。

大多数Linux RPM软件包的命名有一定的规律，它遵循名称-版本-修正版-类型－MYsoftware-1.2 -1.i386.rpm 。 

2.安装RPM包软件 
＃　rpm -ivh MYsoftware-1.2 -1.i386.rpm 

RPM命令主要参数： 

-i 安装软件。 
-t 测试安装，不是真的安装。 
-p 显示安装进度。 
-f 忽略任何错误。 
-U 升级安装。 
-v 检测套件是否正确安装。 


这些参数可以同时采用。更多的内容可以参考RPM的命令帮助。 

3.卸载软件 
＃　rpm -e 软件名 

需要说明的是，上面代码中使用的是软件名，而不是软件包名。例如，要卸载software-1.2.-1.i386.rpm这个包时，应执行： 
＃rpm -e software 
4.强行卸载RPM包 
有时除去一个RPM是不行的，尤其是系统上有别的程序依赖于它的时候。如果执行命令会显示如下错误信息： 

＃# rpm -e xsnow 
error: removing these packages would break dependencies: 
/usr/X11R6/bin/xsnow is needed by x-amusements-1.0-1 


在这种情况下，可以用--force选项重新安装xsnow： 

＃# rpm -ivh --force xsnow-1.41-1.i386.rpm 
xsnow 


这里推荐使用工具软件Kleandisk，用它可以安全彻底清理掉不再使用的RPM包。 

5.安装.src.rpm类型的文件 
目前RPM有两种模式，一种是已经过编码的（i386.rpm），一种是未经编码的（src.rpm）。 
rpm --rebuild Filename.src.rpm 

这时系统会建立一个文件Filenamr.rpm，在/usr/src/redflag/RPMS/子目录下，一般是i386，具体情况和Linux发行版本有关。然后执行下面代码即可：
rpm -ivh /usr/src/regflag/RPMS/i386/Filename.rpm 

使用deb打包的软件安装 

deb是Debian Linux提供的一个包管理器，它与RPM十分类似。但由于RPM出现得早，并且应用广泛，所以在各种版本的Linux中都常见到，而Debian的包管 理器dpkg只出现在Debina Linux中。它的优点是不用被严格的依赖性检查所困扰，缺点是只在Debian Linux发行版中才能见到这个包管理工具。

1. 安装 
＃　dpkg -i MYsoftware-1.2.-1.deb 

2. 卸载 
＃　dpkg -e MYsoftware 

使用源代码进行软件安装 

和RPM安装方式相比，使用源代码进行软件安装会复杂一些，但是用源代码安装软件是Linux下进行软件安装的重要手段，也是运行Linux的最主要 的优势之一。使用源代码安装软件，能按照用户的需要选择定制的安装方式进行安装，而不是仅仅依靠那些在安装包中的预配置的参数选择安装。另外，仍然有一些 软件程序只能从源代码处进行安装。

现在有很多地方都提供源代码包，到底在什么地方获得取决于软件的特殊需要。对于那些使用比较普遍的软件，如Sendmail，可以从商业网站处下载源 代码软件包（如http://www.sendmail.org ）。一般的软件包，可从开发者的Web站点下载。下面介绍一下安装步骤：

1.解压数据包 
源代码软件通常以.tar.gz做为扩展名,也有tar.Z、tar.bz2或.tgz为扩展名的。不同扩展名解压缩命令也不相同，见表1。 


2.编译软件 
成功解压缩源代码文件后，进入解包的目录。在安装前阅读Readme文件和Install文件。尽管许多源代码文件包都使用基本相同的命令，但是有时 在阅读这些文件时能发现一些重要的区别。例如，有些软件包含一个可以安装的安装脚本程序（.sh）。在安装前阅读这些说明文件，有助于安装成功和节约时 间。

在安装软件以前要成为root用户。实现这一点通常有两种方式：在另一台终端以root用户登录，或者输入“su”，此时系统会提示输入root用户的密码。输入密码以后，就将一直拥有root用户的权限。如果已经是root用户，那就可以进行下一步。

通常的安装方法是从安装包的目录执行以下命令： 

gunzip soft1.tar.gz 
cd soft1 
＃. /configure ＃配置＃ 
make ＃调用make＃ 
make install ＃安装源代码＃ 


删除安装时产生的临时文件： 
＃make clean 

卸载软件： 
＃make uninstall 

有些软件包的源代码编译安装后可以用make uninstall命令卸载。如果不提供此功能，则软件的卸载必须手动删除。由于软件可能将文件分散地安装在系统的多个目录中，往往很难把它删除干净，应该在编译前进行配置。