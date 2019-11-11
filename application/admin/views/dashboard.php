<?php include VIEWPATH.'widget/base_header.php'; ?>

	<div id="page-header">
		<div class="title">首页</div>
	</div>
	<div id="page-content">
		<div id="main">
			<?php include VIEWPATH.'widget/page_message.php'; ?>

			<h1>欢迎使用我们的内容管理系统</h1>
			<h5>qq群: 108795026</h5>

		</div>
	</div>






<script>


layui.use(['form', 'table','laypage','layer','alert'], function(){
	var $ = layui.jquery,
		form = layui.form,
		table = layui.table,
		pager = layui.laypage;



});
</script>


<?php include VIEWPATH.'widget/base_footer.php'; ?>
