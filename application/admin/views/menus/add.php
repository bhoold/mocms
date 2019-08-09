<?php include VIEWPATH.'layout_header.php'; ?>

	<div id="page-header">
		<div class="title"><?php echo $page_title;?></div>
		<div class="tooles btn-containe">
			<div class="left">
				<?php
				if($tooles_btns && isset($tooles_btns['left'])) {
					foreach($tooles_btns['left'] as $k => $group) {
						if($k > 0) {
							echo '<span class="separator"></span>';
						}
						foreach($group as $item) {
							echo '<button class="layui-btn '.(isset($item['domClass'])?$item['domClass']:'').'" data-type="'.$item['action'].'">'.$item['text'].'</button>';
						}
					}
				}
				?>
			</div>
			<div class="right">
				<?php
				if($tooles_btns && isset($tooles_btns['left'])) {
					foreach($tooles_btns['right'] as $k => $group) {
						if($k > 0) {
							echo '<span class="separator"></span>';
						}
						foreach($group as $item) {
							echo '<button class="layui-btn '.(isset($item['domClass'])?$item['domClass']:'').'" data-type="'.$item['action'].'">'.$item['text'].'</button>';
						}
					}
				}
				?>
			</div>
		</div>
	</div>
	<div id="page-content">
		<div id="main">
			<?php
				if($page_message) {
					echo '<div class="info-message layui-alert alert-error"><a class="close">x</a>'.$page_message.'</div>';
				}
			?>

			<?php echo form_open('', array('id'=>'form','class'=>'layui-form','lay-filter'=>'form')); ?>

				<input type="hidden" name="_follow-action">

				<div class="layui-form-item">
					<label class="layui-form-label">名称</label>
					<div class="layui-input-inline">
						<input type="text" name="title"  lay-verify="required" autocomplete="off" class="layui-input" value="<?php echo set_value('title'); ?>">
					</div>
				</div>
				<div class="layui-form-item layui-hide">
					<div class="layui-input-block">
						<button type="submit" class="layui-btn layui-btn-primary" lay-submit lay-filter="*">提交</button>
						<button type="reset" class="layui-btn">重置</button>
					</div>
				</div>
			<?php echo form_close(); ?>

		</div>
	</div>

	<script>
		layui.use(['form','layer','alert'], function(){
			var $ = layui.jquery,
				form = layui.form;

			form.on('submit(*)', function(data){
				return true;
			});

			$('#page-header .tooles .layui-btn').on('click', function(){
				var type = $(this).data('type');
				active[type] ? active[type].call(this) : '';
			});

			var active = {
				save: function() {
					var value = $(this).data('value');
					$('#form input[name="_follow-action"]').val('save');
					$('#form button[lay-submit]').trigger('click');
				},
				save_close: function() {
					var value = $(this).data('value');
					$('#form input[name="_follow-action"]').val('save_close');
					$('#form button[lay-submit]').trigger('click');
				},
				save_new: function() {
					var value = $(this).data('value');
					$('#form input[name="_follow-action"]').val('save_new');
					$('#form button[lay-submit]').trigger('click');
				},
				cancel: function() {
					location.href = "<?php echo getUrl('index', 'index');?>";
				},
				setup: function() {
					location.href = "<?php echo getUrl('index');?>";
				}
			};

		});
	</script>

<?php include VIEWPATH.'layout_footer.php'; ?>
