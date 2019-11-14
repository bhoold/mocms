<?php include VIEWPATH.'widget/base_header.php'; ?>
<?php include VIEWPATH.'widget/page_header.php'; ?>
<div id="page-content">
	<div id="main">
		<?php include VIEWPATH.'widget/page_message.php'; ?>

		<?php echo form_open(current_url(), array('id'=>'form','class'=>'layui-form','lay-filter'=>'form')); ?>
			<input type="hidden" name="_follow-action">
			<?php
			/*
				if($edit_formData) {
					foreach ($edit_formData as $item) {
						echo form_item($item);
						$label = $item['label'];
						unset($item['label']);
						$str = '<div class="layui-form-item">';
						$str .= $label;
						$str .= '<div class="layui-input-inline">';
						$str .= form_inputEx($item);
						$str .= '</div></div>';
						echo $str;
					}
				}*/
			?>
			<div class="layui-form-item">
				<label class="layui-form-label">表名</label>
				<div class="layui-input-inline">
					<input name="name" type="text" autocomplete="off" class="layui-input" value="<?php echo $edit_formData['name']; ?>">
				</div>
			</div>

			<div class="layui-form-item">
				<label class="layui-form-label">描述</label>
				<div class="layui-input-inline">
					<input name="comment" type="text" autocomplete="off" class="layui-input" value="<?php echo $edit_formData['comment']; ?>">
				</div>
			</div>

			<div class="layui-form-item layui-hide">
				<div class="layui-input-block">
					<button type="submit" class="layui-btn layui-btn-primary" lay-submit lay-filter="*">提交</button>
					<button type="reset" class="layui-btn">重置</button>
				</div>
			</div>

		<?php echo form_close();?>

		</div>
	</div>





<script>
layui.use(['form','layer','alert','util'], function(){
	var $ = layui.jquery,
		form = layui.form, //表单
		layer = layui.layer, //弹层
		util = layui.util;

	form.on('submit(*)', function(data){
		return true;
	});

});
</script>

<?php include VIEWPATH.'widget/base_footer.php'; ?>


