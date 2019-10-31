<?php include VIEWPATH.'layout_header_less.php'; ?>
<link rel="stylesheet" href="<?php echo getUrl('base')?>assets/admin/css/page-modal.css"  media="all">
	<div id="page-modal">
		<div id="selected">
			<div class="head">已选择: <span><?php echo $selectedList['count'];?></span></div>
			<div class="body">
				<div class="list">
				<?php
					foreach ($selectedList['list'] as $item) {
						echo '<div class="item" data-id="'.$item['id'].'"><a title="删除" class="del layui-icon layui-icon-close"></a><div class="cover"><img src="'.getUrl('base').$item['path'].'" alt="'.$item['title'].'"></div><p class="title">'.$item['title'].'</p></div>';
					}
					?>
				</div>
			</div>
		</div>
		<div id="content">
			<div class="head">
				<div class="title">图片库</div>
				<button type="button" class="layui-btn" id="btn_upload">上传图片</button>
			</div>
			<div class="body">
				<div class="list">
					<?php
					foreach ($index_list as $item) {
						echo '<div class="item" data-id="'.$item['id'].'"><div class="cover"><img src="'.getUrl('base').$item['path'].'" alt="'.$item['title'].'"></div><p class="title">'.$item['title'].'</p></div>';
					}
					?>
				</div>
				<div class="tip"><?php if(!count($index_list)){echo '未上传图片';}else{echo '加载中...';}?></div>
			</div>
		</div>
	</div>
	<div id="page-modal-progress" class="layui-progress" lay-filter="upload-progress">
		<div class="layui-progress-bar" lay-percent="0%"></div>
	</div>
	<script>
		layui.use(['form','layer','alert','table','laypage','laydate','util','upload','element'], function(){
			var $ = layui.jquery,
				form = layui.form, //表单
				laydate = layui.laydate, //日期选择器
				layer = layui.layer, //弹层
				upload = layui.upload, //上传
				element = layui.element, //进度条
				util = layui.util;

			var pageNum = <?php echo $index_pager['pageNum'];?>,
				pageSize = <?php echo $index_pager['pageSize'];?>,
				pageCount = <?php echo $index_pager['count'];?>;

			$('#page-modal #selected .list .item').each(function() {
				$('#page-modal #content .list .item[data-id='+$(this).data('id')+']').addClass('clicked');
			});

			jQuery("#page-modal #selected .body").mCustomScrollbar({
				autoHideScrollbar: true,
				scrollbarPosition: 'outside',
				setHeight: '100%',
				theme:"dark-2"
			});
			jQuery("#page-modal #content .body").mCustomScrollbar({
				//scrollButtons:{enable:true},
				//advanced:{ updateOnImageLoad: true }
				autoHideScrollbar: true,
				scrollbarPosition: 'outside',
				setHeight: '100%',
				theme:"dark-2", //dark dark-2 dark-thick rounded-dark dark-3
				callbacks: {
					onTotalScroll: function(){
						if(pageCount <= pageNum*pageSize) {
							return;
						}
						$('#page-modal #content .tip').removeClass('layui-hide').text('加载中...');
						pageNum++;
						$.ajax({
							url: '<?php echo getUrl('index', '/ajax/imagesList');?>',
							data: {pageNum: pageNum, pageSize: pageSize},
							dataType: 'json',
						}).done(function(res) {
							if(res.code) {
								$('#page-modal #content .tip').addClass('layui-hide');
								layui.each(res.data.list, function(index, item) {
									$item = $('<div class="item" data-id="'+item.id+'"><div class="cover"><img src="'+BASEURL+item.path+'" alt="'+item.title+'"></div><p class="title">'+item.title+'</p></div>');
									$('#page-modal #content .list').append($item);
								});

								$('#page-modal #selected .list .item').each(function() {
									$('#page-modal #content .list .item[data-id='+$(this).data('id')+']').addClass('clicked');
								});

							} else {
								$('#page-modal #content .tip').text(res.msg || '加载失败');
							}
						});
					},
					onTotalScrollOffset: 100,
					alwaysTriggerOffsets: true
				}
			});

			$('#page-modal #selected .list').delegate('.item .del', 'click', function() {
				$('#page-modal #content .list .item[data-id='+$(this).closest('.item').data('id')+']').removeClass('clicked');
				$(this).closest('.item').remove();
				$('#page-modal #selected .head span').text($('#page-modal #selected .list .item').length);
			});

			$('#page-modal #content .list').delegate('.item', 'click', function() {
				var id = $(this).data('id');
				if(id === undefined) {
					return;
				}
				if($(this).hasClass('clicked')) {
					$(this).removeClass('clicked');

					$('#page-modal #selected .list .item').each(function() {
						if($(this).data('id') == id) {
							$(this).remove();
						}
					});
				} else {
					$(this).addClass('clicked');

					var isHas = false;
					$('#page-modal #selected .list .item').each(function() {
						if($(this).data('id') == id) {
							isHas = true;
						}
					});
					if(!isHas) {
						$('#page-modal #selected .list').append('<div class="item" data-id="'+$(this).data('id')+'"><a title="删除" class="del layui-icon layui-icon-close"></a><div class="cover"><img src="'+$(this).find('.cover img').attr('src')+'" alt="'+$(this).find('.title').text()+'" ></div><p class="title">'+$(this).find('.title').text()+'</p></div>');
						jQuery("#page-modal #selected .body").mCustomScrollbar('scrollTo','last');
					}

				}
				$('#page-modal #selected .head span').text($('#page-modal #selected .list .item').length);
			});

			var uploadInst = upload.render({
				exts: '<?php echo config_item('app'.DIRECTORY_SEPARATOR.'upload')['image']['exts'];?>',
				accept: '<?php echo config_item('app'.DIRECTORY_SEPARATOR.'upload')['image']['accept'];?>',
				acceptMime: '<?php echo config_item('app'.DIRECTORY_SEPARATOR.'upload')['image']['acceptMime'];?>',
				size: '<?php echo config_item('app'.DIRECTORY_SEPARATOR.'upload')['image']['size'];?>',
				elem: '#btn_upload'
				,url: '<?php echo getUrl('index', '/ajax/modalUpload');?>'
				,multiple: true
				,auto: false
				,choose: function(obj) {
					var files = obj.pushFile();

					obj.preview(function(index, file, result) {
						var isHas = false;
						$('#page-modal #content .list .item.uploaded').each(function() {
							if($(this).data('index') == index) {
								isHas = true;

								$(this).removeClass('uploaded').addClass('uploading')
								.find('.mask').removeAttr('title')
								.end()
								.find('.mask p.text').text('上传中...');
							}
						});
						if(isHas) {
							return;
						}
						var $item = $('<div class="item uploading" data-index="'+index+'"><div class="mask"><p class="text">上传中...</p><p class="btn"><button type="button" class="redo layui-btn layui-btn-xs">重传</button></p><p class="btn"><button type="button" class="del layui-btn layui-btn-xs">删除</button></p></div><div class="cover"><img src="'+result+'" alt="'+file.name+'" ></div><p class="title">'+file.name+'</p></div>');
						$item.find('.mask button.redo').on('click', function(){
							//debugger
							obj.upload(index, file);

						});
						$item.find('.mask button.del').on('click', function(){
							delete files[index];
							$item.remove();
							uploadInst.config.elem.next()[0].value = '';
						});

						$('#page-modal #content .list').prepend($item);

						obj.upload(index, file);
					});
				}
				,before: function(obj) {
					//layer.load();
				}
				,error: function(index, upload) {
					$('#page-modal #content .list .item.uploading').each(function() {
						if($(this).data('index') == index) {
							$(this).removeClass('uploading').addClass('uploaded').find('.mask p.text').text('上传失败');
						}
					});
				}
				,done: function(res, index, upload) {
					if(res.code) {
						//$('#page-modal #content .list').prepend('<div class="item" data-id="'+res.data.id+'"><div class="cover"><img src="'+BASEURL+res.data.path+'" alt="'+res.data.title+'" ></div><p class="title">'+res.data.title+'</p></div>');
						$('#page-modal #content .list .item.uploading').each(function() {
							if($(this).data('index') == index) {
								$(this).removeClass('uploading')
								.attr('data-id',res.data.id).removeAttr('data-index')
								.remove('.mask')
								.find('.cover img').attr('src',BASEURL+res.data.path).attr('alt',res.data.title)
								.end()
								.find('.title').text(res.data.title);
							}
						});
					} else {
						$('#page-modal #content .list .item.uploading').each(function() {
							if($(this).data('index') == index) {
								$(this).removeClass('uploading').addClass('uploaded')
								.find('.mask').attr('title',res.msg)
								.end()
								.find('p.text').text('上传失败');
							}
						});
					}
				}
				,allDone: function() {

				}
			});
		});
	</script>
<?php include VIEWPATH.'layout_footer_less.php'; ?>
