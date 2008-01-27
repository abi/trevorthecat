<div class="column span-24 border last">
	<div class="column span-4">
		<h1 id="expose"> <?php echo $html->link('Expose','/stories/index/all/all/popular', array('style' => 'color:black; text-decoration: none;')); ?></h1>
	</div>
	<div class="column span-20 last">
	
	<p class="floatright">
	<?php
			
		if($loggedIn){
			echo 'hi there, ' . $html->link($User['User']['nick'],'/users/view/'. $User['User']['id']) . " | ";
			echo $html->link('edit profile','/profiles/edit'). " | ";
			echo $html->link('submit','/stories/submit'). " | ";
			echo $html->link('logout','/users/logout');
		}
		else{
			echo $html->link('login','/users/login') . " | ";
			echo $html->link('register','/users/register');
		}
	?>
	
	</p>
	
	</div>
</div>


<div id="header" class="column span-24 border last">
	
<ul id="nav">
		
		<?php
		
		//debug($this->params);
		//debug($this->params[pass][0]);
		
		echo "<li>" . $html->link('All' ,"/stories/index/all/all/popular") . "</li>";
		echo "<li>" . $html->link('Stories' ,"/stories/index/text/all/popular") . "</li>";
		echo "<li>" . $html->link('Videos' ,"/stories/index/video/all/popular") . "</li>";
		?>

</ul>

<ul id="subnav">
				
		<?php

				foreach($categories as $category){

					
					$type = $this->params['pass'][0] ? $this->params['pass'][0] : 'all';
					
					echo "<li>";
					echo $html->link($category['Category']['category'] ,"/stories/index/$type/". $category['Category']['category'] . "/popular");
					echo "</li>";
				}


		?>
		
</ul>
</div>