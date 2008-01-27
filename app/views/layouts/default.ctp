<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<title><?php echo $title_for_layout?></title>

<?php

	echo $html->css('blueprint/screen'); 
	echo $html->css('mycustom'); 
	echo $html->css('1'); 

?>

</head>


<body>
 

<div id="content" class="container">

	<?php 
	
	if($header == 2){
		echo $this->renderElement('header2', array("categories" => $categories , "User" => $User, "loggedIn" => $loggedIn)); 
	}
	else{
		echo $this->renderElement('header', array("categories" => $categories , "User" => $User, "loggedIn" => $loggedIn)); 
	}
	
	?>
 
	<?php echo $content_for_layout ?>

<div id="footer"></div>

</div>

</body>


</html>