<?php
include "scripts/functions.php";


page::parametres("Page d'inscription - Tutucar");
page::entete();
page::nav();
?>

<body class="align-items-center py-4">
<div class="container justify-content-center mt-5">
            <form class="p-4 p-md-5 border rounded-3 shadow-sm mt-5" method="post">
                <div class="text-center mb-4">
                    <h1 class="h3 mb-3 fw-normal">Inscription</h1>
                </div>

                <div class="d-flex gap-2">
                <div class="form-floating flex-fill mb-3">
                    <input type="text" class="form-control" id="user" name="user" placeholder="Nom d'utilisateur" required autofocus>
                    <label for="user">Nom d'utilisateur</label>
                </div>

                <div class="form-floating flex-fill mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" required>
                    <label for="password">Mot de passe</label>
                </div>
                </div>
                <div class="d-flex align-content-center gap-2">
                    <div class="form-floating flex-fill mb-3">
                        <input type="text" class="form-control" id="email" name="email" placeholder="" required autofocus>
                        <label for="email">Adresse email</label>
                    </div>

                    <div class="form-floating flex-fill mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="vehicule" required>
                            <option selected aria-invalid="true" hidden="">Choisissez la marque de votre véhicule</option>
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

                    <?php
                    inscription();
                    ?>


                <button class="w-100 btn btn-lg btn-primary" name="button" type="submit">S'inscrire</button>

                <hr class="my-4">

                <small class="text-body-secondary d-block text-center mt-3">
                    Déjà inscrits ? <a href="connexion.php" class="text-decoration-none">Connectez-vous</a>
                </small>
            </form>
    </div>
</div>

</body>
<?php page::pieddepage();

