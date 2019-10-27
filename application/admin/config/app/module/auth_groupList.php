<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * @Author: Raven
 * @Date: 2019-08-27 15:19:44
 * @Last Modified by: Raven
 * @Last Modified time: 2019-09-28 13:11:54
 */


$config = array(
	'page_template' => '/list',
	'page_title' => '用户组管理',

	'index_tooles_btns' => array(
		'left' => array(
			array(
				array(
					'text' => '新建',
					'action' => 'add',
					'domClass' => 'layui-btn-primary',
					'event' => function() {
						echo '
							add: function() {
								location.href = "'.getUrl('index','create_group').'";
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
									location.href = "'.getUrl('index','edit_group/').'" + id;
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
		'right' => array()
	),

	'index_leftMenu' => array(
		array(
			'title' => '后台用户',
			'link' => 'auth/index',
			'active' => ''
		),
		array(
			'title' => '后台用户组',
			'link' => 'auth/groupList',
			'active' => 'active'
		),
		array(
			'title' => '前台用户',
			'link' => 'user/index',
			'active' => ''
		),
		array(
			'title' => '前台用户组',
			'link' => 'user/groupList',
			'active' => ''
		)
	), //左侧菜单

	'index_filter' => array( //列表过滤器数据
		array(
			'type' => 'text',
			'label' => '组名称',
			'name' => 'name',
			'value' => '',
			'pattern' => 'like'
		)

	),

	'index_field' => array(
		array(
			'type' => 'checkbox',
			'fixed' => 'left'
		),
		array(
			'field' => 'id',
			'label' => 'ID',
			'width' => '80'
		),
		array(
			'field' => 'name',
			'label' => '组名称',
			'width' => '200'
		),
		array(
			'field' => 'description',
			'label' => '组描述',
			'minWidth' => '500'
		),

	)
);
