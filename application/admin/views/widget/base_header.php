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

	<script charset="utf-8" src="<?php echo getUrl('base')?>assets/admin/layui/layui.js"></script>
	<script>
		layui.config({
			base: '<?php echo getUrl('base')?>assets/admin/layui/component/' //假设这是你存放拓展模块的根目录
		}).extend({ //设定模块别名
			alert: 'alert/alert',
			layregion: 'region/region'
		});

		var BASEURL = '<?php echo getUrl('base')?>';
	</script>

	<link rel="stylesheet" href="<?php echo getUrl('base')?>assets/admin/malihu-custom-scrollbar-plugin-3.1.5/jquery.mCustomScrollbar.css" />
	<script charset="utf-8" src="<?php echo getUrl('base')?>assets/admin/malihu-custom-scrollbar-plugin-3.1.5/js/minified/jquery-1.11.0.min.js"></script>
	<script charset="utf-8" src="<?php echo getUrl('base')?>assets/admin/malihu-custom-scrollbar-plugin-3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
<script>
var PAGEVAR = {
	GET: {
		<?php
		foreach ($page_get as $key => $value) {
			echo $key.':"'.$value.'"';
		}
		?>
	},
	POST: {
		<?php
		foreach ($page_post as $key => $value) {
			echo $key.':"'.$value.'"';
		}
		?>
	}
}
</script>
</head>
<body>
<div id="header">
	<div class="logo"><a href="<?php echo getUrl('index');?>">系统后台管理</a></div>
	<div class="nav">
		<?php
			if($page_menu) {
			foreach ($page_menu as $item) {
				$link = '';
				if(isset($item['link'])) {
					$link = ' href="'.getUrl('index', $item['link']).'"';
				}
				$str =  '<div class="item level1"><a '.$link.'>'.$item['title'].'</a>';
				if(isset($item['child']) && $item['child']) {
					$str .= '<div class="list level1 layui-hide">';
					foreach ($item['child'] as $itemChild) {
						$link = '';
						if(isset($itemChild['link'])) {
							$link = ' href="'.getUrl('index', $itemChild['link']).'"';
						}
						$str .= '<div class="item level2"><a '.$link.'>'.$itemChild['title'].'</a>';
						if(isset($itemChild['child']) && $itemChild['child']) {
							$str .= '<div class="list level2 layui-hide">';
							foreach ($itemChild['child'] as $child2) {
								$link = '';
								if(isset($child2['link'])) {
									$link = ' href="'.getUrl('index', $child2['link']).'"';
								}
								$str .= '<div class="item level3"><a '.$link.'>'.$child2['title'].'</a></div>';
							}
							$str .= '</div>';
						}
						$str .= '</div>';
					}
					$str .= '</div>';
				}
				$str .= '</div>';
				echo $str;
			}
			}
		?>
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


layui.use(['layer','alert'], function(){
	var $ = layui.jquery;

	$(document).on('click', function() {
		$('#header .nav > .item .list').addClass('layui-hide');
		$('#header .person .list').addClass('layui-hide');
		$('#header .nav').data('isShowList', false);
	});

	$('#header .nav .item.level1 > a').on('click', function(event) {
		var isShow = $('#header .nav').data('isShowList');
		if(isShow === true) {
			isShow = false;
		} else {
			isShow = true;
		}
		$('#header .nav').data('isShowList', isShow);

		$currentlist = $(this).siblings('.list');
		if(isShow === true) {
			$('#header .person .list').addClass('layui-hide');
			$('#header .nav > .item .list').addClass('layui-hide');

			$currentlist.removeClass('layui-hide');
		} else {
			$currentlist.addClass('layui-hide');
		}

		event.stopPropagation();
	}).on('mouseover', function() {
		var isShow = $('#header .nav').data('isShowList');

		$('#header .nav > .item .list').addClass('layui-hide');

		$currentlist = $(this).siblings('.list');
		if(isShow === true) {
			$currentlist.removeClass('layui-hide');
		} else {
			$currentlist.addClass('layui-hide');
		}
	});
	$('#header .nav .item.level2 > a').on('mouseover', function() {
		$('#header .nav .item.level2 .list').addClass('layui-hide');
		$(this).siblings('.list').removeClass('layui-hide');
	});

	$('#header .person button.name').on('click', function(event) {
		$(this).siblings('.list').toggleClass('layui-hide');
		$('#header .nav > .item .list').addClass('layui-hide');
		$('#header .nav').data('isShowList', false);
		event.stopPropagation();
	});

});
</script>
<div id="body">
