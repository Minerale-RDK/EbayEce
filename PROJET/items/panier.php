<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 

    }
    include('../bases/header.php');
?>

<body>

    <?php 
        include ("../bases/menu.php");
        $ids = array();
        $prix_panier = 0;
        if(!empty($_SESSION['panier'])){

          for($i=0; $i<sizeof($_SESSION['panier']); $i++){
            array_push($ids, $_SESSION['panier'][$i]['IDItem']);
            $prix_panier += $_SESSION['panier'][$i]['prix'];
        }

        }
        
    ?>
    
    <br><br>
    <br><br>
    <h1 style="text-align: center">Mon Panier</h1><br>
    <h4 style="text-align: center">Total du panier : <?php echo sizeof($ids); if(sizeof($ids)<2){echo ' produit</h4>';}else{echo ' produits</h4>}';}?>
    <h4 style="text-align: center">Valeur de la commande : <?= $prix_panier ?> €</h4> 
            <br><br>
            
            
            

        require('../bases/bdd.php');

        if(empty($_SESSION['panier'])){
            echo '<div class="col;" style="text-align: center">
            <a href="categorie.html"  class="btn btn-outline-info" role="button" style="text-align: center">Retourner aux achats</a>
    
               </div>
    
            
        <br>
        <br>
        <br><h4 style="text-align: center">Vous n\'avez aucun produit dans votre panier </h4>';
        }else {
            $_SESSION['paiement'] = array();
            $_SESSION['paiement']['IDItem'] = [];
            $_SESSION['paiement']['IDItem'] = $ids;
            $_SESSION['paiement']['prix'] = $prix_panier;
            echo '<div class="col;" style="text-align: center">
            <a href="../paiement/carte_credit.php"  class="btn btn-outline-info" role="button" style="text-align: center">Terminer la commande</a>
            &ensp;
            <a href="index.php"  class="btn btn-outline-info" role="button" style="text-align: center">Retourner aux achats</a>
    
               </div>
    
            <br><br><br>';

    if ($db_found)  
    {
        $ids = array_keys($_SESSION['panier']);
        echo $ids;
        $sql = "SELECT * FROM items WHERE IDItem = '$ids'";
        $req = mysqli_query($db_handle, $sql);

        $data = mysqli_fetch_assoc($req);
    }
        
        
        
        
    ?>
    
    <br><br>

    <?php

    include('../bases/footer.php');

    ?>

</body>
</html>