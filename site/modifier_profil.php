<?php
session_start();
include "scripts/functions.php";
page::parametres("Modification Profil - Tutucar");
page::entete();
page::nav();
modif_profile();
?>
<div class="container py-5">
  <div class="card mx-auto shadow col-md-6 col-lg-4">
    <div class="card-body">
      <h4 class="card-title text-center mb-4">Modifier le profil</h4>
      <form method="post">
        <div class="mb-3">
          <label for="utilisateur" class="form-label">Nom d'utilisateur</label>
          <input type="text" class="form-control" id="utilisateur" name="user" value="<?php echo $_SESSION["user"]?>" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" value="<?php echo $_SESSION["email"]?>" required>
        </div>
        <div class="mb-3">
            <label for="floatingSelect">Marque de véhicule</label>
            <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="vehicule" required>
                <option selected aria-invalid="true" hidden=""><?php echo ucfirst($_SESSION["vehicule"])?></option>
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
        </div>
        <div class="text-center">
          <button type="submit" class="btn btn-success">Enregistrer</button>
          <a href="profil.php" class="btn btn-secondary">Annuler</a>
        </div>
      </form>
    </div>
  </div>
</div>
<?php
page::pieddepage();