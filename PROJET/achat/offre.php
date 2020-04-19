<?php

include('../bases/header.php');

?>

<body>
  

<?php

if(!isset($_SESSION['statut'])){

  header('location: ../comptes/login.php');
  exit;

}

include('../bases/menu.php');
  
            $idVisiteur = $_SESSION['id'];
            $id = $_GET['id'];
            $IDGetAcheteur = isset($_GET["idach"])? $_GET["idach"] : "";

            $sql = "SELECT * FROM items WHERE IDItem = '$id'";
            $req = mysqli_query($db_handle, $sql);

            $data = mysqli_fetch_assoc($req);
              
            $dossier = $data['chemindossier'];
            $files = glob("$dossier/*photo*"); 
            $compteur = count($files);

            $files2 = glob("$dossier/*video*"); 
            $compteur2 = count($files2);

            if($_SESSION['statut'] == "acheteur"){
              $sql2 ="SELECT * FROM meilleuroffre WHERE IDItem = '$id'";
            }
            else{
              $sql2 ="SELECT * FROM meilleuroffre WHERE IDItem = '$id' AND IDAcheteur ='$IDGetAcheteur'";
            }
  
            $req2 = mysqli_query($db_handle, $sql2);
            $req3 = mysqli_query($db_handle, $sql2);
            $data2 = mysqli_fetch_assoc($req2);           

?>

