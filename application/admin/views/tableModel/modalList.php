<?php include VIEWPATH.'layout_header_modal.php'; ?>

	<div id="page-content">
		<div id="main">
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
			<table class="layui-hide" id="listTable" lay-filter="listTable" lay-data="{height: 'full-168'}">
				<thead>
					<tr>
					<th lay-data="{type:'radio', fixed: 'left'}"></th>
					<th lay-data="{field:'id', width:80}">ID</th>
					<?php
						foreach ($index_tableField as $fieldItem) {
							$width = '';
							if(isset($fieldItem['width'])) {
								$width = 'width:'.$fieldItem['width'].',';
							}
							$minWidth = '';
							if(isset($fieldItem['minWidth'])) {
								$minWidth = 'minWidth:'.$fieldItem['minWidth'].',';
							}
							echo '<th lay-data="{'.$width.$minWidth.'field:\''.$fieldItem['field'].'\'}">'.$fieldItem['text'].'</th>';
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
							//print_r($fieldItem['field']);
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

			window.table = table;

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
			/*
			table.on('radio(listTable)', function(obj){
				console.log(obj.data.id);
			});*/

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

		});
	</script>

<?php include VIEWPATH.'layout_footer_modal.php'; ?>
