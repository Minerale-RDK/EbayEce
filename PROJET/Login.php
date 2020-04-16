<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 

    }
?>
<html>
<head>
<title>EbayECE - Connexion</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> <link rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
  <!--  <link rel="stylesheet" type="text/css" href="css/login.css" />-->
</head>

<body>
        <?php 
            include ("menu.php");
        ?>
    <div class="container"> 
        <div calss="row"> 
            <div class="col-lg-10 col-xl-9 mx-auto" >
               <div class="card card-signin flex-row my-5" >
                   <div class="card-body" >
            
                <h4 class="card-header text-center" >Bienvenue sur la page de connexion</h4>
              <br>
                
                <form class="col-md4 ml-auto mr-auto" action="connexion.php" method="post" enctype="multipart/form-data" >       
                       
             <div class="form-label-group">
                 <label for="identifiant">Identifiant:</label>
                <input type="text" class="form-control" name="identifiant" id="identifiant" aria-describedby="nameHelp" placeholder="Identifiant">
                <br>
              </div>
            
            <div class="form-label-group">
                <label for="mdp">Mot de passe :</label>
                <input type="text" class="form-control" name="mdp" id="mdp" aria-describedby="nameHelp" placeholder="Mot de passe"><br>
              </div>
               
                    <input type="submit" id="bttnconnex" value="Connexion" class="btn btn-lg btn-primary btn-block ">
                    
                <br><br>
                </form>
                     <h6 style="text-align: center" >Pas encore de compte ?</h6>
                     <div style="text-align: center">
                <a href="CreationVendeur.php">Créer un compte Vendeur</a>&ensp;
                <a href="CreationAcheteur.php">Créer un compte Acheteur</a>
                    </div>
                       
                   </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