<br><br><div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-5" style="align-content: center;">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">

            <?php
    
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
                  
            <div class="col-sm-4" >
                <h2 style="margin-left:13px"> '.$data['nomitem'].' </h2>
                <p style="text-align: justify; margin-left:14px;" ><br>
              <u>Description :</u> '.$data['description'].'
              <br>';
              if ($compteur2 != 0)
              {
                $extfile2 = $files2[0];
                echo '<a href="'.$extfile2.'">Lien vers la vidéo disponible</a><br><br>';
              }
              if(!mysqli_num_rows ( $req3 )){
                echo'</p>
                    <form method="post" action="traitementoffre.php?id='.$id.'">
                    <div class="input-group col-md-6" >
                    <input type="text" class="form-control" name="montant" aria-label="Montant" placeholder="Montant">
                    <div class="input-group-append">
                      <span class="input-group-text">€</span>
                    </div>
                    <div>
                    <br><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Soumettre votre offre
                    </button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Attention</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                      Selon nos <a href="../bases/CGV">CGV</a>, si le vendeur accepte votre offre vous êtes dans l\'obligation légale de procéder au paiement. Souhaitez-vous continuer ?
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary" value="Valider"></input>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                  </div>
                  </form>';

              }
              else{
                while($data3 = mysqli_fetch_assoc($req3)){

                  if(empty($data3)){
                    

                  }

                  if($idVisiteur != $data3['IDAcheteur'] && $_SESSION['statut'] == "acheteur"){ // Si jamais l'acheteur n'a pas d'offre en cours pour cet item
                    echo'</p>
                    <form method="post" action="traitementoffre.php?id='.$id.'">
                    <div class="input-group col-md-6" >
                    <input type="text" class="form-control" name="montant" aria-label="Montant" placeholder="Montant">
                    <div class="input-group-append">
                      <span class="input-group-text">€</span>
                    </div>
                    <div>
                    <br><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    Soumettre votre offre
                    </button>
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Attention</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                      Selon nos <a href="../bases/CGV">CGV</a>, si le vendeur accepte votre offre vous êtes dans l\'obligation légale de procéder au paiement. Souhaitez-vous continuer ?
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Valider</button>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                  </div>
                  </form>';

                  }
                  
                  
                  elseif($data3['IDAcheteur'] == $idVisiteur && $data3['tour'] == "2" && $data3['accepte'] == "0" && $_SESSION['statut'] == "acheteur" && $data3['nbtry'] < "10"){
                    echo '<br>Votre offre a été soumise, veuillez attendre que le vendeur accepte votre offre ou vous propose une contre-offre </div>
                    </div>'; //Si une offre est en cours et que c'est le tour du vendeur
                  }
                  elseif($data3['IDAcheteur'] == $idVisiteur && $data3['accepte'] == "1" && $_SESSION['statut'] == "acheteur"){
                    echo 'Votre offre a été <strong>acceptée</strong> ! Vous pouvez maintenant procéder au paiement<br><br>
                    <a href="../items/addpanier.php?id='.$id.'"  class="btn btn-outline-info" role="button" >Ajouter au panier</a> </div>
                    </div>'; //Page où accède l'acheteur si jamais une de ses offres à été acceptée
                  }
                  elseif($data3['IDAcheteur'] == $idVisiteur && $data3['tour'] == "1" && $data3['accepte'] == "0" && $_SESSION['statut'] == "acheteur" && $data3['nbtry'] < "10"){
                    // Si c'est le tour de l'acheteur et que le nombre d'essais n'est pas dépassé
                    echo '<p style="margin-left : 14px">Le vendeur vous a proposé une contre-offre. Le montant de cette contre-offre est de '.$data3['prixprop'].' €.<br><u>Vous pouvez :</u> </p>
                    <form method="post" action="traitementoffre.php?id='.$id.'"> 
                    <div class="input-group col-md-6" >
                    <div>
                    <input type="submit" name="Accepter" class="btn btn-primary test" value="Accepter"></input>
                    </div>
                    <br><br><p>Ou <u>faire une contre-offre :</u></p><br>
                    <div class="input-group ">
                    <input type="text" class="form-control" name="montant" aria-label="Contre-offre" placeholder="Montant">
                    <div class="input-group-append">
                    <span class="input-group-text">€</span>
                    </div>
                    </div>
                    <div>
                    <br>
                    <input type="submit" name="CO" class="btn btn-primary" value="Soumettre votre offre"></input>
                    </div>
                    </div>
                    </div>
                    </form>';

                  }
                  elseif ($data3['IDAcheteur'] == $idVisiteur && $data3['tour'] == "1" && $data3['accepte'] == "0" && $_SESSION['statut'] == "acheteur" && $data3['nbtry'] == "10") {
                    //Si c'est le tour de l'acheteur et que c'est sa dernière chance (message pour lui dire)
                    echo '<p style="margin-left : 14px">Le vendeur vous a proposé une contre-offre. Le montant de cette contre-offre est de '.$data3['prixprop'].' €.
                    <br><u>Vous pouvez :</u> </p>
                    <form method="post" action="traitementoffre.php?id='.$id.'">
                    <div class="input-group col-md-12" >
                    <div>
                    <input type="submit" name="Accepter" class="btn btn-primary test value="Accepter l\'offre"></input>
                    </div>
                    <br><br><p>Ou <u>Refuser :</u> Si vous refusez, les négociations s\'arrêtent et vous ne pourrez plus négocier pour cet article.</p><br>
                    <br><input type="submit" name="refuser" class="btn btn-danger" value="Refuser">
                    </form>';
                  }
                  elseif ($data3['IDAcheteur'] == $idVisiteur && $data3['accepte'] == "0" && $_SESSION['statut'] == "acheteur" && $data3['nbtry'] == "11"){
                    // Si l'acheteur tente de refaire une offre pour un article alors qu'il a déjà dépassé le quota de négociations
                      echo '<br>Vous ne pouvez plus négocier pour cet article, vous avez atteint le nombre maximum d\'offre/contre-offre.';
                  }
                  
                  //On passe maintenant à la gestion des offres pour le vendeur. Grâce au Get de l'id de l'acheteur, on accède à l'offre concernée uniquement 
                  //(accès uniquemetn possible via moncompte.php)

                  elseif($data3['IDVendeur'] == $idVisiteur && $data3['tour'] == "1" && $data3['accepte'] == "0" && $_SESSION['statut'] == "vendeur"){
                    //Si c'est le tour de l'acheteur 
                    echo '<br>Votre offre a été soumise , veuillez attendre que l\'acheteur accepte votre offre ou vous propose une contre-offre.';
                  }

                  elseif($data3['IDVendeur'] == $idVisiteur && $data3['tour'] == "2" && $data3['accepte'] == "0" && $_SESSION['statut'] == "vendeur"){
                    //Si c'est le tour du vendeur et qu'on est pas dans la dernière négociation possible
                    echo '<p style="margin-left : 14px">L\'acheteur vous a proposé une offre. Le montant de cette offre est de '.$data3['prixprop'].' €.<br><u>Vous pouvez :</u> </p>
                    <form method="post" action="traitementoffre.php?idach='.$IDGetAcheteur.'&id='.$id.'">
                    <div class="input-group col-md-6" >
                    <div>
                    <input type="submit" name="Accepter" class="btn btn-primary test" value="Accepter"></input>

                    </div>
                    <br><br><p>Ou <u>faire une contre-offre :</u></p><br>
                    <div class="input-group ">
                    <input type="text" class="form-control" name="montant" aria-label="Contre-offre" placeholder="Montant">
                    <div class="input-group-append">
                    <span class="input-group-text">€</span>
                    </div>
                    <div>
                    <br><input type="submit" name="CO2" class="btn btn-primary" value="Soumettre votre offre">
                    </div>
                    </div>
                    </form>';
                  }
                  elseif($data3['IDVendeur'] == $idVisiteur && $data3['tour'] == "2" && $data3['accepte'] == "0" && $_SESSION['statut'] == "vendeur" && $data3['nbtry'] == "9"){
                    //si c'est la dernière offre que le vendeur peut faire
                    echo '<p style="margin-left : 14px">L\'acheteur vous a proposé une contre-offre. Le montant de cette contre-offre est de '.$data3['prixprop'].' €.<br><u>Vous pouvez :</u> </p>
                    <form method="post" action="traitementoffre.php?idach='.$IDGetAcheteur.'&id='.$id.'">
                    <div class="input-group col-md-6" >
                    <div>
                    <input type="submit" name="Accepter" class="btn btn-primary test" value="Accepter"></input>
 
                    </div>
                    <br><br><p>Ou <u>faire une contre-offre :</u> Attention, dernière offre possible. Si l\'acheteur refuse, les négociations seront closes.</p><br>
                    <div class="input-group ">
                    <input type="text" class="form-control" name="montant" aria-label="Contre-offre" placeholder="Montant">
                    <div class="input-group-append">
                    <span class="input-group-text">€</span>
                    </div>
                    <div>
                    <br><input type="submit" name="CO" class="btn btn-primary" value="Soumettre votre offre"></input>
                    </div>
                    </div>
                    </form>';

                  }              
                }
              }
              
              

echo'
              </div>
            </div>';?>
            

    
    <br><br>


    

<?php

include('../bases/footer.php');

?>

</body>



