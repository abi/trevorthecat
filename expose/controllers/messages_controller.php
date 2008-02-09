<?php

class MessagesController extends AppController
{
    var $name = 'Messages';  
  	var $helpers = array('Ajax'); 
    var $components = array('RequestHandler');


	var $paginate = array(
        'limit' => 2,
        'order' => array(
            'Message.created' => 'desc'
        )

    );

    function send()
    {
		if (!empty($this->data))
        {
			$this->data['Message']['sender_id'] = $this->Auth->user('id');
			
            if ($this->Message->save($this->data))
            {
	            $this->set('message', 'Message sent');  	

        	}
			else{
	            $this->set('message', 'Message sending failed. Try again later and pls report.');  	
			}
			
			$this->render('send');
			
		}
    
    }
    
	function index( $type){
		
		if($type == "sent"){
			$id = "sender_id";
			$sent = true;
		}
		else{
			$id = "recipient_id";
			$sent = false;
		}
				
		$conditions  = "Message.$id = ". $this->Auth->user('id');
		$data = $this->paginate('Message', $conditions);
    	$this->set('messages', compact('data'));
		$this->set('sent', $sent);

	}

	function beforeFilter() {
				
		parent::beforeFilter();
		$this->set('header', 2);
					
	}



}

?>