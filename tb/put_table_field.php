
<?php
include "../profiles/endpoint.php";
include "../profiles/auth.php";

header("Access-Control-Allow-Origin: *");
$table_name = $_POST['table_name'];
$column_name = $_POST['column_name'];
$criteria = $_POST['criteria'];

$authentication = getAuthentication($_POST['profileName']);

$url = $resourceEndpoint . '//tables/' . $table_name .'//columns/' . $column_name;

$ch = curl_init();
$header[] = 'Authorization: Bearer ' . $authentication;
$header[] = 'Content-Type: application/json';

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_POSTFIELDS, $criteria);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec ($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
if($httpCode == 200) {    
    echo '200';
    
} else {
    $data = json_decode($server_output);
    if (isset($data->Code))
        echo "Error<br>Code:". $data->Code . "<br>Message:" . $data->Message;
    else
        echo '200';
}
curl_close ($ch);
?>