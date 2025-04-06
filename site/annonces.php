<?php
session_start();
include "scripts/functions.php";

page::parametres("Annonces - Tutucar");
page::entete();
page::nav();
?>

    <section>
        <body class="align-items-center py-4">
        <div class="container justify-content-center mt-5">

            <form class="p-4 p-md-5 border rounded-3 shadow-sm mt-5" method="get" action="">
                <div class="text-center mb-4">
                    <h1 class="h3 mb-3 fw-normal">Gestion des annonces</h1>
                </div>

                <!-- Recherche -->
                <div class="mb-3">
                    <div class="col-md-12">
                        <a href="visualiser.php" class="w-100 btn btn-outline-primary">📄 Liste des annonces</a>
                    </div>
                </div>

                <!-- Boutons -->
                <div class="row g-2">
                    <div class="col-md-6">
                        <a href="rechercher.php" class="btn btn-outline-dark w-100 h-100">🔎 Rechercher</a>

                    </div>
                    <div class="col-md-6">
                        <a href="calendar.php" class="w-100 btn btn-outline-secondary">📅 Calendrier des annonces</a>

                    </div>
                    <div class="col-md-6">
                        <a href="proposer.php" class="w-100 btn btn-outline-success">➕ Créer une annonce</a>
                    </div>
                    <div class="col-md-6">
                        <a href="modifier.php" class="w-100 btn btn-outline-success">✏️ Modification des annonces</a>
                    </div>
                </div>
            </form>

        </div>
        </body>
    </section>

<?php page::pieddepage(); ?>