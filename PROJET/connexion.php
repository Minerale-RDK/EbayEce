<?php

$login = isset($_POST["identifiant"]) ? $_POST["identifiant"] : "";
$pass = isset($_POST["mdp"]) ? $_POST["mdp"] : "";

$database = "ebayece";

$db_handle = mysqli_connect('localhost:3308', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

if ($db_found)
{
    if ($login == "") { 
        echo "Identifiant est vide. <br>";
        include('login.php');
        exit; }

    if ($pass == "") {
        echo"Mot de passe est vide. <br>";
        include('login.php');
        exit; }

    
    $sql = "SELECT pwd FROM vendeurs WHERE login='".$login."'";
    $req = mysqli_query($db_handle, $sql);
    $data = mysqli_fetch_assoc($req);

    if($data['pwd'] != $pass) {
        $sql = "SELECT pwd FROM acheteurs WHERE login='".$login."'";
        $req = mysqli_query($db_handle, $sql);
        $data = mysqli_fetch_assoc($req);
        if($data['pwd'] != $pass) {
            echo '<p>Mauvais identifiant ou mot de passe.</p>';
            include('login.php');
            exit;
        }
        else {
            $statut = "acheteur";
            $_SESSION['login'] = $login;
            $_SESSION['statut'] = $statut;
            $sql = "SELECT * FROM acheteurs WHERE login='".$login."'";
            $req = mysqli_query($db_handle, $sql);
            $data = mysqli_fetch_assoc($req);
            $_SESSION['id'] = $data['IDAcheteur'];
            //header('location: moncompte.php');
            echo 'Vous êtes bien identifié.';
        }
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
        $_SESSION['id'] = $data['IDVendeur'];
        header('location: moncompte.php');
        echo 'Vous êtes bien identifié.';
    }
}
else {
    echo '<p> Vous avez oublié un champ.</p>';
    include('login.php');
    exit;
}

?>