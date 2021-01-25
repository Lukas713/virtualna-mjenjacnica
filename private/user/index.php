<?php include_once "../../etc/config.php"; ?>

<!doctype html>
<html prefix="og: http://ogp.me/ns#" class="no-js" lang="en" dir="ltr">
    <head>
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

        <?php
            $query = $conn->prepare('SELECT a.sredstva_id, a.iznos, a.valuta_id, b.*, c.korisnicko_ime from sredstva a 
                                    inner join valuta b on a.valuta_id = b.valuta_id
                                    inner join korisnik c on a.korisnik_id = c.korisnik_id
                                     where c.korisnicko_ime=:korisnicko_ime');
            $query->bindParam(':korisnicko_ime', $_SESSION[$_SESSION['tip_korisnika']]);
            $query->execute();
            $result = $query->fetchAll(5);
        ?>
        <div class="container">
            <div class="row">
                <div class="container">
                    <a href="/private/user/uploadAmountForm.php" class="btn btn-primary mb-3" role="button">Uplati</a>
                </div>
            </div>
            <div class="row justify-content-center">
                <?php foreach ($result as $iznos): ?>
                    <div class="card-deck ml-2 mr-2 mb-4 text-center">
                        <div class="card md-4 shadow-sm">
                            <div class="card-header">
                                <h4 class="my-0 font-weight-normal"><?= $iznos->naziv; ?></h4>
                            </div>
                            <div class="card-body">
                                <h1 class="card-title pricing-card-title">
                                    <?= $iznos->iznos; ?>
                                </h1>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">tečaj: <?= $iznos->tecaj; ?></li>
                                    <li class="list-group-item">
                                        <a href="/private/user/sellAmountForm.php?id=<?= $iznos->sredstva_id; ?>">Prodaj</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <?php include_once "../../template/footer.php"; ?>

        <?php include_once "../../template/scripts.php"; ?>
    </body>
</html>