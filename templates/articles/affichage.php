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
                                    src="<?php echo 'images/upload/' . strip_tags($article->getImage(), "<br>"); ?>"
                                    alt="image article">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <strong>
                                        <?php echo strip_tags($article->getTitre(), "<br>"); ?>
                                    </strong>
                                </h5>
                                <p class="card-text text-justify">
                                    <?php echo strip_tags($article->getChapo(), "<br>"); ?>
                                </p>
                                <p class="card-text"><small class="text-muted">
                                        <?php echo "Dernière modification : " . strip_tags($article->getDateDerniereMaj()->format("d/m/Y"), "<br>"); ?>
                                    </small></p>
                                <a href="index.php?action=read&id=<?php echo strip_tags($article->getId(), "<br>"); ?>"
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

<?php $content = ob_get_clean(); ?>

<?php include_once __DIR__ . "/../layout.php"; ?>