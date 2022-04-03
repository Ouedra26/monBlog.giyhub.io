<nav class="navbar navbar-expand-md navbar-light bg-light">
    <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId"
        aria-expanded="false" aria-label="Toggle navigation"></button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mx-auto mt-2 mt-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="accueil1.php">Accueil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="articles1.php">Tous les articles</a>
            </li>
            <?php if(!estConnecte()) {?>
            <li class="nav-item">
                <a class="nav-link" href="inscription.php">Inscription</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="connexion.php">Connexion</a>
            </li>
            <?php } else { ?>
            <li class="nav-item">
                <a class="nav-link" href="profil.php"><i class="bi bi-person-circle"></i></a>
            </li>
            <?php } ?>
        </ul>
    </div>
</nav>