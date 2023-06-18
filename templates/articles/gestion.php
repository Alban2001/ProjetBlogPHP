<!--- VUE DE LA PAGE SUR LA GESTION DES ARTICLES --->

<?php $title = "Gestion des articles"; ?>
<?php ob_start(); ?>

<section id="gestionArticles" class="py-3 bg-light bg-gradient">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="fw-bold text-decoration-underline text-center mt-5">Gestion des articles</h1><br><br>
                <table class="table table-striped">
                    <thead>
                        <tr class="table-primary">
                            <th scope="col">ID</th>
                            <th scope="col">Titre</th>
                            <th scope="col">Image</th>
                            <th scope="col">Chapô</th>
                            <th scope="col">Date de création</th>
                            <th scope="col">Date de dernière modification</th>
                            <th class="text-center" scope="col" colspan="2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($articles as $article) { ?>
                        <tr>
                            <td scope="row">
                                <?php echo htmlspecialchars($article->getId()); ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($article->getTitre()); ?>
                            </td>
                            <td>
                                <img class="w-25 h-50" src="<?php echo 'images/upload/' . $article->getImage(); ?>" />
                            </td>
                            <td>
                                <?php echo htmlspecialchars($article->getChapo()); ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($article->getDateCreation()->format("d/m/Y")); ?>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($article->getdateDerniereMAJ()->format("d/m/Y")); ?>
                            </td>
                            <td class="text-center"><i class="fa-solid fa-pen-to-square"></i></td>
                            <td class="text-center"><i class="fa-solid fa-trash"></i></td>
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

<?php $content = ob_get_clean(); ?>

<?php include_once(__DIR__ . "/../layout.php"); ?>