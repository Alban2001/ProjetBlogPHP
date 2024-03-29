<!--- VUE DE LA PAGE SUR L'AFFICHAGE DE L'ENSEMBLE DES ARTICLES --->

<?php $title = "Nos articles";
ob_start(); ?>

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
                                    src="<?php echo 'images/upload/' . htmlspecialchars($article->getImage(), ENT_QUOTES); ?>"
                                    alt="image article">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <strong>
                                        <?php echo htmlspecialchars($article->getTitre(), ENT_QUOTES); ?>
                                    </strong>
                                </h5>
                                <p class="card-text text-justify">
                                    <?php echo htmlspecialchars($article->getChapo(), ENT_QUOTES); ?>
                                </p>
                                <p class="card-text"><small class="text-muted">
                                        <?php echo "Dernière modification : " . htmlspecialchars($article->getDateDerniereMaj()->format("d/m/Y"), ENT_QUOTES); ?>
                                    </small></p>
                                <a href="index.php?action=read&id=<?php echo htmlspecialchars($article->getId(), ENT_QUOTES); ?>"
                                    class="btn btn-affichage-article text-white">Lire cet article...</a>
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
        <button id="btnPaginationLeft" class="btn-pagination-gestion p-2 m-2"><i
                class="fa-solid fa-angle-left"></i></button>
    </div>
    <div id="pagination" class="mt-5 text-center"></div>
    <div>
        <button id="btnPaginationRight" class="btn-pagination-gestion p-2 m-2"><i
                class="fa-solid fa-angle-right"></i></button>
    </div>
</div>

<script type="text/javascript" src="scripts/pagination.js"></script>
<script type="text/javascript" src="scripts/articles.js"></script>

<?php $content = ob_get_clean();

include_once __DIR__ . "/../layout.php";