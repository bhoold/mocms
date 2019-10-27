<?php include VIEWPATH.'layout_header.php'; ?>

	<div id="page-header">
		<div class="title"><?php echo lang('change_password_heading');?></div>
		<div class="tooles btn-containe">
			<div class="left">
				<button class="layui-btn layui-btn-primary" data-type="save">保存</button>
				<button class="layui-btn" data-type="cancel">取消</button>
			</div>
		</div>
	</div>
	<div id="page-content">
		<div id="main">
			<?php
				if($message) {
					echo '<div class="info-message layui-alert alert-error"><a class="close">x</a>'.$message.'</div>';
				}
			?>

			<?php echo form_open('auth/change_password', array('id'=>'form','class'=>'layui-form','lay-filter'=>'form')); ?>

				<input type="hidden" name="_follow-action">


				<div class="layui-form-item">
					<?php echo langEx('change_password_old_password_label', 'old_password');?>
					<div class="layui-input-inline">
						<?php echo form_inputEx($old_password);?>
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label" for="new_password"><?php echo sprintf(lang('change_password_new_password_label'), $min_password_length);?></label>
					<div class="layui-input-inline">
						<?php echo form_inputEx($new_password);?>
					</div>
				</div>
				<div class="layui-form-item">
					<?php echo langEx('change_password_new_password_confirm_label', 'new_password_confirm');?>
					<div class="layui-input-inline">
						<?php echo form_inputEx($new_password_confirm);?>
					</div>
				</div>

      			<?php echo form_inputEx($user_id);?>


				<div class="layui-form-item layui-hide">
					<div class="layui-input-block">
						<button type="submit" class="layui-btn layui-btn-primary" lay-submit lay-filter="*"><?php echo lang('change_password_submit_btn');?></button>
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

//监听提交
form.on('submit(*)', function(data){

//layer.msg(JSON.stringify(data.field));
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

	cancel: function() {
		history.back();
	},


};





});
</script>


<?php include VIEWPATH.'layout_footer.php'; ?>
