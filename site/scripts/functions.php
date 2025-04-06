<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 1);
define('ROOT_PATH', dirname(__DIR__)); // remonte au dossier parent = /site

# COOKIES
function cookies(){
    if (isset($_COOKIE["user"]) && isset($_COOKIE["hash"])){
        $secretKey = 'FDK578doèeudpqoçàç"1567&é';
        if (hash_equals(hash_hmac('sha256', $_COOKIE["user"], $secretKey), $_COOKIE["hash"])) {
            foreach (users::get() as $user => $inf) {
                if ($_COOKIE["user"] === $inf["utilisateur"]){
                    session_start();
                    $_SESSION["user"] = $inf["utilisateur"];
                    $_SESSION["role"] = $inf["apropos"];
                    $_SESSION["email"] = $inf["email"];
                    $_SESSION["voiture"] = $inf["vehicule"];
                    $_SESSION["id"] = $user;
                    break;
                }
            }
        }
    }
}

# CONNEXION
function connexion(){
    if (isset($_POST['button'])) {
        foreach (users::get() as $id => $inf) {
            if ($_POST["utilisateur"] == $inf["utilisateur"]) {
                if (password_verify($_POST["motdepasse"], $inf["motdepasse"])) {
                    session_start();
                    if (isset($_POST["souvenir"])) {
                        $secretKey = 'FDK578doèeudpqoçàç"1567&é';
                        setcookie("user", $inf["utilisateur"], time() + 84600, ROOT_PATH);
                        setcookie("hash", hash_hmac('sha256', $inf["utilisateur"], $secretKey), time() + 84600, "/");
                    }
                    $_SESSION["user"] = $inf["utilisateur"];
                    $_SESSION["role"] = $inf["role"];
                    $_SESSION["email"] = $inf["email"];
                    $_SESSION["vehicule"] = $inf["vehicule"];
                    $_SESSION["id"] = $id;

                    $_SESSION["icon"] = users::icon();;


                    header("Location: accueil.php", true, 303); /* Redirection du navigateur */
                    exit();
                } else echo '<div class="alert alert-danger" role="alert"> Mauvais mot de passe ! </div>';
                return;
            }
            if ($id == users::count() - 1) echo '<div class="alert alert-danger" role="alert"> Utilisateur introuvable </div>';
            else continue;
    }
}
}

function modif_profile(){
    foreach (users::get() as $item => $value){
        if ($item == $_SESSION["id"]){
            if (isset($_POST['user'], $_POST['email'], $_POST['vehicule'])) {
                $_SESSION['user'] = $_POST['user'];
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['vehicule'] = $_POST['vehicule'];


                $_SESSION["icon"] = strtolower(users::icon());

                $id = $_SESSION['id'];
                users::$data[$id]['utilisateur'] = $_POST['user'];
                users::$data[$id]['email'] = $_POST['email'];
                users::$data[$id]['vehicule'] = $_POST['vehicule'];
                users::put();
            }
        }
    }
}

# INSCRIPTION
function inscription(): void{
    ob_start();
    if (isset($_POST["button"])) {
        if ($_POST["vehicule"] === "Choisissez la marque de votre véhicule"){
            echo '<div class="alert alert-danger" role="alert"> Veuillez sélectionner une marque de véhicule valide ! </div>';
            return;
        }

        $userexist = false;
        $user = htmlspecialchars(trim($_POST["user"]), ENT_QUOTES, 'UTF-8');
        $users = array_column(users::get(), "utilisateur");
        if (in_array($user, $users)){
            echo '<div class="alert alert-danger" role="alert"> L\'utilisateur existe ! </div>';
            $userexist = true;
        }
            if (!$userexist){
                $map = [
                    "user" => "utilisateur",
                    "password" => "motdepasse",
                    "vehicule" => "vehicule",
                    "email" => "email"
                ];

                $data = [];

                foreach ($map as $source => $target){
                    $val = $_POST[$source] ?? null;
                    $val = trim($val);
                    $val = htmlspecialchars($val, ENT_QUOTES, 'UTF-8');
                    $data[$target] = $val;
                }

                // Validation email
                if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                    echo ('<div class="alert alert-danger" role="alert"> Veuillez saisir une adresse E-mail valide ! </div>');
                    return;
                }
                $data['motdepasse'] = password_hash($data['motdepasse'], PASSWORD_DEFAULT);
                $data['role'] = 'user';
                echo '<div class="alert alert-success" role="alert">Compte créé ! Vous allez être redirigé dans 5 secondes ...</div>';
                users::addUser($data);
                echo '<script>
                    setTimeout(function() {
                    window.location.href = "accueil.php";
                    }, 5000);
                </script>';
            }

    }
}

