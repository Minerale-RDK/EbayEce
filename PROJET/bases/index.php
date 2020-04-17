
<?php
include('header.php');
?>
<body>
   
        <?php 
            include ('menu.php');
        ?>
       
       <br><br>
       <div class="wrapper">
    
    <div class="row" >
        <div style="margin-left: 40px" class="col" >
        
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="../images/1.jpg" alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="../images/2.jpg" alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="../images/3.jpg" alt="Third slide">
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
            <br><br><br><br><br><br><br><br>
        </div>
    
    
    
    <div style="margin-left: auto; margin-right: 40px" class="col" >
    
    <br>
        <h5 style="text-align: center">Bienvenue dans notre vente aux enchères en lignes</h5><br><br>
        <h6>Comment ca fonctionne ? </h6><br><br>
        <p>Ici, vous pouvez découvrir vos articles ainsi que les achetez de plusieurs facons differentes, voici comment :
        </p>
        <ul>
                <li>Choisissez votre faccon d'acheter: </li>
            <li>Choisissez la catégorie</li>
            
            </ul>
    
    </div>        

</div>
    <br><br>
    <?php
   include('footer.php');
   ?>

</body>
</html>
