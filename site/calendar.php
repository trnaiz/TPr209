<?php
session_start();
include "scripts/functions.php";

page::parametres("Mon calendrier - Tutucar");
page::entete();
page::nav();
?>

<section class="py-5">
    <div class="container">
        <h1 class="text-center mb-4">📅 Calendrier des annonces</h1>
        <?php if ($_SESSION["user"] ?? null) : ?>
        <div id="calendar">
            <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const calendarEl = document.getElementById('calendar');
                    const calendar = new FullCalendar.Calendar(calendarEl, {
                        themeSystem: 'bootstrap5',
                        initialView: 'dayGridMonth',
                        locale: 'fr',
                        height: 'auto',
                        events: <?= annonces::user_event(); ?>

                    });
                    calendar.render();
                });
            </script>
        </div>
        <?php else: ?>
            <div class="alert alert-warning text-center my-5" role="alert">
                <h4 class="alert-heading">Accès restreint</h4>
                <p>⚠️ Vous devez être connecté pour accéder au calendrier des annonces.</p>
                <hr>
                <a href="connexion.php" class="btn btn-primary">Se connecter</a>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php page::pieddepage(); ?>
