
<?php
include "../profiles/endpoint.php";
include "../profiles/auth.php";

header("Access-Control-Allow-Origin: *");
$table_name = $_POST['table_name'];
$u_criteria = $_POST['u_criteria'];

$authentication = getAuthentication($_POST['profileName']);

$url =  $resourceEndpoint . '//tables/'. $table_name .'/rows?q=' . $u_criteria;
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