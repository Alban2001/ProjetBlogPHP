<!--- VUE PARTIELLE : HEADER + NAV --->
<?php if (isset($_SESSION["user"]["id"]) === true) { ?>
<div class="p-2 fw-bold text-black border bg-white text-center">
  <?php echo "Bonjour " . htmlspecialchars($_SESSION["user"]["prenom"], ENT_QUOTES) . ". Ravi de vous revoir ! :-)"; ?>
</div>
<?php } ?>
<header>
  <div class="container-fluid">
    <div class="row">
      <div class="col px-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-primary bg-gradient">
          <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><img class="w-50 rounded-pill logo" src="images/logo.png"
                alt="logo" /></a>
            <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
              aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
              <ul class="navbar-nav text-center">
                <li class="nav-item">
                  <a class="nav-link text-white fs-5 active" aria-current="page" href="index.php">Accueil</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white fs-5" href="index.php#presentation">Présentation</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white fs-5" href="index.php#competences">Compétences</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white fs-5" href="index.php#cv">Mon CV</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white fs-5" href="index.php?action=affichageArticles">Articles</a>
                </li>
                <?php if (isset($_SESSION["user"]["role"]) === true && $_SESSION["user"]["role"] === "admin") { ?>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle text-white fs-5" href="#" id="navbarDropdownGestion" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Gestion
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdownGestion">
                    <li><a class="dropdown-item" href="index.php?action=gestionArticles">Articles</a></li>
                    <li><a class="dropdown-item" href="index.php?action=gestionUtilisateurs">Utilisateurs</a></li>
                    <li><a class="dropdown-item" href="index.php?action=gestionCommentaires">Commentaires</a></li>
                  </ul>
                </li>
                <?php } ?>
                <li class="nav-item">
                  <a class="nav-link text-white fs-5" href="index.php#contact">Contact</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>
</header>