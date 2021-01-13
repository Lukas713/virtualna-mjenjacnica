<?php include_once "etc/config.php"; ?>
<!DOCTYPE html>

<html>
    <head>
        <?php include_once "template/head.php"; ?>
        <style>
            .reg {
                color: black;
            }
        </style>
    </head>

    <body>
        <?php include_once "template/navigation.php"; ?>
        <br>
        <div class="grid-container">
            <div class="row justify-content-md-center">
                <div class="col col-lg-4">
                    <h3>Login</h3> <hr>
                    <form action="authorization/login.php" method="post">
                        <div class="form-group">
                            <label for="email">Enter email</label>
                            <input type="email" class="form-control" id="email" autocomplete="on" placeholder="admin@admin.com" name="email">
                            <small id="emailHelp" class="form-text text-muted">Dont share your privacy informations.</small>
                        </div>
                        <div class="form-group">
                            <label for="password">Enter password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                            </div>
                            <div class="col">
                                <a class="reg" href="/registration.php" data-toggle="modal" data-target="#exampleModal"><h5>Dont have account?</h5></a>
                            </div>
                            <hr>
                        </div>
                    </form>

    </body>
</html>
