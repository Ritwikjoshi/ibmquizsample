<?php
	//Cloudant Database Credentials
	
	$cloudant_username = "<YOUR CLOUDANT USERNAME HERE>";
	$cloudant_password = "<YOUR CLOUDANT PASSWORD HERE>";
	$dbhost = "<YOUR CLOUDANT HOST HERE>";
	$dbname = "<YOUR CLOUDANT DATABASE NAME HERE>";
	$authstring = $cloudant_username.":".$cloudant_password."";//Creating an Authenticaiton String for accessing the Cloudant DB

	$designdocument = "<YOUR DESIGN DOCUMENT NAME HERE>";
	$searchindex = "<YOUR SEARCH INDEX NAME HERE>";//Search indexes are created for faster excecution of custom queries on Cloudant DB
	
?>