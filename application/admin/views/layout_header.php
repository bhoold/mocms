<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html dir="ltr" lang="zh-cn">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>系统后台管理</title>
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="format-detection" content="telephone=no">

	<link rel="stylesheet" href="<?php echo getUrl('base')?>assets/admin/layui/css/layui.css"  media="all">
	<link rel="stylesheet" href="<?php echo getUrl('base')?>assets/admin/css/layout.css"  media="all">

	<script src="<?php echo getUrl('base')?>assets/admin/layui/layui.js" charset="utf-8"></script>
	<script>
		layui.config({
			base: '<?php echo getUrl('base')?>assets/admin/layui/component/' //假设这是你存放拓展模块的根目录
		}).extend({ //设定模块别名
			alert: 'alert/alert'
		});
	</script>

</head>
<body>
<div id="header">
	<div class="logo"><a href="<?php echo getUrl('index');?>">系统后台管理</a></div>
	<div class="nav">
		<div class="item">
			<a>系统</a>
			<div class="list layui-hide">
				<a class="item" href="">首页</a>
				<a class="item" href="">全局设置</a>
				<a class="item" href="">清理缓存</a>
				<a class="item" href="">系统信息</a>
			</div>
		</div>
		<div class="item">
			<a>菜单</a>
			<div class="list layui-hide">
				<a class="item" href="<?php echo getUrl('index','/menus/index');?>">菜单</a>
				<a class="item" href="<?php echo getUrl('index','/menusItem/index');?>">菜单项</a>
			</div>
		</div>
		<div class="item">
			<a>用户</a>
			<div class="list layui-hide">
				<a class="item" href="<?php echo getUrl('index','/auth/index');?>">用户</a>
				<a class="item" href="<?php echo getUrl('index','/auth/groupList');?>">用户组</a>
			</div>
		</div>
		<div class="item">
			<a>内容</a>
			<div class="list layui-hide">
				<a class="item" href="<?php echo getUrl('index','/tableModel/index');?>">数据模型</a>
				<a class="item" href="<?php echo getUrl('index','/viewTemplet/index');?>">页面模板</a>
				<a class="item" href="<?php echo getUrl('index','/module/index');?>">功能模块</a>
			</div>
		</div>
		<div class="item">
			<a>附件</a>
		</div>
	</div>
	<!--
	<div class="icon-container">
	<button class="name layui-btn" title="设置"><i class="layui-icon layui-icon-set-fill"></i></button>
	<button class="name layui-btn" title="帮助"><i class="layui-icon layui-icon-help"></i></button>
	</div>
	-->
	<div class="person">
		<button class="name layui-btn" title="账号"><?php echo getCurUser('username');?></button>
		<div class="list layui-hide">
			<h4 class="title"><i class="layui-icon layui-icon-username"></i> 个人中心</h4>
			<a class="item" href="<?php echo getUrl('index','/auth/change_password');?>">修改密码</a>
			<a class="item" href="<?php echo getUrl('index','/auth/logout');?>">退出登录</a>
		</div>
	</div>
</div>
<script>


layui.use(['form','layer','alert'], function(){
	var $ = layui.jquery,
		form = layui.form;

	$(document).on('click', function() {
		$('#header .nav > .item .list').addClass('layui-hide');
		$('#header .person .list').addClass('layui-hide');
	});


	$('#header .nav > .item > a').on('click', function(event) {
		$currentlist = $(this).siblings('.list');
		$currentlist.toggleClass('layui-hide');

		$('#header .person .list').addClass('layui-hide');

		$('#header .nav > .item .list').each(function() {
			if(this != $currentlist[0]) {
				$(this).addClass('layui-hide');
			}
		});
		event.stopPropagation();
	}).on('mouseover', function() {
		$currentlist = $(this).siblings('.list');
		if(!$currentlist.hasClass('layui-hide')) {
			return;
		}
		$('#header .nav > .item .list').each(function() {
			if(this != $currentlist[0]) {
				if(!$(this).hasClass('layui-hide')) {
					$(this).addClass('layui-hide')
					$currentlist.removeClass('layui-hide');
				}
			}
		});
	});

	$('#header .person button.name').on('click', function(event) {
		$(this).siblings('.list').toggleClass('layui-hide');
		$('#header .nav > .item .list').addClass('layui-hide');
		event.stopPropagation();
	});



});
</script>
<div id="body">
