<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>首页</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Loading Bootstrap -->
    <link href="<?php echo base_url();?>assets/dist/css/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


    <link rel="stylesheet/less" type="text/css" href="<?php echo base_url();?>assets/less/flat-ui.less" />
    
    <script src="/winapp/less.js-master/dist/less.js" type="text/javascript"></script>
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/dist/img/favicon.ico">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="js/vendor/html5shiv.js"></script>
      <script src="js/vendor/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <!-- Static navbar -->
    <div class="navbar navbar-inverse navbar-static-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
          </button>
          <a class="navbar-brand">后台管理</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="#">栏目</a></li>
            <li><a href="#about">模块</a></li>
            <li class="active"><a href="#contact">表单</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">更多 <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">超级管理员<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">我的资料</a></li>
                <li><a href="#">修改密码</a></li>
                <li><a href="#">退出登录</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>


<div class="container">
<div class="row">
  <div class="col-md-3">
    <ul class="nav">
      <li>网站设置</li>
      <li>产品</li>
      <li>新闻</li>
    </ul>
  </div>
  <div class="col-md-9">
    <table class="table table-striped table-bordered table-condensed table-hover">
      <caption>表格標題</caption>
      <thead>
        <tr>
          <th>#</th>
          <th><input type="checkbox" name="selectAll"></th>
          <th>標題</th>
          <th>標題</th>
          <th>標題</th>
          <th>標題</th>
          <th>標題</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td><input type="checkbox" name="select[]"></td>
          <td>是古代服飾風格是</td>
          <td>是古代服飾風格是</td>
          <td>是古代服飾風格是</td>
          <td>是古代服飾風格是</td>
          <td>是古代服飾風格是</td>
        </tr>
        <tr>
          <td>1</td>
          <td><input type="checkbox" name="select[]"></td>
          <td>是古代服飾風格是</td>
          <td>是古代服飾風格是</td>
          <td>是古代服飾風格是</td>
          <td>是古代服飾風格是</td>
          <td>是古代服飾風格是</td>
        </tr>
        <tr>
          <td>1</td>
          <td><input type="checkbox" name="select[]"></td>
          <td>是古代服飾風格是</td>
          <td>是古代服飾風格是</td>
          <td>是古代服飾風格是</td>
          <td>是古代服飾風格是</td>
          <td>是古代服飾風格是</td>
        </tr>
        <tr>
          <td>1</td>
          <td><input type="checkbox" name="select[]"></td>
          <td>是古代服飾風格是</td>
          <td>是古代服飾風格是</td>
          <td>是古代服飾風格是</td>
          <td>是古代服飾風格是</td>
          <td>是古代服飾風格是</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
</div>







    <!-- jQuery (necessary for Flat UI's JavaScript plugins) -->
    <script src="<?php echo base_url();?>assets/dist/js/vendor/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url();?>assets/dist/js/vendor/video.js"></script>
    <script src="<?php echo base_url();?>assets/dist/js/flat-ui.min.js"></script>

  </body>
</html>
