<!--- VUE DE LA PAGE D'ACCUEIL --->

<?php $title = "Accueil"; ?>

<?php ob_start(); ?>

<!-- SECTION : ACCUEIL -->
<section id="accueil">
    <div class="container-fluid">
        <div class="row">
            <div class="div-accueil1 col-12 col-md-6 bg-light bg-gradient p-3 p-md-5">
                <h1 class="shadow-lg">
                    <code class="text-secondary fw-bold"><<span class="text-primary">h1</span>></code>
                    Alban VOIRIOT
                    <code class="text-secondary fw-bold"><<span>/</span><span class="text-primary">h1</span>></code>
                </h1>
                <p class="shadow-lg fs-2">21ans, Développeur Web en alternance</p><br>
                <p><cite>=> Autonome, passionné et curieux. Je suis celui qu'il vous faut dans votre équipe !</cite></p>
                <a class="btn btn-dark" href="#presentation">Allez vers le bas</a>
                <img class="photo-profil rounded" src="images/Photo-ProfilCV.jpg" alt="Photo de profil">
            </div>
            <div class="col-12 col-md-6 div-accueil-photo">
            </div>
        </div>
    </div>
</section>

<!-- SECTION : PRESENTATION -->
<div class="div-inter-accueil-presentation"></div>
<section id="presentation" class="p-4 text-white">
    <div class="container">
        <h2>Présentation</h2>
        <hr class="border border-2 border-white"><br>
        <div class="row">
            <div class="div-presentation bg-light text-dark p-4 border-start border-5 border-dark mb-5 mb-md-0">
                Je vous souhaite la bienvenue sur blog personnel (portfolio) où je présente mon parcours avec mes
                compétences, mon CV au format PDF et un formulaire sur lequel vous pourrez me contacter en m'envoyant un
                message.
            </div>
            <div class="div-presentation bg-light text-dark p-4 border-end border-5 border-dark mb-5 mb-md-0">
                Je m'appelle Alban Voiriot, 21 ans et je suis développeur web en alternance depuis septembre 2022. Etant
                titulaire d'un BTS SIO option SLAM (Bac +2), j'effectue une formation de développeur d'applications PHP
                / Symfony chez OpenClassrooms.
            </div>
            <div class="div-presentation bg-light text-dark p-4 border-start border-5 border-dark mb-5 mb-md-0">
                Vous aurez aussi la possibilité de lire des articles et de les commenter uniquement si vous posséder un
                compte. Si ce n'est pas le cas, je vous invite à en créer un, en allant dans le <a href="#footer">pied
                    de page</a> sur le lien "<strong>Se connecter</strong>" puis de créer un compte. Ensuite, vous
                pourrez intéragir sur n'importe quel article de votre choix avec d'autres utilisateurs.
            </div>
            <div class="div-presentation bg-light text-dark p-4 border-end border-5 border-dark mb-5 mb-md-0">
                Pour visualiser et tester mes projets, allez sur mon compte
                <a href="https://github.com/Alban2001">GitHub</a> puis ajoutez-moi sur votre réseau
                <a href="https://www.linkedin.com/in/alban-voiriot-aa69b820b/">LinkedIn</a> en m'envoyant une demande
                d'invitation.
            </div>
        </div>
    </div>
</section>

