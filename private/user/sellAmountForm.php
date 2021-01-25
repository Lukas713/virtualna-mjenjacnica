<?php

include_once "../../etc/config.php";

if (isset($_SESSION['anonimni']) || !isset($_GET['id'])) {
    return header('location: /');
}

$query = $conn->prepare('SELECT distinct * from sredstva a where a.sredstva_id=:sredstva_id');
$query->bindParam(':sredstva_id', $_GET['id']);
$query->execute();
$sredstvo = $query->fetchObject();

if (!$sredstvo) {
    $response = [
        'odgovor' => true,
        'poruka' => 9
    ];
    return header('location: /private/user/index.php?' . http_build_query($response));
}
?>

<!doctype html>
<html prefix="og: http://ogp.me/ns#" class="no-js" lang="en" dir="ltr">
<head>
    <title>Upload Valutu</title>
    <?php include_once "../../template/head.php"; ?>
</head>
<body>
<?php include_once "../../template/navigation.php"; ?>
<br>
<?php if(isset($_GET['odgovor'])): ?>
    <div class="<?= $flashPoruke[$_GET['poruka']]['style'] ?>" role="alert">
        <?= $flashPoruke[$_GET['poruka']]['poruka']; ?>
    </div>
<?php endif;?>

<div class="row justify-content-center align-self-center">
    <div class="container align-items-center">
        <form action="/private/user/sellAmount.php" method="post">
            <div class="form-group">
                <label for="iznos">Iznos (kn)</label>
                <input type="number" step="0.01" max="<?= $sredstvo->iznos;?>" class="form-control" id="iznos" name="iznos">
            </div>
            <div class="form-group">
                <label for="valuta">Valuta</label>
                <?php
                $query = $conn->prepare('SELECT distinct * from valuta a where a.valuta_id != :valuta_id');
                $query->bindParam(':valuta_id', $sredstvo->valuta_id, PDO::PARAM_INT);
                $query->execute();
                $results = $query->fetchAll(5);
                ?>
                <select class="form-control" name="valuta_kupujem" id="valuta_kupujem">
                    <?php foreach ($results as $result):?>
                        <option value="<?= $result->valuta_id;?>">
                            <?= $result->naziv;?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" class="form-control" id="submit" name="submit" value="submit">
                <input type="hidden" name="valuta_prodajem" value="<?= $sredstvo->valuta_id?>">
                <input type="hidden" name="sredstvo" value="<?= $sredstvo->sredstva_id?>">
            </div>
            <br>
        </form>
    </div>
</div>

<?php include_once "../../template/footer.php"; ?>

<?php include_once "../../template/scripts.php"; ?>

</body>
</html>