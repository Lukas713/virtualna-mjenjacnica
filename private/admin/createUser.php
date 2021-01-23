<?php

include_once "../../etc/config.php";

if (!isset($_SESSION['tip_korisnika']) || $_SESSION['tip_korisnika'] !== 'admin') {
    return header('location: /private/admin/users.php');
}

if (!isset($_POST['korisnicko_ime'])) {
    $response = [
        'odgovor' => true,
        'poruka' => 1
    ];

    return header('location: /private/admin/users.php?' . http_build_query($response));
}

$query = $conn->prepare('SELECT * FROM korisnik a WHERE a.korisnicko_ime=:korisnicko_ime OR a.email=:email');
$query->bindParam(':korisnicko_ime', $_POST['korisnicko_ime']);
$query->bindParam(':email', $_POST['email']);
$query->execute();
$result = $query->fetch(PDO::FETCH_OBJ);
if ($result != false) {
    $response = [
        'odgovor' => true,
        'poruka' => 2
    ];
    return header('location: /private/admin/users.php?' . http_build_query($response));
}

$conn->beginTransaction();
$query = $conn->prepare('INSERT INTO korisnik(tip_korisnika_id, korisnicko_ime, lozinka, ime, prezime, email, slika)
                                VALUES (:tip_korisnika_id, :korisnicko_ime, :lozinka, :ime, :prezime, :email, :slika)');

$hash = password_hash($_POST['lozinka'],PASSWORD_BCRYPT, ['cost' => 12]);
$query->bindParam(':tip_korisnika_id', $_POST['tip_korisnika_id'], PDO::PARAM_INT);
$query->bindParam(':korisnicko_ime', $_POST['korisnicko_ime']);
$query->bindParam(':lozinka', $hash);
$query->bindParam(':ime', $_POST['ime']);
$query->bindParam(':prezime', $_POST['prezime']);
$query->bindParam(':email', $_POST['email']);
$query->bindParam(':slika', $_POST['slika']);
$query->execute();
$id = $conn->lastInsertId();
$conn->commit();


$response = [
    'id' => $id,
    'odgovor' => true,
    'poruka' => 8
];
return header('location: /private/admin/userInfo.php?' . http_build_query($response));
?>
