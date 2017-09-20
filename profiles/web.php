<?php

$clientid['profileA'] = '';
$clientsecret['profileA'] = '';

$clientid['profileB'] = '';
$clientsecret['profileB'] = '';

$clientid['profileC'] = '';
$clientsecret['profileC'] = '';

function getClientID($profileName) {
    global $clientid;
    return $clientid[$profileName];
}

function getClientSecret($profileName) {
    global $clientsecret;
    return $clientsecret[$profileName];
}
?>