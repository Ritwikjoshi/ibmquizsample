<?php
	//Cloudant Database Credentials
	
	$cloudant_username = "<YOUR CLOUDANT USERNAME HERE>";
	$cloudant_password = "<YOUR CLOUDANT PASSWORD HERE>";
	$dbhost = "<YOUR CLOUDANT HOST HERE>";
	$authstring = $cloudant_username.":".$cloudant_password."";//Creating an Authenticaiton String for accessing the Cloudant DB

	//Search indexes are created for faster excecution of custom queries on Cloudant DB
	
	
	//Details of First Database. We will be using this database to store the details of quizzes
	$dbname1 = "<NAME OF THE FIRST DATABASE>";
	$designdocument1 = "<NAME OF DESIGN DOCUMENT OF FIRST DATABASE HERE>";
	$searchindex1 = "<NAME OF SEARCH INDEX OF FIRST DATABASE HERE>";
	
	//Details of Second Database. We will be using this database to store the quiz submissions by users for all quizzes
	$dbname2 = "<NAME OF THE SECOND DATABASE>";
	$designdocument2 = "<NAME OF DESIGN DOCUMENT OF SECOND DATABASE HERE>";
	$searchindex2 = "<NAME OF SEARCH INDEX OF SECOND DATABASE HERE>";
?>