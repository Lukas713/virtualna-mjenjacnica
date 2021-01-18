<?php include_once "etc/config.php"; ?>
<!DOCTYPE html>

<html>
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
        <div class="grid-container">
            <div class="row justify-content-md-center">
                <div class="col col-lg-4">
                    <h3>Registracija</h3> <hr>
                    <form action="/authorization/registration.php" method="post">
                        <div class="form-group">
                            <label for="korisnicko_ime">Unesi korisničko ime</label>
                            <input type="text" class="form-control" id="korisnicko_ime" name="korisnicko_ime">
                        </div>
                        <div class="form-group">
                            <label for="email">Unesi email</label>
                            <input type="email" class="form-control" id="email" autocomplete="on" placeholder="admin@admin.com" name="email">
                        </div>
                        <div class="form-group">
                            <label for="lozinka">Unesi lozinku</label>
                            <input type="password" class="form-control" id="lozinka" name="lozinka">
                        </div>
                        <div class="form-group">
                            <label for="ime">Unesi ime</label>
                            <input type="text" class="form-control" id="ime"  name="ime">
                        </div>
                        <div class="form-group">
                            <label for="prezime">Unesi Prezime</label>
                            <input type="text" class="form-control" id="prezime" name="prezime">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="form-control" id="submit" name="submit" value="submit">
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
        <?php include_once "template/footer.php"; ?>
    </body>
</html>
