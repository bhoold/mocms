<?php include VIEWPATH.'layout_header.php'; ?>

	<div id="page-header">
		<div class="title"><?php echo $page_title;?></div>
		<div class="tooles btn-containe">
			<div class="left">
				<button class="layui-btn layui-btn-primary" data-type="add">新建</button>
				<button class="layui-btn" data-type="edit">编辑</button>
				<button class="layui-btn" data-type="del">删除</button>
			</div>
			<div class="right">
				<button class="layui-btn" data-type="setup">设置</button>
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
			<?php echo form_open(uri_string(), array('method'=>'get','class'=>'layui-form','lay-filter'=>'form')); ?>

				<?php echo form_hidden('pageNum', $index_pager['pageNum']);?>
				<?php echo form_hidden('pageSize', $index_pager['pageSize']);?>

				<div class="item">
					<span class="lable">组名称</span>
					<input class="layui-input inline" type="text" name="filter[name]" autocomplete="off" value="<?php echo $index_filter['name'];?>">
				</div>
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
					<th lay-data="{field:'name', width:200}">组名称</th>
					<th lay-data="{field:'description', minWidth:500}">组描述</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($index_list as $item):?>
					<tr>
					<td></td>
					<td><?php echo $item['id'];?></td>
					<td><?php echo htmlspecialchars($item['name'],ENT_QUOTES,'UTF-8');?></td>
					<td><?php echo htmlspecialchars($item['description'],ENT_QUOTES,'UTF-8');?></td>
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
		//height: 315 //设置高度
		//,limit: 10 //注意：请务必确保 limit 参数（默认：10）是与你服务端限定的数据条数一致
		//支持所有基础参数
		limit: <?php echo $index_pager['pageSize'];?>,
		page: false
	});

	pager.render({
		elem: 'pager',
		layout: ['prev', 'page', 'next', 'count', 'limit', 'skip'],
		count: <?php echo $index_pager['count'];?>,
		curr: <?php echo $index_pager['pageNum'];?>,
		limit: <?php echo $index_pager['pageSize'];?>,
		//limits: [10,12],
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





  $('#page-header .tooles .layui-btn').on('click', function(){
    var type = $(this).data('type');
    active[type] ? active[type].call(this) : '';
  });


  var active = {
		add: function() {
			location.href = "<?php echo getUrl('index','create_group');?>";
		},
		edit: function() {
			var checkStatus = table.checkStatus('listTable');
			if(checkStatus.data.length){
				var id = checkStatus.data[0].id;
				location.href = "<?php echo getUrl('index','edit_group/" + id + "');?>";
			}else{
				layer.msg('请从列表选择数据', {icon: 5, shift: 6});
			}
		},
		del: function() {
			var checkStatus = table.checkStatus('listTable');
			if(checkStatus.data.length){
				layer.confirm('是否删除所选数据?', function() {
					var ids = [];
					layui.each(checkStatus.data, function(index, item){
						ids.push(item.id);
					});

					$('#main .list-filter form').prepend('<input type="hidden" name="_action" value="delete" /><input type="hidden" name="_action_id" value="'+ids.join(',')+'" />');

					$('#main .list-filter form').data('isSavePage', true);
					$('#main .list-filter form button[lay-submit]').trigger('click');
				});
			}else{
				layer.msg('请从列表选择数据', {icon: 5, shift: 6});
			}
		},
		setup: function() {
			location.href = "<?php echo getUrl('index');?>";
		}


  };





});
</script>


<?php include VIEWPATH.'layout_footer.php'; ?>
