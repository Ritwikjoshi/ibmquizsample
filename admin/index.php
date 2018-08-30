<?php
require "../credentials.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
     <title>IBM Cloudant Sample</title>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="../src/css/bootstrap.css">
    <link rel="stylesheet" href="../src/css/customcss.css">
    <script src="../src/js/jquery.js"></script>
    <script src="../src/js/customjs.js"></script>
    <script src="../src/js/qrcode.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script>
    function deleteteamsubmission(id,rev)
	{
		url = "deleteteamsubmission.php?id=" + id + "&rev=" + rev;
		window.location.href = url;
	}
	function viewteamsubmission(id,rev)
	{
		url = "viewteamsubmission.php?id=" + id + "&rev=" + rev;
		window.location = url;
	}
	
	
    </script>

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
      <a class="nav-link active" href="/admin/index.php">Admin</a>
    </li>
  </ul>
</div>
</nav> 

<div style="margin-top: 1%;">
<div class="container card shadow-lg p-3 mb-5 bg-white rounded table-responsive" style="margin: 0 auto;padding: 5%;"> 
	<h2 style="text-align:center">Manage Submissions</h2>
<table class="table table-hover"> 
	<thead>
		<tr>
			<th>Name of User</th>
			<th class="text-center">View</th>
			<th class="text-center">Delete</th>
		</tr>
	</thead>
	<tbody>

<?php

//$url = "https://".$authstring."@0394f385-5643-40db-b1aa-94749be22786-bluemix.cloudant.com/".$dbname."/_all_docs?include_docs=true";
$url = "https://".$authstring."@".$dbhost."/".$dbname."/_all_docs?include_docs=true";
//echo "URL is: ".$url;

$headers = array("Content-Type:application/json");

$ch = curl_init();

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POST, 0);
//curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_NOBODY, 0);
//curl_setopt($ch, CURLOPT_FAILONERROR, 1);

$response = curl_exec($ch);
curl_close($ch);

//echo $response;
$response=json_decode($response,true);


$numberofusers = $response['total_rows'];

$rows = $response['rows'];

for ($i=0; $i < $numberofusers; $i++) 
{ 
	$doc[$i] = $rows[$i]['doc'];
	if(isset($doc[$i]["username"]))
	{
	echo '
		<tr>
			<td>'.$doc[$i]["username"].'</td>
			<td class="text-center"><button class="btn btn-primary" onclick="viewteamsubmission(\''.$doc[$i]['_id'].'\',\''.$doc[$i]['_rev'].'\')"><i class="fa fa-search"></i> View</button></td>
			<td class="text-center"><button class="btn btn-danger" onclick="deleteteamsubmission(\''.$doc[$i]['_id'].'\',\''.$doc[$i]['_rev'].'\')"><i class="fa fa-trash"></i> Delete</button></td>
		</tr>

	'; 
	}
}

?>

</tbody>
</table>
</div>
</div>


</body>
</html>


