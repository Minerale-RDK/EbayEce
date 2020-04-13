<?php
session_start();
?>
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
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head> 
<body>
   
        <?php 
            include ("menu.php");
        ?>
       
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="images/1.jpg" alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="images/2.jpg" alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="images/3.jpg" alt="Third slide">
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
    <footer class="page-footer"> 
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12">
                <h6 class="text-uppercase font-weight-bold">Information additionnelle</h6> 
                <p>
                    Blablalalalalalallalalalalalaalallalallalalalallalalalallalaallalal</p>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <h6 class="text-uppercase font-weight-bold">Contact</h6> 
                    <p>
                        Blabla <br> email <br>
                        number <br>
                        number
                    </p> 
                </div>
            </div>
        <div class="footer-copyright text-center">&copy; 2020 Copyright | Droit d'auteur: Paul SENARD | Victor QUIDET | Solène HACOUN</div> 
        </div>
    </footer>
</body>
</html>
