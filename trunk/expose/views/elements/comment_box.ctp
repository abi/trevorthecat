<div id="next_comment_<?php echo $comment_id;?>"></div>


<?php 	

		echo $ajax->form(array('action' => '/comments/submit'),  'post', array('id' => 'replyForm' . $comment_id, 'style' => 'width:' . (700 - $comment_indent * 100) . 'px;margin-left:' . ($comment_indent * 100) . 'px;display:'. $display, 'class' => "column span-18 last", 'update' => 'next_comment_' . $comment_id));
        echo $form->textarea('body', array('rows'=>'3', 'cols'=>'10', 'class' => 'reply-box', 'name' => 'data[Comment][body]'));
        echo $form->error('You can\'t submit an empty comment'); 
        echo $form->hidden('story_id', array('value' => $story_id, 'name' => 'data[Comment][story_id]'));
        echo $form->hidden('parent_id', array('value' => $comment_id, 'name' => 'data[Comment][parent_id]'));
		echo $form->end('Submit', array('class' => 'button reply-button'));
	 	
?>