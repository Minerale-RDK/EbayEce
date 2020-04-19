<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 

    }
    include('../bases/header.php');
?>
<head>
 <script type="text/javascript">
    //http://blog.rolandl.fr/1465-bootstrap-une-fenetre-modale-a-la-suppression-des-lignes-de-vos-tableaux
        $(document).ready(function () {
        var theHREF;

        $(".confirmModalLink").click(function(e) {
            e.preventDefault();
            theHREF = $(this).attr("href");
            $("#confirmModal").modal("show");
        });

        $("#confirmModalYes").click(function(e) {
            window.location.href = theHREF;
        });
    });
    </script>
</head> 
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
            
            
            

    <?php

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

            for($i=0; $i<sizeof($_SESSION['panier']); $i++){
            echo ' <div class="row"> <div class="col-lg-10 col-xl-9 mx-auto" >
          
            <div class="card card-signin flex-row my-5" >
                
            <div class="card-body" >
                    <a href="produit.html">
                    <img src="'.$_SESSION['panier'][$i]['chemindossier'].'/photo0.jpg" alt="Nature" id ="itemImage" style="height : 200px; max-width: 400px;">
                    </a>
                    <label for="itemImage" style="width: 600px; margin-left : 10%; font-size: 35px; ">&ensp;'.$_SESSION['panier'][$i]['nomitem'].'</label>
                    <label for="itemImage" style=" margin-left : 10%; font-size: 30px; ">Prix : '.$_SESSION['panier'][$i]['prix'].' €</label>
                    <a href="deletepanier.php?id='.$i.'" 
                    class="confirmModalLink" data-toggle="modal" data-target="#exampleModal" style="float : right;">Supprimer&ensp;
                    <i class="fa fa-trash" aria-hidden="true" ></i></a>
            </div>
    
            
            
            
        
            </div>
            </div>
        </div>';
            }
        }

    ?>
 
   <!-- Modal confirmation de supression -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Supression de l'article</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Êtes-vous sûr de vouloir supprimer l'article de votre panier ?
      </div>
      <div class="modal-footer">
        <a class="btn btn-secondary" data-dismiss="modal" >Annuler</a>
        <a href="#" class="btn btn-primary" id="confirmModalYes" >Supprimer</a>
      </div>
    </div>
  </div>
</div>
    
    <br><br>

    <?php

    include('../bases/footer.php');

    ?>

</body>
</html>