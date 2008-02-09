<?php 


		echo $javascript->link(array('prototype','mf_lightbox'));
		
		//shouldn't be hardedcoded image locations in css
		echo $html->css('lightbox');
		
		$paginator->options(
            array('update'=>'content', 
                    'url'=>$this->params['pass'],
                    'model'=>'Message'));

?>

	
		<div class="column span-6">
		
		<h2>Messages</h2>
		<br/>
			<?php

				if($this->params['pass'][0] == 'received'){
					echo $html->link('Received', '/messages/index/received' ,array("class" => "button nav-button-active positive"));
					echo $html->link('Sent', '/messages/index/sent' ,array("class" => "button nav-button positive selected"));
					
				}
				else{
					echo $html->link('Received', '/messages/index/received' ,array("class" => "button nav-button positive"));
					echo $html->link('Sent', '/messages/index/sent' ,array("class" => "button nav-button-active positive selected"));
				}
					

			?>
			
		</div>
	
	
		<div class="column span-18 last">

		<?php 
		
		foreach ($messages['data'] as $message){
			
				echo $this->renderElement('message', array("message" => $message , "sent" => $sent));
					
		}
				
		echo $paginator->prev('<< Previous ', null, null, array('class' => 'disabled'));
		echo $paginator->next(' Next >>', null, null, array('class' => 'disabled'));
		echo $paginator->counter(); 
	
		echo $this->renderElement('send_message_box', array("message" => $message , "sent" => $sent));
		?>
				
		</div>
		


