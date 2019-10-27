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
  <link rel="stylesheet" href="<?php echo getUrl('base')?>assets/admin/css/auth-login.css">



</head>
<body>



<div class="block login">


<h1><?php echo lang('login_heading');?></h1>
<!--
<p><?php echo lang('login_subheading');?></p>
-->
<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open($formUrl, array('id'=>'form','class'=>'layui-form','lay-filter'=>'form')); ?>

<div class="layui-form-item">
	<label class="layui-form-label" for="identity"><?php echo lang('login_identity_label');?></label>
	<div class="layui-input-block">
		<input class="layui-input" <?php echo _parse_form_attributes($identity,array());?> placeholder="<?php echo lang('login_identity_label_placeholder');?>" lay-verify="required" autocomplete="off">
	</div>
</div>
<div class="layui-form-item">
	<label class="layui-form-label" for="password"><?php echo lang('login_password_label');?></label>
	<div class="layui-input-block">
		<input class="layui-input" <?php echo _parse_form_attributes($password,array());?> placeholder="<?php echo lang('login_password_label_placeholder');?>" lay-verify="required" autocomplete="off">
	</div>
</div>
<div class="layui-form-item">
	<label class="layui-form-label"><?php echo lang('login_remember_label');?></label>
	<div class="layui-input-block">
		<input type="checkbox" name="remember" id="remember" value="1" title="<?php echo lang('login_remember_label_placeholder');?>" lay-skin="primary">
	</div>
</div>

<p class="forgot_password"><a href="forgot_password"><?php echo lang('login_forgot_password');?></a></p>

<div class="layui-btn-container text-right">
	<button class="layui-btn layui-btn-primary" lay-submit lay-filter="*"><?php echo lang('login_submit_btn');?></button>
</div>


<?php echo form_close();?>



</div>


<script src="<?php echo getUrl('base')?>assets/admin/layui/layui.js" charset="utf-8"></script>
<script>

layui.use('form', function(){
  var form = layui.form;

  //监听提交
  form.on('submit(*)', function(data){

    //layer.msg(JSON.stringify(data.field));
    return true;
  });


});
</script>
</body>
</html>
