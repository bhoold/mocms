#mocms 简单的内容管理系统


##介绍
mocms是用CodeIgniter框架搭建的内容管理系统，界面参考Joomla!布局方式。
RBAC权限控制

##安装
* application/admin/config/database.php修改数据库连接信息
* application/admin/config/config.php修改$config['base_url']
* application/site/config/config.php修改$config['sess_save_path']




##代码中用到的框架和库
* [layui](https://www.layui.com) - UI
* [CodeIgniter](https://codeigniter.org.cn) - web
* [Ion Auth](http://benedmunds.com/ion_auth/) - 身份验证
