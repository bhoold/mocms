<?php include VIEWPATH.'widget/base_header.php'; ?>

<div id="page-header">
	<div class="title"><?php echo $page_title;?></div>
	<div class="tooles btn-containe">
		<div class="left">
			<?php
			if($edit_tooles_btns && isset($edit_tooles_btns['left'])) {
				foreach($edit_tooles_btns['left'] as $k => $group) {
					if($k > 0) {
						echo '<span class="separator"></span>';
					}
					foreach($group as $item) {
						echo '<button class="layui-btn '.(isset($item['domClass'])?$item['domClass']:'').'" lay-btn-event="'.$item['action'].'">'.$item['text'].'</button>';
					}
				}
			}
			?>
		</div>
		<div class="right">
			<?php
			if($edit_tooles_btns && isset($edit_tooles_btns['right'])) {
				foreach($edit_tooles_btns['right'] as $k => $group) {
					if($k > 0) {
						echo '<span class="separator"></span>';
					}
					foreach($group as $item) {
						echo '<button class="layui-btn '.(isset($item['domClass'])?$item['domClass']:'').'" lay-btn-event="'.$item['action'].'">'.$item['text'].'</button>';
					}
				}
			}
			?>
		</div>
	</div>
</div>
<div id="page-content">
	<div id="main">
		<?php include VIEWPATH.'widget/page_message.php'; ?>

		<?php echo form_open('auth/create_group', array('id'=>'form','class'=>'layui-form','lay-filter'=>'form')); ?>
			<input type="hidden" name="_follow-action">
			<!--
			<?php
				foreach ($edit_formData as $item) {
					$label = $item['label'];
					unset($item['label']);
					$str = '<div class="layui-form-item">';
					$str .= $label;
					$str .= '<div class="layui-input-inline">';
					$str .= form_inputEx($item);
					$str .= '</div></div>';
					echo $str;
				}
			?>
			<div class="layui-form-item">
				<?php echo langEx('create_group_name_label', 'group_name');?>
				<div class="layui-input-inline">
					<div class="layui-upload">
						<button type="button" class="layui-btn" id="test1">上传图片</button>
						<div class="layui-upload-list">
							<img class="layui-upload-img" id="demo1">
							<p id="demoText"></p>
						</div>
					</div>
				</div>
			</div>
			<div class="layui-form-item">
				<?php echo langEx('create_group_desc_label', 'description');?>
				<div class="layui-input-inline">
					<?php echo form_inputEx($description);?>
				</div>
			</div>
			-->

<div class="layui-form-item">
    <label class="layui-form-label">输入框</label>
    <div class="layui-input-block">
    	<input type="text" autocomplete="off" class="layui-input">
    </div>
</div>

<div class="layui-form-item layui-form-text">
    <label class="layui-form-label">多行输入框</label>
    <div class="layui-input-block">
    	<textarea class="layui-textarea"></textarea>
    </div>
</div>

<div class="layui-form-item">
    <label class="layui-form-label">搜索框(改变键盘)</label>
    <div class="layui-input-block">
    	<input type="search" autocomplete="off" class="layui-input">
    </div>
</div>
<div class="layui-form-item">
    <label class="layui-form-label">数字框(改变键盘)</label>
    <div class="layui-input-block">
    	<input type="number" min="1" max="10" step="2" autocomplete="off" class="layui-input">
    </div>
</div>
<div class="layui-form-item">
    <label class="layui-form-label">邮箱框(改变键盘)</label>
    <div class="layui-input-block">
    	<input type="email" autocomplete="off" class="layui-input">
    </div>
</div>
<div class="layui-form-item">
    <label class="layui-form-label">网址框(改变键盘)</label>
    <div class="layui-input-block">
    	<input type="url" autocomplete="off" class="layui-input">
    </div>
</div>
<div class="layui-form-item">
    <label class="layui-form-label">日期框</label>
    <div class="layui-input-block">
    	<input type="text" id="date" autocomplete="off" class="layui-input">
    </div>
</div>
<div class="layui-form-item">
    <label class="layui-form-label">日期框2</label>
    <div class="layui-input-block">
    	<input type="text" id="date2" autocomplete="off" class="layui-input">
    </div>
</div>
<div class="layui-form-item">
    <label class="layui-form-label">省市区选择</label>
    <div class="layui-input-block">
		<input type="text" id="region" readonly="true" autocomplete="off" class="layui-input">
    </div>
</div>


<div class="layui-form-item">
    <label class="layui-form-label">密码框</label>
    <div class="layui-input-block">
    	<input type="password" autocomplete="off" class="layui-input">
	</div>
	<div class="layui-form-mid layui-word-aux">辅助文字</div>
</div>

