<?php

class VotesController extends AppController
{
    var $name = 'Votes';
    var $uses = array('Story', 'Vote');
    var $components = array('RequestHandler');

    function submit($content_type, $content_id, $type)
    {
			//convert url parameters to data array so that $data can be saved
			$this->data['Vote']['content_id'] = $content_id;
			$this->data['Vote']['content_type'] = $content_type;
			$this->data['Vote']['type'] = $type;
			
			//look if the user has already voted on this before
            $conditions = array(
        						"Vote.user_id" => $this->Auth->user('id'),
        						"Vote.content_id" => $content_id,
        						"Vote.content_type" => $content_type
        						);
        	
        	$userVote = $this->Vote->findCount($conditions);
			
			//if the user has voted before, get the vote type
			$userVoteType = false;
			
        	if($userVote != 0){
				$userVoteType = $this->Vote->field('type',$conditions);
    		}

			//if the user has indeed voted and it is the same kind as the current vote
			//do nothing, just return current number of votes for this story/comment and exit
			if( $userVote != 0 && $userVoteType == $type){

				$votes = $this->Vote->getVotes('up', $content_id, $content_type) - $this->Vote->getVotes('down', $content_id, $content_type);
				
				$this->set('votes', $votes);
				$this->render('submit');
				exit();
			}
			
			//if vote registered is not the same kind as the current vote
			//remove the old vote
			if( $userVoteType != $type ){
        		$this->Vote->deleteAll($conditions);
			}
			
			            
		    //add the new vote to the vote table
		    $this->data['Vote']['user_id'] = $this->Auth->user('id');
			$this->Vote->save($this->data);		  
		  
			
			$votes = $this->Vote->getVotes('up', $content_id, $content_type) - $this->Vote->getVotes('down', $content_id, $content_type);
		
			//if the story is not yet popular, check popular algo (currently > 0 votes) and make it popular
			if($content_type == 'story' && $this->Story->field("popular","Story.id = $content_id") == '0000-00-00 00:00:00' && $votes > 0){
					$this->Story->makePopular($this->data['Vote']['content_id']);
			}
			
			//return the number of votes for the story or comment
			$this->set('votes', $votes);
			$this->render('submit');			

    }
    

}

?>