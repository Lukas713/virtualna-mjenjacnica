<?php

if (!isset($_POST['submit']) || !isset($_POST['korisnicko_ime']) || !isset($_POST['lozinka'])) {
    $response = [
        'odgovor' => true,
        'poruka' => 1
    ];
    return header('location: /login.php' . '?' . http_build_query($response));
}

if ($_POST['korisnicko_ime'] === '' || $_POST['lozinka'] === '') {
    $response = [
        'odgovor' => true,
        'poruka' => 1
    ];
    return header('location: /login.php' . '?' . http_build_query($response));
}


include_once '../etc/config.php';

$query = $conn->prepare('SELECT a.email, a.korisnik_id, a.korisnicko_ime, a.lozinka, a.tip_korisnika_id, b.naziv as tip_korisnika FROM korisnik a INNER JOIN tip_korisnika b on a.tip_korisnika_id = b.tip_korisnika_id
                                WHERE korisnicko_ime=:korisnicko_ime');
$query->execute(['korisnicko_ime' => $_POST['korisnicko_ime']]);
$result = $query->fetch(PDO::FETCH_OBJ);
if (!$result || !password_verify($_POST['lozinka'], $result->lozinka)) {
    $response = [
        'odgovor' => true,
        'poruka' => 4
    ];
    return header('location: /login.php' . '?' . http_build_query($response));
}

$_SESSION[$result->tip_korisnika] = $result->korisnicko_ime;
$_SESSION['tip_korisnika'] = $result->tip_korisnika;
$_SESSION['id_korisnika'] = $result->korisnik_id;
$_SESSION['email'] = $result->email;
$response = [
    'odgovor' => true,
    'poruka' => 5
];
return header('location: /' . '?' . http_build_query($response));

