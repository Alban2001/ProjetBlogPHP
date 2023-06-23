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
                                <a href="#"><i class="fa-solid fa-trash text-dark"></i></a>
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

<script type="text/javascript" src="scripts/articles.js"></script>

<?php $content = ob_get_clean(); ?>

<?php include_once(__DIR__ . "/../layout.php"); ?>