<?php
class Story extends AppModel
{
   var $name = 'Story';

   var $belongsTo = array(
        'User' => array(
            'className'    => 'User',
        ),
        'Category' => array(
            'className'    => 'Category',
        )
    );
  
   var $hasMany = array(
        'Comment' => array(
            'className'     => 'Comment'
        ),
        
        'Vote' => array(
            'className'     => 'Vote',
            'foreignKey'    => 'content_id',
            'conditions'    => 'Vote.content_type = \'story\'',
            'order'    => 'Vote.created DESC',
            'dependent'=> true
        )
    );
   
   
    var $validate = array(
        'title' => array( 
						'rule' => array('between', 1, 60),
						'required' => true,
						'allowEmpty' => false,
						'message' => 'You need a title that is between 5 and 80 characters'
					),
        'description' => array( 
						'rule' => array('between', 1, 350),
						'required' => true,
						'allowEmpty' => false,
						'message' => 'You need a description that is between 5 and 350 characters'
					),
        'link' => array( 
						'rule' => array('minLength', '3'), //TODO: url validation rule doesn't seem to work sometimes
						'required' => true,
						'allowEmpty' => false,
						'message' => 'Your link must be an URL'
					),
        'type' => array( 
						'rule' => array('checkType'),
						'required' => true,
						'allowEmpty' => false,
						'message' => 'Invalid type'
					),
        'category_id' => array( 
						'rule' => array('checkCategory'),
						'required' => true,
						'allowEmpty' => false,
						'message' => 'Invalid category'
					),
	    'popular' => array( 
						'rule' => array('comparison', '==', 0),
						'required' => true,
						'allowEmpty' => false,
						'on' => 'create',
						'message' => 'Invalid popularity status'
					)
		); 
		
	function afterFind($results){
		
		//add a votes column for each story
		foreach($results as &$story){
			$story['Story']['votes'] = $this->Vote->getVotes('up', $story['Story']['id'], 'story') - $this->Vote->getVotes('down', $story['Story']['id'], 'story');
		}
		
		return $results;
	}
	
	//FUNCTIONS
	
    function checkType($data)
    {
        $valid = false;
                
        $validTypes = array("text", "image", "audio", "video");
        
        if( in_array($data, $validTypes))
        {
            $valid = true;
        }
        
        return $valid;
   }   
   
    function checkCategory($data)
    {
        $valid = false;
        
        $conditions = "Category.id = $data AND Category.parent_id > 0";
                        
        if( $this->Category->findCount($conditions) > 0)
        {
            $valid = true;
        }
        
        return $valid;
   }       


   function makePopular ($id=null){

	      if ($id)
	      {
	          $this->query("UPDATE `stories` SET `popular` = NOW() WHERE `id` = $id");
	      }
 
   }

	//gets all stories that are voted up, voted down, submitted or commented by set of users
	
	function getByUserSQL( $sort , $id){
		
		
		if(is_array($id)){
			$userIdList = $this->convertListSQL($id, 'Friend', 'friend_id');
		}
		else{
			$userIdList = "( " . $id . " )";
		}
		
		if($sort == 'voted_up' || $sort == 'voted_down'){
			
			if($sort == 'voted_up'){
				$vote_type = 'up';
			}
			else{
				$vote_type = 'down';
			}
			
			//find all votes by the list of users
			$conditions = "Vote.type = '$vote_type' AND Vote.user_id IN $userIdList AND Vote.content_type = 'story'";
	        $idList = $this->Vote->findAll($conditions,'content_id');
	
			//extract all the stories voted on
			$sqlIdList = $this->convertListSQL($idList, 'Vote', 'content_id');
			$sql = "Story.id IN $sqlIdList";

	        
		}
		else if($sort == 'commented'){
			
			//find all comments by the list of users
			$conditions = "Comment.user_id IN $userIdList";
	        $idList = $this->Comment->findAll($conditions,'story_id');
			
			//extracts all stories from the comments
			$sqlIdList = $this->convertListSQL($idList, 'Comment', 'story_id');
			$sql = "Story.id IN $sqlIdList";
			
		}
		else{
			
			//find stories that are submitted by the set of users
			$sql = "Story.user_id IN $userIdList";
			
		}
		
		return $sql;
		
	}

}
?>