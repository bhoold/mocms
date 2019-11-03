<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * @Author: Raven
 * @Date: 2019-10-31 19:40:14
 * @Last Modified by: Raven
 * @Last Modified time: 2019-11-04 00:31:33
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

	'index_field' => false,
	'index_pager' => false
);
