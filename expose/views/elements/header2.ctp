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
		
		//echo "<li>" . $html->link('My Profile' ,"/stories/index/all/") . "</li>";
		echo "<li>" . $html->link('Friends\' Activity' ,"/friends/activity/submitted") . "</li>";
		echo "<li>" . $html->link('Friends' ,"/users/friends/" . $User['User']['id']) . "</li>";
		echo "<li>" . $html->link('Followers' ,"/users/followers/" . $User['User']['id']) . "</li>";
		echo "<li>" . $html->link('Messages' ,"/messages/index/received") . "</li>";
		echo "<li>" . $html->link('Edit Profile' ,"/profiles/edit") . "</li>";
		?>

</ul>
</div>