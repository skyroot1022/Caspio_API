
<?php
include "endpoint.php";
include "web.php";

function getAuthentication($profileName) {
    global $tokenEndpoint;
    global $granttype;
    
    if(!session_id()) session_start();
    
    if (isset($_SESSION['token_time'])) {        
        if (time() < $_SESSION['token_time'] + 1200) //1200 second
            return $_SESSION['token_key'];
    }

    $client_id = getClientID($profileName);
    $client_secret = getClientSecret($profileName);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $tokenEndpoint);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=".$granttype."&client_id=".$client_id."&client_secret=".$client_secret);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/plain'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec($ch);
    curl_close($ch);    
    $data = json_decode($server_output);

    $_SESSION['token_key'] = $data->access_token;
    $_SESSION['token_time'] = time();
    return $data->access_token;
}
?>
