<!DOCTYPE html>
<html>
<head>
    <title>Ebay ECE</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head> 
<!--<body>-->



    <body>

    <?php 
 include ("menu.php");
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
                <input type="text" id="Nom" class="form-control" placeholder="Nom de l'objet" required autofocus >     <label for="Nom"></label>
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
                    
                    <input type="checkbox" name="enchere" id="enchere" value="enchere">
                    <label for="enchere">Enchères</label>
                    
                    <input type="checkbox" name="achatim" id="achatim" value="achatim">
                    <label for="achatim">Achat immédiat</label>

                    <input type="checkbox" name="meilleurof" id="meilleurof" value="meilleurof">
                    <label for="meilleurof">Meilleure offre</label><br>

                </div>
</div>
    
                
                
                
                    
                    
                  
                    
                     <hr class="my-4"><br>
                
                
            
                <label ><dt>Importez les photos de l'objet :</dt></label><br>
                <input type="hidden" style="margin-top: 30px; ;" name="MAX_FILE_SIZE" value="100000">
                Photo 1 : <input type="file" style="margin-top: 30px; ;" name="photo[]"><br>

                <input type="hidden" style="margin-top: 30px; ;" name="MAX_FILE_SIZE" value="100000">
                Photo 2 : <input type="file" style="margin-top: 30px; ;" name="photo[]"><br>

                <input type="hidden" style="margin-top: 30px; ;" name="MAX_FILE_SIZE" value="100000">
                Photo 3 : <input type="file" style="margin-top: 30px; ;" name="photo[]"><br>

                <input type="hidden" style="margin-top: 30px; ;" name="MAX_FILE_SIZE" value="20000000">
                Vidéo (max 2mo) : <input type="file" style="margin-top: 30px; ;" name="photo[]"><br>

                

                <input type="number" style="margin-top: 30px;" name="prix" id="prix" placeholder="Prix">
                <label for="prix">€</label><br> <br><br>

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