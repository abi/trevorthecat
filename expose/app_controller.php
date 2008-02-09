<?php

class AppController extends Controller {

     var $components = array('Auth', 'Session', 'Cookie');
     var $helpers = array('Form','Html','Javascript','Time','Image');
 	 var $uses = array('Category');
    
 	 	
	 function beforeFilter() {
	 
		$this->Auth->fields = array('username' => 'email', 'password' => 'password');
		$this->Auth->autoRedirect = true;
		$this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
		$this->Auth->loginRedirect = array('controller' => 'stories', 'action' => 'index');
		$this->Auth->logoutRedirect = array('controller' => 'stories', 'action' => 'index');
		$this->Auth->loginError = 'Invalid e-mail / password combination. Please try again';
		$this->Auth->authorize = false;
		$this->set('User', $this->Auth->user());
		$this->Auth->allow('display');
		
		if($this->Auth->user()){
			$this->set('loggedIn' , true);
		}
		else{
			$this->set('loggedIn' , false);
		}
		
		$this->set('categories', $this->Category->findAllThreaded());		
	}

}

?>