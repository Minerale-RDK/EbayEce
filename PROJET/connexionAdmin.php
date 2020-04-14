<?php

$login = isset($_POST["identifiant"]) ? $_POST["identifiant"] : "";
$pass = isset($_POST["passw"]) ? $_POST["passw"] : "";

$database = "ebayece";

$db_handle = mysqli_connect('localhost:3308', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

if ($db_found)
{
    if ($login == "") { 
        echo "Identifiant est vide. <br>";
        include('admin.php');
        exit; }

    if ($pass == "") {
        echo"Mot de passe est vide. <br>";
        include('admin.php');
        exit; }

    $sql = "SELECT pwd FROM administrateurs WHERE login='".$login."'";
    $req = mysqli_query($db_handle, $sql);

    $data = mysqli_fetch_assoc($req);

    if($data['pwd'] != $pass) {
        echo '<p>Mauvais identifiant ou mot de passe.</p>';
        include('admin.php');
        exit;
    }
    else {
        session_start();
        $_SESSION['login'] = $login;
        $_SESSION['statut'] = "administrateur";
        header('location: adminPage.php');
        echo 'Vous êtes bien identifié.';
    }
}
else {
    echo '<p> Vous avez oublié un champ.</p>';
    include('admin.php');
    exit;
}

?>