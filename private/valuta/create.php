<?php

include_once "../../etc/config.php";

if (!isset($_SESSION['tip_korisnika']) || $_SESSION['tip_korisnika'] !== 'admin') {
    return header('location: /');
}

if ($_POST['ime'] === '' || $_POST['tecaj'] === '' || $_POST['aktivno_od'] === '' || $_POST['aktivno_do'] === ''
    || $_POST['zahtjevi'] === '') {
    $response = [
        'odgovor' => true,
        'poruka' => 1
    ];

    return header('location: /private/valuta/index.php?' . http_build_query($response));
}

$date = date('y-m-d');
$conn->beginTransaction();
$query = $conn->prepare('INSERT INTO valuta(moderator_id, naziv, tecaj, slika, zvuk, aktivno_od, aktivno_do, datum_azuriranja)
                                VALUES (:moderator_id, :naziv, :tecaj, :slika, :zvuk, :aktivno_od, :aktivno_do, :datum_azuriranja)');

$query->bindParam(':moderator_id', $_POST['moderator'], PDO::PARAM_INT);
$query->bindParam(':naziv', $_POST['naziv']);
$query->bindParam(':tecaj', $_POST['tecaj']);
$query->bindParam(':slika', $_POST['slika']);
$query->bindParam(':zvuk', $_POST['zvuk']);
$query->bindParam(':aktivno_od', $_POST['aktivno_od']);
$query->bindParam(':aktivno_do', $_POST['aktivno_do']);
$query->bindParam(':datum_azuriranja', $date);
$query->execute();
$id = $conn->lastInsertId();
$conn->commit();


$response = [
    'id' => $id,
    'odgovor' => true,
    'poruka' => 8
];
return header('location: /index.php?' . http_build_query($response));
?>
