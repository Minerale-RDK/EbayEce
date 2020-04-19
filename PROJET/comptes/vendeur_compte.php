<?php

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    include('../bases/header.php');
    require('boutique.php');
?>
<head>
    <link rel="stylesheet" type="text/css" href="../css/compte.css">
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
            $id = $_GET['id'];
            if($id == $_SESSION['id'] && $_SESSION['statut']=="vendeur"){
              echo '<script language="Javascript"> document.location.replace("moncompte_vendeur.php"); </script>';
              exit;
            }
            include ("../bases/bdd.php");
            include ("../bases/menu_comptevendeur.php");
            $sql = "SELECT * FROM vendeurs WHERE IDVendeur = '$id'";
            $result = mysqli_query($db_handle, $sql);
            $data = mysqli_fetch_assoc($result);
            $sql2 = "SELECT * FROM items WHERE IDVendeur = $id AND avendre = 0";
            $result2 = mysqli_query($db_handle, $sql2);
            echo '<div style="background-image: url('.$data['cover_url'].') ; background-position: center;
            background-repeat: no-repeat;
            background-size: cover;">
                  <a href="../bases/index.php"><img src="../images/logo.png" class="logo-accueil"></a>
                 
                  
                      <img style="position: absolute;
              top: 15%;
              left: 5%;
              width: 200px;
            height: 200px;
            border-radius: 70%;" src="'.$data['file_url'].'" class="over-img"/>
                  
              </div>';
            
        ?>
    
        <br><h1 style="text-align: center">Bienvenue sur le compte vendeur de <?=$data['login']?></h1><br>
        <?php

            if($_SESSION['statut'] == 'administrateur'){
                echo '<div class="col;" style="text-align: center">
                <a href="deletevendeur.php?id='.$id.'" class="confirmModalLink btn btn-outline-danger" 
                data-toggle="modal" data-target="#exampleModal">Supprimer des ventes&ensp;
                <i class="fa fa-trash" aria-hidden="true" ></i></a>
                </div>';
            }
            
        ?>
        <br>
        <h4 style="text-align: center">Nombre de ventes réalisées : <?= mysqli_num_rows($result2)?></h4><br>
        <br>
    <div class="objets">
        <?php

            $sql = "SELECT * FROM items WHERE IDVendeur = $id AND avendre = 1";
            $result = mysqli_query($db_handle, $sql);
            $titre_boutique = 'La Boutique de '.$data['login'].'';
            $titre_historique = 'Les ventes de '.$data['login'].'';
            $msg_erreurh = "Aucun objet vendu";
            $msg_erreurb = "Aucun objet en vente";

            $vendu = 1;

            maboutique($titre_boutique, $msg_erreurb, $result);
            echo '<br><br>';
            maboutique($titre_historique, $msg_erreurh, $result2, $vendu);
        

        
        ?>
    </div>  
<?php
    include('../bases/footer.php');
?>
<!-- Modal confirmation de supression -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Supression du Vendeur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Êtes-vous sûr de vouloir supprimer ce vendeur ?
      </div>
      <div class="modal-footer">
        <a class="btn btn-secondary" data-dismiss="modal" >Annuler</a>
        <a href="#" class="btn btn-primary" id="confirmModalYes" >Supprimer</a>
      </div>
    </div>
    </div>
</div>
</body>
</html>

