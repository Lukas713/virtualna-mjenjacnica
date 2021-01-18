<?php
include_once "../../etc/config.php";

if (!isset($_SESSION['tip_korisnika']) || $_SESSION['tip_korisnika'] !== 'admin') {
        return header('location: /');
}
?>
<!doctype html>
<html prefix="og: http://ogp.me/ns#" class="no-js" lang="en" dir="ltr">
    <head>
        <title>Svi korisnici</title>
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
            $query = $conn->prepare('SELECT * FROM korisnik');
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_OBJ);
            $X = 3;
        ?>

        <div class="row justify-content-center">
            <?php foreach ($result as $user): ?>
                <div class="card-deck mb-4 text-center">
                    <div class="card md-4 shadow-sm">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal"><?= $user->korisnicko_ime; ?></h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">

                            </h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>ime: <?= $user->ime; ?></li>
                                <li>prezime: <?= $user->prezime; ?></li>
                                <li>email: <?= $user->email; ?></li>
                                <li>rola: <?= $user->ime; ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>


        <?php include_once "../../template/footer.php"; ?>

        <?php include_once "../../template/scripts.php"; ?>
    </body>
</html>