<?php
session_start();
include "scripts/functions.php";

page::parametres("Annonces - Tutucar");
page::entete();
page::nav();

if (isset($_POST["action"])) {
    if ($_POST["action"] == "supprimer") {
        annonces::remove($_POST["id"]);
    } elseif ($_POST["action"] == "modifier") {
        annonces::put($_POST);
    }
}
$annonces = annonces::get();
$afficherActions = false;

if (isset($_SESSION["user
"]))
    foreach ($annonces as $a) {
        if ($_SESSION['user'] === $a['Pseudo'] || in_array($_SESSION['role'], ['modo', 'admin'])) {
            $afficherActions = true;
            break;
        }
    }
$user = $_SESSION["user"] ?? null;
$role = $_SESSION["role"] ?? null;
?>

<h1 class="my-4 text-center">Modification des annonces</h1>

<div class="container">
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Pseudo</th>
                    <th>Date</th>
                    <th>Départ</th>
                    <th>Arrivée</th>
                    <th>Places</th>
                    <th>Commentaire</th>
                    <?php if ($afficherActions): ?>
                        <th>Actions</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
            <?php foreach (annonces::get() as $id => $a) { ?>
                    <tr>
                        <td><?= $id ?></td>
                        <td><?= htmlspecialchars($a['Pseudo']) ?></td>
                        <td><?= htmlspecialchars($a['Date']) ?></td>
                        <td><?= htmlspecialchars($a['Depart']) ?></td>
                        <td><?= htmlspecialchars($a['Arrivee']) ?></td>
                        <td><?= htmlspecialchars($a['Places']) ?></td>
                        <td><?= htmlspecialchars($a['Commentaire']) ?></td>
                            <?php if ($user === $a['Pseudo'] || in_array($role, ['modo', 'admin'])) : ?>
                            <td class="d-flex gap-1" style="border: none;">
                                <form method="post">
                                    <input type="hidden" name="action" value="supprimer">
                                    <input type="hidden" name="id" value="<?= $id ?>">
                                    <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Supprimer cette annonce ?')">
                                        🗑️
                                    </button>
                                </form>
                                <a href="?edit=<?= $id ?>#modif" class="btn btn-sm btn-success">✏️</a>
                        </td>
                            <?php endif; ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <?php
    if (isset($_GET['edit'])):
        $edit = $_GET['edit'];
        $a = annonces::get()[$edit];

        // Autorisation : proprio ou modo/admin
        if ($user === $a['Pseudo'] || in_array($role, ['modo', 'admin'])):
    ?>
        <h2 class="my-4">Modifier l'annonce</h2>
        <form method="post" class="row g-3" id="modif">
            <input type="hidden" name="action" value="modifier">
            <input type="hidden" name="id" value="<?= $edit ?>">

            <div class="col-md-3">
                <div class="form-floating mb-3">
                    <input type="date" class="form-control" id="date" name="date" placeholder="Date" required>
                    <label for="date">Date</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="depart" name="start" placeholder="Départ" value="<?= htmlspecialchars($a['Depart']) ?>" required>
                    <label for="depart">Départ</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="arrivee" name="stop" placeholder="Arrivée" value="<?= htmlspecialchars($a['Arrivee']) ?>" required>
                    <label for="arrivee">Arrivée</label>
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="places" name="places" placeholder="Places" value="<?= $a['Places'] ?>" min="1" required>
                    <label for="places">Places</label>
                </div>
            </div>
            <div class="col-md-2">
                <input type="text" name="commentaire" class="form-control" value="<?= htmlspecialchars($a['Commentaire']) ?>">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    <?php endif; endif; ?>
</div>

<?php page::pieddepage(); ?>
