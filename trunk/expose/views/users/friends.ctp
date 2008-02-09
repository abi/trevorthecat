
<?php

	foreach($friends as $friend){
				
		echo $this->renderElement('friend', array("friend" => $friend, "friend_page" => $friend_page, "type" => $type));
		
	}

?>