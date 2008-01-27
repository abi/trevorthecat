
	<div class="column span-24 last">
	<fieldset>
		<legend>Edit your profile</legend>

<?php 
		echo $form->create('Profile', array('action' => 'edit'));
		echo "<label>Avatar</label>";
		echo "<br/>";
		
		echo $html->image($profile['Profile']['avatar_file']);
		
		echo "<br/>";
		echo $html->link('Change Avatar', '/profiles/change_avatar');
		echo "<br/>";
		echo "<br/>";
		
        echo $form->input('first_name', array('value' => $profile['Profile']['first_name'], 'class' => 'text'));        
        echo $form->input('last_name', array('value' => $profile['Profile']['last_name'], 'class' => 'text'));	
        echo $form->input('about', array('value' => $profile['Profile']['about']));        
        echo $form->input('mixx', array('value' => $profile['Profile']['mixx'], 'class' => 'text'));        
        echo $form->input('digg', array('value' => $profile['Profile']['digg'], 'class' => 'text'));        
        echo $form->input('website_label', array('value' => $profile['Profile']['website_label'], 'class' => 'text'));        
        echo $form->input('website_url', array('value' => $profile['Profile']['website_url'], 'class' => 'text'));        

?>

			<br/>
		      <button type="submit" class="button positive">
		       Update
		      </button>

		</fieldset>
		</div>

<?php echo $form->end(); ?>

<?php
	debug($profile);
	
?>