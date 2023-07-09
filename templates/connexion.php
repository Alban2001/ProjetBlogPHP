<?php $title = "Connexion"; ?>

<?php ob_start();
$_SESSION['token'] = bin2hex(random_bytes(35)); ?>

<div class="div-connexion-bg">
</div>
<section>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="div-connexion p-4 border rounded shadow-lg fw-bold">
                    <h1 class="fs-4 fw-bold text-center">Connexion à votre compte</h1>
                    <br>
                    <?php if (isset($numErreur) && $numErreur == true) { ?>
                        <div class="bg-danger text-white fw-bold p-3">
                            Erreur : votre adresse mail ou mot de passe est incorrect ou compte non validé !
                        </div>
                    <?php } ?>
                    <br>
                    <form action="index.php?action=retourConnexion" method="POST">
                        <label for="email" class="form-label">Email</label>
                        <input class="form-control" type="email" name="email" placeholder="Email" /><br>
                        <label for="email" class="form-label">Mot de Passe</label>
                        <div class="d-flex align-items-center bg-white border border-1 rounded">
                            <input id="input-password-connexion" class="form-control w-100 border-0" type="password"
                                name="password" placeholder="Mot de Passe" />
                            <i id="eye-closed" class="d-block fa-sharp fa-solid fa-eye-slash p-2"></i>
                            <i id="eye-opened" class="d-none fa-solid fa-eye p-2"></i>
                        </div>
                        <br>
                        <a class="text-center" href="#">Mot de passe oublié ?</a>
                        <br><br>
                        <input type="hidden" name="token" value="<?php echo htmlspecialchars($_SESSION['token']); ?>">
                        <input class="btn btn-dark w-100" type="submit" name="btnConnecter" value="Se connecter" />
                        <hr class="border border-2 border-dark">
                        <a href="index.php?action=creationCompte" class="btn btn-primary w-100">Créer un compte</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript" src="scripts/connexion.js"></script>

<?php $content = ob_get_clean(); ?>

<?php include_once __DIR__ . "/layout.php"; ?>