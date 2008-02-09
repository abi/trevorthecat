
	   <?php
	 	  	echo $javascript->link('prototype.js');
			echo $javascript->link('effects.js');

	    ?>




<?php echo $form->create('Story', array('action' => 'submit2')); ?>


<fieldset class="column span-22 last">
<legend>Complete your submission</legend>

   <?php

        echo $form->input('title', array('type' => 'text', 'class' => 'text submit-title', 'value' => $story_title));        
		
		echo $form->input('description', array('rows'=>'3', 'class' => 'submit-desc'));
        
		echo $form->hidden('link', array('value' => $story_link, 'name' => 'data[Story][link]'));
        echo $form->hidden('type', array('value' => $story_type, 'name' => 'data[Story][type]'));
		
		
		echo "<strong>Category</strong> <br/><br/>";
		
  		foreach($categories as $supercategory){
			
			
			echo "<button href='javascript:none' type='button' class='button positive' onclick=\"Effect.Appear('sub_". $supercategory['Category']['category'] . "')\">";
		    echo $supercategory['Category']['category'];
		    echo "</button>";
		
			echo "<div id='sub_". $supercategory['Category']['category'] . "' style='display:none''>";
			
			foreach($supercategory['children'] as $subcategory){
							
				echo "<input type=\"radio\" name=\"data[Story][category_id]\" value=\"" . $subcategory['Category']['id'] . "\">" .$subcategory['Category']['category'].  "</input>"; 
			}
			
			echo "</div>";
			echo "<br/><br/>";
	
		}
		

			
		
    ?>
				
		      <button type="submit" class="button error">
		       Done! Submit this!
		      </button>
		</fieldset>
		
<?php echo $form->end(); ?>