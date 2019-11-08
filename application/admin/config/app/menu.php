<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * @Author: Raven
 * @Date: 2019-08-27 20:20:52
 * @Last Modified by: Raven
 * @Last Modified time: 2019-11-08 17:11:25
 */


$config = array(
	array(
		'title'	=>	'系统',
		'child'	=>	array(
			array(
				'title'	=>	'首页',
				'link'	=>	'/dashboard'
			),
			array(
				'title'	=>	'设置',
				'link'	=>	'/config'
			),
			array(
				'title'	=>	'缓存',
				'link'	=>	'/cache'
			),
		),
	),/*
	array(
		'title'	=>	'菜单',
		'child'	=>	array(
			array(
				'title'	=>	'菜单',
				'link'	=>	'/menu'
			),
			array(
				'title'	=>	'菜单组',
				'link'	=>	'/menugroup'
			),
			array(
				'title'	=>	'菜单项',
				'link'	=>	'/menuitem'
			),
		),
	),*/
	array(
		'title'	=>	'数据字典',
		'link'	=>	'/dictinfo'
	),
	array(
		'title'	=>	'数据库',
		'link'	=>	'/dbmanage'
	),
	array(
		'title'	=>	'用户',
		'child'	=>	array(
			array(
				'title'	=>	'后台用户',
				'link'	=>	'/auth/index',
				'child' => array(
					array(
						'title'	=>	'新建用户',
						'link'	=>	'/auth/create_user',
					)
				)
			),
			array(
				'title'	=>	'后台用户组',
				'link'	=>	'/auth/groupList',
				'child' => array(
					array(
						'title'	=>	'新建用户组',
						'link'	=>	'/auth/create_group',
					)
				)
			),
			array(
				'title'	=>	'前台用户',
				'link'	=>	'/user',
				'child' => array(
					array(
						'title'	=>	'新建用户',
						'link'	=>	'/user/create',
					)
				)
			),
			array(
				'title'	=>	'前台用户组',
				'link'	=>	'/usergroup',
				'child' => array(
					array(
						'title'	=>	'新建用户组',
						'link'	=>	'/usergroup/create',
					)
				)
			),
		),
	),
	array(
		'title'	=>	'内容',
		'child'	=>	array(
			array(
				'title'	=>	'数据模型',
				'link'	=>	'/datamodel'
			),
			array(
				'title'	=>	'页面模板',
				'link'	=>	'/pagetmpl'
			),
			array(
				'title'	=>	'功能模块',
				'link'	=>	'/funcmodule'
			),

		),
	),
	array(
		'title'	=>	'文件',
		'link'	=>	'/attachment'
	),
	/*
	array(
		'title'	=>	'行政区域',
		'link'	=>	'/region'
	),*/
	array(
		'title'	=>	'站点',
		'link'	=>	'/website'
	),
);
