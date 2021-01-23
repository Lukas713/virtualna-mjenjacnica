<?php
include_once "../../etc/config.php";

if (!isset($_SESSION['tip_korisnika']) || $_SESSION['tip_korisnika'] !== 'admin') {
    return header('location: /private/admin/users.php');
}

if (!isset($_GET['id'])) {
    return header('location: /private/admin/users.php');
}

$conn->beginTransaction();
$query = $conn->prepare('DELETE FROM korisnik a WHERE a.korisnik_id=:korisnik_id');
$query->bindParam(':korisnik_id', $_GET['id'], PDO::PARAM_INT);
$query->execute();
$conn->commit();

$response = [
    'odgovor' => true,
    'poruka' => 8
];
return header('location: /private/admin/users.php?' . http_build_query($response));
?>
