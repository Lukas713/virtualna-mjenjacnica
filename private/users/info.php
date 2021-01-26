<?php
include_once "../../etc/config.php";

if (!isset($_SESSION['tip_korisnika']) || $_SESSION['tip_korisnika'] !== 'admin') {
    return header('location: /');
}

if (!isset($_GET['id'])) {
    return header('location: /private/index.php');
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
        $query = $conn->prepare('SELECT a.*, b.naziv as rola FROM korisnik a 
                                        inner join tip_korisnika b on a.tip_korisnika_id=b.tip_korisnika_id 
                                        where a.korisnik_id=:id');
        $query->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_OBJ);
        ?>

        <div class="row justify-content-center">
            <div class="card" style="width: 20rem;">
                <img class="card-img-top" src="<?= $result->slika; ?>" alt="<?= $result->korisnicko_ime; ?>">
                <div class="card-body">
                    <form action="/private/users/update.php" method="post">
                        <div class="form-group">
                            <label for="ime">Ime</label>
                            <input type="text" class="form-control" id="ime" name="ime" value="<?= $result->ime; ?>">
                        </div>
                        <div class="form-group">
                            <label for="prezime">Prezime</label>
                            <input type="text" class="form-control" id="prezime" name="prezime" value="<?= $result->prezime; ?>">
                        </div>
                        <div class="form-group">
                            <label for="korisnicko_ime">Korisnicko Ime</label>
                            <input type="text" class="form-control" id="korisnicko_ime" name="korisnicko_ime" value="<?= $result->korisnicko_ime; ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email"  name="email" value="<?= $result->email; ?>">
                        </div>
                        <?php
                        $query = $conn->prepare('SELECT * FROM tip_korisnika a where a.naziv != "anonimni"');
                        $query->execute();
                        $roles = $query->fetchAll(PDO::FETCH_OBJ);

                        ?>
                        <div class="form-group">
                            <label for="rola">Rola</label>
                            <select class="form-control" name="rola" id="rola">
                                <?php foreach ($roles as $role):?>
                                    <option <?= $role->tip_korisnika_id === $result->tip_korisnika_id ? 'selected' : '' ?>
                                            value="<?= $role->tip_korisnika_id;?>">
                                        <?= $role->naziv;?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="slika">Slika</label>
                            <textarea class="form-control" id="slika" name="slika">
                                <?= $result->slika; ?>
                            </textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="form-control" id="submit" name="submit" value="submit">
                        </div>
                        <input type="hidden" name="id" value="<?= $result->korisnik_id; ?>"/>
                        <br>
                    </form>
                </div>
            </div>
        </div>


        <?php include_once "../../template/footer.php"; ?>

        <?php include_once "../../template/scripts.php"; ?>
    </body>
</html>