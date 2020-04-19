<?php
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

if(isset($_GET['valid']) && $_GET['valid']==1){
  echo '<div class="alert alert-success" role="alert"><i class="fa fa-check" aria-hidden="true"></i>
&ensp;Votre produit est maintenant en vente !</div>';
}



            $dateajd = time();

           
            include ("../bases/menu.php");
            $id = $_GET['id'];

            
            if(!isset($_SESSION['statut']))
            {
              $_SESSION['statut'] = "";
            }

            include ("../bases/bdd.php");
            


        if ($db_found)  
        {
          

            $sql = "SELECT * FROM items WHERE IDItem = '$id'";
            $req = mysqli_query($db_handle, $sql);

             $data = mysqli_fetch_assoc($req);
              
            $dossier = $data['chemindossier'];
            $files = glob("$dossier/*photo*"); 
            $compteur = count($files);

            $files2 = glob("$dossier/*video*"); 
            $compteur2 = count($files2);

          $datefinenchere = $data['datefin'];
          $datefinenchere2 = date("Y-m-d H:i:s", $datefinenchere);
          $dateajd2 = date("Y-m-d H:i:s", $dateajd);
          $datefinenchere3 = new DateTime($datefinenchere2);
          $dateajd3 = new DateTime($dateajd2);

          $interval = $datefinenchere3->diff($dateajd3);
            
            
            echo '<br><br><div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-5" style="align-content: center;">';
            

              echo '
              <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">';
              for($i=0; $i<$compteur; $i++)
              {
                if($i==0){
                  echo'
                  <li data-target="#carouselExampleIndicators" data-slide-to="'.$i.'" class="active"></li>';
                }
                else{
                  echo'
                 <li data-target="#carouselExampleIndicators" data-slide-to="'.$i.'"></li>';
                }
                
              }
            echo '</ol>';
            echo'
              <div class="carousel-inner">';
            for($i2=0; $i2<$compteur;$i2++)
            {
              $extfile = $files[$i2];
              if($i2 == 0){
                echo'<div class="carousel-item active">
              <img class="d-block w-100 rounded" src="'.$extfile.'" alt="First slide" style=" height:350px;">
            </div>';

              }
              elseif($i2 == 1){
                echo'<div class="carousel-item ">
              <img class="d-block w-100 rounded" src="'.$extfile.'" alt="Second slide" style=" height:350px;">
            </div>';
              }
              else{
                echo'<div class="carousel-item ">
                <img class="d-block w-100 rounded" src="'.$extfile.'" alt="Third slide" style=" height:350px;">
              </div>';

              }
              
            }
                
              echo'
              </div>
              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
         </div>';


           echo '</div>
                  
            <div class="col-sm-4">
                <h2> '.$data['nomitem'].' </h2>
                <p style="text-align: justify"><br>
              <u>Description :</u> '.$data['description'].'
              <br></p>';
              if ($compteur2 != 0)
              {
                $extfile2 = $files2[0];
                echo '<a href="'.$extfile2.'">Lien vers la vidéo disponible</a><br><br>';
              }

              if ($data['typevente'] == "1"){
                echo '<u>Méthode d\'achat </u>: Achat immédiat <br><br>
                Prix : '.$data['prix'].' € <br><br>';

                if($_SESSION['statut'] == "acheteur"){
                  echo '<a href="addpanier.html?id='.$data['IDItem'].'"  class="btn btn-outline-info" role="button" >Ajouter au panier</a>
                  </p>';
                }

                elseif($_SESSION['statut'] == "" ){
                  echo '<a href="../comptes/login.php"  class="btn btn-outline-info" role="button" >Ajouter au panier</a>
                  </p>';
                }

                elseif($_SESSION['statut'] == "administrateur"){
                  echo '<a href="destruction.php?id='.$id.'" 
                  class="confirmModalLink btn btn-outline-danger" data-toggle="modal" data-target="#exampleModal">Supprimer des ventes&ensp;
                  <i class="fa fa-trash" aria-hidden="true" ></i></a>
                  ';
                }
                elseif($_SESSION['statut'] == "vendeur" && $_SESSION['id'] == $data['IDVendeur']){
                  echo '<a href="destruction.php?id='.$id.'" 
                  class="confirmModalLink btn btn-outline-danger" data-toggle="modal" data-target="#exampleModal">Supprimer des ventes&ensp;
                  <i class="fa fa-trash" aria-hidden="true" ></i></a>
                  ';
                }
                elseif($_SESSION['statut'] == "vendeur" && $_SESSION['id'] != $data['IDVendeur']){
                  echo '<a href="../comptes/login.php"  class="btn btn-outline-info" role="button" >Ajouter au panier</a>
                  </p>';
                }

                
              }
              elseif($data['typevente'] == "2"){

                echo '<u>Méthode d\'achat </u>: Enchères <br><br>
                <u>Prix de départ des enchères</u>: '.$data['prixench'].' € <br><br>';

                if($_SESSION['statut'] == "acheteur")
                {
                  echo '
                <a href="encherir.php?id='.$data['IDItem'].'"  class="btn btn-outline-info" role="button" >Enchèrir</a><br><br>
                ';
                
                }

                elseif($_SESSION['statut'] == ""){
                  echo '
                <a href="../comptes/login.php"  class="btn btn-outline-info" role="button" >Enchèrir</a><br><br>
                ';
                }
                elseif($_SESSION['statut'] == "administrateur"){
                  echo '<a href="destruction.php?id='.$id.'" 
                  class="confirmModalLink btn btn-outline-danger" data-toggle="modal" data-target="#exampleModal">Supprimer des ventes&ensp;
                  <i class="fa fa-trash" aria-hidden="true" ></i></a><br><br>
                  ';
                } elseif($_SESSION['statut'] == "vendeur" && $_SESSION['id'] == $data['IDVendeur']){
                  echo '<a href="destruction.php?id='.$id.'" 
                  class="confirmModalLink btn btn-outline-danger" data-toggle="modal" data-target="#exampleModal">Supprimer des ventes&ensp;
                  <i class="fa fa-trash" aria-hidden="true" ></i></a><br><br>
                  ';
                }
                elseif($_SESSION['statut'] == "vendeur" && $_SESSION['id'] != $data['IDVendeur']){
                  echo '<a href="../comptes/login.php"  class="btn btn-outline-info" role="button" >Enchérir</a>
                  </p><br>';
                }

                echo 'Il reste ';
                echo $interval->format('%m mois %d jours %H heures et %i minutes pour enchérir'); echo '</p>';}


              elseif($data['typevente'] == "3"){
                echo '<u>Méthode d\'achat </u>: Meilleur offre <br><br>';

                if($_SESSION['statut'] == "acheteur"){
                  echo '<a href="../achat/offre.php?id='.$data['IDItem'].'"  class="btn btn-outline-info" role="button" >Faire une offre</a><br><br>
                  ';
                 }
                 elseif($_SESSION['statut'] == "")
                 {
                  echo '<a href="../comptes/login.php"  class="btn btn-outline-info" role="button" >Faire une offre</a><br><br>
                  '; }
                  elseif($_SESSION['statut'] == "administrateur"){
                    echo '<a href="destruction.php?id='.$id.'" 
                    class="confirmModalLink btn btn-outline-danger" data-toggle="modal" data-target="#exampleModal">Supprimer des ventes&ensp;
                    <i class="fa fa-trash" aria-hidden="true" ></i></a>
                    </p>';
                  }
                  elseif($_SESSION['statut'] == "vendeur" && $_SESSION['id'] == $data['IDVendeur']){
                    echo 'Merci de passer par vos <a href="../comptes/moncompte_vendeur.php">négociations en cours</a> pour gérer vos négociations <br><br>
                    <a href="destruction.php?id='.$id.'" 
                  class="confirmModalLink btn btn-outline-danger" data-toggle="modal" data-target="#exampleModal">Supprimer des ventes&ensp;
                  <i class="fa fa-trash" aria-hidden="true" ></i></a>
                  </p>';
                  }
                  elseif($_SESSION['statut'] == "vendeur" && $_SESSION['id'] != $data['IDVendeur']){
                    echo '<a href="../comptes/login.php"  class="btn btn-outline-info" role="button" >Faire une offre</a><br><br>
                  ';
                  }

              }
              elseif($data['typevente'] == "4"){
                echo '<u>Méthodes d\'achat </u>: Achat immédiat ou enchère <br><br>
                <u>Prix de départ des enchères</u>: '.$data['prixench'].' € &nbsp';
                if($_SESSION['statut'] == "acheteur"){
                    echo '<a href="ecnherir.php?id='.$data['IDItem'].'"  class="btn btn-outline-info" role="button" >Enchèrir</a><br><br>
                    ';
                }

                elseif($_SESSION['statut'] == ""){
                  echo '<a href="../comptes/login.php"  class="btn btn-outline-info" role="button" >Enchèrir</a><br><br>
                    ';
                   }
                   elseif($_SESSION['statut'] == "administrateur"){
                    echo '<a href="destruction.php?id='.$id.'" 
                    class="confirmModalLink btn btn-outline-danger" data-toggle="modal" data-target="#exampleModal">Supprimer des ventes&ensp;
                    <i class="fa fa-trash" aria-hidden="true" ></i></a>
                    </p><br><br>';
                  }
                  elseif($_SESSION['statut'] == "vendeur" && $_SESSION['id'] == $data['IDVendeur']){
                    echo '<br><br>';
                  }
                  elseif($_SESSION['statut'] == "vendeur" && $_SESSION['id'] != $data['IDVendeur']){
                    echo '<a href="../comptes/login.php"  class="btn btn-outline-info" role="button" >Enchèrir</a><br><br>
                    ';
                  }
                   echo 'Il reste ';
                   echo $interval->format('%m mois %d jours %H heures et %i minutes pour enchérir'); echo '</p>';

                echo'
                <u>Prix pour achat immédiat</u>: '.$data['prix'].' € &nbsp';
                if($_SESSION['statut'] == "acheteur"){
                  echo'
                  <a href="addpanier.php?id='.$data['IDItem'].'"  class="btn btn-outline-info" role="button" >Ajouter au panier</a>
                  </p>';
                }
                elseif($_SESSION['statut'] == ""){
                  echo'
                  <a href="../comptes/login.php"  class="btn btn-outline-info" role="button" >Ajouter au panier</a>
                  </p>';
                }
                elseif($_SESSION['statut'] == "vendeur" && $_SESSION['id'] == $data['IDVendeur']){
                  echo '<br><br><a href="destruction.php?id='.$id.'" 
                    class="confirmModalLink btn btn-outline-danger" data-toggle="modal" data-target="#exampleModal">Supprimer des ventes&ensp;
                    <i class="fa fa-trash" aria-hidden="true" ></i></a>
                    </p>';

                }
                elseif($_SESSION['statut'] == "vendeur" && $_SESSION['id'] != $data['IDVendeur']){
                  echo'
                  <a href="../comptes/login.php"  class="btn btn-outline-info" role="button" >Ajouter au panier</a>
                  </p>';
                }

                

              }
              elseif($data['typevente'] == "5"){
                
                isset($_SESSION['statut']) ? $_SESSION['statut'] : "";

                echo '<u>Méthodes d\'achat </u>: Achat immédiat ou meilleur offre <br><br>
                <u>Prix pour achat immédiat</u>: '.$data['prix'].' € &nbsp <br><br>';
                if($_SESSION['statut'] == "acheteur"){
                  echo '<a href="addpanier.php?id='.$data['IDItem'].'"  class="btn btn-outline-info" role="button" >Ajouter au panier</a>
                  </p> <br><a href="../achat/offre.php?id='.$data['IDItem'].'"  class="btn btn-outline-info" role="button" >Faire une offre</a><br><br>';
                }
                elseif($_SESSION['statut'] == "" ){
                  echo '<a href="../comptes/login.php"  class="btn btn-outline-info" role="button" >Ajouter au panier</a>
                  </p><br><a href="../comptes/login.php"  class="btn btn-outline-info" role="button" >Faire une offre</a><br><br>';
                }
                elseif($_SESSION['statut'] == "administrateur"){
                  echo '<a href="destruction.php?id='.$id.'" 
                  class="confirmModalLink btn btn-outline-danger" data-toggle="modal" data-target="#exampleModal">Supprimer des ventes&ensp;
                  <i class="fa fa-trash" aria-hidden="true" ></i></a>
                  </p>';
                }
                elseif($_SESSION['statut'] == "vendeur" && $_SESSION['id'] == $data['IDVendeur']){
                  echo 'Merci de passer par vos <a href="../comptes/moncompte_vendeur.php">négociations en cours</a> pour gérer vos négociations<br><br>
                  <a href="destruction.php?id='.$id.'" 
                  class="confirmModalLink btn btn-outline-danger" data-toggle="modal" data-target="#exampleModal">Supprimer des ventes&ensp;
                  <i class="fa fa-trash" aria-hidden="true" ></i></a>
                  </p>';
                }
                elseif($_SESSION['statut'] == "vendeur" && $_SESSION['id'] != $data['IDVendeur']){
                  echo '<a href="../comptes/login.php"  class="btn btn-outline-info" role="button" >Ajouter au panier</a>
                  </p><a href="../comptes/login.php"  class="btn btn-outline-info" role="button" >Faire une offre</a><br><br>
                ';
                }
              }
  
            echo'<a href="../comptes/vendeur_compte.php?id='.$data['IDVendeur'].'"> Visiter le compte du vendeur</a></div>
            </div>';   

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
        Êtes-vous sûr de vouloir supprimer l'article ?
      </div>
      <div class="modal-footer">
        <a class="btn btn-secondary" data-dismiss="modal" >Annuler</a>
        <?php echo'
        <a href="destruction.php?id='.$id.'" class="btn btn-primary" id="confirmModalYes" >Supprimer</a>'; ?>
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