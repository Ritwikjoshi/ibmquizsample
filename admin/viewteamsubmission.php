<?php
require "../credentials.php";
$id = $_GET['id'];
$rev = $_GET['rev'];

$url = "https://".$authstring."@".$dbhost."/".$dbname."/".$id;

$headers = array("Content-Type:application/json");

$ch = curl_init();

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POST, 0);
//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
//curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_NOBODY, 0);
//curl_setopt($ch, CURLOPT_FAILONERROR, 1);

$response = curl_exec($ch);
curl_close($ch);

//echo $response;
$response=json_decode($response,true);

$numberofattachments = sizeof($response['_attachments']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
     <title>View User Submission</title>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../src/css/bootstrap.css">
    <link rel="stylesheet" href="../src/css/customcss.css">
    <script src="../src/js/jquery.js"></script>
    <script src="../src/js/customjs.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<?php 
echo '
    <script type="text/javascript">
    	function viewattachment(attachmentname)
    	{	
    		var url = "'.$url.'" + "/" + attachmentname;

    		//alert(url);
    		window.open(url, "_blank");
    	}

    	function downloadattachment(attachmentname)
    	{	
    		var url = "'.$url.'" + "/" + attachmentname;

    		//alert(url);
    		//window.open(url,"download","_blank");
    		downloadWithName(url, attachmentname);
    	}

    	function downloadWithName(url, attachmentname)
		{	
			var file_path = url;
			var a = document.createElement("A");
			a.href = file_path;
			a.target = "_blank";
			a.download = attachmentname;
			document.body.appendChild(a);
			a.click();
			document.body.removeChild(a);
		}




    </script>
';
?>
</head>
<body>

<nav class="navbar navbar-collapse navbar-expand-sm bg-light navbar-light">
<a class="navbar-brand" href="#" style="color:#166fff">IBM Cloudant Sample</a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
  <span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="collapsibleNavbar">
  <ul class="navbar-nav">
  	<li class="nav-item">
      <a class="nav-link" href="/index.php">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" href="admin.php">Admin</a>
    </li>
  </ul>
</div>
</nav> 

<div style="margin-top: 0%;">
	<div class="container card card-columns shadow-lg p-3 mb-5 bg-white rounded d-flex justify-content-center" style="margin-top: 3%;padding: 1%;text-align: center;"> 
		<h3><strong>User Submissions</strong></h3>
		<div class="d-flex flex-row flex-wrap p-2 justify-content-around align-content-around">
			<div class="p-2 container card" style="margin: .5%;"><h5><strong>Name of User: </strong><?php echo $response['username']; ?> </h5></div>
		</div>
		<div class="container card shadow-lg p-3 mb-5 bg-white rounded table-responsive" style="margin: 0 auto;padding: 5%;"> 
		<h4 style="text-align:Left"><strong>Uploaded Documents</strong></h4>
		<table class="table table-hover table-condensed"> 
			<thead>
				<tr>
					<th class="text-center">Sr. No.</th>
					<th class="text-center">Name</th>
					<th class="text-center">View</th>
					<th class="text-center">Download</th>
				</tr>
			</thead>
			<tbody>
		<?php
			$srno = 1;
			foreach ($response["_attachments"] as $attachmentname => $attachment )
			{
				echo'
				<tr>
					<td>'.$srno.'</td>
					<td class="text-center">'.$attachmentname.'</td>
					<td class="text-center"><button class="btn btn-primary" onclick="viewattachment(\''.$attachmentname.'\');"><i class="fa fa-search"></i> View Attachment</button></td>
					<td class="text-center"><button class="btn btn-success" onclick="downloadattachment(\''.$attachmentname.'\');"><i class="fa fa-download"></i> Download Attachment</button></td>
				</tr>
				';
				$srno++;
			}


		?>

			</tbody>
		</table>
		</div>
	</div>
</div>
</body>
</html>


