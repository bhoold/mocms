<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>登录</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Loading Bootstrap -->
    <link href="<?php echo base_url();?>assets/dist/css/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/flat-ui.css" />

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="js/vendor/html5shiv.js"></script>
      <script src="js/vendor/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="login-screen">
          <?php echo form_open('',array('class' => 'login-form')); ?>
            <div class="has-error"><div class="help-block"><?php echo validation_errors(); ?></div></div>
            <div class="form-group">
              <input id="login-name" name="username" type="text" class="form-control login-field" placeholder="账号" value="<?php echo set_value('username'); ?>">
              <label class="login-field-icon fui-user" for="login-name"></label>
            </div>
            <div class="form-group">
              <input id="login-pass" name="password" type="password" class="form-control login-field" placeholder="密码" value="<?php echo set_value('password'); ?>">
              <label class="login-field-icon fui-lock" for="login-pass"></label>
            </div>
            <button class="btn btn-primary btn-lg btn-block">登录</button>
            </form>

    <!-- jQuery (necessary for Flat UI's JavaScript plugins) -->
    <script src="<?php echo base_url();?>assets/dist/js/vendor/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url();?>assets/dist/js/vendor/video.js"></script>
    <script src="<?php echo base_url();?>assets/dist/js/flat-ui.min.js"></script>
<style type="text/css">
.has-error{
  margin-bottom: 15px;
}
.has-error p{
  margin-bottom: 0;
}

</style>
  </body>
</html>
