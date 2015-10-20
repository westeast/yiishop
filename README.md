yiishop
=======

yiishop a multiuser mall like tmall and jd

数椐结构
目录结构


部署帮助:
1，配置xxxx.com  虚拟域名

现在只有后台，后台登录地址：http://xxxx.com/admin/manage/login


账号 admin 密码admin1234


apache 主机配置




<VirtualHost *:80>
DocumentRoot "D:\wamp\www\yiishop"
ServerName yii.com
<Directory "D:\wamp\www\yiishop">
       Options FollowSymLinks
       AllowOverride None
       Order allow,deny
       Allow from all
</Directory>
</VirtualHost>