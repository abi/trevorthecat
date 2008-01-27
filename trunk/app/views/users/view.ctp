<?php

	//debug($profile);

	$paginator->options(array('url'=>$this->params['pass'], 'model'=>'Story'));
	
	echo $javascript->link(array('prototype','mf_lightbox'));
	echo $html->css('lightbox');	

?>



	<div class="column span-6">
		
		<div align="left" class="column span-4">
			<?php 
			 		echo $image->resize($profile['Profile']['avatar_file'], 128, 128, true, array('class' => 'photo') ); 
			?>
		</div>
		<div class="column span-2 last">
				<h2 class="karma" align="left">110</h2>
				<strong>karma
				points (NW)</strong>
		</div>
		<br/>
		
		<div class="column span-6 last">
		<?php
		
			if($friend){
				echo $html->link('Remove friend', '/friends/remove/' . $profile['User']['id']  ,array("class" => "button friend-button negative"));
			}
			else if(!$you){
				echo $html->link('Add as friend', '/friends/add/' . $profile['User']['id']  ,array("class" => "button friend-button positive"));
			}
			
			if($you){
				echo $html->link('Edit Profile', '/profiles/edit/'  ,array("class" => "button friend-button positive"));
			}
			
			if($follower){
				echo $html->link('Send message', '#' , array("class" => "button friend-button positive", 'onclick' => "$('recipient_id').value = " . $profile['User']['id'] . "; Lightbox.showBoxByID('send_message_box', 350, 300);return false;"));
			
			}
			
			echo $html->link('View Friends', '/users/friends/' . $profile['User']['id']  ,array("class" => "button friend-button positive"));
			echo $html->link('View Followers', '/users/followers/' . $profile['User']['id']  ,array("class" => "button friend-button positive"));
			
			
		?>
		</div>
		
		<div class="column span-6 last">
		<div class="box">
			<h3 class="">
			<?php echo ucfirst($profile['Profile']['first_name']) . " " . ucfirst($profile['Profile']['last_name']);?>
			</h3>
				
			<strong><?php echo $profile['User']['nick']; ?></strong><br><br>
			
		<?php 
		if($profile['Profile']['website_label'] && $profile['Profile']['website_url']){
			echo $html->link( ucfirst($profile['Profile']['website_label']), $profile['Profile']['website_url']);
		}
		?>
		
		</div>
		</div>

		<?php
		
		if($profile['Profile']['about']){
			echo "<div class='column span-6 last'>";
			echo "<p class='box about'>" . $profile['Profile']['about'] . " </p>";
			echo "</div>";
		}
	
		
	?>
	</div>
	
	
	
		<div class="column span-18 last">
			
			<div id="sort-bar" class="column span-18 last">

				<div id="sort-bar-nav" class="column span-18 last">
					<p class="">
					
					
					<?php
					
					$sorts_info = array( 'submitted' => array('submitted', 'Submitted', ''),
										'voted_up' => array('voted_up', 'Voted Up', ''),
										'voted_down' => array('voted_down', 'Voted Down', ''),
										'commented' => array('commented', 'Commented', ''));

					$user_id = $this->params['pass'][0];
					$sort = $this->params['pass'][1] ? $this->params['pass'][1] : 'submitted';
					$sorts_info[$sort][2] = 'sort-active';

					
					foreach ($sorts_info as $sort_info) {						
						echo $html->link($sort_info[1] , '/users/view/' . $user_id .'/'.$sort_info[0] ,array("class" => $sort_info[2] . " button"));
						
					}
					
					?>
					
					
					</p>
				</div>
				
			</div>
			
			<?php 
			
				foreach ($stories['data'] as $story){
					echo $this->renderElement('story', array("story" => $story, "loggedIn" => $loggedIn));
				}
			?>
			
				<div class="column span-18 last" style="margin-top:30px">
			
				<?php
				
					echo $paginator->prev('<< Previous ', null, null, array('class' => 'disabled'));
					echo $paginator->next(' Next >>', null, null, array('class' => 'disabled'));
					echo $paginator->counter();
					
					//send message box (hidden)
					
					echo $this->renderElement('send_message_box');
						
				?>
					
				</div>
			
			
		</div>

		
	</div>
