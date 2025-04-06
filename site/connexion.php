<?php
include "scripts/functions.php";


page::parametres("Page de connexion - Tutucar");
page::entete();
page::nav();
?>
<section>
<body class="align-items-center py-4">
<div class="container justify-content-center mt-5">
            <form class="p-4 p-md-5 border rounded-3 shadow-sm mt-5" method="post">
                <div class="text-center mb-4">
                    <h1 class="h3 mb-3 fw-normal">Connexion</h1>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="utilisateur" name="utilisateur" placeholder="Nom d'utilisateur" required autofocus>
                    <label for="utilisateur">Nom d'utilisateur</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="motdepasse" name="motdepasse" placeholder="Mot de passe" required>
                    <label for="motdepasse">Mot de passe</label>
                </div>

                    <?php
                    connexion();
                    ?>

                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me" name="souvenir"> Se souvenir de moi
                    </label>
                </div>

                <button class="w-100 btn btn-lg btn-primary" name="button" type="submit">Se connecter</button>

                <hr class="my-4">

                <small class="text-body-secondary d-block text-center mt-2">
                    Pas de compte ? <a href="inscription.php" class="text-decoration-none">Inscrivez-vous</a>
                </small>
            </form>
    </div>
</div>

</body>
</section>
<?php page::pieddepage();