<div class="layui-form-item">
    <label class="layui-form-label">下拉选择框</label>
    <div class="layui-input-block">
		<select name="interest">
			<option value="">请选择</option>
			<option value="0">写作</option>
			<option value="1">阅读</option>
		</select>
    </div>
</div>

<div class="layui-form-item">
    <label class="layui-form-label">复选框</label>
    <div class="layui-input-block">
		<input type="checkbox" name="like[write]" title="写作">
		<input type="checkbox" name="like[read]" title="阅读">
    </div>
</div>

<div class="layui-form-item">
    <label class="layui-form-label">复选框2</label>
    <div class="layui-input-block">
		<input type="checkbox" name="like2[write]" title="写作" lay-skin="primary">
		<input type="checkbox" name="like2[read]" title="阅读" lay-skin="primary">
    </div>
</div>

<div class="layui-form-item">
    <label class="layui-form-label">开关</label>
    <div class="layui-input-block">
    	<input type="checkbox" checked lay-skin="switch">
    </div>
</div>

<div class="layui-form-item">
    <label class="layui-form-label">开关2</label>
    <div class="layui-input-block">
    	<input type="checkbox" lay-skin="switch" lay-text="开启|关闭">
    </div>
</div>

<div class="layui-form-item">
    <label class="layui-form-label">单选框</label>
    <div class="layui-input-block">
    	<input type="radio" name="sex" value="0" title="男">
    	<input type="radio" name="sex" value="1" title="女" checked>
    </div>
</div>

<div class="layui-form-item">
	<label class="layui-form-label">上传框</label>
	<div class="layui-input-block">
		<div class="layui-upload">
			<button type="button" class="layui-btn" lay-btn-event="showUploadImgModal">选择图片</button>
			<span class="tip">已选择: <span>0</span></span>
			<div class="layui-upload-list image"></div>
		</div>
	</div>
</div>





			<div class="layui-form-item layui-hide">
				<div class="layui-input-block">
					<button type="submit" class="layui-btn layui-btn-primary" lay-submit lay-filter="*"><?php echo lang('create_group_submit_btn');?></button>
					<button type="reset" class="layui-btn">重置</button>
				</div>
			</div>

		<?php echo form_close();?>


		</div>
	</div>





<script>
layui.use(['form','layer','alert','laydate','layregion','util'], function(){
	var $ = layui.jquery,
		form = layui.form, //表单
		laydate = layui.laydate, //日期选择器
		layer = layui.layer, //弹层
		layregion = layui.layregion, //地区选择
		util = layui.util;

	form.on('submit(*)', function(data){
		return true;
	});

	laydate.render({
		elem: '#date' //日期元素

	});

	laydate.render({
		elem: '#date2' //日期元素
		,range: true
		,format: 'yyyy-MM-dd'
	});

	layregion.render({
		elem: '#region',
		source: '<?php echo getUrl('index', '/ajax/regionList');?>'
	});

	util.event('lay-btn-event', {
		<?php
		if(isset($edit_tooles_btns['left'])) {
			foreach($edit_tooles_btns['left'] as $group) {
				foreach($group as $item) {
					if(isset($item['event'])) {
						$item['event']();
					}
				}
			}
		}
		if(isset($edit_tooles_btns['right'])) {
			foreach($edit_tooles_btns['right'] as $group) {
				foreach($group as $item) {
					if(isset($item['event'])) {
						$item['event']();
					}
				}
			}
		}
		?>

		showUploadImgModal: function() {
			var $listElem = $(this).siblings('.layui-upload-list');
			var $tipElem = $(this).siblings('.tip');
			var selectedList = [];
			$listElem.find('.item').each(function() {
				selectedList.push($(this).data('id'));
			});
			layer.open({
				title: '选择图片',
				type: 2,
				area: ['920px', '600px'],
				content: ['<?php echo getUrl('index', '/modal/index');?>?pageNum=1&pageSize=42&selected='+selectedList.join(), 'yes'],
				btnAlign: 'r',
				btn: ['确定','取消'],
				yes: function(index, layero) {
					var childFrame = $('iframe#layui-layer-iframe' + index)[0],
						childDoc = childFrame.contentDocument || childFrame.contentWindow.document,
						$items = $(childDoc).find('#page-modal #selected .item');
					if(!$items.length) {
						layer.msg('未选择图片', {icon: 5, shift: 6});
					} else {
						$listElem.empty();
						$items.each(function() {
							var $item = $('<div class="item" data-id="'+$(this).data('id')+'"><div class="cover"><img src="'+$(this).find('.cover img').attr('src')+'" alt="'+$(this).find('.cover img').attr('alt')+'" ></div><p class="title">'+$(this).find('.title').text()+'</p></div>');
							$listElem.append($item);
						});
						$tipElem.find('span').text($items.length);
						layer.close(index);
					}
				}
			});
		},

	});

});
</script>

<?php include VIEWPATH.'widget/base_footer.php'; ?>


