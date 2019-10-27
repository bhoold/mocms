<?php include VIEWPATH.'layout_header_modal.php'; ?>

	<div id="page-content">
		<div id="main">
			<table class="layui-hide" id="listTable" lay-filter="listTable"></table>
		</div>
	</div>

	<script>
		layui.use(['form','table','laypage','layer','alert'], function(){
			var $ = layui.jquery,
				form = layui.form,
				table = layui.table,
				pager = layui.laypage;

			window.table = table;

			var defaultData = [];
			var postData = <?php echo json_encode($index_list); ?>;
			var selectedData = new URL(location).searchParams.get('tableData');
			if(selectedData) {
				selectedData = JSON.parse(selectedData);
				layui.each(selectedData, function(i, item) {
					layui.each(postData, function(i2, item2) {
						if(item.title === item2.title) {
							item2.LAY_CHECKED = true;
							return false;
						}
					});
				});
			}
			table.render({
				elem: '#listTable'
				,height: 'full-90'
				,cols: [<?php echo json_encode($index_tableField); ?>],
				data: postData || defaultData,
				limit: 1000, //假定值
			});



		});
	</script>

<?php include VIEWPATH.'layout_footer_modal.php'; ?>
