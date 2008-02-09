<?php

//component that adds the indent level and number of votes for each comment

class CommentsComponent extends Object
{
	  var $controller = true;

	  var $listcom = array();
	
	  function get($data)
	  {
			//start with highest level comment of indent 0
	    	$this->list_element($data, 0);
	    	return $this->listcom;
	  }

	  function list_element($data, $level)
	  {
	
	    foreach ($data as $key=>$val)
	    {

			//get votes for the comment
			loadModel('Votes');
			$Vote = new Vote();
	      	$val['Comment']['votes'] = $Vote->getVotes('up',$val['Comment']['id'],'comment');
		
			//add the indent level for the comment
	      	$val['Comment']['indent'] = $level;
			//reconstruct the array
	      	array_push($this->listcom, array('Comment' => $val['Comment'] ,'User' => $val['User']));
		
			//recurse thorugh the children while incrementing the level
	      	if(isset($val['children'][0])){
		         $this->list_element($val['children'], $level+1);
		      }
	    }

	    return 0;
	  }


}

?>