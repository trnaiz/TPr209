<?php
session_start();
include "scripts/functions.php";

page::parametres("Accueil - Tutucar");

page::entete();
page::nav();
?>
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold">Bienvenue sur Tutucar</h1>
            <p class="lead">La plateforme simple et efficace pour organiser vos trajets en covoiturage.</p>
        </div>

        <div class="container my-5 text-center">
            <div class="p-3 bg-light border rounded-3 d-inline-block shadow-sm">
                <strong><?= users::count() ?></strong> utilisateur<?= (users::count() > 1 ? "s" : "") ?> inscrit<?= (users::count() > 1 ? "s" : "") ?> sur Tutucar
            </div>
        </div>


        <div class="row g-4">
            <!-- Section 1 -->
            <div class="col-md-6">
                <div class="p-4 border rounded-3 shadow-sm h-100">
                    <h3>🚗 Publiez une annonce</h3>
                    <p>En quelques clics, proposez un trajet et partagez vos frais avec d'autres utilisateurs.</p>
                    <a href="proposer.php" class="btn btn-outline-success">Créer une annonce</a>
                </div>
            </div>

            <!-- Section 2 -->
            <div class="col-md-6">
                <div class="p-4 border rounded-3 shadow-sm h-100">
                    <h3>🔍 Recherchez un trajet</h3>
                    <p>Consultez les annonces disponibles et trouvez facilement un covoiturage proche de chez vous.</p>
                    <a href="rechercher.php" class="btn btn-outline-primary">Voir les annonces</a>
                </div>
            </div>

            <!-- Section 3 -->
            <div class="col-md-6">
                <div class="p-4 border rounded-3 shadow-sm h-100">
                    <h3>🧑‍🤝‍🧑 Rejoignez la communauté</h3>
                    <p>Partagez vos trajets en toute confiance avec des membres vérifiés et bienveillants.</p>
                    <a href="inscription.php" class="btn btn-outline-secondary">S'inscrire</a>
                </div>
            </div>

            <!-- Section 4 -->
            <div class="col-md-6">
                <div class="p-4 border rounded-3 shadow-sm h-100">
                    <h3>📅 Suivez vos trajets</h3>
                    <p>Accédez à votre calendrier de trajets et gérez vos réservations en toute simplicité.</p>
                    <a href="calendar.php" class="btn btn-outline-dark">Voir mon calendrier</a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php page::pieddepage();