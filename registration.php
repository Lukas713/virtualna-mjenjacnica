<?php include_once "etc/config.php"; ?>
<!DOCTYPE html>

<html>
    <head>
        <?php include_once "template/head.php"; ?>
    </head>

    <body>
    <?php include_once "template/navigation.php"; ?>
    <br>
        <div class="grid-container">
            <div class="row justify-content-md-center">
                <div class="col col-lg-4">
                    <h3>Registracija</h3> <hr>
                    <form action="/authorization/register.php" method="post">
                        <div class="form-group">
                            <label for="email">Unesi email</label>
                            <input type="email" class="form-control" id="email" autocomplete="on" placeholder="admin@admin.com" name="email">
                            <small id="emailHelp" class="form-text text-muted">Dont share your privacy informations.</small>
                        </div>
                        <div class="form-group">
                            <label for="password">Unesi lozinku</label>
                            <input type="password" class="form-control" id="password" autocomplete="new-password" name="password">
                        </div>
                        <div class="form-group">
                            <label for="repeat_password">Ponovi lozinku</label>
                            <input type="password" class="form-control" id="repeat_password"  name="repeat_password">
                        </div>
                        <div class="form-group">
                            <label for="firstName">Unesi ime</label>
                            <input type="text" class="form-control" id="firstName"  name="firstName">
                        </div>
                        <div class="form-group">
                            <label for="lastName">Unesi Prezime</label>
                            <input type="text" class="form-control" id="lastName" name="lastName">
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
        <?php include_once "template/footer.php"; ?>
    </body>
</html>
