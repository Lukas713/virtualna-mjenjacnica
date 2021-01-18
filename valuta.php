<?php
    if (!isset($_GET) || !isset($_GET['id'])) {
        $response = [
            'odgovor' => true,
            'poruka' => 7
        ];
        return header('location: /login.php' . '?' . http_build_query($response));
    }
?>

<?php include_once "etc/config.php"; ?>

<!doctype html>
<html prefix="og: http://ogp.me/ns#" class="no-js" lang="en" dir="ltr">
    <head>
        <?php include_once "template/head.php"; ?>
    </head>
    <div>
        <?php include_once "template/navigation.php"; ?>
        <br>
        <?php
            $query = $conn->prepare('select a.* from valuta a where a.valuta_id = :valuta_id');
            $query->execute([
                'valuta_id' => $_GET['id']
            ]);
            $valuta = $query->fetch(5);
            if ($valuta != true) {
                $response = [
                    'odgovor' => true,
                    'poruka' => 7
                ];
                return header('location: /login.php' . '?' . http_build_query($response));
            }

        ?>
        <div class="row justify-content-center align-self-center">
            <div class="container align-items-center">
                <div class="card" style="width: 20rem; margin-left: 36%;">
                    <img class="card-img-top" src="<?= $valuta->slika; ?>" alt="<?= $valuta->naziv; ?>">
                    <div class="card-body">
                        naziv: <h5 class="card-title"><?= $valuta->naziv; ?></h5><br>
                        tečaj: <h5 class="card-title"><?= $valuta->tecaj; ?></h5><br>
                        1kn = <?= $valuta->tecaj; ?> <?= $valuta->naziv; ?>
                    </div>
                    <?php if(isset($_SESSION['tip_korisnika']) && $_SESSION['tip_korisnika'] !== 'korisnik'):?>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">aktivno od: <?= $valuta->aktivno_od; ?></li>
                            <li class="list-group-item">aktivno do: <?= $valuta->aktivno_do; ?></li>
                            <li class="list-group-item">datum ažuriranja: <?= $valuta->datum_azuriranja ?></li>
                        </ul>
                    <?php  endif; ?>
                    <div class="card-body">
                        <?php if ($valuta->zvuk !== ''):?>
                            <iframe src="<?= $valuta->zvuk; ?>" allow="autoplay"></iframe>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
    </div>

        <?php include_once "template/footer.php"; ?>

        <?php include_once "template/scripts.php"; ?>
    </div>
</html>