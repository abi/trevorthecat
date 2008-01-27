
<?php 

 	  	echo $javascript->link('main.js');
 	  	echo $javascript->link('prototype.js');
		echo $javascript->link('effects.js');

		//debug($comments);
		//debug($story);

?>


	<div id="navigation" class="column span-6">

		
		<div class="column span-6 last">
			
			<div id="recently-voted">
				
			<h3>Recently voted</h3>
			
			<ul>
				<li>
					<img src="http://digg.com/users/TheVigilante/s.png" class="avatar-small"/> 
					<a href="" class="avatar-username">badwithcomputer</a> 
					<span>voted up</span>
				</li>
			</ul>
			
			<strong>NW</strong>
			</div>
			
		</div>

	</div>
	
	<div id="main-content" class="column span-18 last">
		
		<?php echo $this->renderElement('story', array("story" => $story)); ?>
		
		
		
		<br><br><br>
		
		<div id="comments" class="column span-18 last">
			
			<?php
			
				foreach ($comments as $comment){
				 	echo $this->renderElement('comment', array("comment" => $comment)); //, "votes" => $comment['Comment']['votes'], "body" => $comment['Comment']['body']));

				}
				
			?>
					
		</div>
		
		
		<?php 	

				 echo $this->renderElement('comment_box', array('comment_id' => '0', 'display' => '',
											"story_id" => $story['Story']['id'], "comment_indent" => '0'));
		 ?>
	
	</div>
	

