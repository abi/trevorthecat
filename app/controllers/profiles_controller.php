<?php

class ProfilesController extends AppController
{
    var $name = 'Profiles';

   	function edit(){
	
	    if (!empty($this->data))
        {
			
			//editing profile currently involves deleting the old profile and then, creating a new profile with same userid
			//TODO: find a more efficient way
			
			$this->data['Profile']['user_id'] = $this->Auth->user('id');
			$this->data['Profile']['avatar_file'] = "avatars/" . $this->Auth->user('id') . ".png";
			
			$conditions = "Profile.user_id = " . $this->Auth->user('id');
			$this->Profile->deleteAll($conditions);
			
            if ($this->Profile->save($this->data))
            {
                  	$this->redirect('/users/view/' . $this->Auth->user('id'));
            }

       	 }else{
					$conditions = "Profile.user_id = " . $this->Auth->user('id');
					$this->set('profile', $this->Profile->find($conditions));	
		}
		
	}
	
	function change_avatar(){
		
		if (!empty($this->data))
        {
	
			//TODO: check if png and > 128 X 128
			
			//move the uploaded file to the current location for the userid picture
			
			$target_path = "img/avatars/" . $this->Auth->user('id') . ".png"; 
			
			if($this->data['Profile']['avatar_file']['tmp_name']){
				if(!move_uploaded_file($this->data['Profile']['avatar_file']['tmp_name'], $target_path)) {
				   $error = "There was an error uploading the file, please try again!";
				}
				else{
					$this->redirect('/profiles/edit/');
				}
			}
		
			$this->set('error', $error);
		}
		else{	
			$this->set('error', '');
		}
		
		$conditions = "Profile.user_id = " . $this->Auth->user('id');
		$this->set('avatar_file', $this->Profile->field('avatar_file',$conditions));
		
	}
	
	function beforeFilter() {
				
		parent::beforeFilter();
		$this->set('header', 2);
						
	}
       
}

?>