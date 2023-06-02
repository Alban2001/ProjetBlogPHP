<!--- VUE PARTIELLE : FOOTER --->
<footer id="footer" class="bg-dark text-white">
    <div class="container-fluid">
        <div class="row p-4 p-md-5">
            <div class="col-12 col-md-3 mb-4 mb-md-0">
                <h4 class="text-center text-md-start fw-bold">A Propos</h4>
                <hr class="border border-2 border-white">
                <p><strong>Nom / Prénom</strong> : Alban VOIRIOT</p>
                <p><i class="fa-solid fa-location-dot"></i><strong> Ville de Résidence</strong> : Strasbourg
                </p>
            </div>
            <div class="col-12 col-md-3 mb-4 mb-md-0 text-center text-md-start">
                <h4 class="text-center text-md-start fw-bold">Navigation</h4>
                <hr class="border border-2 border-white">
                <ul class="list-navigation">
                    <li><a class="text-white" href="index.php">Accueil</a></li>
                    <li><a class="text-white" href="#">Articles</a></li>
                    <li><a class="text-white" href="#contact">Contact</a></li>
                    <?php if (isset($_SESSION["role"])) { ?>
                    <li><a class="text-white" href="index.php?action=deconnexion">Se déconnecter</a></li>
                    <?php } else { ?>
                    <li><a class="text-white" href="index.php?action=connexion">Se connecter</a></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-12 col-md-4 mb-4 mb-md-0 text-center text-md-start">
                <h4 class="text-center text-md-start fw-bold">Informations sur le site</h4>
                <hr class="border border-2 border-white">
                <ul class="list-navigation">
                    <li><a class="text-white" href="#">Mentions légales</a></li>
                    <li><a class="text-white" href="#">Gestion des cookies</a></li>
                    <li><a class="text-white" href="#">Politique de confidentialité</a></li>
                    <li><a class="text-white" href="#">Protection des données personnelles</a></li>
                </ul>
            </div>
            <div class="col-12 col-md-2">
                <h4 class="text-center fw-bold">Suivez-Moi</h4>
                <hr class="border border-2 border-white">
                <div class="d-flex flex-row justify-content-evenly">
                    <a class="me-md-5" href="https://www.linkedin.com/in/alban-voiriot-aa69b820b/">
                        <i class="fa-brands fa-linkedin text-white logo-reseaux"></i>
                    </a>
                    <a href="https://github.com/Alban2001">
                        <i class="fa-brands fa-github text-white logo-reseaux"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <hr class="border border-2 border-white">
                <p class="text-write text-center">(c) 2023 Copyright - Tous droits réservés à Alban VOIRIOT - Blog
                    Personnel
                </p>
            </div>
        </div>
    </div>
</footer>