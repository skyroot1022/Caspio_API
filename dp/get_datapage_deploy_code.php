
<?php
include "../profiles/endpoint.php";
include "../profiles/auth.php";

header("Access-Control-Allow-Origin: *");
$appKey = $_POST['appKey'];
$dp_method = $_POST['dp_method'];
$httpsFlag = $_POST['httpsFlag'];
$authentication = getAuthentication($_POST['profileName']);

$url = $resourceEndpoint . '//datapages/' . $appKey . '/deploy?method=' . $dp_method . '&https=' . $httpsFlag;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $authentication));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$server_output = curl_exec($ch);

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

curl_close($ch);
?>


<!-- ac0e8ed0-676c-45fa-869f-56263908edd9 -->
<!-- 46e95000a5a69dec824844b98b7d -->

<!-- Available deployment methods:
“IFrame”, “Frame”, “URL”, “Link”, “Embedded”, “Net”, “PHP”, “ASP”, “ASPX”. 
Values are case-insensitive and can be replaced by a single character of 
each string (I, F, U, L, E, N, P, A, X) respectively. -->