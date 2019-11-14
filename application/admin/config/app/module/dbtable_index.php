<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * @Author: Raven
 * @Date: 2019-11-04 18:39:59
 * @Last Modified by: Raven
 * @Last Modified time: 2019-11-10 01:06:44
 */


$config = array(
	'page_template' => '/list',
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
									var id = checkStatus.data[0].Name;
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
											ids.push(item.Name);
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
			),
			array(
				array(
					'text' => '结构',
					'action' => 'structure',
					'event' => function() {
						echo '
							structure: function() {
								var checkStatus = table.checkStatus("listTable");
								if(checkStatus.data.length){
									var id = checkStatus.data[0].Name;
									location.href = "'.getUrl('index','edit/').'" + id;
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
			'title' => '数据表',
			'link' => '/dictinfo',
			'active' => 'active'
		),
		array(
			'title' => '备份',
			'link' => '/dictype',
			'active' => ''
		),

	), //左侧菜单

	'index_field' => array(
		array(
			'type' => 'checkbox',
			'fixed' => 'left'
		),
		array(
			'field' => 'Name',
			'label' => 'Name',
			'width' => '300'
		),
		array(
			'field' => 'Engine',
			'label' => 'Engine',
			'width' => '100'
		),
		array(
			'field' => 'Collation',
			'label' => 'Collation',
			'width' => '150'
		),
		array(
			'field' => 'Rows',
			'label' => 'Rows',
			'width' => '100'
		),
		array(
			'field' => 'Auto_increment',
			'label' => 'Auto_increment',
			'width' => '150'
		),
		array(
			'field' => 'Comment',
			'label' => 'Comment',
			'width' => '200'
		),
		array(
			'field' => 'Create_time',
			'label' => 'Create_time',
			'width' => '200'
		),
		array(
			'field' => 'Update_time',
			'label' => 'Update_time',
			'width' => '200'
		)
	),
	'index_pager' => false
);
