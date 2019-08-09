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
		<?php if(count($index_leftMenu)):?>
		<div id="left-menu">
			<div class="list">
				<?php foreach ($index_leftMenu as $item) {
					echo '<div class="item '.$item['active'].'">'.anchor($item['link'], $item['title']).'</div>';
				}
				?>
			</div>
		</div>
		<?php endif;?>
		<div id="main">
			<?php
				if($page_message) {
					echo '<div class="info-message layui-alert alert-error"><a class="close">x</a>'.$page_message.'</div>';
				}
			?>
			<div class="list-filter">
			<?php echo form_open('', array('method'=>'get','class'=>'layui-form','lay-filter'=>'form')); ?>
				<?php echo form_hidden('pageNum', $index_pager['pageNum']);?>
				<?php echo form_hidden('pageSize', $index_pager['pageSize']);?>
				<?php
					foreach ($index_filter as $item) {
						echo '<div class="item"><span class="lable">'.$item['label'].'</span><input class="layui-input inline" type="text" name="filter[title]" autocomplete="off" value="'.$item['value'].'"></div>';
					}
				?>
				<div class="btn-container">
					<button class="layui-btn" lay-submit lay-filter="search">搜索</button>
				</div>
			<?php echo form_close(); ?>
			</div>
			<table class="layui-hide" id="listTable" lay-filter="listTable">
				<thead>
					<tr>
					<th lay-data="{type:'checkbox', fixed: 'left'}"></th>
					<th lay-data="{field:'id', width:80}">ID</th>
					<?php
						foreach ($index_tableField as $fieldItem) {
							echo '<th lay-data="{field:\''.$fieldItem['field'].'\', width:'.$fieldItem['width'].'}">'.$fieldItem['text'].'</th>';
						}
					?>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($index_list as $item):?>
					<tr>
					<td></td>
					<td><?php echo $item['id'];?></td>
					<?php
						foreach ($index_tableField as $fieldItem) {
							echo '<td>'.$item[$fieldItem['field']].'</td>';
						}
					?>
					</tr>
					<?php endforeach;?>
				</tbody>
    		</table>
			<div id="pager"></div>
		</div>
	</div>

	<script>
		layui.use(['form','table','laypage','layer','alert'], function(){
			var $ = layui.jquery,
				form = layui.form,
				table = layui.table,
				pager = layui.laypage;

			//按钮动作
			$('#page-header .tooles .layui-btn').on('click', function(){
				var type = $(this).data('type');
				active[type] ? active[type].call(this) : '';
			});

			//搜索条件
			form.on('submit(search)', function(data){
				if($(data.form).data('isSavePage')){
					$(data.form).data('isSavePage', false);
				}else{
					$(data.form).find('input[name=pageNum]').val(1);
				}
				return true;
			});

			//初始化表格
			table.init('listTable', {
				limit: <?php echo $index_pager['pageSize'];?>,
				page: false
			});

			//分页
			pager.render({
				elem: 'pager',
				layout: ['prev', 'page', 'next', 'count', 'limit', 'skip'],
				count: <?php echo $index_pager['count'];?>,
				curr: <?php echo $index_pager['pageNum'];?>,
				limit: <?php echo $index_pager['pageSize'];?>,
				jump: function(obj, first){
					if(!first){
						$('#main .list-filter form input[name="pageNum"]').val(obj.curr);
						$('#main .list-filter form input[name="pageSize"]').val(obj.limit);
						$('#main .list-filter form').data('isSavePage', true);
						$('#main .list-filter form button[lay-submit]').trigger('click');
					}
				}
			});

			//按钮动作事件
			var active = {
				add: function() {
					location.href = "<?php echo getUrl('index','add');?>";
				},
				edit: function() {
					var checkStatus = table.checkStatus('listTable');
					if(checkStatus.data.length){
						var id = checkStatus.data[0].id;
						location.href = "<?php echo getUrl('index','edit/" + id + "');?>";
					}else{
						layer.msg('请从列表中选择', {icon: 5, shift: 6});
					}
				},
				del: function() {
					var checkStatus = table.checkStatus('listTable');
					if(checkStatus.data.length){
						layer.confirm('确定要删除吗？', function() {
							var ids = [];
							layui.each(checkStatus.data, function(index, item){
								ids.push(item.id);
							});

							$('#main .list-filter form').prepend('<input type="hidden" name="_action" value="delete" /><input type="hidden" name="_action_id" value="'+ids.join(',')+'" />');

							$('#main .list-filter form').data('isSavePage', true);
							$('#main .list-filter form button[lay-submit]').trigger('click');
						});
					}else{
						layer.msg('请从列表中选择', {icon: 5, shift: 6});
					}
				},
				setup: function() {
					location.href = "<?php echo getUrl('index');?>";
				}
			};
		});
	</script>

<?php include VIEWPATH.'layout_footer.php'; ?>
