<div id="pager"></div>

<script>
layui.use(['layer','alert','laypage'], function(){
	var $ = layui.jquery,
		pager = layui.laypage;

	<?php if(isset($index_pager) && $index_pager): ?>
	pager.render({
		elem: 'pager',
		layout: ['prev', 'page', 'next', 'count', 'limit', 'skip'],
		count: <?php echo $index_pager['count'];?>,
		curr: <?php echo $index_pager['pageNum'];?>,
		limit: <?php echo $index_pager['pageSize'];?>,
		limits: <?php echo json_encode($index_pager['pagelimits']);?>,
		jump: function(obj, first){
			//首次不执行
			if(!first){
				$('#main .list-filter form input[name="pageNum"]').val(obj.curr);
				$('#main .list-filter form input[name="pageSize"]').val(obj.limit);
				$('#main .list-filter form').data('isSavePage', true);
				$('#main .list-filter form button[lay-submit]').trigger('click');
			}
		}
  	});
	<?php endif; ?>

});
</script>
