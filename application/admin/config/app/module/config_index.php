<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * @Author: Raven
 * @Date: 2019-10-31 19:40:14
 * @Last Modified by: Raven
 * @Last Modified time: 2019-11-04 00:36:26
 */


$config = array(
	'page_template' => '/config/index',

	'index_tooles_btns' => array(
		'left' => array(
			array(
				array(
					'text' => '保存',
					'action' => 'add',
					'domClass' => 'layui-btn-primary',
					'event' => function() {
						echo '
							add: function() {
								location.href = "'.getUrl('index','create_user').'";
							},
						';
					}
				)
			)
		),
		'right' => array()
	),

	'index_leftMenu' => array(
		array(
			'title' => '全局设置',
			'link' => '/config',
			'active' => 'active'
		),
		array(
			'title' => '数据字典',
			'link' => '/config/',
			'active' => ''
		),
		array(
			'title' => '字典类型',
			'link' => '/config',
			'active' => ''
		),

	), //左侧菜单

	'index_field' => false,
	'index_pager' => false
);
