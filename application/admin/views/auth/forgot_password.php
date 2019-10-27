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
  <link rel="stylesheet" href="<?php echo getUrl('base')?>assets/admin/css/page-forgot_password.css">



</head>
<body>



<div class="block forgot_password">





<h1><?php echo lang('forgot_password_heading');?></h1>
<p class="subheading"><?php echo sprintf(lang('forgot_password_subheading'), $identity_label);?></p>

<div id="infoMessage"><?php echo $message;?></div>


<?php echo form_open("auth/forgot_password", array('id'=>'form','class'=>'layui-form','lay-filter'=>'form'));?>

<div class="layui-form-item">
	<label class="layui-form-label" for="<?php echo $identity['name'];?>"><?php echo (($type=='email') ? sprintf(lang('forgot_password_email_label'), $identity_label) : sprintf(lang('forgot_password_identity_label'), $identity_label));?></label>
	<div class="layui-input-block">
		<input class="layui-input" type="text" <?php echo _parse_form_attributes($identity,array());?> placeholder="<?php echo (($type=='email') ? sprintf(lang('forgot_password_email_label'), $identity_label) : sprintf(lang('forgot_password_identity_label'), $identity_label));?>" lay-verify="required" autocomplete="off">
	</div>
</div>
<div class="layui-btn-container text-right">
	<a class="layui-btn" href="login">取消</a>
	<button class="layui-btn layui-btn-primary" lay-submit lay-filter="*"><?php echo lang('forgot_password_submit_btn');?></button>
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
