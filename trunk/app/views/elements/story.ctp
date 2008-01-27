<div class="column span-18 last">
	
	<div class="column span-2">
			<h2 class="votes" align="center" id="<?php echo "votes_" . $story['Story']['id'] ?>"><?php echo $story['Story']['votes'] ?></h2>
			<p align="center">votes</p>

			
			<?php
			
			if($loggedIn){
				echo $ajax->link('up', '/votes/submit/story/' . $story['Story']['id'] . '/up', array("update" => "votes_" . $story['Story']['id']));
				echo "&nbsp;";
				echo $ajax->link('down', '/votes/submit/story/' . $story['Story']['id'] . '/down', array("update" => "votes_" . $story['Story']['id']));
			}
			else{
				echo $html->link('up', '/users/login');
				echo "&nbsp;";
				echo $html->link('down', '/users/login');
			}
			?>
			&nbsp

	</div>

	<div class="column span-16 last">
	
		<div class="column span-16 last">
			<a href="<?php echo $story['Story']['link']; ?>" class="story-title"><h3 class="story-title"><?php echo $story['Story']['title']; ?></h3></a>
		</div>
	
		<div class="column span-16 last story-info">
			
			<?php 				
				echo $image->resize($story['Profile']['avatar_file'], 10, 10, true );  
				
				?>
			<?php 
				echo $html->link( $story['User']['nick'], '/users/view/' . $story['User']['id'], array("class" => "avatar-username"));
			?> 

			submitted <?php echo $time->timeAgoInWords($story['Story']['created']) ?>
			<?php
				if($story['Story']['popular'] != 0){
				echo "<span class='story-popular'>made popular " . $time->timeAgoInWords($story['Story']['popular']) ."</span>";
				}
			?>
		</div>
		
		<div class="column span-16 last story-desc">
			<p class="story-desc"> <strong><?php echo strtoupper($story['Category']['category']); ?>/<?php echo strtoupper($story['Story']['type']); ?></strong> - <?php echo $story['Story']['description'] ?></p>
		</div>
		
		<div class="column span-16 last">
			
			<?php echo $html->link( sizeof($story['Comment']) . ' comments', "/stories/view/" . $story['Story']['id'], array("class" => "comment-link")) ?>

			&nbsp;&nbsp;&nbsp;
			<a href="" class="share-link">
				<span class="story-action">Share(NW)</span>
			</a>
			&nbsp;&nbsp;&nbsp;
			<a href="" class="report-link">
				<span class="story-action">Report(NW)</span>
			</a>
		</div>
		
	</div>				
</div>
