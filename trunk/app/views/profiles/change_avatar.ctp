	<div class="column span-24 last">
	<fieldset>
		<legend>Change your avatar</legend>

<?php 
	
	echo $error;

	echo $form->create('Profile', array('action' => 'change_avatar', 'type' => 'file')); 
	
	echo $html->image($avatar_file);
	
	echo "<br/>";
	
	echo $form->file('avatar_file');    

	echo "<br/><strong>Your file must be in png and must be square. And larger the better, at least 128 X 128 for clarity on profiles</strong><br/>";

?>
		<br/>
	      <button type="submit" class="button positive">
	       Change avatar
	      </button>

	</fieldset>
	</div>

<?php

	echo $form->end(); 
?>
