

<?php 

 	if($message){
		echo "<div class=\"error column span-23 last\">$message</div>";
	}

	echo $form->create('User', array('action' => 'register')); 
	
?>

<div class="column span-24 last">
<fieldset>
	<legend>Register</legend>
	
<?php
        echo $form->input('email', array('class' => 'text'));
        echo $form->input('password', array('class' => 'text', 'value' => '')); 
        echo $form->input('nick', array('class' => 'text'));
        echo $form->hidden('active',array('value' => 1));
		
		echo "<br/><strong> Human? </strong>";
		echo $recaptcha;
		
?>

	<br/>
      <button type="submit" class="button positive">
       Register
      </button>

</fieldset>
</div>

<?php echo $form->end(); ?>


