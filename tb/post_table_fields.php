
<?php
include "../profiles/endpoint.php";
include "../profiles/auth.php";

header("Access-Control-Allow-Origin: *");
$table_name = $_POST['table_name'];
$criteria = $_POST['criteria'];

$authentication = getAuthentication($_POST['profileName']);

$url = $resourceEndpoint . '//tables/' . $table_name .'/columns';

$ch = curl_init();
$header[] = 'Authorization: Bearer ' . $authentication;
$header[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
curl_setopt($ch, CURLOPT_POSTFIELDS, $criteria);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec ($ch);

$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
if($httpCode == 201) {    
    echo '201';
    
} else {
    $data = json_decode($server_output);
    if (isset($data->Code))
        echo "Error<br>Code:". $data->Code . "<br>Message:" . $data->Message;
    else
        echo 'Success!';
}

curl_close($ch);
?>

<!-- {"Name":"columnName","Type":"columnType"} -->

<!-- {
“Name”:”columnName”,                   (required)
“Type”:”columnType”,                       (required)
“Unique”:(true/false),                        (optional, default value = false)
“Description”:”description”,             (optional, default value = “”)
“DisplayOrder”:(integer),                  (optional, default value = 0 (last))
“Label”:”label”,                                    (optional, default value = “”)
“UniqueAllowNulls”:(true/false),    (optional, only if UNIQUE set to TRUE, default value = false)
“OnInsert”:(true/false),                     (optional, only for TIMESTAMP, default value = false)
“OnUpdate”:(true/false),                   (optional, only for TIMESTAMP, default value = false)
“TimeZone”:”timeZone”                    (optional, only for TIMESTAMP, default value = “”)
} -->