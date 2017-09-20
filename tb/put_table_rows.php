
<?php
include "../profiles/endpoint.php";
include "../profiles/auth.php";

header("Access-Control-Allow-Origin: *");
$table_name = $_POST['table_name'];
$u_criteria = $_POST['u_criteria'];
$criteria = $_POST['criteria'];

$authentication = getAuthentication($_POST['profileName']);

$url = $resourceEndpoint . '//tables/' . $table_name .'/rows?q=' . $u_criteria;

$ch = curl_init();
$header[] = 'Authorization: Bearer ' . $authentication;
$header[] = 'Content-Type: application/json';

curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_POSTFIELDS, $criteria);//{"field1":"value11","field2":"value21"}            
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec ($ch);
curl_close ($ch);

$data = json_decode($server_output);
if (isset($data->RowsAffected))
    echo $data->RowsAffected;
else
    echo "Error:<br>Code:" . $data->Code . "<br>Message:" . $data->Message;
?>