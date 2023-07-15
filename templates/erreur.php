<?php $title = "Page d'erreur";

ob_start(); ?>

<section id="erreur">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="div-erreur bg-danger bg-gradient p-4 text-white fw-bold">
                    <h2>
                        <?php echo htmlspecialchars($messageErreur, ENT_QUOTES); ?>
                    </h2>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $content = ob_get_clean();

include_once __DIR__ . "/layout.php";