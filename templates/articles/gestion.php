<!--- VUE DE LA PAGE SUR LA GESTION DES ARTICLES --->

<?php $title = "Gestion des articles"; ?>
<?php ob_start(); ?>

<section id="gestionArticles" class="py-3 bg-light bg-gradient">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="fw-bold text-decoration-underline text-center mt-5">Gestion des articles</h1><br><br>
                <?php
                if (isset($_GET["successInsert"]) && $_GET["successInsert"] === "1") { ?>
                <div class="messageSuccess fw-bold bg-success text-white text-center p-3 w-100">
                    Insertion d'un article effectuée avec succès !
                </div>
                <br>
                <?php } ?>
                <?php
                if (isset($_GET["successUpdate"]) && $_GET["successUpdate"] === "1") { ?>
                <div class="messageSuccess fw-bold bg-success text-white text-center p-3 w-100">
                    Mise à jour de l'article effectuée avec succès !
                </div>
                <br>
                <?php } ?>
                <?php
                if (isset($_GET["successDelete"]) && $_GET["successDelete"] === "1") { ?>
                <div class="messageSuccess fw-bold bg-success text-white text-center p-3 w-100">
                    Suppression l'article effectuée avec succès !
                </div>
                <br>
                <?php } ?>
                <table class="table table-striped table-mobile-responsive table-mobile-sided">
                    <thead>
                        <tr class="table-primary">
                            <th scope="col">ID</th>
                            <th scope="col">Titre</th>
                            <th scope="col">Image</th>
                            <th scope="col">Chapô</th>
                            <th scope="col">Date de création</th>
                            <th scope="col">Date de dernière modification</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($articles as $article) { ?>
                        <tr>
                            <td scope="row" data-content="ID">
                                <?php echo htmlspecialchars($article->getId()); ?>
                            </td>
                            <td data-content="Titre">
                                <?php echo htmlspecialchars($article->getTitre()); ?>
                            </td>
                            <td data-content="Image">
                                <img class="imageArticle"
                                    src="<?php echo 'images/upload/' . $article->getImage(); ?>" />
                            </td>
                            <td data-content="Chapô">
                                <?php echo htmlspecialchars($article->getChapo()); ?>
                            </td>
                            <td data-content="Date de Création">
                                <?php echo htmlspecialchars($article->getDateCreation()->format("d/m/Y")); ?>
                            </td>
                            <td data-content="Date de dernière MAJ">
                                <?php echo htmlspecialchars($article->getDateDerniereMaj()->format("d/m/Y")); ?>
                            </td>
                            <td data-content="Actions"><a
                                    href="<?php echo "index.php?action=edit&id=" . htmlspecialchars($article->getId()); ?>"
                                    class="me-4 me-md-3"><i class="fa-solid fa-pen-to-square text-dark"></i></a>
                                <a class="btnSupprimerArticle" href="#" data-bs-toggle="modal"
                                    data-bs-target="#modalDelete"><i class="fa-solid fa-trash text-dark"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <a class="btn btnAjoutArticle text-white fw-bold p-2" href="index.php?action=ajoutArticle"><i
                        class="fa-solid fa-plus"></i></a>
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
            <div class="modal-body">
                Etes-vous sûr de vouloir supprimer l'article n°<span id="spanDelete"></span> ?<br>Si oui, cet article
                sera supprimé définitivement !
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Non</button>
                <button id="btnConfirmerDelete" type="button" class="btn btn-primary">Oui</button>
            </div>
        </div>
    </div>
</div>
<form id="formDelete" action="index.php?action=delete" method="POST">
</form>

<script type="text/javascript" src="scripts/articles.js"></script>

<?php $content = ob_get_clean(); ?>

<?php include_once(__DIR__ . "/../layout.php"); ?>