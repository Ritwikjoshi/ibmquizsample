<?php
require 'credentials.php';
// Getting the user name from the POST request
$username = strtoupper($_POST['username']);

//Getting all uploaded files from the form through a POST request in the form of an array
$documents=$_FILES['file'];

// Finding the number of uploaded files
$numberofattachments = sizeof($documents['name']);

$uploaddatasize = 0;
// Calculating the total size of uploaded files
for ($i=0; $i < sizeof($documents['name']); $i++)
{ 
	$uploaddatasize = $uploaddatasize + $documents['size'][$i];
}

// Checkin if total size of upload lies under the default maximum upload limit of PHP
if($uploaddatasize < 134217728)
{
	//Making a search request using search index to check weather the team alreaady exists in the DB or not
	$url = "https://".$authstring."@".$dbhost."/".$dbname."/_design/".$designdocument."/_search/".$searchindex."?include_docs=true&q=username:".urlencode($username);
	$headers = array("Content-Type:application/json");
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_POST, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_NOBODY, 0);
	$response = curl_exec($ch);
	curl_close($ch);

	//Converting JSON response to PHP Array using json_decode function for easy parsing of response data
	$response=json_decode($response,true);

	//Checking if the team Exists, if the team already exists than $response['total_rows'] will be greated than 0. In such case the DB will be updated with new uploads
	if ($response['total_rows']>0)
	{
		$existingdocument = $response['rows'][0]['doc'];
		
		$id = $existingdocument['_id'];
		$rev = $existingdocument['_rev'];

		for ($i=0; $i < $numberofattachments; $i++)
		{ 


			$attachmentname = urlencode($documents['name'][$i]);
			$mime1 = $documents['type'][$i];
			$data1 = file_get_contents($documents['tmp_name'][$i]);

			$url1 = "https://".$authstring."@".$dbhost."/".$dbname."/".$id."/".$attachmentname."?rev=".$rev;



			$headers1 = array("Content-Type:".$mime1."");

			$ch1 = curl_init();

			curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers1);
			curl_setopt($ch1, CURLOPT_HEADER, 0);
			curl_setopt($ch1, CURLOPT_URL,$url1);
			//curl_setopt($ch1, CURLOPT_POST, 1);
			curl_setopt($ch1, CURLOPT_CUSTOMREQUEST, "PUT");
			curl_setopt($ch1, CURLOPT_POSTFIELDS, $data1);
			curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch1, CURLOPT_NOBODY, 0);
			//curl_setopt($ch, CURLOPT_FAILONERROR, 1);

			$response1 = curl_exec($ch1);
			curl_close($ch1);


			//echo "=>".$response1."<br>";
			$response1=json_decode($response1,true);
			$id = $response1['id'];
			$rev = $response1['rev'];

		}
		if ($response1['ok']==true)
			{
				echo '
				<script>
				console.log("Submission Updated Successfully");
				alert("Submission Updated Successfully");
				window.location="index.php";
				</script>';
				

			}
			else
			{
				echo '
				<script>
				console.log("Error Updating Submission!");
				alert("Error Updating Submission!");
				window.location="index.php";
				</script>';
				
			}
		
	}
	//If the team does not exists, then it will create the team in DB and then 
	else
	{

		$url = "https://".$authstring."@".$dbhost."/".$dbname;

		$data = 
		'{
		  "username":"'.$username.'"
		  }';
		//echo $data;

		$headers = array("Content-Type:application/json");

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_NOBODY, 0);
		//curl_setopt($ch, CURLOPT_FAILONERROR, 1);

		$response = curl_exec($ch);
		curl_close($ch);

		//echo '<script>console.log("Response is : '.$response.'")</script>';
		//echo $response;

		//echo $response;
		$response=json_decode($response,true);
		$id = $response['id'];
		$rev = $response['rev'];


		for ($i=0; $i < $numberofattachments; $i++)
		{ 

			$attachmentname = urlencode($documents['name'][$i]);
			$mime1 = $documents['type'][$i];
			$data1 = file_get_contents($documents['tmp_name'][$i]);

			$url1 = "https://".$authstring."@".$dbhost."/".$dbname."/".$id."/".$attachmentname."?rev=".$rev;



			$headers1 = array("Content-Type:".$mime1."");

			$ch1 = curl_init();

			curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers1);
			curl_setopt($ch1, CURLOPT_HEADER, 0);
			curl_setopt($ch1, CURLOPT_URL,$url1);
			//curl_setopt($ch1, CURLOPT_POST, 1);
			curl_setopt($ch1, CURLOPT_CUSTOMREQUEST, "PUT");
			curl_setopt($ch1, CURLOPT_POSTFIELDS, $data1);
			curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch1, CURLOPT_NOBODY, 0);
			//curl_setopt($ch, CURLOPT_FAILONERROR, 1);

			$response1 = curl_exec($ch1);
			curl_close($ch1);

			//echo "=>".$response1."<br>";
			$response1=json_decode($response1,true);
			$id = $response1['id'];
			$rev = $response1['rev'];

			if ($response1['ok']==true)
			{

				echo '
				<script>
				console.log("Submission Successfull");
				alert("Submission Successfull");
				window.location="index.php";
				</script>';
				

			}
			else
			{
				echo '
				<script>
				console.log("Error Making Submission!");
				alert("Error Making Submission!");
				window.location="index.php";
				</script>';
				
			}


		}
	}

} //Res
else
{
	echo '
	<script>
	alert("File Upload Limit Exceeded/nYou can upload files upto 134 Megabytes");
	window.location = "index.php";
	</script>
	';
}


?>

