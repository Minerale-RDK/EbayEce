<?php

$login = isset($_POST["identifiant"]) ? $_POST["identifiant"] : "";
$pass = isset($_POST["passw"]) ? $_POST["passw"] : "";

$database = "ebayece";

$db_handle = mysqli_connect('127.0.0.1', 'root', 'root');
$db_found = mysqli_select_db($db_handle, $database);

if ($db_found)
{
    if ($login == "") { 
        echo "Identifiant est vide. <br>";
        include('login.html');
        exit; }

    if ($pass == "") {
        echo"Mot de passe est vide. <br>";
        include('login.html');
        exit; }

    $sql = "SELECT pwd FROM vendeurs WHERE login='".$login."'";
    $req = mysqli_query($db_handle, $sql);

    $data = mysqli_fetch_assoc($req);

    if($data['pwd'] != $pass) {
        echo '<p>Mauvais identifiant ou mot de passe.</p>';
        include('login_vendeur.html');
        exit;
    }
    else {
        session_start();
        $statut = "vendeur";
        $_SESSION['login'] = $login;
        $_SESSION['statut'] = $statut;
        $sql = "SELECT * FROM vendeurs WHERE login='".$login."'";
        $req = mysqli_query($db_handle, $sql);
        $data = mysqli_fetch_assoc($req);
        $_SESSION['fond'] = $data['cover_url'];

        header('location: moncompte.php');
        echo 'Vous êtes bien identifié.';
    }
}
else {
    echo '<p> Vous avez oublié un champ.</p>';
    include('login_vendeur.html');
    exit;
}

?>