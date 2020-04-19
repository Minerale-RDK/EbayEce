<?php

$login = isset($_POST["identifiant"]) ? $_POST["identifiant"] : "";
$pass = isset($_POST["mdp"]) ? $_POST["mdp"] : "";

$database = "ebayece";

require('../bases/bdd.php');

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
            $sql = "SELECT pwd FROM admin WHERE login='".$login."'";
            $req = mysqli_query($db_handle, $sql);
            $data = mysqli_fetch_assoc($req);
            if($data['pwd'] != $pass) {
            echo '<script language="Javascript"> document.location.replace("login.php?erreur=1"); </script>';
            exit;
            }else{
                session_start();
                $statut = "administrateur";
                $_SESSION['login'] = $login;
                $_SESSION['statut'] = $statut;
                echo '<script language="Javascript"> document.location.replace("../comptes/moncompte_admin.php"); </script>';
                exit;
            }
        }
        else {
            session_start();
            $statut = "acheteur";
            $_SESSION['login'] = $login;
            $_SESSION['statut'] = $statut;
            $sql = "SELECT * FROM acheteurs WHERE login='".$login."'";
            $req = mysqli_query($db_handle, $sql);
            $data = mysqli_fetch_assoc($req);
            $_SESSION['id'] = $data['IDAcheteur'];
            echo '<script language="Javascript"> document.location.replace("../bases/index.php"); </script>';
            exit;
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
        $_SESSION['avatar'] = $data['file_url'];
        $_SESSION['fond'] = $data['cover_url'];
        $_SESSION['id'] = $data['IDVendeur'];
        echo '<script language="Javascript"> document.location.replace("moncompte_vendeur.php"); </script>';
        exit;
    }
}
else {
    echo '<p> Vous avez oublié un champ.</p>';
    include('login.php');
    exit;
}

?>