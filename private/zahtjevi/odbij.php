<?php

if (!isset($_GET['id'])) {
    $response = [
        'odgovor' => true,
        'poruka' => 1
    ];

    header('location /?' . http_build_query($response));
}

include_once '../../etc/config.php';

$false = false;
$query = $conn->prepare('DELETE FROM zahtjev WHERE zahtjev_id=:id');
$query->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
$query->execute();

$response = [
    'odgovor' => true,
    'poruka' => 8
];

return header('location: /?' . http_build_query($response));