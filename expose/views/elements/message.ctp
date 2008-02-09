<div class="column span-18">
	
	<div align="left" class="column span-4">
		<?php 
		
		if($sent){
			echo $image->resize($message['Recipient_profile']['avatar_file'], 128, 128, true, array('class' => 'photo') ); 
		}
		else{
			echo $image->resize($message['Sender_profile']['avatar_file'], 128, 128, true, array('class' => 'photo') ); 
		}
		
		?>
	</div>
	<div class="column span-14 last">

		<strong>
		<?php
		
			if($sent){
				echo $html->link( "To: " . $message['Recipient']['nick'], '/users/view/'. $message['Recipient']['nick']);
			}
			else{
				echo $html->link($message['Sender']['nick'], '/users/view/'. $message['Sender']['nick']);
			}
		
		?>
		</strong><br/>
		
		<?php
		
		echo $time->timeAgoInWords($message['Message']['created']);
		echo "<br/>";
		echo "<br/>";
		echo $message['Message']['message'];
		
		
		echo "<br/>";
		echo "<br/>";
		echo "<br/>";
		
		
		if(!$sent){
			
			echo $html->link('Reply', '#' , array("class" => "button reply-button positive", 'onclick' => "$('recipient_id').value = " . $message['Sender']['id'] . "; Lightbox.showBoxByID('send_message_box', 350, 300);return false;"));
		}
		?>
	</div>
	
</div>

<br/>
<br/>