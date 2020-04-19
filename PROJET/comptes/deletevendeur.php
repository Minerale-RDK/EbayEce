<?php

if(!isset($_SESSION)) { 

    session_start(); 

} 

require('../bases/bdd.php');

$id = $_GET['id'];
if(empty($id)){

    $nom = strtoupper(isset($_POST["nom"])? $_POST["nom"] : "");
    $email = isset($_POST["email"])? $_POST["email"] : "";
    $login = isset($_POST["identifiant"])? $_POST["identifiant"] : "";

    $sql = "SELECT * FROM vendeurs WHERE Nom LIKE '%$nom%' AND email LIKE '%$email%' AND login LIKE '%$login%'";
    $result = mysqli_query($db_handle, $sql);
    if (mysqli_num_rows($result) == 0) {
        echo '<div class="alert alert-danger" role="alert"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
        &ensp;Le vendeur n\'a pas été trouvé</div>';
        include('moncompte_admin.php');
        exit;
    }else{
        $data = mysqli_fetch_assoc($result);
        $login_vendeur = $data['login'];
        $id = $data['IDVendeur'];
    }
}else {
    $sql = "SELECT * FROM vendeurs WHERE IDVendeur = $id";
    $result = mysqli_query($db_handle, $sql);
    $data = mysqli_fetch_assoc($result);

    $login_vendeur = $data['login'];
}

$sql = "DELETE FROM items WHERE IDVendeur = $id";
$result = mysqli_query($db_handle, $sql);

$sql = "DELETE FROM vendeurs WHERE IDVendeur = $id";
$result = mysqli_query($db_handle, $sql);

echo '<script language="Javascript"> document.location.replace("moncompte_admin.php?vendeur='.$login_vendeur.'"); </script>';
exit;

?>