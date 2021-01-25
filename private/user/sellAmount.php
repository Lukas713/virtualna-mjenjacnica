<?php

include_once "../../etc/config.php";

if (!isset($_SESSION['id_korisnika'])) {
    return header('location: /');
}

if ($_POST['iznos'] === '') {
    $response = [
        'odgovor' => true,
        'poruka' => 1
    ];

    return header('location: /?' . http_build_query($response));
}

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$query = $conn->prepare('INSERT INTO zahtjev 
    (korisnik_id, iznos, prodajem_valuta_id, kupujem_valuta_id, datum_vrijeme_kreiranja, prihvacen)
    VALUES (:korisnik_id, :iznos, :prodajem_valuta_id, :kupujem_valuta_id, :datum_vrijeme_kreiranja, :prihvacen)');
$iznos = floatval($_POST['iznos']);
$prihvacen = false;
$date = date("Y-m-d H:i:s");
$conn->beginTransaction();
$query->bindParam(':korisnik_id', $_SESSION['id_korisnika'], PDO::PARAM_INT);
$query->bindParam(':iznos', $iznos);
$query->bindParam(':prodajem_valuta_id', $_POST['valuta_prodajem'], PDO::PARAM_INT);
$query->bindParam(':kupujem_valuta_id', $_POST['valuta_kupujem'], PDO::PARAM_INT);
$query->bindParam(':datum_vrijeme_kreiranja', $date);
$query->bindParam(':prihvacen', $prihvacen, PDO::PARAM_BOOL);
$query->execute();
$conn->commit();

if (!isset($_SESSION['id_korisnika'])) {
    return header('location: /');
}

$response = [
    'odgovor' => true,
    'poruka' => 8
];
return header('location: /private/user/index.php?' . http_build_query($response));