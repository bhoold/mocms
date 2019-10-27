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
	'page_title' => '',

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
								location.href = "'.getUrl('index','create_user').'";
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
									location.href = "'.getUrl('index','edit_user/').'" + id;
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
			),
			array(
				array(
					'text' => '停用',
					'action' => 'deactivate',
					'event' => function() {
						echo '
							deactivate: function() {
								var checkStatus = table.checkStatus("listTable");
								if(checkStatus.data.length){
									layer.confirm("所选数据将设为停用状态?", function() {
										var ids = [];
										layui.each(checkStatus.data, function(index, item){
											ids.push(item.id);
										});

										$("#main .list-filter form").prepend("<input type=\"hidden\" name=\"_action\" value=\"deactivate\" /><input type=\"hidden\" name=\"_action_id\" value=\""+ids.join(",")+"\" />");

										$("#main .list-filter form").data("isSavePage", true);
										$("#main .list-filter form button[lay-submit]").trigger("click");
									});
								}else{
									layer.msg("请从列表选择数据", {icon: 5, shift: 6});
								}
							},
						';
					}
				),
				array(
					'text' => '启用',
					'action' => 'activate',
					'event' => function() {
						echo '
							activate: function() {
								var checkStatus = table.checkStatus("listTable");
								if(checkStatus.data.length){
									layer.confirm("所选数据将设为启用状态?", function() {
										var ids = [];
										layui.each(checkStatus.data, function(index, item){
											ids.push(item.id);
										});

										$("#main .list-filter form").prepend("<input type=\"hidden\" name=\"_action\" value=\"activate\" /><input type=\"hidden\" name=\"_action_id\" value=\""+ids.join(",")+"\" />");

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
			'active' => 'active'
		),
		array(
			'title' => '后台用户组',
			'link' => 'auth/groupList',
			'active' => ''
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
			'label' => '账号',
			'name' => 'username',
			'value' => '',
			'pattern' => 'like'
		),
		array(
			'type' => 'text',
			'label' => '邮箱',
			'name' => 'email',
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
			'field' => 'username',
			'label' => '账号',
			'width' => '200'
		),
		array(
			'field' => 'email',
			'label' => '邮箱',
			'width' => '250'
		),
		array(
			'field' => 'group',
			'label' => '用户组',
			'width' => '250',
			'value' => array(
				'type' => 'function',
				'function' => function($item) {
					$str = '';
					foreach ($item['groups'] as $key =>$group) {
						$break = ', ';
						if(count($item['groups']) == $key+1) {
							$break = '';
						};
						$str .= htmlspecialchars($group->name,ENT_QUOTES,'UTF-8').$break;
					}
					return $str;
				}
			)
		),
		array(
			'field' => 'active',
			'label' => '状态',
			'minWidth' => '80',
			'value' => array(
				'type' => 'function',
				'function' => function ($item) {
					return $item['active'] ? '正常' : '停用';
				}
			)
		),

	)
);
