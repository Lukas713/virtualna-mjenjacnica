<?php

include_once "../../etc/config.php";

if (isset($_SESSION['anonimni'])) {
    return header('location: /');
}

$query = $conn->prepare('SELECT * from valuta a where a.naziv = "kuna"');
$query->execute();
$result = $query->fetchObject();
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
                <form action="/private/user/uploadAmount.php" method="post">
                    <div class="form-group">
                        <label for="iznos">Iznos (kn)</label>
                        <input type="number" step="0.01" class="form-control" id="iznos" name="iznos">
                    </div>
                    <div class="form-group">
                        <label for="valuta">Valuta</label>
                        <?php
                        $query = $conn->prepare('SELECT distinct * from valuta');
                        $query->execute();
                        $results = $query->fetchAll(5);
                        ?>
                        <select class="form-control" name="valuta" id="valuta">
                            <?php foreach ($results as $result):?>
                                <option value="<?= $result->valuta_id;?>">
                                    <?= $result->naziv;?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="form-control" id="submit" name="submit" value="submit">
                    </div>
                    <br>
                </form>
            </div>
        </div>

        <?php include_once "../../template/footer.php"; ?>

        <?php include_once "../../template/scripts.php"; ?>

    </body>
</html>