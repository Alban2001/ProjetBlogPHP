<!--- VUE DE LA PAGE SUR LA LECTURE D'UN ARTICLE --->

<?php use Lib\Globals;

$globals = new Globals();
$globals->setGET();
$get = $globals->getGET();

$title = "Lecture d'article";
ob_start();
$_SESSION['token'] = bin2hex(random_bytes(35)); ?>

<section id="lireArticle" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col overflow-auto bg-light bg-gradient p-4 p-md-5">
                <h1 class="fw-bold text-center">Article n°
                    <?php echo htmlspecialchars($article->getId(), ENT_QUOTES) . ' : ' . htmlspecialchars($article->getTitre(), ENT_QUOTES); ?>
                </h1>
                <br>
                <p><strong>Auteur</strong> :
                    <?php echo htmlspecialchars($user->getPrenom(), ENT_QUOTES) . ' ' . htmlspecialchars($user->getNom(), ENT_QUOTES); ?>
                </p>
                <p><strong>Date de la dernière mise à jour</strong> :
                    <?php echo htmlspecialchars($article->getDateDerniereMaj()->format("d/m/Y"), ENT_QUOTES); ?>
                </p>
                <hr>
                <div class="fs-5 text-justify">
                    <?php echo htmlspecialchars($article->getChapo(), ENT_QUOTES); ?>
                </div>
                <div class="text-center m-5">
                    <img class="image-article-read"
                        src="<?php echo 'images/upload/' . htmlspecialchars($article->getImage(), ENT_QUOTES); ?>"
                        alt="image article" />
                </div>
                <div class="fs-6 text-justify">
                    <?php echo htmlspecialchars($article->getContenu(), ENT_QUOTES); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?php if (isset($get["messageErreur"]) === true && $get["messageErreur"] === "1") { ?>
                <div class="bg-danger text-white fw-bold p-3">
                    La saisie du commentaire est obligatoire !
                </div>
                <br>
                <?php } ?>
                <form action="index.php?action=comment" method="POST">
                    <label for="textarea-commentaire" class="form-label fw-bold">Votre commentaire</label>
                    <?php if (isset($_SESSION["user"]["id"]) === true) { ?>
                    <textarea id="textarea-commentaire" class="form-control" rows="5"
                        placeholder="Ecrivez votre commentaire..." name="commentaire"></textarea>
                    <input type="hidden" name="token"
                        value="<?php echo htmlspecialchars($_SESSION['token'], ENT_QUOTES); ?>">
                    <p class="messageErreurCommentaire d-none fst-italic fw-bold text-danger">La saisie du commentaire
                        est obligatoire !
                    </p><br>
                    <input id="btnEnvoyerCommentaire" class="btn btn-commentaire text-white fw-bold" type="submit"
                        value="Envoyer le commentaire" disabled>
                    <?php } else { ?>
                    <p class="text-danger">* Vous devez vous connecter pour écrire un commentaire !</p>
                    <br>
                    <a class="btn btn-commentaire bg-dark text-white fw-bold"
                        href="index.php?action=connexion">Connectez-vous</a>
                    <?php } ?>
                </form>
                <br>
                <?php if (isset($get["success"]) === true && $get["success"] === "1") { ?>
                <br>
                <div class="messageSuccess fw-bold bg-success text-white text-center p-3">
                    Insertion du commentaire effectuée avec succès !<br>
                    Votre commentaire sera visible dès que l'administrateur l'aura validé.
                </div>
                <br>
                <?php } ?>
                <?php if ($nbrCommentaire > 0) { ?>
                <h3>
                    <?php echo $nbrCommentaire . ' commentaires'; ?>
                </h3>
                <?php } else { ?>
                <h3>
                    <?php echo 'Auncun commentaire'; ?>
                </h3>
                <?php } ?>
                <?php foreach ($commentaires as $commentaire) { ?>
                <div class="border bg-light bg-gradient">
                    <div>
                        <p><strong>De</strong> :
                            <?php echo htmlspecialchars($commentaire->getNomUtilisateur(), ENT_QUOTES) . " " . htmlspecialchars($commentaire->getPreomUtilisateur(), ENT_QUOTES); ?>
                        </p>
                        <p><strong>Date</strong> :
                            <?php echo htmlspecialchars($commentaire->getDateCreation()->format("d/m/Y"), ENT_QUOTES) . " à " . htmlspecialchars($commentaire->getDateCreation()->format("H:i"), ENT_QUOTES); ?>
                        </p>
                    </div>
                    <div>
                        <?php echo htmlspecialchars($commentaire->getContenu(), ENT_QUOTES); ?>
                    </div>
                </div>
                <br>
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript" src="scripts/articles.js"></script>

<?php $content = ob_get_clean();

include_once __DIR__ . "/../layout.php";