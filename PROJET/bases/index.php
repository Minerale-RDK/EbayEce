<?php

  include('header.php');
  
?>

<body>

<?php 
    include ("menu.php");
?>

<br>
    
<div class="col-container">
    
    <div class="row" >
        <div style="margin-left: 40px ; " class="col">
        
         <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="  top: 50%; left: 50%; -ms-transform: translate(-50%, -50%); transform: translate(-50%, -50%);">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="../images/1.png" alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="../images/2.png" alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="../images/3.png" alt="Third slide">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
    </div>
            </div>
            <br><br><br><br><br><br><br><br>
       
   
    
    <div style="margin-left: auto; margin-right: 40px ; " class="col" >
    
        
       
    
        <h2 style="text-align: center; margin-top: 10%">Ebay ECE</h2>
        <h2 style="text-align: center; margin-top: 10px">Achetez et vendez des articles de qualité </h2>
        <br><br>
        <h5 style="margin-top: 20px">Comment ca fonctionne?</h5>
        <p>
         Voici comment trouver les articles qui vous intéressent :
        </p>
        
          <h6 >En filtrant par catégorie</h6>
        <p style=" text-align: justify ;text-justify: inter-word" > Si vous cherchez un bijoux, une montre ou n'importe quel accessoire porté, il vous suffit d'aller dans l'onglet "Accessoires VIP".
        <br> Si vous cherchez une œuvre d'art vous pouvez vous rendre dans la catégorie "Bons pour le Musée".
        <br>En cliquant sur la catégorie "Ferraille ou Trésors" vous trouverez des antiquités comme d'anciennes pièces de monnaie et autres. </p>
       
        <h6 >En filtrant par type d'achat</h6>
        <p style=" text-align: justify ;text-justify: inter-word">Vous pouvez aussi choisir de ne voir que les articles qui sont soit dans les ventes aux enchères, en achat immédiat, ou ceux dont les prix sont négociables en "meilleures offres". </p>

        
        

</div>
        
   
    </div>
        
 </div>
    
    
    </body>
    
    

<?php
   include('footer.php');
?>



</html>


