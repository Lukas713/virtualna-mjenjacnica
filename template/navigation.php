<nav class="navbar navbar-expand-lg navbar-light bg-info text-white">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-0">
                <li class="nav-item dropdown">
                    <a class="text-light dropdown-toggle" data-toggle="dropdown" href="/"
                       role="button" aria-haspopup="true" aria-expanded="false">Virtualna mjenjacnica
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/">Valute</a>
                        <a class="dropdown-item" href="/o_autoru.php">O autoru</a>
                        <?php if(isset($_SESSION['tip_korisnika'])): ?>
                            <a class="dropdown-item" href="/private/iznosi/index.php">Moji iznosi</a>
                        <?php endif; ?>
                        <?php if(isset($_SESSION['tip_korisnika']) && $_SESSION['tip_korisnika'] === 'admin'): ?>
                            <a class="dropdown-item" href="/private/users/index.php">Korisnici</a>
                        <?php endif; ?>
                        <?php if(isset($_SESSION['tip_korisnika']) && ($_SESSION['tip_korisnika'] === 'admin' || $_SESSION['tip_korisnika'] === 'zahtjevi')): ?>
                            <a class="dropdown-item" href="/private/zahtjevi/index.php">Zahtjevi</a>
                        <?php endif; ?>
                        <div class="dropdown-divider"></div>
                    </div>
                </li>
        </ul>
        <div class="ml-4">
            <?= isset($_SESSION['email']) ? $_SESSION['email'] : '' ?>
        </div>
    </div>
    <ul class="nav justify-content-end">
        <?php if(empty($_SESSION) || $_SESSION['tip_korisnika'] === 'anonimni'): ?>
            <li><a class="text-light" href="/login.php"><i class='text-light fas fa-user-lock'></i> Login</a></li>
        <?php else: ?>
            <li><a class="text-light" href="/authorization/logout.php"><i class='text-light fas fa-unlock-alt'></i> Logout</a></li>
        <?php endif; ?>
    </ul>
</nav>