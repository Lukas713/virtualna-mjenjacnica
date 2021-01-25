<?php

include_once "../../etc/config.php";

if (isset($_SESSION['anonimni']) || !isset($_SESSION)) {
    return header('location: /');
}

if ($_POST['iznos'] == '' || !isset($_POST['valuta'])) {
    $response = [
        'odgovor' => true,
        'poruka' => 1
    ];
    return header('location: /' . '?' . http_build_query($response));
}


$query = $conn->prepare('SELECT * FROM sredstva a WHERE a.korisnik_id=:korisnik_id and a.valuta_id=:valuta_id');
$query->bindParam(':korisnik_id', $_SESSION['id_korisnika'], PDO::PARAM_INT);
$query->bindParam(':valuta_id', $_POST['valuta'], PDO::PARAM_INT);
$query->execute();
$result = $query->fetchObject();
if (!$result) {
    $iznos = floatval($_POST['iznos']);
    $query = $conn->prepare('INSERT INTO sredstva (korisnik_id, valuta_id, iznos) values (:korisnik_id, :valuta_id, :iznos)');
    $query->bindParam(':korisnik_id', $_SESSION['id_korisnika'], PDO::PARAM_INT);
    $query->bindParam(':valuta_id', $_POST['valuta'], PDO::PARAM_INT);
    $query->bindParam(':iznos', $iznos, PDO::PARAM_INT);
    $query->execute();
} else {
    $iznos = floatval($_POST['iznos']) + floatval($result->iznos);
    $query = $conn->prepare('UPDATE sredstva SET iznos=:iznos WHERE korisnik_id=:korisnik_id AND valuta_id=:valuta_id');
    $query->bindParam(':iznos', $iznos, PDO::PARAM_INT);
    $query->bindParam(':korisnik_id', $_SESSION['id_korisnika'], PDO::PARAM_INT);
    $query->bindParam(':valuta_id', $_POST['valuta'], PDO::PARAM_INT);
    $query->execute();

}

$response = [
    'odgovor' => true,
    'poruka' => 8
];
return header('location: /private/user/index.php?' . http_build_query($response));