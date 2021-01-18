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
                    <h3>Login</h3> <hr>
                    <form action="/authorization/login.php" method="post">
                        <div class="form-group">
                            <label for="korisnicko_ime">Unesi korisnicko ime</label>
                            <input type="text" class="form-control" id="korisnicko_ime" name="korisnicko_ime"/>
                        </div>
                        <div class="form-group">
                            <label for="lozinka">Unesi lozinku</label>
                            <input type="password" class="form-control" id="lozinka" name="lozinka"/>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <input type="submit" class="btn btn-primary" name="submit" value="Submit"/>
                            </div>
                            <div class="col">
                                <a class="reg" href="/registration.php" data-toggle="modal" data-target="#exampleModal"><h5>Nisi se registrirao ?</h5></a>
                            </div>
                            <hr>
                        </div>
                    </form>

    </body>
</html>
