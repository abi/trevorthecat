<?php
 
class Profile extends AppModel
{
    var $name = 'Profile';
    
    
    var $belongsTo = array(
        'User' => array(
            'className'    => 'User',
            'conditions'    => 'User.active = 1'
        )
    );


	//TODO: validation
}
 
?>
