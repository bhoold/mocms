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

		var BASEURL = '<?php echo getUrl('base')?>';
	</script>

	<link rel="stylesheet" href="<?php echo getUrl('base')?>assets/admin/malihu-custom-scrollbar-plugin-3.1.5/jquery.mCustomScrollbar.css" />
	<script charset="utf-8" src="<?php echo getUrl('base')?>assets/admin/malihu-custom-scrollbar-plugin-3.1.5/js/minified/jquery-1.11.0.min.js"></script>
	<script charset="utf-8" src="<?php echo getUrl('base')?>assets/admin/malihu-custom-scrollbar-plugin-3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

</head>
<body>
<div id="body">
