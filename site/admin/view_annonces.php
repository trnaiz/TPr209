<?php
include $_SERVER['DOCUMENT_ROOT']."/tpr209/site/scripts/functions.php";
page::parametres("Admin_annonces");

echo '<pre>';
var_dump(annonces::get());
echo '</pre>';

