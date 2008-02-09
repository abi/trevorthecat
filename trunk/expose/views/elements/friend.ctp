<div class="column span-7">
	
	<div align="left" class="column span-4">
		<?php echo $image->resize($friend[$type.'_profile']['avatar_file'], 128, 128, true, array('class' => 'photo') ); ?>
	</div>
	<div class="column span-3 last">
		<h3 class="">
		<?php echo ucfirst($friend[$type.'_profile']['first_name']) . " " . ucfirst($friend[$type.'_profile']['last_name']);?>
		</h3>
		<strong><?php echo $html->link($friend[$type.'_user']['nick'], '/users/view/' . $friend[$type.'_user']['id']); ?></strong><br><br>
		
		<?php
		if($friend_page){
			
			echo $html->link('Remove friend', '/friends/remove/' . $friend[$type.'_user']['id']  ,array("class" => "button friend-button negative"));
		}
		?>
	</div>
	
</div>