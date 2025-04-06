<?php
session_start();
include "scripts/functions.php";

page::parametres("Utilisateurs - Tutucar");
page::entete();
page::nav();
if (isset($_POST["action"])){
    if ($_POST["action"] == "supprimer"){
        users::removeUser($_POST["id"]);
    }elseif ($_POST["action"] == "edit"){
        users::put();
    };
}
?>
    <h1 class="my-4 text-center">Liste des utilisateurs</h1 >

    <div class="container">
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nom d'utilisateur</th>
                        <th scope="col">Véhicule</th>
                        <th scope="col">Rôle</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    foreach (users::get() as $personnage => $info) {
                    ?>
                        <tr>
                            <th scope="row"><?php echo $personnage ?></th>
                            <td><?php echo $info['utilisateur'] ?></td>
                            <td><?php echo $info['vehicule'] ?></td>
                            <td><?php echo $info['role'] ?></td>
                        <?php if ($_SESSION['role'] == "admin" || ($_SESSION["role"] == "modo")) :?>
                            <td class="px-0 text-center" style="border: none;">
                                <form method="post" style="display: inline;">
                                    <input type="hidden" name="action" value="supprimer">
                                    <input type="hidden" name="id" value="<?php echo $personnage ?>">
                                    <button type="submit"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');"
                                            class="btn btn-sm btn-danger"
                                            style="cursor: pointer;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white"
                                             class="bi bi-x-lg" viewBox="0 0 16 16">
                                            <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                                        </svg>
                                    </button>
                                </form>
                            </td>

                            <td class="px-0" style="border: none">
                                <a href="?edit=<?php echo $personnage ?>#modif" class="btn btn-sm btn-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                    </svg>
                                </a>
                            </td>
                        <?php endif;?>
                            </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <?php if (($_SESSION['role'] === "admin" || $_SESSION['role'] === "modo") && isset($_GET['edit'])):
        $edit = $_GET['edit'];
        $u = users::get()[$edit];
        ?>
        <h2 class="my-4">Modifier l'utilisateur</h2>
        <form method="post" class="row g-3" id="modif">
            <input type="hidden" name="action" value="modifier">
            <input type="hidden" name="id" value="<?= $edit ?>">

            <div class="col-md-4">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="utilisateur" name="utilisateur" placeholder="Nom d'utilisateur" value="<?php echo htmlspecialchars($u['utilisateur']) ?>" required autofocus>
                    <label for="utilisateur">Nom d'utilisateur</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating mb-3">

                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="vehicule" required>
                        <option selected aria-invalid="true" hidden=""><?php echo ucfirst($u["vehicule"])?></option>
                        <option value="renault">Renault</option>
                        <option value="volkswagen">Volkswagen</option>
                        <option value="honda">Honda</option>
                        <option value="lancia">Lancia</option>
                        <option value="ferrari">Ferrari</option>
                        <option value="ford">Ford</option>
                        <option value="lada">Lada</option>
                        <option value="bmw">Bmw</option>
                        <option value="citroen">Citroën</option>
                        <option value="mini">Mini</option>
                        <option value="zoe">Zoé</option>
                    </select>
                    <label for="floatingSelect">Marque de véhicule</label>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-floating mb-3">

                    <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="role" required>
                        <option selected aria-invalid="true" hidden=""><?php echo ucfirst($u["role"])?></option>
                        <option value="admin">Admin</option>
                        <option value="modo">Modo</option>
                        <option value="user">User</option>
                    </select>
                    <label for="floatingSelect">Rôle de l'utilisateur</label>
                </div>
            </div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-primary">OK</button>
            </div>
        </form>
    <?php endif; ?>
    </div>
<?php
page::pieddepage();