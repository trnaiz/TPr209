<?php
include $_SERVER['DOCUMENT_ROOT']."/tpr209/site/scripts/functions.php";
page::parametres("Admin_utilisateurs");

echo '<pre>';
var_dump(users::get());
echo '</pre>';
