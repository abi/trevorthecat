
<?php


	$paginator->options(array('url'=>$this->params['pass'], 'model'=>'Story'));
	echo $javascript->link('prototype.js');
	

?>


<div class="column span-18 last">
		
		<div id="sort-bar" class="column span-18 last">

			<div id="sort-bar-nav" class="column span-18 last">
				<p class="">
				
				
				<?php
				
				$sorts_info = array( 'submitted' => array('submitted', 'Submitted', ''),
									'voted_up' => array('voted_up', 'Voted Up', ''),
									'voted_down' => array('voted_down', 'Voted Down', ''),
									'commented' => array('commented', 'Commented', ''));

				$sort = $this->params['pass'][0] ? $this->params['pass'][0] : 'submitted';
				$sorts_info[$sort][2] = 'sort-active';

				
				foreach ($sorts_info as $sort_info) {						
					echo $html->link($sort_info[1] , '/friends/activity/' . $sort_info[0] ,array("class" => $sort_info[2] . " button"));
					
				}
				
				?>
				
				
				</p>
			</div>
			
		</div>
		
		<div class="column span-18 last" style="margin-top:30px">
		
		<?php 
		
			foreach ($stories['data'] as $story){
				echo $this->renderElement('story', array("story" => $story, "loggedIn" => $loggedIn));
			}
		?>
		
		
			<?php
			
				echo $paginator->prev('<< Previous ', null, null, array('class' => 'disabled'));
				echo $paginator->next(' Next >>', null, null, array('class' => 'disabled'));
				echo $paginator->counter();

					
			?>
				
			</div>
		
		
	</div>

	
</div>
