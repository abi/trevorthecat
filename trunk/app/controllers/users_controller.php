<?php

class UsersController extends AppController
{
    var $name = 'Users';
    var $uses = array('User','Friend', 'Profile', 'Story','Vote','Comment');
    var $components = array('Recaptcha');

  	var $paginate = array(
        'limit' => 10,
        'order' => array(
            'Story.created' => 'desc'
        )

    );

 	function login() {
		$this->Auth->login();
  	}


	function logout() {
		$this->redirect($this->Auth->logout());
	}


   function register(){
	       
		$message = "";
		
		if (!empty($this->data))
		{
			$recaptchaValid = $this->Recaptcha->is_valid($this->params['form']);
			
			if($recaptchaValid){
				if ($this->User->save($this->data))
				{
					//besides creating a new user, create a new profile
					
					$file = "img/avatars/tux.png";
					$newfile = "img/avatars/" . $this->User->id . ".png";

					if (!copy($file, $newfile)) {
					    debug("failed to copy $file...\n");
					}
					
					//add the avatar url to the profile
					
					$this->data['Profile']['user_id'] = $this->User->id;
					$this->data['Profile']['avatar_file'] = "avatars/" . $this->User->id . ".png";
					
		            if ($this->Profile->save($this->data))
		            {
		                 $this->redirect('/users/login');
		            }
					
				}
			}
			else{
				$message = 'Invalid reCAPTCHA.';
			}
		}
		
		$this->set('message', $message);
		$this->set('recaptcha', $this->Recaptcha->display());
   
   }
	
	function view( $id , $sort = 'submitted'){
		
		//get stories submitted, commented, voted up or down by user
		$sql = $this->Story->getByUserSQL( $sort , $id);
		$data = $this->paginate('Story', $sql);
		$this->set('stories',compact('data'));
		
		//get profile and viewer-user relationships to display relevant buttons (like add as friend, remove friend, etc.)
		$conditions = "Profile.user_id = $id";
		$this->set('profile', $this->Profile->find($conditions));
		$this->set('friend', $this->Friend->isFriend($id, $this->Auth->user('id')));
		$this->set('follower', $this->Friend->isFollower($id, $this->Auth->user('id')));
		$this->set('you', ($this->Auth->user('id') == $id));
		
		//if the viewer is looking at his own profile
		if($id == $this->Auth->user('id')){
	    	$this->set('header', 2);
		}else{
			$this->set('header', 1);
		}
      
   	}


	function friends( $id ){
		
		$conditions = "Friend.user_id = $id";
		$this->set('friends', $this->Friend->findAll($conditions));
		$this->set('friend_page', $id == $this->Auth->user('id'));
		$this->set('type', 'Friend');
		
		if($id == $this->Auth->user('id')){
	    	$this->set('header', 2);
		}else{
			$this->set('header', 1);
		}
		
	}
	
	function followers( $id ){
		
		$conditions = "Friend.friend_id = $id";
		$this->set('friends', $this->Friend->findAll($conditions));
		$this->set('header', 2);
		$this->set('friend_page', false);
		$this->set('type', 'Follower');
		
		$this->render('friends');
		
		if($id == $this->Auth->user('id')){
	    	$this->set('header', 2);
		}else{
			$this->set('header', 1);
		}
		
	}
   	
	function beforeFilter() {
				
		parent::beforeFilter();
		//login is allowed by default in Auth
		$this->Auth->allow('register');
						
	}
	   
       
}

?>