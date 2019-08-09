<?php include VIEWPATH.'layout_header.php'; ?>

<div id="page-header">
	<div class="title"><?php echo lang('edit_user_heading');?></div>
	<div class="tooles btn-containe">
		<div class="left">
			<button class="layui-btn layui-btn-primary" data-type="save">保存</button>
			<button class="layui-btn" data-type="save_close">保存并关闭</button>
			<button class="layui-btn" data-type="save_new">保存并新建</button>
			<button class="layui-btn" data-type="cancel">取消</button>
		</div>
		<div class="right">
			<button class="layui-btn" data-type="setup">设置</button>
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

		<?php echo form_open(uri_string(), array('id'=>'form','class'=>'layui-form','lay-filter'=>'form')); ?>
			<input type="hidden" name="_follow-action">
			<!--
			<div class="layui-form-item">
				<?php echo langEx('edit_user_fname_label', 'first_name');?>
				<div class="layui-input-inline">
					<?php echo form_inputEx($first_name);?>
				</div>
			</div>
			<div class="layui-form-item">
				<?php echo langEx('edit_user_lname_label', 'last_name');?>
				<div class="layui-input-inline">
					<?php echo form_inputEx($last_name);?>
				</div>
			</div>
			<div class="layui-form-item">
				<?php echo langEx('edit_user_company_label', 'company');?>
				<div class="layui-input-inline">
					<?php echo form_inputEx($company);?>
				</div>
			</div>
			<div class="layui-form-item">
				<?php echo langEx('edit_user_phone_label', 'phone');?>
				<div class="layui-input-inline">
					<?php echo form_inputEx($phone);?>
				</div>
			</div>
			-->
			<?php
			if($identity_column!=='email') {
				echo '<div class="layui-form-item">';
				echo langEx('edit_user_identity_label', 'identity');
				echo '<div class="layui-input-inline">';
				echo form_inputEx($identity);
				echo '</div></div>';
			}
			?>
			<div class="layui-form-item">
				<?php echo langEx('edit_user_email_label', 'email');?>
				<div class="layui-input-inline">
					<?php echo form_inputEx($email);?>
				</div>
			</div>
			<div class="layui-form-item">
				<?php echo langEx('edit_user_password_label', 'password');?>
				<div class="layui-input-inline">
					<?php echo form_inputEx($password);?>
				</div>
				<div class="layui-form-mid layui-word-aux">如果需要修改请输入</div>
			</div>
			<div class="layui-form-item">
				<?php echo langEx('edit_user_password_confirm_label', 'password_confirm');?>
				<div class="layui-input-inline">
					<?php echo form_inputEx($password_confirm);?>
				</div>
				<div class="layui-form-mid layui-word-aux">如果需要修改请输入</div>
			</div>
			<?php if ($this->ion_auth->is_admin()): ?>
			<div class="layui-form-item">
				<?php echo langEx('edit_user_groups_heading', 'password_confirm');?>
				<div class="layui-input-block">
				<?php foreach ($groups as $group):?>
					<?php
						$gID=$group['id'];
						$checked = null;
						$item = null;
						foreach($currentGroups as $grp) {
							if ($gID == $grp->id) {
								$checked= ' checked="checked"';
							break;
							}
						}
					?>
					<input lay-skin="primary" type="checkbox" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?> title="<?php echo htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8');?>">

				<?php endforeach?>
				</div>
			</div>
			<?php endif ?>

			<?php echo form_hidden('id', $user->id);?>
			<?php echo form_hidden($csrf); ?>

	  		<div class="layui-form-item layui-hide">
				<div class="layui-input-block">
					<button type="submit" class="layui-btn layui-btn-primary" lay-submit lay-filter="*"><?php echo lang('edit_user_submit_btn');?></button>
					<button type="reset" class="layui-btn">重置</button>
				</div>
			</div>


		<?php echo form_close();?>




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
