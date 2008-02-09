<?php
class Vote extends AppModel
{
   var $name = 'Vote';
   
   var $belongsTo = array(
        'Story' => array(
            'className'    => 'Story',
            'foreignKey'    => 'content_id',
            'conditions'    => 'Vote.content_type = \'story\'',            
        ),
        'Comment' => array(
            'className'    => 'Comment',
            'foreignKey'    => 'content_id',
            'conditions'    => 'Vote.content_type = \'comment\'',            
        ),
        'User' => array(
            'className'    => 'User',
            'foreignKey'    => 'user_id',
        )        
    );
    
    
    var $validate = array(
        'content_id' => array( 
						'rule' => 'numeric',
						'required' => true,
						'allowEmpty' => false,
						'message' => 'Invalid content ID'
					),
        'type' => array( 
						'rule' => array('checkType'),
						'required' => true,
						'allowEmpty' => false,
						'message' => 'Invalid vote type'
					),
        'content_type' => array( 
						'rule' => array('checkContentType'),
						'required' => true,
						'allowEmpty' => false,
						'message' => 'Invalid content type'
					),
		'user_id' => array( 
						'rule' => 'numeric', //TODO: checkUser()
						'required' => true,
						'allowEmpty' => false,
						'message' => 'Invalid user'
					)
	);
	
	function checkType($data)
    {
        $valid = false;
        $type = $data;
        
        $validTypes = array("up", "down");
        
        if(in_array($type, $validTypes))
        {
            $valid = true;
        }
        
        return $valid;
   }   
   
	function checkContentType($data)
    {
        $valid = false;
        $type = $data;
        
        $validTypes = array("story", "comment");
        
        if(in_array($type, $validTypes))
        {
            $valid = true;
        }
        
        return $valid;
   }

	function getVotes ( $type, $id, $content_type){
		
        $conditions = "Vote.content_id = $id AND Vote.type = '$type' AND Vote.content_type = '$content_type'";
        return $this->find('count', array('conditions' => $conditions));

	}
   
      
}
?>