<?php
include('../bases/header.php');

?>
   
    <script>
function myFunction() {
  var checkBox = document.getElementById("achatim");
  var text = document.getElementById("prix");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
     text.style.display = "none";
  }
}
function myFunction2() {
  var checkBox2 = document.getElementById("enchere");
  var text2 = document.getElementById("prix2");
  if (checkBox2.checked == true){
    text2.style.display = "block";
  } else {
     text2.style.display = "none";
  }
}
</script>
</head> 
<!--<body>-->



    <body>
    <?php 
 
if(!isset($_SESSION['statut'])){
  echo "Merci de vous connecter à un compte vendeur";
  header('location: ../comptes/login.php');
  exit;
}
elseif($_SESSION['statut'] != "administrateur" && $_SESSION['statut'] != "vendeur")
{
  echo "Merci de vous connecter à un compte vendeur";
  header('location: ../comptes/login.php');
  exit;
}
else{
  include ("../bases/menu.php");

}

 ?>



  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-9 mx-auto">
          
        <div class="card card-signin flex-row my-5">
          
          <div class="card-body">
              
            <h4 class="card-header text-center" >Ajouter un objet à mettre en vente</h4>
              <br>
              
            <form class="form-signin" action="ajoutItem.php" method="post" enctype="multipart/form-data">
                
              <div class="form-label-group">
                <input type="text" id="Nom" name="Nom" class="form-control" placeholder="Nom de l'objet" required autofocus >     <label for="Nom"></label>
              </div>

              <div class="form-label-group">
                <input type="text" id="Description" class="form-control" placeholder="Description" required style="margin-top: 30px; height: 150px;" name="Description" >
                <label for="Description"></label>
              </div>
              
              <hr>
                
    
   <div for="categorie" class="form-label-group">            
                <div class="row">

                <div style="margin-left: 50px" class="col" >

                    <label> <dt>Séléctionner une catégorie :</dt> </label>
                    <br>
                    <select name="categorie" id="categorie" class="text-center ; btn btn-primary dropdown-toggle" style="background-color: rgb(25,69,126)">
                        
                        <option value="FoT">Ferraille ou Trésor</option>
                        <option value="BpM">Bon pour le musée</option>
                        <option value="vip">Accessoire VIP</option>
                    </select>        
                    <br><br>
                    
                </div>

                <div style="margin-right: 25px ; margin-left: inherit" class="col">
                        
                      <label ><dt>Séléctionner un type d'achat :</dt></label><br>
                    
                    <input type="checkbox" name="enchere" id="enchere" value="enchere" onclick="myFunction2()">
                    <label for="enchere">Enchères</label><br>

                    <label for="date1"> Date de fin de l'enchère</label>
                    <input type="date" name="date1" id="date1" value=""><br><br>
                    
                    
                    <input type="checkbox" name="achatim" id="achatim" value="achatim" onclick="myFunction()">
                    <label for="achatim">Achat immédiat</label>

                    <input type="checkbox" name="meilleurof" id="meilleurof" value="meilleurof">
                    <label for="meilleurof">Meilleure offre</label><br>

                </div>
</div>
                  
                     <hr class="my-4"><br>
                
                
            
                <label ><dt>Importez les photos de l'objet :</dt></label><br>
                <input type="hidden" style="margin-top: 30px; ;" name="MAX_FILE_SIZE" value="10000000000">
                Photo 1 : <input type="file" style="margin-top: 30px; ;" name="photo[]"><br>

                <input type="hidden" style="margin-top: 30px; ;" name="MAX_FILE_SIZE" value="100000000000">
                Photo 2 : <input type="file" style="margin-top: 30px; ;" name="photo[]"><br>

                <input type="hidden" style="margin-top: 30px; ;" name="MAX_FILE_SIZE" value="100000000000">
                Photo 3 : <input type="file" style="margin-top: 30px; ;" name="photo[]"><br>

                <input type="hidden" style="margin-top: 30px; ;" name="MAX_FILE_SIZE" value="2000000000000">
                Vidéo (max 2mo) : <input type="file" style="margin-top: 30px; ;" name="photo[]"><br>

                
                <div id="prix1">
                <input type="text" style="margin-top: 30px; display:none;" name="prix" id="prix" placeholder="Prix pour achat immédiat">
                </div>

                <div id="prix3">
                <input type="text" style="margin-top: 30px; display:none;" name="prix2" id="prix2" placeholder="Prix de départ enchères">
                </div>

                 <br><br>
                <input type="submit" id="bttnvalider" value="Mettre en vente" class="btn btn-lg btn-primary btn-block " style="background-color: rgb(25,69,126)">

                
              <a class="d-block text-center mt-2 small" href="#">Aller à "Mon compte"</a>
             
            
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>


    </body>

    
 </html>