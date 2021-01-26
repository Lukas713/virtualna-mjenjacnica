<?php include_once "etc/config.php"; ?>
<?php
$query = $conn->prepare('SELECT a.*, b.email from valuta a INNER JOIN korisnik b where a.moderator_id = b.korisnik_id');
$query->execute();
$result = $query->fetchAll(PDO::FETCH_OBJ);

?>
<!doctype html>
<html prefix="og: http://ogp.me/ns#" class="no-js" lang="en" dir="ltr">
    <head>
        <?php include_once "template/head.php"; ?>
    </head>
    <body>
        <?php include_once "template/navigation.php"; ?>
        <br>
        <?php if(isset($_GET['odgovor'])): ?>
            <div class="<?= $flashPoruke[$_GET['poruka']]['style'] ?>" role="alert">
                <?= $flashPoruke[$_GET['poruka']]['poruka']; ?>
            </div>
        <?php endif;?>

        <div class="container">
            <?php if (isset($_SESSION['admin'])): ?>
                <div class="row">
                    <div class="container">
                        <a href="/private/valuta/createForm.php" class="btn btn-primary mb-3" role="button">Kreiraj</a>
                    </div>
                </div>
            <?php endif; ?>
            <div class="row justify-content-center">
                <?php foreach ($result as $valuta): ?>
                    <div class="card-deck mb-4 ml-1 mr-1 text-center">
                        <div class="card md-4shadow-sm">
                            <div class="card-header">
                                <h4 class="my-0 font-weight-normal"><?= $valuta->naziv; ?></h4>
                            </div>
                            <div class="card-body">
                                <h1 class="card-title pricing-card-title">
                                    <img src="<?= $valuta->slika; ?>"
                                         alt="<?= $valuta->naziv; ?>"
                                         width="250"
                                         height="250">
                                </h1>
                                <ul class="list-unstyled mt-3 mb-4">
                                    <li><a href="/private/valuta/index.php?id=<?= $valuta->valuta_id; ?>">Više informacija</a></li>
                                    <?php if(isset($_SESSION['admin']) || isset($_SESSION['moderator'])):?>
                                    <li><a class="btn btn-danger delete mt-3"
                                           href="/private/valuta/delete.php?id=<?= $valuta->valuta_id; ?>">
                                            Obriši
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>


        <?php include_once "template/footer.php"; ?>

        <?php include_once "template/scripts.php"; ?>
        <script>
            $('.delete').on('click', function () {
                return confirm('Jeste li sigurni ?');
            });
        </script>
    </body>
</html>