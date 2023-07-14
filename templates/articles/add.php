<!-- VUE DE LA PAGE POUR L'AJOUT D'UN ARTICLE -->

<?php $title = "Ajouter un article"; ?>
<?php ob_start();
$_SESSION['token'] = bin2hex(random_bytes(35)); ?>

<section id="ajoutArticle" class="py-5 bg-light bg-gradient">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="fw-bold p-5 text-center">Ajouter un article</h1>
                <br>
                <?php if (isset($numErreur) && $numErreur == true) { ?>
                    <div class="bg-danger text-white fw-bold p-3">
                        La saisie de tout les champs est obligatoire !
                    </div>
                <?php } ?>
                <br>
                <form action="index.php?action=retourAjoutArticle" method="POST" enctype='multipart/form-data'>
                    <label class="fw-bold" for="title" class="form-label">Titre</label>
                    <input class="inputAjoutArticle form-control border border-3" type="text" name="title"
                        placeholder="Titre" maxlength="255" value="<?php if (isset($inputs["title"])) {
                            echo htmlentities($inputs["title"], ENT_QUOTES);
                        } ?>">
                    <p class="messageErreurP d-none fst-italic fw-bold text-danger">La saisie du titre est obligatoire !
                    </p><br>
                    <label class="fw-bold" for="image" class="form-label">Image</label>
                    <br>
                    <img id="imgEditArticle" class="imageArticle d-none" />
                    <input id="inputFileImage" class="form-control border border-3" type="file" name="image"
                        accept="image/png, image/jpg, image/jpeg">
                    <?php if (isset($erreurExtension) && $erreurExtension == true) { ?>
                        <p class="bg-danger fst-italic fw-bold text-white p-1">
                            <?php echo htmlentities($messageErreur, ENT_QUOTES); ?>
                        </p><br>
                    <?php } ?>
                    <br>
                    <label class="fw-bold" for="chapo">Chapô</label><br>
                    <textarea class="inputAjoutArticle w-100 border border-3 p-3" name="chapo" id="chapo" rows="10"
                        placeholder="Ecrivez votre chapô..."><?php if (isset($inputs["chapo"])) {
                            echo htmlentities($inputs["chapo"], ENT_QUOTES);
                        } ?></textarea>
                    <p class="messageErreurP d-none fst-italic fw-bold text-danger">La saisie du chapô est obligatoire !
                    </p><br><br>
                    <label class="fw-bold" for="content">Contenu</label><br>
                    <textarea class="inputAjoutArticle w-100 border border-3 p-3" name="content" id="content" rows="10"
                        placeholder="Ecrivez votre contenu..."><?php if (isset($inputs["content"])) {
                            echo htmlentities($inputs["content"], ENT_QUOTES);
                        } ?></textarea>
                    <p class="messageErreurP d-none fst-italic fw-bold text-danger">La saisie du contenu est obligatoire
                        !</p><br><br>
                    <input type="hidden" name="token"
                        value="<?php echo htmlentities($_SESSION['token'], ENT_QUOTES); ?>">
                    <input class="btn btn-primary bg-gradient w-100 fw-bold p-2 mb-3" type="submit"
                        value="Ajouter l'article">
                    <button id="btnAnnulerArticle" class="btn btn-secondary bg-gradient w-100 fw-bold p-2" type="button"
                        data-bs-toggle="modal" data-bs-target="#modalAnnuler">Annuler</button>
                </form>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="modalAnnuler" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalAnnulerLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAnnulerLabel">Annuler l'ajout d'un article</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Etes-vous sûr de vouloir annuler l'ajout de l'article. <br>Si oui, Vos saisies seront perdues !
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                <button id="btnConfirmerAnnuler" type="button" class="btn btn-primary">Oui</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="scripts/articles.js"></script>

<?php $content = ob_get_clean(); ?>

<?php include_once __DIR__ . "/../layout.php"; ?>