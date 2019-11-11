	<div id="page-header">
		<div class="title"><?php echo $page_title;?></div>
		<div class="tooles btn-containe">
			<div class="left">
				<?php
				if(isset($tooles_btns) && isset($tooles_btns['left'])) {
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
				if(isset($tooles_btns) && isset($tooles_btns['right'])) {
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

<script>
layui.use(['layer','alert','util','table'], function(){
	var $ = layui.jquery,
	util = layui.util,
	table = layui.table;

	util.event('lay-btn-event', {
		<?php
		if(isset($tooles_btns['left'])) {
			foreach($tooles_btns['left'] as $group) {
				foreach($group as $item) {
					if(isset($item['event'])) {
						$item['event']();
					}
				}
			}
		}
		if(isset($tooles_btns['right'])) {
			foreach($tooles_btns['right'] as $group) {
				foreach($group as $item) {
					if(isset($item['event'])) {
						$item['event']();
					}
				}
			}
		}
		?>
	});

});
</script>
