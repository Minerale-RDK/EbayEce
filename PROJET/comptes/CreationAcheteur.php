<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 

    }
    include ("../bases/header.php");
?>
<head>
    <link rel="stylesheet" type="text/css" href="css/CreationVendeur.css" />
</head>
    
    
    <body>
    <?php 
            include ("../bases/menu.php");
      ?>
        
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-9 mx-auto" >
          
        <div class="card card-signin flex-row my-5" >
          
          <div class="card-body" >
              
            <h4 class="card-header text-center" >Bienvenue sur la page de création du Compte Acheteur</h4>
              <br>
              
            <form class="col-md4 ml-auto mr-auto" action="upload_acheteur.php" method="post" enctype="multipart/form-data" >
                
              <div class="form-label-group">
                 <label for="Prénom">Prénom</label>
                <input type="text" class="form-control" name="Prénom" id="Prénom" aria-describedby="nameHelp" placeholder="Entrez votre prénom" required autofocus  ><br>
                
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
                <input type="password" class="form-control" name="pwd2" id="pwd2" aria-describedby="pwd2Help" placeholder="Veuillez confimer votre mot de passe" required autofocus ><br>
              </div>
                    <br> <br>
                
    
   <div for="categorie" class="form-label-group">            
                    

               <div>
                     <input type="checkbox" id="CGV" name="CGV" value="CGV" required autofocus >
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
