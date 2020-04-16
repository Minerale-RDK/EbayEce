<?php

if(!isset($_SESSION)) { 
        
    session_start(); 

}
if(!isset($_SESSION['panier'])){
    $_SESSION['panier'] = array();
}


$database = "ebayece";
$db_handle = mysqli_connect('127.0.0.1', 'root', 'root');
$db_found = mysqli_select_db($db_handle, $database);
$valeurs = array('IDItem','nomitem', 'description', 'chemindossier', 'typevente',
'prix', 'categorie', 'datefin', 'IDVendeur', 'avendre');
if ($db_found)  
{
    $id = $_GET['id'];
    if(isset($_GET['id'])){
        $sql = "SELECT * FROM items WHERE IDItem = '$id'";
        $req = mysqli_query($db_handle, $sql);
        $data = mysqli_fetch_assoc($req);
        $result = mysqli_query($db_handle, $sql);
        if (mysqli_num_rows($result) == 0) {}
        $taille = sizeof($_SESSION['panier']) + 1;
        $donnees_item = array();
        $tampon = [];
        foreach($valeurs as &$valeur){
            
           $tampon += [$valeur => $data[$valeur]];

        }
        $_SESSION['panier'][$taille] = $tampon;
        print_r($_SESSION['panier'][$taille]['IDItem']);

        die("Le produit a bien été ajouté à votre panier");
    }else {
        die("Vous n'avez pas sélectionné de produits");
    }
} 
?>