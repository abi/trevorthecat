<?php

class FriendsController extends AppController
{
    var $name = 'Friends';
    var $uses = array('User','Friend', 'Profile', 'Story','Vote','Comment');

    function add($friend_id)
    {
		if($friend_id && $friend_id != $this->Auth->user('id')){
			
			$this->data['Friend']['user_id'] = $this->Auth->user('id');
			$this->data['Friend']['friend_id'] = $friend_id;
			
			//add a friend if the person is not already a friend
	        if(!($this->Friend->isFriend($this->data['Friend']['friend_id'], $this->data['Friend']['user_id']))){
				if($this->Friend->save($this->data)){
					$this->flash('You have befriended the person','/stories/');
				}
	    	}
		}

    }

	function remove($friend_id){
		
		if($friend_id && $friend_id != $this->Auth->user('id')){
        
		    $conditions = "Friend.user_id = " . $this->Auth->user('id') . " AND Friend.friend_id = " . $friend_id;
			
			if($this->Friend->deleteAll($conditions)){
					$this->flash('You are no longer friends with this asshole','/stories/');
			}
			
		}		
		
	}
	
	
	function activity($sort = 'submitted'){
				
		//get array of friends
		$conditions = "Friend.user_id = " . $this->Auth->user('id');
		$friends = $this->Friend->find('all', array('conditions' => $conditions));
		
		//get stories by this group of friends
		$sql = $this->Story->getByUserSQL( $sort , $friends);
		
		//paginate the stories
		$data = $this->paginate('Story', $sql);
		$this->set('stories',compact('data'));
		$this->set('header', 2);
		
	}	    


	function beforeFilter() {
				
		parent::beforeFilter();
					
	}
	
}

?>