class annonces{
    static $file = ROOT_PATH."/data/r209-tp_annonces.json";
    static $data = null;

    static function get()
    {
        if (self::$data === null) {
            if (!file_exists(self::$file)) {
                self::$data = [];
            } else {
                self::$data = json_decode(file_get_contents(self::$file), true);
            }
        }
        return self::$data;
    }

    static function remove($id)
    {
        self::get(); // charge les données si pas déjà chargées

        if (isset(self::$data[$id])) {
            unset(self::$data[$id]);
            self::$data = array_values(self::$data); // réindexation (si index numériques)
            self::put();
        }
    }

    static function put()
    {
        file_put_contents(self::$file, json_encode(self::$data));
    }

    static function count()
    {
        self::get();
        return count(self::$data);
    }

    static function add()
    {
        self::get();
        //if (!in_array($user,array_keys(self::$data))) self::$data[$user]=;$data

        $user = $_POST["user"] ?? "null";
        $new_data = [];
        if (isset($_POST["button"])) {
            if ($user !== "null") {
                $new_data = [
                    "Pseudo"      => $user,
                    "Date"        => $_POST["date"]."T".$_POST["heure"] ?? "",
                    "Depart"      => $_POST["start"] ?? "",
                    "Arrivee"     => $_POST["stop"] ?? "",
                    "Places"      => $_POST["places"] ?? "",
                    "Commentaire" => $_POST["commentaire"] ?? "",
                    "Inscrits" => [],
                ];

                self::$data[] = $new_data;
                self::put();

            } else {
                echo '<div class="alert alert-danger" role="alert"> Vous devez être connecté ! </div>';
            }
        };

    }

    static function nbr_inscrit($id_annonce){
        self::get();
            $num = self::$data[$id_annonce]["Inscrits"];
            $nbr = count($num) ?? 0;
        return $nbr;
    }

    static function reservation($nom_user){
        $reservation = $_POST["reservation"] ?? false;
        $del_reservation = $_POST["dell_reservation"] ?? false;
        $id = $_POST["id"] ?? null;
        if ($reservation){
            self::get();
            if (!in_array($nom_user, self::$data[$id]["Inscrits"])) {
                self::$data[$id]["Inscrits"][] = $nom_user;
            }
            self::put();
        }
        elseif ($del_reservation){
            self::get();
            if (in_array($nom_user, self::$data[$id]["Inscrits"])) {
                self::$data[$id]["Inscrits"] = array_values(array_filter(self::$data[$id]["Inscrits"], fn($user)=> $user !== $nom_user));
            }
            self::put();
        }
    }

    static function user_event(){
        $user = $_SESSION["user"] ?? null;
        self::get();

        foreach (self::$data as $id => $annonce) {
            if (in_array($user, $annonce["Inscrits"])) {
                $events[] = [
                    "title" => "Trajet {$annonce['Depart']} → {$annonce['Arrivee']}",
                    "start" => substr($annonce['Date'], 0, 10)
                ];
            }
        }
        return json_encode($events);
    }
}
class users{
    static $file = ROOT_PATH.'/data/r209-tp_utilisateurs.json';
    static $data = null;

    static function get()
    {
        if (self::$data === null) {
            if (!file_exists(self::$file)) {
                self::$data = [];
            } else {
                self::$data = json_decode(file_get_contents(self::$file), true);
            }
        }
        return self::$data;
    }

