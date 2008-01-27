<?php
class Friend extends AppModel
{
   	var $name = 'Friend';
   	
	var $belongsTo = array(
        'Follower_user' => array(
            'className'    => 'User',
            'foreignKey'    => 'user_id'
        ),
	    'Friend_user' => array(
	        'className'    => 'User',
	        'foreignKey'    => 'friend_id'
	    )
    );

    var $validate = array(
        'user_id' => array( 
						'rule' => array('checkUser'),
						'required' => true,
						'allowEmpty' => false,
						'message' => 'Invalid user'
					),
        'friend_id' => array( 
						'rule' => array('checkUser'),
						'required' => true,
						'allowEmpty' => false,
						'message' => 'Invalid user'
					)
	);
	
	function afterFind($results){
		
		//get the profile for each friend and the user/follower
		
		foreach($results as &$friend){
						
			loadModel('Profiles');
			$Profile = new Profile();
			$friend_profile = $Profile->findByUserId($friend['Friend']['friend_id']);
			$friend['Friend_profile'] = $friend_profile['Profile'];
			
			$follower_profile = $Profile->findByUserId($friend['Friend']['user_id']);
			$friend['Follower_profile'] = $follower_profile['Profile'];
			
		}
				
		return $results;
		
	}
 
    function checkUser($data)
    {
        $valid = false;

        $conditions = "User.id = $data";
                        
        if( $this->Friend_user->findCount($conditions) > 0)
        {
            $valid = true;
        }
        		
        return $valid;
   }


	function isFriend($id, $user_id){
		
		$conditions = "Friend.user_id = " . $user_id . " AND Friend.friend_id =" . $id;
		$isFriend = $this->findCount($conditions);
		
		if($isFriend == 0){
			return false;
		}
		else{
			return true;
		}
	}
	
	function isFollower($id, $user_id){
		
		$conditions = "Friend.user_id = " . $id . " AND Friend.friend_id =" . $user_id;
		$isFriend = $this->findCount($conditions);
		
		if($isFriend == 0){
			return false;
		}
		else{
			return true;
		}
	}
   
}
?>