<?php

class StoriesController extends AppController
{
    var $name = 'Stories';
    var $uses = array('Story','Comment', 'Category', 'Vote');
  	var $helpers = array('Html', 'Time', 'Ajax'); 
    var $components = array('Comments');
  	
  	var $paginate = array(
        'limit' => 10,
        'order' => array(
            'Story.created' => 'desc'
        )

    );

                      
    function index($type = 'all' , $category = 'all', $status = 'popular')
    {
    	        
        $conditions = array();
        
        //type
        if(!($type == 'all')){
        	array_push($conditions, "Story.type = '$type'");
        }
        
        //categories
        if( !($category == 'all')){
        	  array_push($conditions, $this->Category->getCategoriesSQL($category));
        }
        
        //status

        if ( $status == 'upcoming'){
        	array_push($conditions, "Story.popular = '0000-00-00 00:00:00.0'");
        }
        else{
        	array_push($conditions, "NOT Story.popular = '0000-00-00 00:00:00.0'");
			$this->paginate['order'] = "Story.popular DESC"; 
        }
        
 		//paginate and set the stories
        $data = $this->paginate('Story', $conditions);
    	$this->set('stories',compact('data'));
    }    
    
    
    
    function view($id = null)
    {
        
		//get and set the story
		$this->Story->id = $id;
	    $this->set('story', $this->Story->read());
        
        //get all comments of the story
        $conditions = array("Comment.story_id" => $id);
		$comments = $this->Comment->findAllThreaded($conditions,array(),'Comment.created ASC');
		
		//use the comments component to add indent level and number of votes for each component
		$this->set('comments',  $this->Comments->get($comments));
    }
    
    function submit()
    {
		//1st page of 2 page submit process
		//all data is handled by submit2()
    }

	function submit2(){
		
		if (!empty($this->data))
        {
			//data has been sent from submit -> submit2
			//analyse link and extract relevant info
			$url = $this->data['Story']['link'];
			$type = $this->data['Story']['type'];
			
			//if current step is submit -> submit2
			if(empty($this->data['Story']['title'])){
				
				//extract the title from story
				$doc = new DOMDocument();
				$doc->loadHTMLFile($url);			
				$title = $doc->getElementsByTagName('title')->item(0)->nodeValue;
				
			}
			//if data has been sent from submit2
			else{
				
				$this->data['Story']['user_id'] = $this->Auth->user('id');
	        	$this->data['Story']['popular'] = 0;
	
				if($this->Story->save($this->data)){
					$this->redirect('/stories/view/' . $this->Story->id);
		        }
							
				$title = $this->data['Story']['title'];
				
			}
			
			//set the story params that need to be used in the forms
			$this->set('story_link', $url);
			$this->set('story_type', $type);
			$this->set('story_title', $title);
			
			//display the list of categories as options for the user
			$this->set('categories', $this->Category->findAllThreaded());
			
		}
			
	}
    
	function beforeFilter() {
        
		parent::beforeFilter();	
        $this->Auth->allow('view', 'index');
		$this->Auth->deny('submit');
	}

}

?>