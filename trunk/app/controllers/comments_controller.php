<?php

class CommentsController extends AppController
{
    var $name = 'Comments';
    var $components = array('RequestHandler');
    
    function submit()
    {
	
		//AJAX submitting of comments
		
        if (!empty($this->data))
        {
			$this->data['Comment']['user_id'] = $this->Auth->user('id');
			
            if ($this->Comment->save($this->data))
            {	
				$message = "Your comment has been added. Refresh your page to view it.";
				$this->set('type','success');
            }
			else{
				$message = "Some unknown error occurred. Try again";
				$this->set('type','error');
				
			}
			
			
			$this->set('message',$message);
            $this->render('submit');


        }
    }
    
    
}

?>