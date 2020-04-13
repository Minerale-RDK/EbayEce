<?php

$login = isset($_POST["identifiant"]) ? $_POST["identifiant"] : "";
$pass = isset($_POST["passw"]) ? $_POST["passw"] : "";

$database = "ebayece";

$db_handle = mysqli_connect('localhost:3308', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

if ($db_found)
{
    $sql = "SELECT pwd FROM acheteurs WHERE login='".$login."'";
    $req = mysqli_query($db_handle, $sql);

    $data = mysqli_fetch_assoc($req);

    if($data['pwd'] != $pass) {
        echo '<p>Mauvais identifiant ou mot de passe.</p>';
        include('Login.html');
        exit;
    }
    else {
        session_start();
        $_SESSION['login'] = $login;
        echo 'Vous êtes bien identifié.';
    }
}
else {
    echo '<p> Vous avez oublié un champ.</p>';
    include('login.html');
    exit;
}

?>