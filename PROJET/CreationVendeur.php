<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 

    }
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Inscription Vendeur</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> <link rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" type="text/css" href="css/CreationVendeur.css" />
</head>
    
    
    <body>
    <?php 
            include ("menu.php");
      ?>
        
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-9 mx-auto" >
          
        <div class="card card-signin flex-row my-5" >
          
          <div class="card-body" >
              
            <h4 class="card-header text-center" >Bienvenue sur la page de création du Compte Vendeur</h4>
              <br>
              
            <form class="col-md4 ml-auto mr-auto" action="upload_vendeurs.php" method="post" enctype="multipart/form-data" >
                
              <div class="form-label-group">
                 <label for="Prénom">Prénom</label>
                <input type="text" class="form-control" name="Prénom" id="Prénom" aria-describedby="nameHelp" placeholder="Entrez votre prénom" required autofocus >
                <br>
              </div>

              <div class="form-label-group">
                <label for="Nom">Nom</label>
                <input type="text" class="form-control" name="Nom" id="Nom" aria-describedby="nameHelp" placeholder="Entrez votre nom" required autofocus ><br>
              </div>
                
                <div class="form-label-group">
                <label for="Nom">Identifiant</label>
                <input type="text" class="form-control" name="Identifiant" id="Identifiant" aria-describedby="identifiantHelp" placeholder="Entrez votre login" required autofocus ><br>
              </div>
                
                <div class="form-label-group">
                <label for="Nom">Email</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Entrez votre adresse email" required autofocus ><br>
              </div>
                
                <div class="form-label-group">
                <label for="Nom">Mot de passe</label>
                <input type="password" class="form-control" name="pwd" id="pwd" aria-describedby="pwdHelp" placeholder="Entrez votre mot de passe" required autofocus >
                <small class="form-text text-muted">
                  Votre mot de passe doit faire au moins 8 caractères et contenir au moins une majuscule, un chiffre et un caractère spécial
                </small><br>
              </div>
                
                <div class="form-label-group">
                <label for="Nom">Confirmation mot de passe</label>
                <input type="password" class="form-control" name="pwd2" id="pwd2" aria-describedby="pwd2Help" placeholder="Veuillez confimer votre mot de passe" required autofocus><br>
              </div>
              
              <hr class="my-4">
            
                <label for="fichier"><dt>Importez votre photo de profil :</dt></label>
                <div class="custom-file">
                  <input size="100" type="file" style="margin-top: 30px;" name="fichier" id="fichier" value="" accept="image/png, image/jpeg, image/jpg" required><br>
                  <small class="form-text text-muted">
                    Votre image doit faire moins de 1Mo.
                  </small>
                </div>
                <br><br>
                
                <br><br> <label ><dt>Choisissez votre fond préféré :</dt></label><br><br>            
               
<div class="row">
    

                 
     <div style="margin-left: 30px " class="col">
                        
           <div class="cover"><img src="images/fonddecouv/1.jpg" alt="automne"></div>
                                
          
               <div class="form-check">
                  <input class="form-check-input" type="radio" name="cover" id="cover" value="images/fonddecouv/1.jpg" checked>
                     <label class="form-check-label" for="cover">  Couverture Automne</label>
               </div>                           

      </div>          
                    
      <div style="margin-left: 30px " class="col">
                        
             <div class="cover"><img src="images/fonddecouv/5.jpg" alt="Wallpaper"></div>
                 <div class="form-check">
                     <input class="form-check-input" type="radio" name="cover" id="cover" value="images/fonddecouv/5.jpg" checked>
                    <label class="form-check-label" for="cover"> Couverture Stylisée</label>
                 </div>  

      </div>     
     
      <div style="margin-left: 30px " class="col" >

            <div class="cover"><img src="images/fonddecouv/3.jpg" alt="Flou"></div>
                 <div class="form-check">
                     <input class="form-check-input" type="radio" name="cover" id="cover" value="images/fonddecouv/3.jpg" checked>
                                <label class="form-check-label" for="cover">
                                    Couverture Gouttes
                                </label>
                </div>   
                    
       </div>

                <div style=" margin-left:30px ; margin-right: 30px " class="col">
                        
                     <div class="cover"><img  src="images/fonddecouv/4.jpg" alt="Etoiles"></div>  
                                <div class="form-check">
                                <input class="form-check-input" type="radio" name="cover" id="cover" value="images/fonddecouv/4.jpg" checked>
                                <label class="form-check-label" for="cover">
                                    Couverture Etoiles
                                </label>
                                </div> 

                </div>  
                    
                    
</div>   
                <br> <br> <br>
                
    
   <div for="categorie" class="form-label-group">            
                    

               <div>
                     <input type="checkbox" id="CGV" name="CGV" value="CGV" required autofocus>
                     <label for="CGV" style="font-size: small;">Acceptez vous les <a href="CGV.htlm">Conditions Générales de Vente </a></label>
               </div>

                <input type="submit" id="bttncreation" value="Créez votre compte" class="btn btn-lg btn-primary btn-block " target="blank">
          <br>
                
                </div>
                
            
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    </body>

    
    

</html>



