<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * @Author: Raven
 * @Date: 2019-11-04 18:39:59
 * @Last Modified by: Raven
 * @Last Modified time: 2019-11-16 13:38:01
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
								location.href = "'.getUrl('index','add').'/" + PAGEVAR.GET.tableName;
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
			'link' => '/dbtable',
			'active' => 'active'
		),
		array(
			'title' => '备份',
			'link' => '/dbbackup',
			'active' => ''
		),

	), //左侧菜单

	'index_field' => array(
		array(
			'type' => 'checkbox',
			'fixed' => 'left'
		),
		array(
			'field' => 'Field',
			'label' => 'Field',
			'width' => '250'
		),
		array(
			'field' => 'Type',
			'label' => 'Type',
			'width' => '250'
		),
		array(
			'field' => 'Null',
			'label' => 'Null',
			'width' => '100'
		),
		array(
			'field' => 'Key',
			'label' => 'Key',
			'width' => '100'
		),
		array(
			'field' => 'Default',
			'label' => 'Default',
			'width' => '300'
		),
		array(
			'field' => 'Extra',
			'label' => 'Extra',
			'width' => '500'
		)
	),
	'index_pager' => false
);