    static function count()
    {
        self::get();
        return count(self::$data);
    }

    static function put()
    {
        file_put_contents(self::$file, json_encode(self::$data));
    }

    static function addUser($data = null)
    {
        self::get();
        //if (!in_array($user,array_keys(self::$data))) self::$data[$user]=;$data
        self::$data[] = $data;
        self::put();

    }

    static function removeUser($user)
    {
        self::get();
        if (self::unser_exists($user)) {
            unset(self::$data[$user]);
        }
        self::put();
    }

    static function unser_exists($user): bool
    {
        return (self::$data[$user] ?? null) !== null;
//        return array_key_exists($user,self::$data);
//        return !in_array($user,array_keys(self::$data)) ;

    }

    static function icon(){

        if (isset($_SESSION["user"])) {
            if ($_SESSION["role"] === "admin") {
                $icon = "admin";
            } elseif ($_SESSION["role"] === "modo") {
                $icon = "modo";
            } elseif ($_SESSION["role"] === "user") {
                $icon = $_SESSION["vehicule"];
            } else {
                $icon = "anonymous";
            }
        }
        return $icon;
    }

}
class page{
    static $param = ROOT_PATH."/info_page/parametres.tpl";
    static $header = ROOT_PATH."/info_page/header.tpl";

    static $nav = ROOT_PATH."/info_page/nav.tpl";
    static $nav_admin = ROOT_PATH."/info_page/nav_admin.tpl";
    static $connected = ROOT_PATH."/info_page/headerconnected.tpl";
    static $noconnected = ROOT_PATH."/info_page/headernotconnected.tpl";
    static $footer = ROOT_PATH."/info_page/footer.tpl";

    static function parametres($title){
        $html = file_get_contents(self::$param);
        $replacements = ['%%title%%'=>$title];
        echo strtr($html,$replacements);
    }

    static function entete(){
        $html = file_get_contents(self::$header);

        $partieconnect = isset($_SESSION["user"]) ? file_get_contents(self::$connected) : file_get_contents(self::$noconnected);
        $icon = (isset($_SESSION["icon"]) ? $_SESSION["icon"] : "anonymous");

        # Ajout du logo et la partie à connecter
        $replacements = [
            '%%cookies%%' => cookies(),
            '%%icon%%' => "/tpr209/site/img/avatar/".$icon.".png",
            '%%logo%%' => "/tpr209/site/img/favicon.png",
            '%%connected%%' => $partieconnect,
        ];
        $html = strtr($html, $replacements);
        echo strtr($html, $replacements);
    }

    static function nav(){
        $role = ($_SESSION["role"] ?? null);
        $html = ($role === "admin" | $role === "modo") ? file_get_contents(self::$nav_admin) : file_get_contents(self::$nav) ;

        $pages = ["accueil", "utilisateurs", "annonces"];

        foreach ($pages as $page){
            $marker = "%%active".$page."%%";
            $class = (page::active() === $page) ? 'active border-bottom border-primary' : '';
            $html = strtr($html, [$marker => $class]);
        }

        $replacement = [
            '%%count_annonces%%' => annonces::count(),
            '%%count_utilisateurs%%' => users::count()
        ];
        echo strtr($html, $replacement);
    }
    static function active(){
        $currentPage = basename($_SERVER['PHP_SELF']);
        $currentPage = pathinfo($currentPage, PATHINFO_FILENAME);
        return $currentPage;
    }

    static function pieddepage(){
        date_default_timezone_set('Europe/Paris');
        $html = file_get_contents(self::$footer);

        $replacement = [
            "%%date%%" => date("d M"),
            "%%heure%%" => date("G"),
            "%%annee%%" => date("Y"),
            "%%ip%%" => $_SERVER['REMOTE_ADDR'],
            "%%port%%" => $_SERVER['REMOTE_PORT']
        ];

        echo strtr($html, $replacement);
    }

}
