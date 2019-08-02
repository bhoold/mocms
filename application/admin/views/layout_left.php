<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php
	$uriArr = explode('/', uri_string());
	$layoutLeft = array(
		'uri' => array(
			'action' => $uriArr[0],
			'method' => $uriArr[1]
		)
	);
	unset($uriArr);

?>
<div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
      <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
      <ul class="layui-nav layui-nav-tree"  lay-filter="test">
				<li class="layui-nav-item <?php echo $layoutLeft['uri']['action']=='Dashboard'?' layui-this ':'';?>"><a href="<?php echo mysite_url('/Dashboard/index');?>">首页</a></li>
				<li class="layui-nav-item <?php echo $layoutLeft['uri']['action']=='GlobalConfig'?' layui-this ':'';?>"><a href="<?php echo mysite_url('/GlobalConfig/index');?>">全局配置</a></li>
				<li class="layui-nav-item <?php echo $layoutLeft['uri']['action']=='SystemUser'?' layui-this ':'';?>"><a href="<?php echo mysite_url('/SystemUser/index');?>">后台用户</a></li>
				<li class="layui-nav-item <?php echo $layoutLeft['uri']['action']=='User'?' layui-this ':'';?>"><a href="<?php echo mysite_url('/User/index');?>">用户</a></li>
        <li class="layui-nav-item <?php echo $layoutLeft['uri']['action']=='Streamer'?' layui-this ':'';?>"><a href="<?php echo mysite_url('/Streamer/index');?>">主播</a></li>
				<li class="layui-nav-item <?php echo $layoutLeft['uri']['action']=='StreamRoom'?' layui-this ':'';?>"><a href="<?php echo mysite_url('/StreamRoom/index');?>">房间</a></li>

				<li class="layui-nav-item <?php echo $layoutLeft['uri']['action']=='Gift'?' layui-this ':'';?>"><a href="<?php echo mysite_url('/Gift/index');?>">礼物</a></li>
				<li class="layui-nav-item <?php echo $layoutLeft['uri']['action']=='Gift'?' layui-this ':'';?>"><a href="<?php echo mysite_url('/Gift/index');?>">送礼日志</a></li>

				<li style="display:none" class="layui-nav-item <?php echo $layoutLeft['uri']['action']=='Gift'?' layui-this ':'';?>"><a href="<?php echo mysite_url('/Gift/index');?>">充值管理</a></li>
				<li class="layui-nav-item <?php echo $layoutLeft['uri']['action']=='Gift'?' layui-this ':'';?>"><a href="<?php echo mysite_url('/Gift/index');?>">充值日志</a></li>
				<li style="display:none" class="layui-nav-item <?php echo $layoutLeft['uri']['action']=='Gift'?' layui-this ':'';?>"><a href="<?php echo mysite_url('/Gift/index');?>">提现管理</a></li>
				<li class="layui-nav-item <?php echo $layoutLeft['uri']['action']=='Gift'?' layui-this ':'';?>"><a href="<?php echo mysite_url('/Gift/index');?>">提现日志</a></li>



				<li class="layui-nav-item <?php echo $layoutLeft['uri']['action']=='SystemLog'?' layui-this ':'';?>"><a href="<?php echo mysite_url('/SystemLog/index');?>">后台日志</a></li>
			</ul>
    </div>
  </div>
