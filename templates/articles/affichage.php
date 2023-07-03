<!--- VUE DE LA PAGE SUR L'AFFICHAGE DE L'ENSEMBLE DES ARTICLES --->

<?php $title = "Nos articles"; ?>
<?php ob_start(); ?>

<section id="affichageArticles" class="py-3 bg-light bg-gradient">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="fw-bold text-decoration-underline text-center mt-5">Nos Articles</h1><br><br>
                <div class="card-group">
                    <div class="row justify-content-center">
                        <?php foreach ($articles as $article) { ?>
                        <div class="card col-12 col-md-4 ms-0 ms-md-3 mb-5" style="width: 20rem;">
                            <div style="width:300px;height:250px;">
                                <img class="w-100 h-75"
                                    src="<?php echo 'images/upload/' . htmlspecialchars($article->getImage()); ?>"
                                    alt="image article">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <strong>
                                        <?php echo htmlspecialchars($article->getTitre()); ?>
                                    </strong>
                                </h5>
                                <p class="card-text text-justify">
                                    <?php echo htmlspecialchars($article->getChapo()); ?>
                                </p>
                                <p class="card-text"><small class="text-muted">
                                        <?php echo "Dernière modification : " . htmlspecialchars($article->getDateDerniereMaj()->format("d/m/Y")); ?>
                                    </small></p>
                                <a href="index.php?action=read&id=<?php echo htmlspecialchars($article->getId()); ?>"
                                    class="btn btnAffichageArticle text-white">Lire cet article...</a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
</section>
<div class="d-flex justify-content-center align-items-end">
    <div>
        <button id="btnPaginationLeft" class="btnPaginationGestion p-2 m-2"><i
                class="fa-solid fa-angle-left"></i></button>
    </div>
    <div id="pagination" class="mt-5 text-center"></div>
    <div>
        <button id="btnPaginationRight" class="btnPaginationGestion p-2 m-2"><i
                class="fa-solid fa-angle-right"></i></button>
    </div>
</div>

<script type="text/javascript" src="scripts/pagination.js"></script>
<script type="text/javascript" src="scripts/articles.js"></script>

<?php $content = ob_get_clean(); ?>

<?php include_once(__DIR__ . "/../layout.php"); ?>