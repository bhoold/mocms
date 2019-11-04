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

<script>
layui.use(['layer','alert'], function(){
	var $ = layui.jquery;

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
