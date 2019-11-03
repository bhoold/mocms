<?php include VIEWPATH.'component/base_header.php'; ?>
<?php include VIEWPATH.'component/page_header.php'; ?>
	<div id="page-content">
		<?php include VIEWPATH.'component/left_menu.php'; ?>
		<div id="main">
			<?php
				if($page_message) {
					echo '<div class="info-message layui-alert alert-error"><a class="close">x</a>'.$page_message.'</div>';
				}
			?>

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


<?php include VIEWPATH.'component/base_footer.php'; ?>
