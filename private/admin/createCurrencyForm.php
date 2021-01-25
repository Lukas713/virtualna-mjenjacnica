<?php
include_once "../../etc/config.php";

if (!isset($_SESSION['tip_korisnika']) || $_SESSION['tip_korisnika'] !== 'admin') {
    return header('location: /');
}

?>

<!doctype html>
<html prefix="og: http://ogp.me/ns#" class="no-js" lang="en" dir="ltr">
    <head>
        <title>Kreiraj Valutu</title>
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
                <form action="/private/admin/createCurrency.php" method="post">
                    <div class="form-group">
                        <label for="naziv">Naziv</label>
                        <input type="text" class="form-control" id="naziv" name="naziv">
                    </div>
                    <div class="form-group">
                        <label for="tecaj">Tečaj</label>
                        <input type="number" step="0.01" class="form-control" id="tecaj" name="tecaj">
                    </div>
                    <div class="form-group">
                        <label for="slika">Slika</label>
                        <input type="text" class="form-control" id="slika"  name="slika">
                    </div>
                    <div class="form-group">
                        <label for="zvuk">Himna</label>
                        <input type="text" class="form-control" id="zvuk"  name="zvuk">
                    </div>
                    <div class="form-group">
                        <label for="aktivno_od">Aktivno od</label>
                        <input type="text" class="form-control time_picker" id="aktivno_od" name="aktivno_od">
                    </div>
                    <div class="form-group">
                        <label for="aktivno_do">Aktivno do</label>
                        <input type="text" class="form-control time_picker" id="aktivno_do" name="aktivno_do">
                    </div>
                    <?php
                    $query = $conn->prepare('SELECT a.korisnik_id, a.email FROM korisnik a 
                                            inner join tip_korisnika b on a.tip_korisnika_id = b.tip_korisnika_id 
                                            where b.naziv = "moderator" OR b.naziv= "admin"');
                    $query->execute();
                    $moderators = $query->fetchAll(PDO::FETCH_OBJ);

                    ?>
                    <div class="form-group">
                        <label for="moderator">Rola</label>
                        <select class="form-control" name="moderator" id="moderator">
                            <?php foreach ($moderators as $moderator):?>
                                <option value="<?= $moderator->korisnik_id;?>">
                                    <?= $moderator->email;?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="slika">Slika</label>
                        <textarea class="form-control" id="slika" name="slika"></textarea>
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
    <script>
        $('.time_picker').timepicker({
            timeFormat: 'HH:mm:ss',
            interval: 1,
            minTime: '7:00:00 am',
            maxTime: '10:00:00 pm',
            defaultTime: '7:00:00 am',
            startTime: '7:00:00 am',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
    </script>
    </body>
</html>