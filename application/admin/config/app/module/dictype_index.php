<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * @Author: Raven
 * @Date: 2019-11-04 18:39:59
 * @Last Modified by: Raven
 * @Last Modified time: 2019-11-05 14:18:33
 */


$config = array(
	'page_template' => '/list',
	'page_title' => '字典类型',
	'index_tooles_btns' => array( //按钮
		'left' => array(
			array(
				array(
					'text' => '新建',
					'action' => 'add',
					'domClass' => 'layui-btn-primary',
					'event' => function() {
						echo '
							add: function() {
								location.href = "'.getUrl('index','add').'";
							},
						';
					}
				),
				array(
					'text' => '编辑',
					'action' => 'edit',
					'event' => function() {
						echo '
							edit: function() {
								var checkStatus = table.checkStatus("listTable");
								if(checkStatus.data.length){
									var id = checkStatus.data[0].id;
									location.href = "'.getUrl('index','edit/').'" + id;
								}else{
									layer.msg("请从列表选择数据", {icon: 5, shift: 6});
								}
							},
						';
					}
				),
				array(
					'text' => '删除',
					'action' => 'del',
					'event' => function() {
						echo '
							del: function() {
								var checkStatus = table.checkStatus("listTable");
								if(checkStatus.data.length){
									layer.confirm("是否删除所选数据?", function() {
										var ids = [];
										layui.each(checkStatus.data, function(index, item){
											ids.push(item.id);
										});

										$("#main .list-filter form").prepend("<input type=\"hidden\" name=\"_action\" value=\"delete\" /><input type=\"hidden\" name=\"_action_id\" value=\""+ids.join(",")+"\" />");

										$("#main .list-filter form").data("isSavePage", true);
										$("#main .list-filter form button[lay-submit]").trigger("click");
									});
								}else{
									layer.msg("请从列表选择数据", {icon: 5, shift: 6});
								}
							},
						';
					}
				)
			)
		),
		'right' => array(
			array(
				array(
					'text' => '设置',
					'action' => 'setup',
					'event' => function() {
						echo '
							setup: function() {
								location.href = "'.getUrl('index', 'setup').'";
							},
						';
					}
				)
			)
		)
	),
	'index_leftMenu' => array(
		array(
			'title' => '数据字典',
			'link' => '/dictinfo',
			'active' => ''
		),
		array(
			'title' => '字典类型',
			'link' => '/dictype',
			'active' => 'active'
		),

	), //左侧菜单

);
