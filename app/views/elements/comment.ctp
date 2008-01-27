<div id="comment" class="column last comment" style="width:<?php echo 700 - $comment['Comment']['indent'] * 100;?>px;margin-left:<?php echo $comment['Comment']['indent'] * 100;?>px;">
	
	<div id="comment-header" class="column last comment-header">
			<img src="http://digg.com/users/TheVigilante/s.png" class="avatar-small"/> 
			<?php 
				echo $html->link( $comment['User']['nick'], '/users/view/' . $comment['User']['id'], array("class" => "avatar-username"));
				echo "&nbsp;&nbsp;&nbsp;" . $time->timeAgoInWords($comment['Comment']['created']);
				echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>(<span id='comment_votes_" .  $comment['Comment']['id'] ."'>" . $comment['Comment']['votes'] . "</span>)</strong>";
				echo $ajax->link($html->image('http://digg.com/img/c-digg.png', array('class' => 'comment-up')), '/votes/submit/comment/' . $comment['Comment']['id'] . '/up', array("update" => 'comment_votes_' .  $comment['Comment']['id']),null, false);
				
			?>
					
	</div>
	
	<br>
	<div id="comment-body" class="column last comment-body">
		<p class="comment-text"><?php echo $comment['Comment']['body']; ?></p>
	</div>
	
	<div id="comment-actions" class="column last comment-actions">
		<a href="javascript:none" class="comment-link">
			<span class="story-action" onclick="Effect.Appear('<?php echo 'replyForm' . $comment['Comment']['id'];?>');">Reply</span>
		</a>
		&nbsp;&nbsp;&nbsp;
		<a href="" class="report-link">
			<span class="story-action">Spam</span>
		</a>
	</div>

</div>

<?php

	

	 echo $this->renderElement('comment_box', array("comment_id" => $comment['Comment']['id'], 'display' => 'none',
								"story_id" => $comment['Comment']['story_id'], "comment_indent" => $comment['Comment']['indent'])); //, "votes" => $comment['Comment']['votes'], "body" => $comment['Comment']['body']));
	
?>

<div id="next_comment_<?php echo $comment['Comment']['id'];?>">

</div>

