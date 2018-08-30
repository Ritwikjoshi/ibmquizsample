<?php
require "../credentials.php";


$id = $_GET['id'];
$rev = $_GET['rev'];

$url = "https://".$authstring."@".$dbhost."/".$dbname."/".$id."/?rev=".$rev;

$headers = array("Content-Type:application/json");

$ch = curl_init();

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_URL,$url);
//curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
//curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_NOBODY, 0);
//curl_setopt($ch, CURLOPT_FAILONERROR, 1);

$response = curl_exec($ch);
curl_close($ch);

//echo $response;
$response=json_decode($response,true);

header('location:index.php');

?>