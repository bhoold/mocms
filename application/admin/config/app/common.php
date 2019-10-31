<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * @Author: Raven
 * @Date: 2019-08-27 20:20:52
 * @Last Modified by: Raven
 * @Last Modified time: 2019-10-31 20:08:21
 */


$config = array(
	'page_template' => '/template', //页面模板
	'page_menu' => '', //头部菜单
	'page_title' => '', //当前模块菜单名称
	'page_message' => '', //页面消息

	//列表页面
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
								location.href = "'.getUrl('index').'";
							},
						';
					}
				)
			)
		)
	),
	'index_leftMenu' => array(), //左侧菜单
	'index_filter' => array(), //列表过滤器数据
	'index_field' => array(), //列表页字段,如果不需要列表设为false
	'index_list' => array(), //列表页列表数据
	'index_pager' => array( //分页,如果不需要分页设为false
		'count' => 0,
		'pageNum' => 1,
		'pageSize' => 10,
		'pagelimits' => [10, 20, 30, 40, 50]
	),

	//编辑页面
	'edit_tooles_btns' => array(),
	'edit_hideForm' => FALSE, //是否隐藏编辑表单
	'edit_formData' => array() //编辑数据
);
