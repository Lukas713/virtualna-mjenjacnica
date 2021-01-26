<?php

include_once "../../etc/config.php";

if (!isset($_SESSION['tip_korisnika']) || $_SESSION['tip_korisnika'] !== 'admin') {
    return header('location: /');
}

if (!isset($_GET['id'])) {
    $response = [
        'id' => $_GET['id'],
        'odgovor' => true,
        'poruka' => 1
    ];
    return header('location: /?' . http_build_query($response));
}

$conn->beginTransaction();
$query = $conn->prepare('DELETE FROM valuta a WHERE a.valuta_id = :valuta_id');
$query->bindParam(':valuta_id', $_GET['id'], PDO::PARAM_INT);
$query->execute();
$conn->commit();

$response = [
    'id' => $_GET['id'],
    'odgovor' => true,
    'poruka' => 8
];
return header('location: /index.php?' . http_build_query($response));
