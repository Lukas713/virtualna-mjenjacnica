<?php

include_once "../../etc/config.php";

if (!isset($_SESSION['tip_korisnika']) || $_SESSION['tip_korisnika'] !== 'admin') {
    return header('location: /');
}

if (!isset($_POST['id'])) {
    $response = [
        'id' => $_POST['id'],
        'odgovor' => true,
        'poruka' => 1
    ];
    return header('location: /?' . http_build_query($response));
}

$query = $conn->prepare('SELECT * FROM valuta a where a.id=:id');
$query->bindParam(':id', $_POST['id']);
$query->execute();
$result = $query->fetch(5);
if ($result != false) {
    $response = [
        'odgovor' => true,
        'poruka' => 9
    ];
    return header('location: /?' . http_build_query($response));
}

$now = date('y-m-d');
$tecaj = floatval($_POST['tecaj']);
$aktivnoOd = date('h:i:s', strtotime($now . $_POST['aktivno_od']));
$aktivnoDo = date('h:i:s', strtotime($now . $_POST['aktivno_do']));
$query = $conn->prepare('UPDATE valuta set
                    moderator_id=:moderator_id, naziv=:naziv, tecaj=:tecaj, 
                    slika=:slika, zvuk=:zvuk, aktivno_od=:aktivno_od, aktivno_do=:aktivno_do, datum_azuriranja=:datum_azuriranja
                    WHERE valuta_id=:valuta_id');

$conn->beginTransaction();
$query->bindParam(':naziv', $_POST['naziv']);
$query->bindParam(':tecaj', $tecaj);
$query->bindParam(':slika', $_POST['ime']);
$query->bindParam(':zvuk', $_POST['zvuk']);
$query->bindParam(':aktivno_od', $aktivnoOd);
$query->bindParam(':aktivno_do', $aktivnoDo);
$query->bindParam(':datum_azuriranja', $now);
$query->bindParam(':moderator_id', $_POST['moderator'], PDO::PARAM_INT);
$query->bindParam(':valuta_id', $_POST['id'], PDO::PARAM_INT);
$query->execute();
$conn->commit();

$response = [
    'id' => $_POST['id'],
    'odgovor' => true,
    'poruka' => 8
];
return header('location: /valuta.php?' . http_build_query($response));
