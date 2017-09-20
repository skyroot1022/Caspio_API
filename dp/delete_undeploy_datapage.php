
<?php
include "../profiles/endpoint.php";
include "../profiles/auth.php";

header("Access-Control-Allow-Origin: *");
$appKey = $_POST['appKey'];

$authentication = getAuthentication($_POST['profileName']);

$url = $resourceEndpoint . '//datapages/' . $appKey .'/deploy';

$ch = curl_init();
$header[] = 'Authorization: Bearer ' . $authentication;
$header[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec ($ch);

$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
if($httpCode == 200) {    
    echo 'Success!';
    
} else {
    echo "Error:" . $httpCode;
}
curl_close ($ch);
    
?>

<!-- 46e95000f3c7082fda764ffb8268 -->