<!-- SECTION : COMPETENCES -->
<section id="competences" class="p-4 bg-light bg-gradient">
    <div class="container">
        <h2>Mes Compétences</h2>
        <hr class="border border-2 border-dark"><br>
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="pb-3">
                    <img class="logo-competences rounded-circle" src="images/HTML5_logo.png" alt="HTML5_logo" />
                    <div class="progress" style="height: 20px;">
                        <div class="progress-bar" role="progressbar" style="width: 90%;" aria-valuenow="90"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="pb-3">
                    <img class="logo-competences rounded-circle" src="images/CSS3_logo.png" alt="CSS3_logo" />
                    <div class="progress" style="height: 20px;">
                        <div class="progress-bar" role="progressbar" style="width: 75%;" aria-valuenow="75"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="pb-3">
                    <img class="logo-competences rounded-circle" src="images/JavaScript-Logo.png"
                        alt="JavaScript-Logo" />
                    <div class="progress" style="height: 20px;">
                        <div class="progress-bar" role="progressbar" style="width: 65%;" aria-valuenow="65"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="pb-3">
                    <img class="logo-competences rounded-circle" src="images/bootstrap_logo.png" alt="bootstrap_logo" />
                    <div class="progress" style="height: 20px;">
                        <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="pb-3">
                    <img class="logo-competences rounded-circle" src="images/WordPress-logo.png" alt="WordPress-logo" />
                    <div class="progress" style="height: 20px;">
                        <div class="progress-bar" role="progressbar" style="width: 60%;" aria-valuenow="60"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="pb-3">
                    <img class="logo-competences rounded-circle" src="images/PHP-logo.png" alt="PHP-logo" />
                    <div class="progress" style="height: 20px;">
                        <div class="progress-bar" role="progressbar" style="width: 80%;" aria-valuenow="80"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="pb-3">
                    <img class="logo-competences rounded-circle" src="images/sql_logo.png" alt="sql_logo" />
                    <div class="progress" style="height: 20px;">
                        <div class="progress-bar" role="progressbar" style="width: 80%;" aria-valuenow="80"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="pb-3">
                    <img class="logo-competences rounded-circle" src="images/CSharpLogo.png" alt="CSharpLogo" />
                    <div class="progress" style="height: 20px;">
                        <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="pb-3">
                    <img class="logo-competences rounded-circle" src="images/VB_Logo.svg.png" alt="VB_Logo" />
                    <div class="progress" style="height: 20px;">
                        <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="pb-3">
                    <img class="logo-competences rounded-circle" src="images/asp.net_logo.png" alt="asp.net_logo" />
                    <div class="progress" style="height: 20px;">
                        <div class="progress-bar" role="progressbar" style="width: 50%;" aria-valuenow="50"
                            aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION : CV -->
<section id="cv" class="p-4 text-white">
    <div class="container">
        <div class="row">
            <div class="col">
                <h2>Mon CV</h2>
                <hr class="border border-2 border-white"><br>
                <p>Je vous invite à télécharger mon CV en format PDF :
                    <a class="text-decoration-none text-white" href="images/CV_AlbanVOIRIOT.pdf">
                        <i class="fa-solid fa-file-pdf"></i> CV_AlbanVOIRIOT.pdf
                    </a>
                </p>
            </div>
        </div>
    </div>
</section>

<!-- SECTION : CONTACT -->
<section id="contact" class="p-4 bg-light bg-gradient">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 bg-light bg-gradient">
                <div class="div-coordonnees"></div>
                <div class="div-coordonnees"></div>
                <div class="div-coordonnees"></div>
            </div>
            <div class="col-12 col-md-6">
                <form action="" method="post">
                    <h2 class="fw-bold">Contactez-moi</h2>
                    <hr class="border border-2 border-dark">
                    <label class="fw-bold bg-dark p-1 rounded-top text-white" for="nomPrenom">Nom / Prénom</label>
                    <input id="nomPrenom" class="form-control border border-3" type="text" name="nomPrenom"
                        placeholder="Saisissez votre nom et prénom..."><br>
                    <label class="fw-bold bg-dark p-1 rounded-top text-white" for="email">Email</label>
                    <input id="email" class="form-control border border-3" type="email" name="email"
                        placeholder="exemple@mail.fr"><br>
                    <label class="fw-bold bg-dark p-1 rounded-top text-white" for="objet">Objet</label>
                    <input id="objet" class="form-control border border-3" type="text" name="objet"
                        placeholder="Votre objet"><br>
                    <label class="fw-bold bg-dark p-1 rounded-top text-white" for="message">Message</label><br>
                    <textarea class="w-100 border border-3 p-3" name="message" id="message" rows="10"
                        placeholder="Ecrivez votre message..."></textarea><br><br>
                    <input class="btn btn-dark bg-gradient w-100" type="submit" value="Envoyer">
                </form>
            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php include_once(__DIR__ . "/layout.php"); ?>