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
		<div id="main">
			<?php
				if($page_message) {
					echo '<div class="info-message layui-alert alert-error"><a class="close">x</a>'.$page_message.'</div>';
				}
			?>

			<?php echo form_open('', array('id'=>'form','class'=>'layui-form','lay-filter'=>'form')); ?>

				<input type="hidden" name="_follow-action">

				<div class="layui-form-item">
					<label class="layui-form-label">表名</label>
					<div class="layui-input-inline">
						<input type="text" name="title" lay-verify="required" autocomplete="off" class="layui-input" value="<?php echo set_value('title'); ?>">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">描述</label>
					<div class="layui-input-inline">
						<input type="text" name="desc" autocomplete="off" class="layui-input" value="<?php echo set_value('desc'); ?>">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">字段</label>
					<div class="layui-input-block">
					<table class="layui-hide" id="listTable" lay-size="sm" lay-filter="listTable"></table>
					</div>
				</div>
				<div class="layui-form-item layui-hide">
					<div class="layui-input-block">
						<button type="submit" class="layui-btn layui-btn-primary" lay-submit lay-filter="*">提交</button>
						<button type="reset" class="layui-btn">重置</button>
					</div>
				</div>
			<?php echo form_close(); ?>
		</div>
	</div>

	<script type="text/html" id="tableOpt">
		<a class="layui-btn layui-btn-primary" lay-event="add">添加</a>
		{{#  if(!(d.name == 'id' || d.name == 'createtime' || d.name == 'updatetime')){ }}
		<a class="layui-btn layui-btn-danger" lay-event="del">删除</a>
		{{# } }}
	</script>

	<script>
		layui.use(['form','table','layer','alert'], function(){
			var $ = layui.jquery,
				form = layui.form,
				table = layui.table;

			form.on('submit(*)', function(data){

				var data = [];
				var index = 0;
				layui.each(table.cache['listTable'], function(i, item){
					var rowData = {};

					table.eachCols('listTable',function(i,col){
						if(col.field !== undefined){
							if(item[col.field] !== undefined){
								rowData[col.field] = item[col.field];
							}else{
								rowData[col.field] = '';
							}
						}
					});
					rowData._rowIndex = index;
					index++;
					data.push(rowData);
				});
				var isFieldok = true;
				layui.each(data, function(i, item){
					if(item.name == '' || item.type == '') {
						isFieldok = false;
						layer.msg('字段未填写完整', {icon: 5, shift: 6});
						return true;
					}
				})

				if(!isFieldok){
					return false;
				}
				var dataStr = JSON.stringify(data);//console.log(dataStr)
				$('#main #form').prepend('<input type="hidden" name="fields" value=\''+dataStr+'\' />');
				return true;
			});

			$('#page-header .tooles .layui-btn').on('click', function(){
				var type = $(this).data('type');
				active[type] ? active[type].call(this) : '';
			});

			var active = {
				save: function() {
					var value = $(this).data('value');
					$('#form input[name="_follow-action"]').val('save');
					$('#form button[lay-submit]').trigger('click');
				},
				save_close: function() {
					var value = $(this).data('value');
					$('#form input[name="_follow-action"]').val('save_close');
					$('#form button[lay-submit]').trigger('click');
				},
				save_new: function() {
					var value = $(this).data('value');
					$('#form input[name="_follow-action"]').val('save_new');
					$('#form button[lay-submit]').trigger('click');
				},
				cancel: function() {
					location.href = "<?php echo getUrl('index', 'index');?>";
				},
				setup: function() {
					location.href = "<?php echo getUrl('index');?>";
				}
			};

			var defaultData = [
					{name: 'id', type: 'MEDIUMINT(8)', value: '', desc: '自增主键', primary: true, auto_increment: true, unsigned: true, notnull: true, unique: true, edit:false, off: true},
					{name: 'createtime', type: 'TIMESTAMP', value: 'CURRENT_TIMESTAMP', desc: '创建时间', primary: false, auto_increment: false, unsigned: false, notnull: true, unique: false, edit:false, off: true},
					{name: 'updatetime', type: 'TIMESTAMP', value: 'CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP', desc: '更新时间', primary: false, auto_increment: false, unsigned: false, notnull: true, unique: false, edit:false, off: true},
				];
			var postData = <?php echo set_value('fields', '\'\'', FALSE); ?>;

			table.render({
				elem: '#listTable' //指定原始表格元素选择器（推荐id选择器）
				//,height: 315 //容器高度
				,size: 'sm'
				,cols: [[

					{field:'name', width:150, edit:'text', title: '字段名称'},
					{field:'type', width:150, edit:'text', title: '类型'},
					{field:'value', width:400, edit:'text', title: '默认值'},
					{field:'desc', width:200, edit:'text', title: '描述'},

					{field:'primary', width:80, title: '主键', toolbar:'<div><input type="checkbox" name="primaryCheckbox" lay-filter="tableChoose" disabled lay-skin="primary" {{d.primary?\'checked\':\'\'}}></div>'},
					{field:'auto_increment', width:80, title: '自动递增', templet:'<div><input type="checkbox" name="auto_incrementCheckbox" lay-filter="tableChoose" disabled lay-skin="primary" {{d.auto_increment?\'checked\':\'\'}}></div>'},
					{field:'unsigned', width:80, title: '无符号', toolbar:'<div><input type="checkbox" name="unsignedCheckbox" lay-filter="tableChoose" lay-skin="primary" {{d.unsigned?\'checked\':\'\'}}></div>'},
					{field:'notnull', width:80, title: '非空', toolbar:'<div><input type="checkbox" name="notnullCheckbox" lay-filter="tableChoose" lay-skin="primary" {{d.notnull?\'checked\':\'\'}}></div>'},
					{field:'unique', width:80, title: '唯一值', toolbar:'<div><input type="checkbox" name="uniqueCheckbox" lay-filter="tableChoose" lay-skin="primary" {{d.unique?\'checked\':\'\'}}></div>'},

					{/*fixed:'right', */toolbar:'#tableOpt', width:150, title: '操作'}

				]], //设置表头
				data: postData || defaultData,
				limit: 1000, //假定值
				page: false
			});

			table.on('tool(listTable)', function(obj){ //注：tool是工具条事件名，test是table原始容器的属性 lay-filter="对应的值"
				var data = obj.data; //获得当前行数据
				var layEvent = obj.event; //获得 lay-event 对应的值（也可以是表头的 event 参数对应的值）
				var tr = obj.tr; //获得当前行 tr 的DOM对象

				if(layEvent === 'detail'){ //查看
					//do somehing
				} else if(layEvent === 'del'){ //删除
					obj.del();
					/*
					layer.confirm('确定要删除吗？', function(index){
					obj.del();
					layer.close(index);
					});*/
				} else if(layEvent === 'add'){ //编辑
					obj.add({off: true}); //不要选中效果
				}
			});

			layui.event('form',"checkbox(tableChoose)",{},function(obj){
				var $this = $(this),
					state = $this.is(':checked');
					field = $this.closest('td').data('field'),
					index = $this.closest('tr').data('index'),
					data = table.cache['listTable'];
				data[index][field] = state;

				table.reload('listTable',{
					data: data
				});
			});

		});
	</script>

<?php include VIEWPATH.'layout_footer.php'; ?>
