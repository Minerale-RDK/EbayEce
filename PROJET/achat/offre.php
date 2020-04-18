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

    $(document).ready(function(){
    $("a.submit").click(function(){
        document.getElementById("myForm").submit();
    }); 
});
    </script>
</head> 
<body>

<?php



include('../bases/menu.php');

if(!isset($_SESSION['statut']) || $_SESSION['statut'] == "vendeur"){

    header('location: ../comptes/login.php');
    exit;

}

            $id = $_GET['id'];

            $sql = "SELECT * FROM items WHERE IDItem = '$id'";
            $req = mysqli_query($db_handle, $sql);

            $data = mysqli_fetch_assoc($req);
              
            $dossier = $data['chemindossier'];
            $files = glob("$dossier/*photo*"); 
            $compteur = count($files);

            $files2 = glob("$dossier/*video*"); 
            $compteur2 = count($files2);

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
              <br><br>';
              if ($compteur2 != 0)
              {
                $extfile2 = $files2[0];
                echo '<a href="'.$extfile2.'">Lien vers la vidéo disponible</a><br><br>';
              }
              echo'</p>
              <form class="col-md-8 pull-left" action="traitementoffre.php?id='.$id.'" method="post" enctype="text/plain" id="myForm" >
              <label for="input-group">Entrez le montant de votre offre :<br></label>
              <div class="input-group">
              <input type="text" name="montant" class="form-control" aria-label="Montant de l\'offre" style="float:left; margin-top:5px;" placeholder="Montant" required>
              <div class="input-group-append">
                <span class="input-group-text" style="float:left; margin-top:5px;">€</span>
              </div> 
            </div>
            <br>
            <button type="submit" class="confirmModalLink btn btn-outline-primary" data-toggle="modal" data-target="#exampleModal">Soumettre</button>


              </div>
            </div>';
            ?>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Soumission de l'offre</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Êtes-vous sûr de vouloir enregistrer votre offre ? Selon nos <a href="../compte/CGV.html">CGV</a>, l'acceptation de la part du vendeur entraîne une obligation d'achat. 
      </div>
      <div class="modal-footer">
        <a class="btn btn-secondary" data-dismiss="modal" >Annuler</a>
        
        <a href="#" type="submit" class="submit btn btn-primary" id="confirmModalYes" >Soumettre</a>'; 
      </div>
    </div>
  </div>
</div>
</form>
    
    <br><br>

<?php

include('../bases/footer.php');

?>

</body>



