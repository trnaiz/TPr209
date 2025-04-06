<?php
session_start();
include "scripts/functions.php";

page::parametres("Recherche d'annonces - Tutucar");
page::entete();
page::nav();
$user = $_SESSION["user"] ?? null;
annonces::reservation($user);
?>

<section class="py-5">
    <div class="container">
        <h1 class="text-center mb-4">🔍 Rechercher un trajet</h1>

        <!-- Formulaire de recherche -->
        <form method="get" class="row g-3 mb-5 p-4 border rounded-3 shadow-sm">
            <div class="col-md-4">
                <label for="date" class="form-label">Date</label>
                <input type="date" name="date" id="date" class="form-control" value="<?= $_GET['date'] ?? '' ?>">
            </div>
            <div class="col-md-4">
                <label for="places" class="form-label">Places disponibles (≥)</label>
                <input type="number" name="places" id="places" class="form-control" min="1" value="<?= $_GET['places'] ?? '' ?>">
            </div>
            <div class="col-md-4">
                <label for="trajet" class="form-label">Départ ou arrivée contient</label>
                <input type="text" name="trajet" id="trajet" class="form-control" placeholder="ex: Paris" value="<?= $_GET['trajet'] ?? '' ?>">
            </div>

            <div class="col-12 text-end">
                <button type="submit" class="btn btn-primary">Rechercher</button>
            </div>
        </form>

        <!-- Résultats -->
        <?php
        $annonces = annonces::get();
        $filtres = [];

        foreach ($annonces as $id => $a) {
            $match = true;

            if (!empty($_GET['date']) && $a['Date'] !== $_GET['date']) {
                $match = false;
            }

            if (!empty($_GET['places']) && (intval($a['Places'])-annonces::nbr_inscrit($id)) < intval($_GET['places'])) {
                $match = false;
            }

            if (!empty($_GET['trajet'])) {
                $t = strtolower($_GET['trajet']);
                if (!str_contains(strtolower($a['Depart']), $t) && !str_contains(strtolower($a['Arrivee']), $t)) {
                    $match = false;
                }
            }

            if ($match) {
                $filtres[$id] = $a;
            }
        }
        ?>

        <?php if (!empty($_GET) && count($filtres) === 0): ?>
            <p class="text-center text-muted">Aucune annonce ne correspond aux critères.</p>
        <?php elseif (count($filtres) > 0): ?>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Pseudo</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Départ</th>
                    <th>Arrivée</th>
                    <th>Places</th>
                    <th>Place(s) Disponible(s)</th>
                    <th>Commentaire</th>
                    <?php if (isset($_SESSION["user"])): ?>
                        <th class="text-center">Réservation</th>
                    <?php endif; ?>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($filtres as $id => $a): ?>
                    <?php $date = (new DateTime(substr($a['Date'], 0, 10)))->format("d/m/Y");
                    $heure = (new DateTime(substr($a['Date'], 11)))->format("H:i");?>
                    <tr>
                        <td><?= $id ?></td>
                        <td><?= htmlspecialchars($a['Pseudo']) ?></td>
                        <td><?= htmlspecialchars($date) ?></td>
                        <td><?= htmlspecialchars($heure) ?></td>
                        <td><?= htmlspecialchars($a['Depart']) ?></td>
                        <td><?= htmlspecialchars($a['Arrivee']) ?></td>
                        <td><?= htmlspecialchars($a['Places']) ?></td>
                        <td><?= htmlspecialchars($a['Places'] - annonces::nbr_inscrit($id)) ?></td>
                        <td><?= htmlspecialchars($a['Commentaire']) ?></td>
                        <?php if (isset($_SESSION["user"])): ?>
                            <?php if (in_array($_SESSION["user"], $a["Inscrits"])): ?>
                                <td class="border-0 text-center">
                                    <form method="post">
                                        <input type="text" value="<?= $id ?>" name="id" hidden>
                                        <input name="dell_reservation" type="submit" class="btn btn-sm btn-danger" value="👋">
                                    </form>
                                </td>
                            <?php elseif(!in_array($_SESSION["user"], $a["Inscrits"]) && ($a['Places'] - annonces::nbr_inscrit($id)) > 0):?>
                                <td class="border-0 text-center">
                                    <form method="post">
                                        <input type="text" value="<?= $id ?>" name="id" hidden>
                                        <input name="reservation" type="submit" class="btn btn-sm btn-success" value="🎟️">
                                    </form>
                                </td>
                            <?php endif; ?>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</section>

<?php page::pieddepage(); ?>
