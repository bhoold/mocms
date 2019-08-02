<?php include VIEWPATH.'layout_header.php'; ?>

	<div id="page-header">
		<div class="title">
			<p><?php echo lang('index_heading');?></p>
		</div>
		<div class="tooles btn-containe">
			<div class="left">
				<button class="layui-btn layui-btn-primary">新建</button>
				<button class="layui-btn">编辑</button>
				<button class="layui-btn">删除</button>
			</div>
			<div class="right">
				<button class="layui-btn">设置</button>
			</div>
		</div>
	</div>
	<div id="page-content">
		<div id="left-menu">
			<div class="list">
				<div class="item"><?php echo anchor('auth/create_user', lang('index_create_user_link'))?> </div>
				<div class="item"><?php echo anchor('auth/create_group', lang('index_create_group_link'))?></div>
			</div>
		</div>
		<div id="main">
			<div class="info-message layui-alert">
			<button type="button" class="close">×</button>
				<?php echo $message;?>
			</div>
			<div class="list-filter">
				<div class="item">
					<span class="lable">账户</span>
					<input class="layui-input inline" type="text" name="title" autocomplete="off">
				</div>
				<div class="btn-container">
					<button class="layui-btn">搜索</button>
				</div>
			</div>
			<table class="layui-hide" id="listTable" lay-filter="listTable">
				<thead>
					<tr>
					<th lay-data="{type:'checkbox', fixed: 'left'}"></th>
					<th lay-data="{field:'username', width:150}"><?php echo lang('index_fname_th');?></th>
					<th lay-data="{field:'sex', width:150}"><?php echo lang('index_lname_th');?></th>
					<th lay-data="{field:'email', width:250}"><?php echo lang('index_email_th');?></th>
					<th lay-data="{field:'lastlogintime', width:250}"><?php echo lang('index_groups_th');?></th>
					<th lay-data="{field:'state', width:80}"><?php echo lang('index_status_th');?></th>
					<th lay-data="{field:'regip', width:150}"><?php echo lang('index_action_th');?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($users as $user):?>
					<tr>
					<td></td>
					<td><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
					<td><?php echo htmlspecialchars($user->last_name,ENT_QUOTES,'UTF-8');?></td>
					<td><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
					<td>
					<?php foreach ($user->groups as $group):?>
						<?php echo anchor("auth/edit_group/".$group->id, htmlspecialchars($group->name,ENT_QUOTES,'UTF-8')) ;?><br />
					<?php endforeach?>
					</td>
					<td><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, lang('index_active_link')) : anchor("auth/activate/". $user->id, lang('index_inactive_link'));?></td>
					<td><?php echo anchor("auth/edit_user/".$user->id, 'Edit') ;?></td>
					<td></td>
					</tr>
					<?php endforeach;?>
				</tbody>
    		</table>
			<div id="pager"></div>
		</div>
	</div>






<script>


layui.use(['form', 'table','laypage','layer','alert'], function(){
	var $ = layui.jquery,
		form = layui.form,
		table = layui.table,
		pager = layui.laypage;

  //监听提交
  form.on('submit(*)', function(data){

    //layer.msg(JSON.stringify(data.field));
    return true;
  });




	//转换静态表格
	table.init('listTable', {
		//height: 315 //设置高度
		//,limit: 10 //注意：请务必确保 limit 参数（默认：10）是与你服务端限定的数据条数一致
		//支持所有基础参数
		page: false
	});

	pager.render({
		elem: 'pager',
		layout: ['prev', 'page', 'next', 'count', 'limit', 'skip'],
		count: 100,
		curr: 5,
		limit: 10,
		//limits: [10,12],
		jump: function(obj, first){
			//首次不执行
			if(!first){
				$('#form-filter input[name="pageNum"]').val(obj.curr);
				$('#form-filter input[name="pageSize"]').val(obj.limit);
				$('#form-filter').data('isSavePage', true);
				$('#form-filter button[lay-submit]').trigger('click');
			}
		}
  });






});
</script>


<?php include VIEWPATH.'layout_footer.php'; ?>
