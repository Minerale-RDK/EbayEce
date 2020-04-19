<?php

if(!isset($_SESSION)) { 
        
    session_start(); 

}
if(!isset($_SESSION['panier'])){
    $_SESSION['panier'] = array();
}


require('../bases/bdd.php');

$valeurs = array('IDItem','nomitem', 'description', 'chemindossier', 'typevente',
'prix', 'categorie', 'datefin', 'IDVendeur', 'avendre');
if ($db_found)  
{
    if($_SESSION['statut'] == 'vendeur'){
        echo '<div class="alert alert-danger" role="alert"> Vous ne pouvez pas acheter car vous êtes en compte vendeur.</div>';
        include('produit.php');
        exit();
    }
    $id = $_GET['id'];
    if(isset($_GET['id'])){
        for($i=0; $i<sizeof($_SESSION['panier']); $i++){
            if ($id == $_SESSION['panier'][$i]['IDItem']){
                echo '<div class="alert alert-danger" role="alert"> Ce produit est déjà dans votre panier </div>';
                include('produit.php');
                exit();
            }
        }
        $sql = "SELECT * FROM items WHERE IDItem = '$id'";
        $req = mysqli_query($db_handle, $sql);
        $data = mysqli_fetch_assoc($req);
        $result = mysqli_query($db_handle, $sql);
        if (mysqli_num_rows($result) == 0) {}
        $taille = sizeof($_SESSION['panier']);
        $donnees_item = array();
        $tampon = [];
        foreach($valeurs as &$valeur){
            
           $tampon += [$valeur => $data[$valeur]];

        }
        $_SESSION['panier'][$taille] = $tampon;

        echo '<div class="alert alert-success" role="alert"> Ce produit est déjà dans votre panier </div>';
        include('produit.php');
        exit();
    }else {
        die("Vous n'avez pas sélectionné de produits");
    }
} 
?>