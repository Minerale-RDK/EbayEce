<?php

if(!isset($_SESSION)){
    session_start();
}

$montant = isset($_POST["montant"]) ? $_POST["montant"] : "";

$idItem = $_GET['id'];
$idAcheteur = $_SESSION['id'];

if($montant == "" || !is_numeric($montant))
{
    echo 'Merci de rentrer un montant valide';
    include('offre.php?id='.$id.'');
}

require('../bases/bdd.php');

if($dbfound){

    $sql = "SELECT * FROM meilleuroffre WHERE IDAcheteur ='".$idAcheteur."' AND IDItem = '".$idItem."' ";
    $req = mysqli_query($db_handle, $sql);
    $data = mysqli_fetch_assoc($req);

}

?>