			<table class="layui-hide" id="listTable" lay-filter="listTable">
				<thead>
					<tr>
					<?php
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
<script>
layui.use(['layer','alert','table'], function(){
	var $ = layui.jquery,
		table = layui.table;

	//转换静态表格
	table.init('listTable', {
		limit: <?php if(isset($index_pager) && $index_pager){echo $index_pager['pageSize'];}else{echo '99999';}?>,
		page: false
	});
});
</script>
