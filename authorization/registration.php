<?php

if (!isset($_POST) || !isset($_POST['email']) || !isset($_POST['lozinka']) || !isset($_POST['korisnicko_ime'])) {
    $response = [
        'odgovor' => true,
        'poruka' => 1
    ];
    return header('location: /registration.php' . '?' . http_build_query($response));
}

include_once "../etc/config.php";
$query = $conn->prepare("SELECT korisnik_id from korisnik where email=:email or korisnicko_ime=:korisnicko_ime");
$query->execute([
    'email' => $_POST['email'],
    'korisnicko_ime' => $_POST['korisnicko_ime']
]);
$result = $query->fetchColumn();
if ($result != false) {
    $response = [
        'odgovor' => true,
        'poruka'    => 2
    ];
    return header('location: /registration.php' . '?' . http_build_query($response));
}


$roleQuery = $conn->prepare('select a.tip_korisnika_id from tip_korisnika a where a.naziv = "korisnik"');
$roleQuery->execute();
$result = $roleQuery->fetch(PDO::FETCH_OBJ);

$hash = password_hash($_POST["lozinka"],PASSWORD_BCRYPT, ['cost' => 12]);
$conn->beginTransaction();
$query = $conn->prepare("INSERT INTO korisnik(tip_korisnika_id, korisnicko_ime, lozinka, ime, prezime, email)
                                    VALUES (:tip_korisnika_id, :korisnicko_ime, :lozinka, :ime, :prezime, :email)");
$query->bindParam(":tip_korisnika_id", $result->tip_korisnika_id, PDO::PARAM_INT);
$query->bindParam(":korisnicko_ime", $_POST["korisnicko_ime"], PDO::PARAM_STR);
$query->bindParam(":lozinka", $hash, PDO::PARAM_STR);
$query->bindParam(":ime", $_POST["ime"], PDO::PARAM_STR);
$query->bindParam(":prezime", $_POST["prezime"], PDO::PARAM_STR);
$query->bindParam(":email", $_POST["email"], PDO::PARAM_STR);
$query->execute();
$id = $conn->lastInsertId();
$conn->commit();

$_SESSION['iznosi'] = $_POST['korisnicko_ime'];
$_SESSION['tip_korisnika'] = 'iznosi';
$_SESSION['id_korisnika'] = $id;
$_SESSION['email'] = $_POST["email"];
$response = [
    'odgovor' => true,
    'poruka'    => 3
];
header('location: /' . '?' . http_build_query($response));