		<?php if(isset($index_leftMenu) && count($index_leftMenu)):?>
		<div id="left-menu">
			<div class="list">
				<?php foreach ($index_leftMenu as $item) {
					echo '<div class="item '.$item['active'].'">'.anchor($item['link'], $item['title']).'</div>';
				}
				?>
			</div>
		</div>
		<?php endif;?>
