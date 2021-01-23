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

<div class="row justify-content-center">
    <div class="card" style="width: 20rem;">
        <div class="card-body">
            <form action="/private/admin/createUser.php" method="post">
                <div class="form-group">
                    <label for="ime">Ime</label>
                    <input type="text" class="form-control" id="ime" name="ime">
                </div>
                <div class="form-group">
                    <label for="prezime">Prezime</label>
                    <input type="text" class="form-control" id="prezime" name="prezime">
                </div>
                <div class="form-group">
                    <label for="korisnicko_ime">Korisnicko Ime</label>
                    <input type="text" class="form-control" id="korisnicko_ime" name="korisnicko_ime">
                </div>
                <div class="form-group">
                    <label for="lozinka">Lozinka</label>
                    <input type="password" class="form-control" id="lozinka" name="lozinka">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email"  name="email">
                </div>
                <?php
                $query = $conn->prepare('SELECT * FROM tip_korisnika a where a.naziv != "anonimni" ');
                $query->execute();
                $roles = $query->fetchAll(PDO::FETCH_OBJ);

                ?>
                <div class="form-group">
                    <label for="tip_korisnika_id">Rola</label>
                    <select class="form-control" name="tip_korisnika_id" id="tip_korisnika_id">
                        <?php foreach ($roles as $role):?>
                            <option value="<?= $role->tip_korisnika_id;?>">
                                <?= $role->naziv;?>
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
</div>


<?php include_once "../../template/footer.php"; ?>

<?php include_once "../../template/scripts.php"; ?>
</body>
</html>