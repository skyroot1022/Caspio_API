
<?php
include "../profiles/endpoint.php";
include "../profiles/auth.php";

header("Access-Control-Allow-Origin: *");
$externalKey = $_POST['externalKey'];
$authentication = getAuthentication($_POST['profileName']);

$url = $resourceEndpoint . '//tasks/' . $externalKey .'/run';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec ($ch);

$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
if($httpCode == 200 || $httpCode == 400) {    
    echo $httpCode;
} else {
    $data = json_decode($server_output);
    if (isset($data->Code))
        echo "Error<br>Code:". $data->Code . "<br>Message:" . $data->Message;
    else
        echo $httpCode;
}

curl_close($ch);
?>