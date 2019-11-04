			<?php
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

<script>
layui.use(['layer','alert','form'], function(){
	var $ = layui.jquery,
		form = layui.form;

	//监听提交
	form.on('submit(search)', function(data){
		if($(data.form).data('isSavePage')){
			$(data.form).data('isSavePage', false);
		}else{
			$(data.form).find('input[name=pageNum]').val(1);
		}
		return true;
	});

});
</script>
