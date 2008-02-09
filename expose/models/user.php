<?php

class User extends AppModel
{
   var $name = 'User';

   var $hasOne = array(
        'Profile' => array(
            'className'    => 'Profile',
            'dependent'    => true
        )
    );
    
   var $hasMany = array(
        'Story' => array(
            'className'     => 'Story',
            'order'    => 'Story.created DESC',
            'limit'        => '5'
        ),
        'Comment' => array(
            'className'     => 'Comment',
            'order'    => 'Comment.created DESC',
            'limit'        => '5'
        ),
        'Vote' => array(
            'className'     => 'Vote',
            'foreignKey'    => 'user_id',
            'order'    => 'Vote.created DESC',
            'limit'        => '5',
            'dependent'=> true
        ),
		'Friend' => array(
            'className'     => 'Friend',
            'foreignKey'    => 'user_id',
            'order'    => 'RAND()',
            'limit'        => '5',
            'dependent'=> true
        ),
		'Message' => array(
	        'className'     => 'Message',
	        'foreignKey'    => 'sender_id',
	        'order'    => 'RAND()',
	        'limit'        => '5',
	        'dependent'=> true
	    )    
	);
    
    
    var $validate = array(
        'nick' => array(
        				'between' => array(
							'rule' => array('between', 4, 20), //TODO: allowed characters
							'required' => true,
							'allowEmpty' => false,
							'message' => 'Your nick must be between 4 and 20 characters'
						),
						
						'checkUnique' => array(
							'rule' => array('checkUnique', 'nick'),  
							'required' => true,
							'allowEmpty' => false,
							'message' => 'Nick has already been taken'
						)),
        'password' =>  array(
						'alphanumeric' => array(
							'rule' => 'alphaNumeric',
							'required' => true,
							'allowEmpty' => false,
							'message' => 'Only alphabets and numbers allowed'
						 ),
						 
						'minlength' => array(
							'rule' => array('minLength', '6'),  
							'required' => true,
							'allowEmpty' => false,
							'message' => 'Minimum length is 6 characters'
						)),
						 
        'email' =>  array(
        				'email' => array(
							'rule' => array('email', true),
							'required' => true,
							'allowEmpty' => false,
							'message' => 'You need to provide a valid email'
						),
						
						'checkUnique' => array(
							'rule' => array('checkUnique', 'email'),  
							'required' => true,
							'allowEmpty' => false,
							'message' => 'Email has already been registered'
						))
		);
		
    function checkUnique($data, $fieldName)
    {
        $valid = true;
                
        $conditions = "User.$fieldName = '$data'";

        if($this->findCount($conditions) > 0)
        {
            $valid = false;
        }
        
        return $valid;
   }
   	
}
?>