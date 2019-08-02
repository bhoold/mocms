<?php include VIEWPATH.'layout_header.php'; ?>

	<div id="page-header">
		<div class="title">
			<p><?php echo lang('create_user_heading');?></p>
		</div>
		<div class="tooles btn-containe">
			<div class="left">
				<button class="layui-btn layui-btn-primary">保存</button>
				<button class="layui-btn">保存并关闭</button>
				<button class="layui-btn">保存并新建</button>
				<button class="layui-btn">取消</button>
			</div>
			<div class="right">
				<button class="layui-btn">帮助</button>
			</div>
		</div>
	</div>
	<div id="page-content">


		<div id="main">
			<div class="info-message layui-alert">
				<button type="button" class="close">×</button>
				<?php echo $message;?>
			</div>













<?php echo form_open("auth/create_user");?>

<p>
	  <?php echo lang('create_user_fname_label', 'first_name');?> <br />
	  <?php echo form_input($first_name);?>
</p>

<p>
	  <?php echo lang('create_user_lname_label', 'last_name');?> <br />
	  <?php echo form_input($last_name);?>
</p>

<?php
if($identity_column!=='email') {
	echo '<p>';
	echo lang('create_user_identity_label', 'identity');
	echo '<br />';
	echo form_error('identity');
	echo form_input($identity);
	echo '</p>';
}
?>

<p>
	  <?php echo lang('create_user_company_label', 'company');?> <br />
	  <?php echo form_input($company);?>
</p>

<p>
	  <?php echo lang('create_user_email_label', 'email');?> <br />
	  <?php echo form_input($email);?>
</p>

<p>
	  <?php echo lang('create_user_phone_label', 'phone');?> <br />
	  <?php echo form_input($phone);?>
</p>

<p>
	  <?php echo lang('create_user_password_label', 'password');?> <br />
	  <?php echo form_input($password);?>
</p>

<p>
	  <?php echo lang('create_user_password_confirm_label', 'password_confirm');?> <br />
	  <?php echo form_input($password_confirm);?>
</p>


<p><?php echo form_submit('submit', lang('create_user_submit_btn'));?></p>

<?php echo form_close();?>








		</div>
	</div>




<script>
layui.use(['form','layer','alert'], function(){

});
</script>



<?php include VIEWPATH.'layout_footer.php'; ?>
