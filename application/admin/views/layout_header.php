<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html dir="ltr" lang="zh-cn">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>网站后台管理</title>
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
	<div class="logo"><a href="<?php echo getUrl('index');?>">网站后台管理</a></div>
	<div class="nav">
		<div class="item">
			<a href="">系统</a>
		</div>
		<div class="item">
			<a href="<?php echo getUrl('index','/auth');?>">后台用户</a>
		</div>
		<div class="item">
			<a href="">内容</a>
		</div>
		<div class="item">
			<a href="">文件</a>
		</div>
	</div>
	<!--
	<div class="icon-container">
	<button class="name layui-btn" title="设置"><i class="layui-icon layui-icon-set-fill"></i></button>
	<button class="name layui-btn" title="帮助"><i class="layui-icon layui-icon-help"></i></button>
	</div>
	-->
	<div class="person">
		<button class="name layui-btn" title="账户">我是大佬虎</button>
	</div>
</div>
<div id="body">
