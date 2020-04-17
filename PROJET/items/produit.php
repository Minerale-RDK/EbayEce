<?php
include('../bases/header.php');
?>

<body>

        <?php 

function dateDiff($date2, $date1){
  $diff = abs($date1 - $date2); // fonction de finalclap.com
  $retour = array();

  $tmp = $diff;
  $retour['second'] = $tmp % 60;

  $tmp = floor( ($tmp - $retour['second']) /60 );
  $retour['minute'] = $tmp % 60;

  $tmp = floor( ($tmp - $retour['minute'])/60 );
  $retour['hour'] = $tmp % 24;

  $tmp = floor( ($tmp - $retour['hour'])  /24 );
  $retour['day'] = $tmp;

  return $retour;
}

          $dateajd = time();

            include ("../bases/menu.php");
            $id = $_GET['id'];

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
              <br><br>';
              if ($compteur2 != 0)
              {
                $extfile2 = $files2[0];
                echo '<a href="'.$extfile2.'">Lien vers la vidéo disponible</a><br><br>';
              }
              if ($data['typevente'] == "1"){
                echo '<u>Méthode d\'achat </u>: Achat immédiat <br><br>
                Prix : '.$data['prix'].' € <br><br>
                <a href="panier.html?id='.$data['IDItem'].'"  class="btn btn-outline-info" role="button" >Ajouter au panier</a>
                </p>';
              }
              elseif($data['typevente'] == "2"){
                echo '<u>Méthode d\'achat </u>: Enchères <br><br>
                <u>Prix de départ des enchères</u>: '.$data['prixench'].' € <br><br>
                <a href="encherir.php?id='.$data['IDItem'].'"  class="btn btn-outline-info" role="button" >Enchèrir</a><br><br>
                ';
               
                $datefinenchere = $data['datefin'];
                echo 'Il reste ';
                $array = dateDiff($dateajd, $datefinenchere);

                echo ''.$array['day'].' jours '.$array['hour'].' heures et '.$array['minute'].' minutes pour enchérir </p>'; 

              }elseif($data['typevente'] == "3"){
                echo '<u>Méthode d\'achat </u>: Meilleur offre <br><br>
                <a href="faireoffre.php?id='.$data['IDItem'].'"  class="btn btn-outline-info" role="button" >Faire une offre</a><br><br>
                ';
              }
              elseif($data['typevente'] == "4"){
                echo '<u>Méthodes d\'achat </u>: Achat immédiat ou enchère <br><br>
                <u>Prix de départ des enchères</u>: '.$data['prixench'].' € &nbsp
                <a href="ecnherir.php?id='.$data['IDItem'].'"  class="btn btn-outline-info" role="button" >Enchèrir</a><br><br>
                ';
               
                $datefinenchere = $data['datefin'];
                echo 'Il reste ';
                $array = dateDiff($dateajd, $datefinenchere);

                echo ''.$array['day'].' jours '.$array['hour'].' heures et '.$array['minute'].' minutes pour enchérir <br><br>
                <u>Prix pour achat immédiat</u>: '.$data['prix'].' € &nbsp
                <a href="panier.html?id='.$data['IDItem'].'"  class="btn btn-outline-info" role="button" >Ajouter au panier</a>
                </p>'; 

              }
              elseif($data['typevente'] == "5"){
                echo '<u>Méthodes d\'achat </u>: Achat immédiat ou meilleur offre <br><br>
                <u>Prix pour achat immédiat</u>: '.$data['prix'].' € &nbsp
                <a href="panier.html?id='.$data['IDItem'].'"  class="btn btn-outline-info" role="button" >Ajouter au panier</a>
                </p><br><br><a href="faireoffre.php?id='.$data['IDItem'].'"  class="btn btn-outline-info" role="button" >Faire une offre</a><br><br>'
                ; 

              }
  
            echo'</div>
            </div>';   

        }
        ?>

    <br><br>
    <?php
   include('../bases/footer.php');
   ?>

</body>
</html>