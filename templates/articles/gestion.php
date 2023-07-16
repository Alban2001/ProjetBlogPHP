<!--- VUE DE LA PAGE SUR LA GESTION DES ARTICLES --->

<?php use Lib\Globals;

$globals = new Globals();
$globals->setGET();
$get = $globals->getGET();

$title = "Gestion des articles";
ob_start();
$_SESSION['token'] = bin2hex(random_bytes(35)); ?>

<section id="gestionArticles" class="py-3 bg-light bg-gradient">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="fw-bold text-decoration-underline text-center mt-5">Gestion des articles</h1><br><br>
                <?php
                if (isset($get["successInsert"]) === true && $get["successInsert"] === "1") { ?>
                <div class="messageSuccess fw-bold bg-success text-white text-center p-3 w-100">
                    Insertion d'un article effectuée avec succès !
                </div>
                <br>
                <?php } ?>
                <?php
                if (isset($get["successUpdate"]) === true && $get["successUpdate"] === "1") { ?>
                <div class="messageSuccess fw-bold bg-success text-white text-center p-3 w-100">
                    Mise à jour de l'article effectuée avec succès !
                </div>
                <br>
                <?php } ?>
                <?php
                if (isset($get["successDelete"]) === true && $get["successDelete"] === "1") { ?>
                <div class="messageSuccess fw-bold bg-success text-white text-center p-3 w-100">
                    Suppression de l'article effectuée avec succès !
                </div>
                <br>
                <?php } ?>
                <table class="table table-striped table-mobile-responsive table-mobile-sided">
                    <thead>
                        <tr class="table-primary">
                            <th class="align-middle" scope="col">ID</th>
                            <th class="align-middle" scope="col">Titre</th>
                            <th class="align-middle" scope="col">Image</th>
                            <th class="align-middle" scope="col">Chapô</th>
                            <th class="align-middle" scope="col">Date de création</th>
                            <th class="align-middle" scope="col">Date de dernière modification</th>
                            <th class="align-middle" scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($articles as $article) { ?>
                        <tr>
                            <td scope="row" class="align-middle" data-content="ID">
                                <?php echo htmlspecialchars($article->getId(), ENT_QUOTES); ?>
                            </td>
                            <td class="align-middle" data-content="Titre">
                                <?php echo htmlspecialchars($article->getTitre(), ENT_QUOTES); ?>
                            </td>
                            <td class="align-middle" data-content="Image">
                                <div class="image-article d-flex align-items-center">
                                    <img src="<?php echo 'images/upload/' . htmlspecialchars($article->getImage(), ENT_QUOTES); ?>"
                                        alt="image article" />
                                </div>
                            </td>
                            <td class="align-middle text-justify" data-content="Chapô">
                                <?php echo htmlspecialchars($article->getChapo(), ENT_QUOTES); ?>
                            </td>
                            <td class="align-middle" data-content="Date de Création">
                                <?php echo htmlspecialchars($article->getDateCreation()->format("d/m/Y"), ENT_QUOTES); ?>
                            </td>
                            <td class="align-middle" data-content="Date de dernière MAJ">
                                <?php echo htmlspecialchars($article->getDateDerniereMaj()->format("d/m/Y"), ENT_QUOTES); ?>
                            </td>
                            <td class="align-middle" data-content="Actions"><a
                                    href="<?php echo "index.php?action=edit&id=" . htmlspecialchars($article->getId(), ENT_QUOTES); ?>"
                                    class="me-4 me-md-3"><i class="fa-solid fa-pen-to-square text-dark"></i></a>
                                <a class="btnSupprimerArticle" href="#" data-bs-toggle="modal"
                                    data-bs-target="#modalDelete"><i class="fa-solid fa-trash text-dark"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <a class="btn btn-ajout-article text-white fw-bold p-2" href="index.php?action=ajoutArticle"><i
                        class="fa-solid fa-plus"></i></a>
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
<div class="modal fade" id="modalDelete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDeleteLabel">Suppression de l'article</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-justify">
                Etes-vous sûr de vouloir supprimer l'article n°<span id="spanDelete"></span> ?<br><br>Si oui, cet
                article
                sera supprimé définitivement avec les commentaires concernés !
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                <button id="btnConfirmerDelete" type="button" class="btn btn-primary">Oui</button>
            </div>
        </div>
    </div>
</div>
<form id="formDelete" action="index.php?action=delete" method="POST">
    <input type="hidden" name="token" value="<?php echo htmlspecialchars($_SESSION['token'], ENT_QUOTES); ?>">
</form>

<script type="text/javascript" src="scripts/pagination.js"></script>
<script type="text/javascript" src="scripts/articles.js"></script>

<?php $content = ob_get_clean();

include_once __DIR__ . "/../layout.php";