<?php defined('BASEPATH') OR exit('No direct script access allowed');?><!DOCTYPE html>
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
	<script src="<?php echo getUrl('base')?>assets/admin/layui/layui.js" charset="utf-8"></script>
<style>
#body-container{
	padding: 15px;
}
#body-container>h2{
	margin-bottom: 10px;
}
</style>
</head>
<body class="layui-layout-body">
<div class="layui-layout layui-layout-admin">
  <div class="layui-header">
    <div class="layui-logo">网站后台管理</div>
    <!-- 头部区域（可配合layui已有的水平导航） -->

    <ul class="layui-nav layui-layout-right">
      <li class="layui-nav-item">
        <a><?php echo getCurUser('username');?></a>
        <dl class="layui-nav-child">
          <dd><a href="">修改密码</a></dd>
        </dl>
      </li>

    </ul>
  </div>
