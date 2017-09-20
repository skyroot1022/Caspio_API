
<?php
include "../profiles/endpoint.php";
include "../profiles/auth.php";

header("Access-Control-Allow-Origin: *");
$externalKey = $_POST['externalKey'];
$authentication = getAuthentication($_POST['profileName']);

$url =  $resourceEndpoint . '//applications/' . $externalKey . '/datapages';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $authentication));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec($ch);
curl_close($ch);

$data = json_decode($server_output);
if (isset($data->Code))
    echo "Error<br>Code:". $data->Code . "<br>Message:" . $data->Message;
else
    echo $server_output;
?>

<!-- ac0e8ed0-676c-45fa-869f-56263908edd9 -->