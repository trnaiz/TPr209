<?php
session_start();
include "scripts/functions.php";
page::parametres("Mon Profil - Tutucar");
page::entete();
page::nav();
?>
<h1 class="my-4 text-center">Mon profil</h1>

<div class="container py-5">
    <div class="card mx-auto shadow col-md-6 col-lg-4">
        <div class="card-body text-center">
            <img src="img/avatar/<?php echo $_SESSION["icon"]?>.png" class="rounded-circle mb-3" alt="Avatar" width="100" height="100">
            <h4 class="card-title fs-2 mb-3"><?php echo $_SESSION["user"]?></h4>
            <ul class="list-group list-group-flush text-start">
                <li class="list-group-item"><strong>Email :</strong> <?php echo $_SESSION["email"]?></li>
                <li class="list-group-item"><strong>Rôle :</strong> <?php echo $_SESSION["role"]?></li>
                <li class="list-group-item"><strong>Véhicule :</strong> <?php echo $_SESSION["vehicule"]?></li>
            </ul>
            <br>
            <a href="modifier_profil.php" class="btn btn-primary">Modifier le profil</a>
        </div>
    </div>
</div>
<?php
page::pieddepage();
?>
