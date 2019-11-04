<?php include VIEWPATH.'widget/base_header.php'; ?>
<?php include VIEWPATH.'widget/page_header.php'; ?>

<link rel="stylesheet" href="<?php echo getUrl('base')?>assets/admin/css/config-list.css"  media="all">

	<div id="page-content">
		<?php include VIEWPATH.'widget/left_menu.php'; ?>
		<div id="main">
			<?php
				if($page_message) {
					echo '<div class="info-message layui-alert alert-error"><a class="close">x</a>'.$page_message.'</div>';
				}
			?>
			<div id="config-list">
			<?php echo form_open('auth/create_group', array('id'=>'form','class'=>'layui-form','lay-filter'=>'form')); ?>

				<h2>分页</h2>
				<div class="layui-form-item">
					<div class="layui-form-label-col">
						<h3>可选择的分页数量</h3>
					</div>
					<div class="layui-input-inline">
						<input type="text" autocomplete="off" class="layui-input" value="10,20,30,40,50">
					</div>
				</div>
				<div class="layui-form-item">
					<div class="layui-form-label-col">
						<h3>默认选中的分页数量</h3>
					</div>
					<div class="layui-input-inline">
						<input type="text" autocomplete="off" class="layui-input" value="10">
					</div>
				</div>

				<h2>常规列表</h2>
				<div class="layui-form-item">
					<div class="layui-form-label-col">
						<h3>排序规则</h3>
					</div>
					<div class="layui-block">
						<p><input type="radio" name="sex" value="0" title="按ID正序"></p>
						<p><input type="radio" name="sex" value="1" title="按ID倒序" checked></p>
						<p><input type="radio" name="sex" value="0" title="按更新时间正序"></p>
						<p><input type="radio" name="sex" value="0" title="按更新时间倒序"></p>
					</div>
				</div>

			<?php echo form_close();?>
			</div>
		</div>
	</div>






<script>
layui.use(['form','table','laypage','layer','alert'], function(){
	var $ = layui.jquery,
		form = layui.form,
		table = layui.table,
		pager = layui.laypage;



});
</script>


<?php include VIEWPATH.'widget/base_footer.php'; ?>
