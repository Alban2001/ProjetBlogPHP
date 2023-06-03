<!--- VUE PARTIELLE : HEADER + NAV --->
<?php session_start(); ?>
<?php if (isset($_SESSION["user"]["id"])) { ?>
<div class="p-2 fw-bold text-black border bg-white text-center">
  <?php echo "Bonjour " . $_SESSION["user"]["nom"] . " " . $_SESSION["user"]["prenom"] . ". Ravi de vous revoir ! :-)"; ?>
</div>
<?php } ?>
<header>
  <div class="container-fluid">
    <div class="row">
      <div class="col px-0">
        <nav class="navbar navbar-expand-md navbar-light bg-primary bg-gradient">
          <div class="container-fluid">
            <a class="navbar-brand" href="#"><img class="w-50 rounded-pill logo" src="images/logo.png" alt="logo" /></a>
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
                  <a class="nav-link text-white fs-5" href="#presentation">Présentation</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white fs-5" href="#competences">Compétences</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white fs-5" href="#cv">Mon CV</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white fs-5" href="#">Articles</a>
                </li>
                <?php if (isset($_SESSION["user"]["role"])) { ?>
                <li class="nav-item">
                  <a class="nav-link text-white fs-5" href="#">Gestion des articles</a>
                </li>
                <?php } ?>
                <li class="nav-item">
                  <a class="nav-link text-white fs-5" href="#contact">Contact</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>
</header>