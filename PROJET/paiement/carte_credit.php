<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 

    }
    include('../bases/header.php');
?>

    
    
    <body>
    <?php 
            include ("../bases/menu.php");
      ?>
  <div class="container">
    <div class="row">
      <div class="col-lg-10 col-xl-9 mx-auto" >
          
        <div class="card card-signin flex-row my-5" >
          
          <div class="card-body" >
              
            <h4 class="card-header text-center" >Page de paiement</h4>
              <br>
              
            <form class="col-md4 ml-auto mr-auto" action="verification_paiement.php" method="post" enctype="multipart/form-data" >
                
              <div class="form-label-group">
                 <label for="num">Numéro de la carte</label>
                <input type="text" class="form-control" name="num" id="num" aria-describedby="numHelp" placeholder="Entrez le numéro de votre carte" required autofocus><br>
              </div>

              <div class="form-label-group">
                <label for="Nom">Nom affiché sur la carte</label>
                <input type="text" class="form-control" name="nom" id="nom" aria-describedby="nameHelp" placeholder="Entrez le nom sur votre carte"required autofocus><br>
              </div>
                
                <div class="form-label-group">
                <label class="my-1 mr-2" for="mois">Date d'expiration :</label>
                <select class="custom-select my-1 mr-sm-2" name="mois" id="mois" required>
                    <option selected>Mois</option>
                    <option value="01">01</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>
                <select class="custom-select my-1 mr-sm-2" name="annee" id="annee" required>
                    <option selected>Année</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>
                    <option value="2026">2026</option>
                </select>
              </div>
                <br>
                <div class="form-label-group">
                <label for="cvv">Code de sécurité</label>
                <input type="text" class="form-control" name="cvv" id="cvv" aria-describedby="cvvHelp" placeholder="CVV" required autofocus><br>
                </div>
                <legend class="col-form-label pt-0">Type de carte de paiement :</legend>
                <div class="form-check form-check-inline">
                    <input class="form-check-input active" type="radio" name="type" id="Visa" value="Visa" checked>
                    <label class="form-check-label" for="Visa">Visa</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="type" id="Mastercard" value="Mastercard">
                    <label class="form-check-label" for="Mastercard">Mastercard</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="type" id="AmericanExpress" value="AmericanExpress">
                    <label class="form-check-label" for="AmericanExpress">AmericanExpress</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="type" id="PayPal" value="PayPal">
                    <label class="form-check-label" for="PayPal">AmericanExpress</label>
                </div>
               
   <br><br>
                <input type="submit" id="bttncreation" value="Validez votre paiement" class="btn btn-lg btn-primary btn-block " target="blank">
          <br>
                
            
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    </body>

    
    

</html>



