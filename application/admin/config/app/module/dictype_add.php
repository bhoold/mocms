<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * @Author: Raven
 * @Date: 2019-11-04 18:39:59
 * @Last Modified by: Raven
 * @Last Modified time: 2019-11-05 14:15:12
 */


$config = array(
	'page_template' => '/dictype/edit',
	'page_title' => '新建字典类型',

	'edit_tooles_btns' => array(
		'left' => array(
			array(
				array(
					'text' => '保存',
					'action' => 'save',
					'domClass' => 'layui-btn-primary',
					'event' => function() {
						echo '
							save: function() {
								var value = $(this).data("value");
								$("#form input[name=\"_follow-action\"]").val("save");
								$("#form button[lay-submit]").trigger("click");
							},
						';
					}
				),
				array(
					'text' => '保存并关闭',
					'action' => 'save_close',
					'event' => function() {
						echo '
							save_close: function() {
								var value = $(this).data("value");
								$("#form input[name=\"_follow-action\"]").val("save_close");
								$("#form button[lay-submit]").trigger("click");
							},
						';
					}
				),
				array(
					'text' => '保存并新建',
					'action' => 'save_new',
					'event' => function() {
						echo '
							save_new: function() {
								var value = $(this).data("value");
								$("#form input[name=\"_follow-action\"]").val("save_new");
								$("#form button[lay-submit]").trigger("click");
							},
						';
					}
				),
				array(
					'text' => '取消',
					'action' => 'cancel',
					'event' => function() {
						echo '
							cancel: function() {
								location.href = "'.getUrl('index', 'index').'";
							},
						';
					}
				)
			)
		),
		'right' => array()
	),

);
