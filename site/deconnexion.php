<?php
// set the expiration date to one hour ago
setcookie("hash", " ", time() - 3600, "/");
setcookie("user", " ", time() - 3600, "/");
session_start();
session_unset();
session_destroy();
header("Location: accueil.php", true, 303); /* Redirection du navigateur */
exit();