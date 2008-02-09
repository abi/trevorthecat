

<?php echo $form->create('Story', array('action' => 'submit2')); ?>

<fieldset class="column span-22 last">
<legend>Submit something new</legend>

   <?php
		//<h1>Submit a new story</h1>
		echo "<label for='data[Story][link]'>Link</label>";
        echo $form->input('link', array('type' => 'text', 'label' => false, 'class' => 'text submit-link', 'length' => 200)); 
		echo "<br/>";
		echo "<label for='data[Story][type]'>Type</label>";
        echo $form->input('type', array( 'label' => false, 'options' => array('text' => 'text',  'video' => 'video')));
		echo "<br/>";
		
    ?>


      <button type="submit" class="button positive">
       <img src="css/blueprint/plugins/buttons/icons/key.png" alt=""/> Submit
      </button>
</fieldset>
				
		
<?php echo $form->end(); ?>

