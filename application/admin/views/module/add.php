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
							echo '<button class="layui-btn '.(isset($item['domClass'])?$item['domClass']:'').'" lay-btn-event="'.$item['action'].'">'.$item['text'].'</button>';
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
							echo '<button class="layui-btn '.(isset($item['domClass'])?$item['domClass']:'').'" lay-btn-event="'.$item['action'].'">'.$item['text'].'</button>';
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
				<input type="hidden" name="tableModelId">

				<div class="layui-form-item">
					<label class="layui-form-label">模块名称</label>
					<div class="layui-input-inline">
						<input type="text" name="title"  lay-verify="required" autocomplete="off" class="layui-input" value="<?php echo set_value('title'); ?>">
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">数据模型</label>
					<div class="layui-input-inline">
						<input readonly type="text" name="tableModelName"  lay-verify="required" autocomplete="off" class="layui-input" value="<?php echo set_value('tableModel'); ?>">
					</div>
					<div class="layui-word-aux">
						<button type="button" class="layui-btn" lay-btn-event="showModelModal">选择</button>
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">字段</label>
					<div class="layui-input-block">
					<button type="button" class="layui-btn" lay-btn-event="showFieldModal">选择</button>
					<table class="layui-hide" id="listTable" lay-filter="listTable"></table>
					</div>
				</div>
				<div class="layui-form-item">
					<label class="layui-form-label">模块类型</label>
					<div class="layui-input-inline">
						<select name="type" lay-filter="type">
							<option value=""></option>
							<option value="1">编辑页</option>
							<option value="2">列表页+编辑页</option>
						</select>
					</div>
				</div>
				<!--
				<div class="layui-form-item">
					<label class="layui-form-label">单页模板</label>
					<div class="layui-input-inline">
						<input type="text" name="title"  lay-verify="required" autocomplete="off" class="layui-input" value="<?php echo set_value('title'); ?>">
					</div>
				</div>-->
				<div class="layui-form-item">
					<label class="layui-form-label">列表页</label>
					<div class="layui-input-block">

						<div class="layui-tab">
							<ul class="layui-tab-title">
								<li class="layui-this">表格字段</li>
								<li>搜索字段</li>
							</ul>
							<div class="layui-tab-content">
								<div class="layui-tab-item layui-show">
									<div id="listTableTransfer" class="listTableTransfer"></div>
								</div>
								<div class="layui-tab-item">内容2</div>
							</div>
						</div>
					</div>
				</div><!--
				<div class="layui-form-item">
					<label class="layui-form-label">新增页</label>
					<div class="layui-input-inline">
						<input type="text" name="title"  lay-verify="required" autocomplete="off" class="layui-input" value="<?php echo set_value('title'); ?>">
					</div>
				</div>-->
				<div class="layui-form-item">
					<label class="layui-form-label">编辑页</label>
					<div class="layui-input-inline">
						<input type="text" name="title"  lay-verify="required" autocomplete="off" class="layui-input" value="<?php echo set_value('title'); ?>">
					</div>
				</div><!--
				<div class="layui-form-item">
					<label class="layui-form-label">详情页</label>
					<div class="layui-input-inline">
						<input type="text" name="title"  lay-verify="required" autocomplete="off" class="layui-input" value="<?php echo set_value('title'); ?>">
					</div>
				</div>-->

				<div class="layui-form-item layui-hide">
					<div class="layui-input-block">
						<button type="submit" class="layui-btn layui-btn-primary" lay-submit lay-filter="*">提交</button>
						<button type="reset" class="layui-btn">重置</button>
					</div>
				</div>
			<?php echo form_close(); ?>

		</div>
	</div>

	<script>
		layui.use(['form','layer','table','alert','util','transfer'], function(){
			var $ = layui.jquery,
				util = layui.util,
				layer = layui.layer,
				form = layui.form,
				table = layui.table,
				transfer = layui.transfer;

			form.on('submit(*)', function(data){
				return true;
			});


			var defaultData = [];
			var postData = <?php echo set_value('fields', '\'\'', FALSE); ?>;

			var fieldSTable = table.render({
				elem: '#listTable'
				,size: 'sm'
				,width: 800
				,cols: [[
					{field:'title', width:150, title: '字段'},
					{field:'label', minWidth:200, edit:'text', title: '名称'},
					{field:'formItemType', width:200, edit:'select', title: '表单输入类型'},
					{field:'validateType', width:200, edit:'text', title: '表单验证规则'},
				]],
				data: postData || defaultData,
				limit: 1000, //假定值
			});


			var transferData = [];
			var listTableTransfer = transfer.render({
				elem: '#listTableTransfer'
				,title: ['可用字段','已选字段']
				,data: transferData
			})


			//按钮动作事件
			util.event('lay-btn-event', {
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
				},


				showModelModal: function() {
					layer.open({
						title: '模型列表',
						type: 2,
						area: ['800px', '500px'],
						content: ['<?php echo getUrl('index', '/tableModel/modalList');?>', 'yes'],
						btnAlign: 'l',
						btn: ['选择'],
						yes: function(index, layero) {
							var isError = false;
							var childModal = $('iframe#layui-layer-iframe' + index)[0].contentWindow;
							if(!childModal.table) {
								isError = true;
							}
							if(!isError) {
								var rowData =childModal.table.checkStatus('listTable').data;
								if(!rowData.length) {
									isError = true;
								}
							}

							if(isError) {
								layer.msg('请从列表选择数据', {icon: 5, shift: 6});
							} else {

								$('input[name=tableModelId]').val(rowData[0].id);
								$('input[name=tableModelName]').val(rowData[0].title);
								layer.close(index);

							}

						}
					});
				},

				showFieldModal: function() {
					var id = $('input[name=tableModelId]').val();
					if(id < 1) {
						layer.msg('请先选择数据模型', {icon: 5, shift: 6});
						return;
					}

					var tableData = [];
					layui.each(table.cache.listTable, function(i, item) {
						tableData.push({
							'title': item.title
						})
					});
					var urlQueryStr = '';
					if(tableData.length) {
						urlQueryStr = '?tableData=' + encodeURI(JSON.stringify(tableData));
					}

					layer.open({
						title: '字段列表',
						type: 2,
						area: ['800px', '500px'],
						content: ['<?php echo getUrl('index', '/tableModel/modalFieldList/');?>'+id+urlQueryStr, 'yes'],
						btnAlign: 'l',
						btn: ['选择'],
						yes: function(index, layero) {
							var isError = false;
							var childModal = $('iframe#layui-layer-iframe' + index)[0].contentWindow;
							if(!childModal.table) {
								isError = true;
							}
							if(!isError) {
								var rowData =childModal.table.checkStatus('listTable').data;
								if(!rowData.length) {
									isError = true;
								}
							}

							if(isError) {
								layer.msg('请从列表选择数据', {icon: 5, shift: 6});
							} else {
								var tableData = [];
								var transferData = [];
								layui.each(rowData, function(i, item) {
									tableData.push({
										title: item.title,
										label: item.desc || item.title
									});
									transferData.push({
										title: item.desc || item.title,
										value: item.title
									})
								});
								fieldSTable.reload({
									data: tableData
								});

								listTableTransfer.reload({
									data: transferData
								});

								layer.close(index);
							}

						}
					});
				}
			});

		});
	</script>

<?php include VIEWPATH.'layout_footer.php'; ?>
