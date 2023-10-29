<?php

	// Assuming you have a database connection in another file
	include 'dbConnect.php';

	$originalText = $_POST['originalText'];
	$newText = $_POST['newText'];
	
	echo update_tag_terms($originalText,$newText);
?>
