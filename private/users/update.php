<?php
include_once "../../etc/config.php";

if (!isset($_SESSION['tip_korisnika']) || $_SESSION['tip_korisnika'] !== 'admin') {
    return header('location: /private/users/index.php');
}

if (!isset($_POST['id'])) {
    return header('location: /private/users/index.php');
}

$query = $conn->prepare('UPDATE korisnik set 
                    tip_korisnika_id=:tip_korisnika_id, korisnicko_ime=:korisnicko_ime, 
                    ime=:ime, prezime=:prezime, email=:email, slika=:slika
                    WHERE korisnik_id=:korisnik_id');
$query->bindParam(':tip_korisnika_id', $_POST['rola'], PDO::PARAM_INT);
$query->bindParam(':korisnicko_ime', $_POST['korisnicko_ime']);
$query->bindParam(':ime', $_POST['ime']);
$query->bindParam(':prezime', $_POST['prezime']);
$query->bindParam(':email', $_POST['email']);
$query->bindParam(':slika', $_POST['slika']);
$query->bindParam(':korisnik_id', $_POST['id']);
$query->execute();

$response = [
    'id' => $_POST['id'],
    'odgovor' => true,
    'poruka' => 8
];
return header('location: /private/users/info.php?' . http_build_query($response));
?>
