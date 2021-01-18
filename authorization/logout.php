<?php
include_once "../etc/config.php";
$_SESSION=[];
$response = [
    'odgovor' => true,
    'poruka' => 6
];
return header("location: /login.php" . '?' . http_build_query($response));