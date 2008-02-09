
<script language="javascript">
	Event.observe(window, 'load', init, false);
	
	function init() {
		Lightbox.init();
	}
</script>

<div id="send_message_box" style="display:none">

<?php
	
	echo "<strong><div id='updateEl'></div></strong	>";	
	echo $ajax->form(array('action' => '/messages/send'), 'post', array('update' => 'updateEl'));
	echo $form->textarea('message', array('rows'=>'2', 'name' => 'data[Message][message]', 'class' => 'send_message_box'));
	echo $form->error('You can\'t submit an empty message'); 
	echo $form->hidden('recipient_id', array( 'name' => 'data[Message][recipient_id]' , 'id' => 'recipient_id'));
	echo $form->end('Submit');
	

?>

</div>