<?php

if(!isset($_SESSION)) { 
        
    session_start(); 

}

$id = $_GET['id'];

unset($_SESSION['panier'][$id]);
$_SESSION['panier'] = array_merge($_SESSION['panier']);

echo '<div class="alert alert-success" role="alert"> Le produit a bien été supprimé de votre panier.</div>';
include('panier.php');
exit();

?>