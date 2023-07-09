<!--- VUE DE LA PAGE SUR LA GESTION DES COMMENTAIRES --->
<?php use Lib\Globals;

$globals = new Globals();
$globals->setGET();
$get = $globals->getGET(); ?>

<?php $title = "Gestion des commentaires"; ?>
<?php ob_start();
$_SESSION['token'] = bin2hex(random_bytes(35)); ?>

<section id="gestionCommentaires" class="py-3 bg-light bg-gradient">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="fw-bold text-decoration-underline text-center mt-5">Gestion des commentaires</h1><br><br>
                <?php
                if (isset($get["successValidate"]) && $get["successValidate"] === "1") { ?>
                <div class="messageSuccess fw-bold bg-success text-white text-center p-3 w-100">
                    Validation du commentaire effectuée avec succès !
                </div>
                <br>
                <?php } ?>
                <table class="table table-striped table-mobile-responsive table-mobile-sided">
                    <thead>
                        <tr class="table-primary">
                            <th class="align-middle" scope="col">ID</th>
                            <th class="align-middle" scope="col">ID de l'article</th>
                            <th class="align-middle" scope="col">Contenu</th>
                            <th class="align-middle" scope="col">Date de Création</th>
                            <th class="align-middle" scope="col">Auteur</th>
                            <th class="align-middle" scope="col">Validé</th>
                            <th class="align-middle" scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($commentaires as $commentaire) { ?>
                        <tr>
                            <td scope="row" class="align-middle" data-content="ID">
                                <?php echo htmlspecialchars(addslashes($commentaire->getId()), ENT_COMPAT, 'utf-8'); ?>
                            </td>
                            <td class="align-middle" data-content="ID de l'article">
                                <?php $idArticle = htmlspecialchars(addslashes($commentaire->getIdArticle()), ENT_COMPAT, 'utf-8'); ?>
                                <a
                                    href="index.php?action=read&id=<?php echo htmlspecialchars(addslashes($idArticle), ENT_COMPAT, 'utf-8'); ?>">
                                    <?php echo htmlspecialchars(addslashes($idArticle), ENT_COMPAT, 'utf-8'); ?>
                                </a>
                            </td>
                            <td class="align-middle text-justify" data-content="Contenu">
                                <?php echo htmlspecialchars(addslashes($commentaire->getContenu()), ENT_COMPAT, 'utf-8'); ?>
                            </td>
                            <td class="align-middle" data-content="Date de Création">
                                <?php echo htmlspecialchars(addslashes($commentaire->getDateCreation()->format("d/m/Y")), ENT_COMPAT, 'utf-8'); ?>
                            </td>
                            <td class="align-middle" data-content="Auteur">
                                <?php echo htmlspecialchars(addslashes($commentaire->getPreomUtilisateur()), ENT_COMPAT, 'utf-8') . ' ' . htmlspecialchars(addslashes($commentaire->getNomUtilisateur()), ENT_COMPAT, 'utf-8'); ?>
                            </td>
                            <?php $valide = ($commentaire->getValide() === 1) ? "Oui" : "Non"; ?>
                            <td class="align-middle" data-content="Validé">
                                <?php echo $valide; ?>
                            </td>
                            <td class="align-middle" data-content="Actions">
                                <?php if ($commentaire->getValide() === 0) { ?>
                                <a class="btnValider btn btn-primary text-white fw-bold" href="#" data-bs-toggle="modal"
                                    data-bs-target="#modalValider" title="Valider">Valider</a>
                                <?php } else { ?>
                                <a class="btnValider text-success" title="Déjà validé" disabled tabindex="-1"><i
                                        class="fa-sharp fa-solid fa-square-check"></i></a>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-end">
            <div>
                <button id="btnPaginationLeft" class="btn-pagination-gestion p-2 m-2"><i
                        class="fa-solid fa-angle-left"></i></button>
            </div>
            <div id="pagination" class="mt-5 text-center"></div>
            <div>
                <button id="btnPaginationRight" class="btn-pagination-gestion p-2 m-2"><i
                        class="fa-solid fa-angle-right"></i></button>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="modalValider" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalValiderLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalValiderLabel">Validation d'un commentaire</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-justify">
                Etes-vous sûr de vouloir valider le commentaire n°<span id="spanID"></span> ?<br><br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                <button id="btnConfirmerValider" type="button" class="btn btn-primary">Oui</button>
            </div>
        </div>
    </div>
</div>
<form id="formValider" action="index.php?action=validateComment" method="POST">
    <input type="hidden" name="token"
        value="<?php echo htmlspecialchars(addslashes($_SESSION['token']), ENT_COMPAT, 'utf-8'); ?>">
</form>

<script type="text/javascript" src="scripts/pagination.js"></script>
<script type="text/javascript" src="scripts/gestion.js"></script>

<?php $content = ob_get_clean(); ?>

<?php include_once __DIR__ . "/layout.php"; ?>