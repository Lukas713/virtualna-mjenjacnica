<?php include_once "../../etc/config.php"; ?>

<?php
    if (!isset($_SESSION['moderator']) && !isset($_SESSION['admin'])) {
        return header('location: /');
    }

    $id = $_SESSION['id_korisnika'];
    $query = $conn->prepare('SELECT a.iznos, a.datum_vrijeme_kreiranja, b.ime, b.prezime, b.email,
       c.naziv as prodajem_naziv, c.tecaj as prodajem_tecaj, d.tecaj as kupujem_tecaj, d.naziv as kupujem_naziv  FROM zahtjev a 
    inner join korisnik b on a.korisnik_id = b.korisnik_id 
    inner join valuta c on a.prodajem_valuta_id = c.valuta_id
    inner join valuta d on a.kupujem_valuta_id = d.valuta_id
    WHERE prihvacen = false');
    $query->execute();
    $result = $query->fetchAll(5);
?>

<!doctype html>
<html prefix="og: http://ogp.me/ns#" class="no-js" lang="en" dir="ltr">
    <head>
        <title>Zahtjevi</title>
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

        <div class="container">
            <div class="row justify-content-center">
                <?php foreach ($result as $zahtjev): ?>
                <div class="card-deck mb-4 ml-1 mr-1 text-center">
                    <div class="card md-4shadow-sm">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">email: <?= $zahtjev->email; ?></h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mt-3 mb-4">
                                <li>ime: <?= $zahtjev->ime; ?></li>
                                <li>prezime: <?= $zahtjev->prezime; ?></li>
                                <li>iznos: <b><?= $zahtjev->iznos; ?></b></li>
                                <li>datum i vrijeme kreiranja: <?= $zahtjev->datum_vrijeme_kreiranja; ?></li>
                                <li>prodajem: <?= $zahtjev->prodajem_naziv . ' (' . $zahtjev->prodajem_tecaj . ')'?></li>
                                <li>kupujem: <?= $zahtjev->kupujem_naziv . ' (' . $zahtjev->kupujem_tecaj . ')' ?></li>
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