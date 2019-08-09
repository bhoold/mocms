<?php include VIEWPATH.'layout_header.php'; ?>

	<div id="page-header">
		<div class="title">全局配置</div>
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
				<div class="item">全局设置</div>
				<div class="item">功能模块</div>
				<div class="item">数据模型</div>
				<div class="item">页面模板</div>
			</div>
		</div>
		<div id="main">
			<div class="info-message" style="display:none;"><?php echo $message;?></div>
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
					<th lay-data="{field:'id', width:80}">ID</th>
					<th lay-data="{field:'username', width:150}">账号</th>
					<th lay-data="{field:'sex', width:80}">性别</th>
					<th lay-data="{field:'email', width:250}">电子邮箱</th>
					<th lay-data="{field:'state', width:80}">状态</th>
					<th lay-data="{field:'regtime', width:200}">注册时间</th>
					<th lay-data="{field:'regip', width:150}">注册IP</th>
					<th lay-data="{field:'lastlogintime', width:200}">最后登录时间</th>
					<th lay-data="{field:'lastloginip', width:150}">最后登录IP</th>
					<th lay-data="{field:'createbyadmin', width:150}">是否后台注册</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($list as $item):?>
					<tr>
					<td></td>
					<td><?php echo $item['id'];?></td>
					<td><?php echo $item['username'];?></td>
					<td><?php if($item['sex']==='1'){echo '男';}elseif($item['sex']==='0'){echo '女';}else{echo '保密';}?></td>
					<td><?php echo $item['email'];?></td>
					<td><?php echo $item['state'] ? '启用' : '停用';?></td>
					<td><?php echo $item['regtime'];?></td>
					<td><?php echo $item['regip'];?></td>
					<td><?php echo $item['lastlogintime'];?></td>
					<td><?php echo $item['lastloginip'];?></td>
					<td><?php echo $item['createbyadmin'] ? '是' : '否';?></td>
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
