<!--- VUE DE LA PAGE SUR LA CREATION DE COMPTE --->

<?php use Lib\Globals;

$globals = new Globals();
$globals->setGET();
$get = $globals->getGET(); ?>

<?php $title = "Création d'un compte"; ?>

<?php ob_start();
$_SESSION['tokenCompte'] = bin2hex(random_bytes(35)); ?>

<div class="div-connexion-bg">
</div>
<section class="pos">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="div-connexion p-4 border rounded shadow-lg fw-bold">
                    <h1 class="fs-4 fw-bold text-center">Création d'un compte</h1>
                    <?php if (isset($erreurChamp) && $erreurChamp == true) { ?>
                    <div class="bg-danger text-white fw-bold p-3 mt-3">
                        La saisie de tout les champs est obligatoire !
                    </div>
                    <?php } ?>
                    <?php if (isset($get["success"]) && $get["success"] == "1") { ?>
                    <div class="messageSuccess bg-success text-white fw-bold p-3 mt-3">
                        Création de votre compte effectuée avec succès !<br>
                        Un mail vous sera envoyé dès que l'administrateur vous aura validé votre compte.
                    </div>
                    <?php } ?>
                    <br>
                    <form action="index.php?action=retourCreationCompte" method="POST">
                        <label for="nom" class="form-label">Nom</label>
                        <input class="inputCompte form-control mb-3 border-2" type="text" name="nom" placeholder="Nom"
                            value="<?php if (isset($inputs["nom"])) {
                                echo strip_tags($inputs["nom"]);
                            } ?>" />
                        <p class="msgErreurC d-none fst-italic fw-bold text-danger">La saisie de votre nom est
                            obligatoire !
                        </p>
                        <label for="prenom" class="form-label">Prénom</label>
                        <input class="inputCompte form-control mb-3 border-2" type="text" name="prenom"
                            placeholder="Prénom" value="<?php if (isset($inputs["prenom"])) {
                                echo strip_tags($inputs["prenom"]);
                            } ?>" />
                        <p class="msgErreurC d-none fst-italic fw-bold text-danger">La saisie de votre prénom est
                            obligatoire !
                        </p>
                        <label for="email" class="form-label">Email</label>
                        <input class="inputCompte form-control mb-3 border-2" type="email" name="email"
                            placeholder="exemple@mail.fr" value="<?php if (isset($inputs["email"])) {
                                echo strip_tags($inputs["email"]);
                            } ?>" />
                        <p id="msgErreurEmail" class="d-none fst-italic fw-bold text-danger">Le format de l'email est
                            incorrect !
                        </p>
                        <?php if (isset($erreurMail) && $erreurMail == true) { ?>
                        <p id="msgErreurEmail2" class="fst-italic fw-bold text-danger">Le format de l'email est
                            incorrect !
                        </p>
                        <?php } ?>
                        <?php if (isset($erreurMailExistant) && $erreurMailExistant == true) { ?>
                        <p id="msgErreurEmail3" class="fst-italic fw-bold text-danger">Cette adresse mail a déjà été
                            utilisé. Veuillez en choisir une autre !
                        </p>
                        <?php } ?>
                        <label for="password" class="form-label">Mot de Passe</label>
                        <div class="d-flex align-items-center bg-white border border-2 rounded mb-3">
                            <input id="input-password-connexion" class="inputCompte form-control w-100 border-0"
                                type="password" name="password" placeholder="Mot de Passe" />
                            <i id="eye-closed" class="d-block fa-sharp fa-solid fa-eye-slash p-2"></i>
                            <i id="eye-opened" class="d-none fa-solid fa-eye p-2"></i>
                        </div>
                        <p id="msgErreurMdp" class="d-none fst-italic fw-bold text-danger">Votre mot de passe doit
                            contenir au moins : <br>- 12 caractères<br>- 1 lettre en majuscule<br>- 1 lettre en
                            miniscule<br>- 1 caractère spéciaux (?!@#$%^&*)(+=~.;:_-)
                        </p>
                        <?php if (isset($erreurPassword) && $erreurPassword == true) { ?>
                        <p id="msgErreurMdp2" class="fst-italic fw-bold text-danger">Votre mot de passe doit
                            contenir au moins : <br>- 12 caractères<br>- 1 lettre en majuscule<br>- 1 lettre en
                            minuscule<br>- 1 caractère spéciaux (?!@#$%^&*)(+=~.;:_-)
                        </p>
                        <?php } ?>
                        <label for="password-confirmed" class="form-label">Confirmer votre mot de passe</label>
                        <input id="input-password-connexion-confirmed" class="inputCompte form-control border-2"
                            type="password" name="passwordConfirmed" placeholder="Confirmer votre mot de passe" />
                        <p id="msgErreurMdpConfirmed" class="d-none fst-italic fw-bold text-danger">Ce mot de passe ne
                            correspond pas à celui du dessus !
                        </p>
                        <?php if (isset($erreurPasswordConfirmed) && $erreurPasswordConfirmed == true) { ?>
                        <p id="msgErreurMdpConfirmed2" class="fst-italic fw-bold text-danger">Ce mot de passe ne
                            correspond pas à celui du dessus !
                        </p>
                        <?php } ?>
                        <br>
                        <input type="hidden" name="token" value="<?php echo strip_tags($_SESSION['tokenCompte']); ?>">
                        <input id="btnCreationCompte" class="btn btn-dark w-100" type="submit" name="btnCreationCompte"
                            value="Valider" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript" src="scripts/connexion.js"></script>

<?php $content = ob_get_clean(); ?>

<?php include_once __DIR__ . "/layout.php"; ?>