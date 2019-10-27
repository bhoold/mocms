<?php include VIEWPATH.'layout_header.php'; ?>

	<div id="page-header">
		<div class="title"><?php echo $page_title;?></div>
		<div class="tooles btn-containe">
			<div class="left">
				<?php
				if($index_tooles_btns && isset($index_tooles_btns['left'])) {
					foreach($index_tooles_btns['left'] as $k => $group) {
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
				if($index_tooles_btns && isset($index_tooles_btns['right'])) {
					foreach($index_tooles_btns['right'] as $k => $group) {
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
				if($index_pager || count($index_filter)){
					echo '<div class="list-filter">';
					echo form_open(uri_string(), array('method'=>'get','class'=>'layui-form','lay-filter'=>'form'));
					if($index_pager) {
						echo form_hidden('pageNum', $index_pager['pageNum']);
						echo form_hidden('pageSize', $index_pager['pageSize']);
					}
					foreach ($index_filter as $key => $item) {
						$str = '<div class="item"><span class="lable">'.$item['label'].'</span>';
						if($item['type'] == 'text') {
							$str .= '<input class="layui-input inline" type="text" name="filter['.$item['name'].']" autocomplete="off" value="'.$item['value'].'">';
						}
						$str .= '</div>';
						echo $str;
					}
					if(count($index_filter)) {
						echo '<div class="btn-container"><button class="layui-btn" lay-submit lay-filter="search">搜索</button></div>';
					} else {
						echo '<div class="btn-container layui-hide"><button class="layui-btn" lay-submit lay-filter="search">搜索</button></div>';
					}
					echo form_close();
					echo '</div>';
				}
			?>
			<table class="layui-hide" id="listTable" lay-filter="listTable">
				<thead>
					<tr>
					<?php
					if(!count($index_field)) {
						$index_field = array();
						foreach ($index_list as $i => $row) {
							if($i > 0) {
								break;
							}
							foreach ($row as $key => $value) {
								$index_field[] = array(
									'field' => $key,
									'label' => $key
								);
							}
						}
					}
					foreach ($index_field as $field) {
						if(isset($field['value'])) {
							unset($field['value']);
						}
						if(isset($field['label'])) {
							$label = $field['label'];
							unset($field['label']);
							echo '<th lay-data=\''.json_encode($field).'\'>'.$label.'</th>';
						} else {
							echo '<th lay-data=\''.json_encode($field).'\'></th>';
						}

					}
					?>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($index_list as $row) {
						$str = '<tr>';
						foreach ($index_field as $field) {
							if(isset($field['type'])) {
								$str .= '<td></td>';
							} else {
								$val = '';
								if(isset($field['value'])) {
									if($field['value']['type'] == 'function') {
										$val = $field['value']['function']($row);
									}
								} else if(isset($row[$field['field']])) {
									$val = $row[$field['field']];
									$val = htmlspecialchars($val,ENT_QUOTES,'UTF-8');
								}
								$str .= '<td>'.$val.'</td>';
							}
						}
						$str .= '</tr>';
						echo $str;
					}
					?>
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

	//监听提交
	form.on('submit(search)', function(data){
		if($(data.form).data('isSavePage')){
			$(data.form).data('isSavePage', false);
		}else{
			$(data.form).find('input[name=pageNum]').val(1);
		}
		return true;
	});

	//转换静态表格
	table.init('listTable', {
		limit: <?php if($index_pager){echo $index_pager['pageSize'];}else{echo '99999';}?>,
		page: false
	});

	<?php if($index_pager): ?>
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


	$('#page-header .tooles .layui-btn').on('click', function(){
		var type = $(this).data('type');
		active[type] ? active[type].call(this) : '';
	});


	var active = {
		<?php
		if(isset($index_tooles_btns['left'])) {
			foreach($index_tooles_btns['left'] as $group) {
				foreach($group as $item) {
					if(isset($item['event'])) {
						$item['event']();
					}
				}
			}
		}
		if(isset($index_tooles_btns['right'])) {
			foreach($index_tooles_btns['right'] as $group) {
				foreach($group as $item) {
					if(isset($item['event'])) {
						$item['event']();
					}
				}
			}
		}
		?>
	};

});
</script>


<?php include VIEWPATH.'layout_footer.php'; ?>
