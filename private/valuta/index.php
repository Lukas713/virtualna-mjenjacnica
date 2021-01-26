<?php
    if (!isset($_GET) || !isset($_GET['id'])) {
        $response = [
            'odgovor' => true,
            'poruka' => 7
        ];
        return header('location: /login.php' . '?' . http_build_query($response));
    }
?>

<?php include_once "../../etc/config.php"; ?>

<!doctype html>
<html prefix="og: http://ogp.me/ns#" class="no-js" lang="en" dir="ltr">
    <head>
        <?php include_once "../../template/head.php"; ?>
        <title>Valuta</title>
    </head>
    <div>
        <?php include_once "../../template/navigation.php"; ?>
        <br>
        <?php if(isset($_GET['odgovor'])): ?>
            <div class="<?= $flashPoruke[$_GET['poruka']]['style'] ?>" role="alert">
                <?= $flashPoruke[$_GET['poruka']]['poruka']; ?>
            </div>
        <?php endif;?>
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

            $role = 'notAdmin';
            if (isset($_SESSION['admin'])) {
                $role = 'admin';
            }
        ?>
        <div class="row justify-content-center align-self-center">
            <div class="container align-items-center">

                <form action="/private/valuta/update.php" method="post">
                    <div class="form-group">
                        <label for="naziv">Naziv</label>
                        <input type="text" <?= $role!='admin' ? 'disabled':'' ?>
                               class="form-control" id="naziv" value="<?= $valuta->naziv; ?>" name="naziv">
                    </div>
                    <div class="form-group">
                        <label for="tecaj">Tečaj</label>
                        <input type="number" <?= $role!='admin' ? 'disabled':'' ?>
                               step="0.01" class="form-control" value="<?= $valuta->tecaj; ?>" id="tecaj" name="tecaj">
                    </div>
                    <div class="form-group">
                        <label for="slika">Slika</label>
                        <input type="text" <?= $role!='admin' ? 'disabled':'' ?>
                               class="form-control" id="slika" value="<?= $valuta->slika; ?>"  name="slika">
                    </div>
                    <div class="form-group">
                        <label for="zvuk">Himna</label>
                        <input type="text" <?= $role!='admin' ? 'disabled':'' ?>
                               class="form-control" id="zvuk" value="<?= $valuta->zvuk; ?>" name="zvuk">
                    </div>
                    <div class="form-group">
                        <label for="aktivno_od">Aktivno od</label>
                        <input type="text" <?= $role!='admin' ? 'disabled':'' ?>
                               class="form-control time_picker" id="aktivno_od" name="aktivno_od"
                            value="<?= date('H.i.s', strtotime($valuta->datum_azuriranja . $valuta->aktivno_od)); ?>">
                    </div>
                    <div class="form-group">
                        <label for="aktivno_do">Aktivno do</label>
                        <input type="text" <?= $role!='admin' ? 'disabled':'' ?>
                               class="form-control time_picker" id="aktivno_do" name="aktivno_do"
                               value="<?= date('H.i.s', strtotime($valuta->datum_azuriranja . $valuta->aktivno_do)); ?>">
                    </div>

                    <div class="form-group">
                        <label for="datum_azuriranja">Datum ažuriranja</label>
                        <input type="text" <?= $role!='admin' ? 'disabled':'' ?>
                               class="form-control time_picker" id="datum_azuriranja"
                            value="<?= date('d.m.g', strtotime($valuta->datum_azuriranja)); ?>" name="datum_azuriranja">
                    </div>
                    <?php
                    $query = $conn->prepare('SELECT a.korisnik_id, a.email FROM korisnik a 
                                            inner join tip_korisnika b on a.tip_korisnika_id = b.tip_korisnika_id 
                                            where b.naziv = "zahtjevi"');
                    $query->execute();
                    $moderators = $query->fetchAll(PDO::FETCH_OBJ);

                    ?>
                    <div class="form-group">
                        <label for="moderator">Rola</label>
                        <select class="form-control" <?= $role!='admin' ? 'disabled':'' ?> name="moderator" id="moderator">
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
                        <input type="submit" <?= $role!='admin' ? 'disabled':'' ?> class="form-control" id="submit" name="submit" value="submit">
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="card-body">
                            <?php if ($valuta->zvuk !== ''):?>
                                <iframe src="<?= $valuta->zvuk; ?>" allow="autoplay"></iframe>
                            <?php endif; ?>
                        </div>
                    </div>
                    <input type="hidden" value="<?= $valuta->valuta_id; ?>" name="id">
                </form>
            </div>
        </div>
    </div>

        <?php include_once "template/footer.php"; ?>

        <?php include_once "template/scripts.php"; ?>
    </div>
</html>