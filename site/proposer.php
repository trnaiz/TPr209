<?php
session_start();
include "scripts/functions.php";

page::parametres("Créer une annonce - Tutucar");
page::entete();
page::nav();
?>
<section>
    <body class="align-items-center py-4">
    <div class="container justify-content-center mt-5">
        <?php if ($_SESSION["user"] ?? null) : ?>
        <form method="post" class="p-4 p-md-5 border rounded-3 shadow-sm mt-5">
            <div class="text-center mb-4">
                <h1 class="h3 mb-3 fw-normal">Créer une annonce</h1>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="pseudo" name="user" value="<?= $_SESSION["user"] ?? 'null'?>" hidden>
            </div>

            <div class="form-floating mb-3">
                <input type="date" class="form-control" id="date" name="date" required>
                <label for="date">Date</label>
            </div>

            <div class="form-floating mb-3">
                <input type="time" class="form-control" id="heure" name="heure" required>
                <label for="heure">Heure</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="depart" name="start" placeholder="Départ" required>
                <label for="depart">Départ</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="arrivee" name="stop" placeholder="Arrivée" required>
                <label for="arrivee">Arrivée</label>
            </div>

            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="places" name="places" placeholder="Places" min="1" required>
                <label for="places">Places</label>
            </div>

            <div class="form-floating mb-4">
                <textarea class="form-control" placeholder="Commentaire" id="commentaire" name="commentaire" style="height: 100px"></textarea>
                <label for="commentaire">Commentaire</label>
            </div>

            <div>
                <?php
                annonces::add();
                ?>
            </div>

            <button class="w-100 btn btn-lg btn-success" type="submit" name="button" value="true">Créer l'annonce</button>

            <hr class="my-4">

            <small class="text-body-secondary d-block text-center mt-2">
                <a href="annonces.php" class="text-decoration-none">Retour au menu précédent</a>
            </small>
        </form>
        <?php else: ?>
            <div class="alert alert-warning text-center my-5" role="alert">
                <h4 class="alert-heading">Accès restreint</h4>
                <p>⚠️ Vous devez être connecté pour accéder au calendrier des annonces.</p>
                <hr>
                <a href="connexion.php" class="btn btn-primary">Se connecter</a>
            </div>
        <?php endif; ?>
    </div>
    </body>
</section>
<?php page::pieddepage(); ?>
