<?php $title = "Page d'erreur"; ?>

<?php ob_start(); ?>

<section id="erreur">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="div-erreur bg-danger bg-gradient p-4 text-white fw-bold">
                    <h1 class="text-decoration-underline">Erreur :</h1>
                    <?php echo $messageErreur; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php include_once(__DIR__ . "/layout.php"); ?>