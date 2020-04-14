<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Ebay ECE</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link rel="stylesheet" type="text/css" href="css/moncompte.css">
</head> 
<body>
   
        <?php 
            include ("menu.php");
        ?>
    
    <div class="contenu">
        <?php 
            echo '<img src="'.$_SESSION['fond'].'" id="entiere" class="img-thumbnail" alt="cover.jpg"> 
            <img src="files/'.$_SESSION['login'].'/avatar.jpg" id="img1" class="img-thumbnail" alt="avatar.jpg">';
        ?>
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

