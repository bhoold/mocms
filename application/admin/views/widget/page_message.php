<?php
				if($page_message) {
					if(is_array($page_message)) {
						echo '<div class="info-message layui-alert alert-'.$page_message['type'].'"><a class="close">x</a>'.$page_message['message'].'</div>';
					} else {
						echo '<div class="info-message layui-alert alert-info"><a class="close">x</a>'.$page_message.'</div>';
					}
				}
