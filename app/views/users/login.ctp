
<?php echo $form->create('User', array('action' => 'login')); ?>

<div class="column span-24 last">
<fieldset>
	<legend>Log In</legend>
   <?php
        echo $form->input('email' , array('class' => 'text' ));
        echo $form->input('password', array('class' => 'text' ));
    ?>
	
	<br/>
      <button type="submit" class="button positive">
       Login
      </button>

</fieldset>
</div>

<?php echo $form->end(); ?>