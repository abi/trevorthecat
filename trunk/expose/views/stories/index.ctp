<?php 


		//to carry url options for paginator
		echo $javascript->link('prototype.js');
		
   		$paginator->options(array('url'=>$this->params['pass'], 'model'=>'Story'));

?>		
		
		<div class="column span-6" style="height:100%">
			<br>
			<div id="sort-bar-nav" class="column span-6 last">
				<p>
				
				<?php
				
				$type = $this->params['pass'][0] ? $this->params['pass'][0] : 'all';
				$category = $this->params['pass'][1] ? $this->params['pass'][1] : 'all';
				
				if($this->params['pass'][2] == 'upcoming'){
					echo $html->link('View popular stories' , '/stories/index/' . $type.'/'.$category.'/popular',array("class" =>"sort-active button"));
				}else{
					echo $html->link('View upcoming stories' , '/stories/index/' . $type.'/'.$category.'/upcoming',array("class" =>"sort-active button"));
				}
				
				if($category != 'all'){
				echo "<br/><br/><fieldset><legend>Sub-categories</legend><br/>";
				
				//show sub-categories in the sidebar
				foreach($categories as $cat){
					
					if($cat['Category']['category'] == $category){
						
						foreach($cat['children'] as $subcat){
							echo $html->link($subcat['Category']['category'] , '/stories/index/' . $type.'/'.$subcat['Category']['category'].'/popular',array("class" =>"positive button"));
							echo "<br/><br/>";
						}
					}
					
				}
				
				echo "</fieldset>";
				}
				
				?>
				
				
				</p>
			</div>
		</div>
		
		<div class="column span-18 last">
		
			<div class="success hide">You were logged in successfully.</div>
			
			<div id="sort-bar" class="column span-18 last">
				<div id="sort-bar-title" class="column span-6">
					<h2> 
					<?php echo $this->params['pass'][1] ? ucfirst($this->params['pass'][1]) : 'All'; ?>
					</h2>
				</div>
				
				<div id="sort-bar-nav" class="column span-12 last">
					<p class="floatright">
				    <a class="sort-active button" href="">
				    most recent (NW)
					</a>
				    <a class="button" href="">
				    top in 24hr
					</a>
					<a class="button" href="">
				    week
					</a>
					<a class="button" href="">
				    month
					</a>
					</p>
				</div>
				
			</div>
			
			<?php 
			
				foreach ($stories['data'] as $story){
					echo $this->renderElement('story', array("story" => $story, "loggedIn" => $loggedIn));
				}
			?>
			
				<div class="column span-18 last" style="margin-top:30px">
			
				<?php
				
					echo $paginator->prev('<< Previous ', null, null, array('class' => 'disabled'));
					echo $paginator->next(' Next >>', null, null, array('class' => 'disabled'));
					echo $paginator->counter(); 		
				?>
					
				</div>
				
		</div>