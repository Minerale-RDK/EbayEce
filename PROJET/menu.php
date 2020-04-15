<?php
        if(!isset($_SESSION)) 
        { 
            session_start(); 

        }
?>

<link rel="stylesheet" type="text/css" href="css/styles.css">

<nav class="navbar navbar-expand-md">
        <?php
            echo '<a class="navbar-brand" href="#">Bonjour  '.$_SESSION['login'].'</a>';
        ?>
        <a class="navbar-brand" href="#">Vendre&ensp;<i class="fa fa-money" aria-hidden="true"></i></a>
        <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#main-navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="main-navigation">

            
                <?php 
                if (isset($_SESSION['statut']) && $_SESSION['statut'] == "membre")
                {
                   echo'<ul class="navbar-nav">
                   <li class="nav-item"><a class="nav-link" href="nouvelitem.php">
                       Votre Compte&ensp; <i class="fa fa-user" aria-hidden="true"></i></a></li>
                   <li class="nav-item"><a class="nav-link">|</a></li>
                   <li class="nav-item"><a class="nav-link" href="#">
                       Panier&ensp; <i class="fa fa-shopping-basket" aria-hidden="true"></i></a></li>
                   <li class="nav-item"><a class="nav-link">|</a></li>
                   <li class="nav-item"><a class="nav-link" href="admin.php">Admin</a></li>
               </ul>';
                }
                elseif(isset($_SESSION['statut']) && $_SESSION['statut'] == "administrateur"){
                    echo '<ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="login.html">
                        Votre Compte&ensp; <i class="fa fa-user" aria-hidden="true"></i></a></li>
                    <li class="nav-item"><a class="nav-link">|</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">
                        Panier&ensp; <i class="fa fa-shopping-basket" aria-hidden="true"></i></a></li>
                    <li class="nav-item"><a class="nav-link">|</a></li>
                    <li class="nav-item"><a class="nav-link" href="adminPage.php">Admin</a></li>
                </ul> ';
                }
                else{
                    echo '<ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="login.html">
                        Votre Compte&ensp; <i class="fa fa-user" aria-hidden="true"></i></a></li>
                    <li class="nav-item"><a class="nav-link">|</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">
                        Panier&ensp; <i class="fa fa-shopping-basket" aria-hidden="true"></i></a></li>
                    <li class="nav-item"><a class="nav-link">|</a></li>
                    <li class="nav-item"><a class="nav-link" href="admin.php">Admin</a></li>
                </ul> ';
                }
                ?>
                 </div>
    </nav>
    <div>
        <a href="index.php"><img src="images/logo.png" class="logo-accueil"></a>
    </div>
    <nav class="navbar navbar-expand-md navbar-light">
        <div class="navbar-second">
            <hr>
            <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Accueil&ensp;<i class="fa fa-home" aria-hidden="true"></i><span class="sr-only">Accueil</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="categorie.html" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Catégories
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="ferraille.html">Ferraille ou Trésor</a>
                <a class="dropdown-item" href="musee.html">Bon pour le Musée</a>
                <a class="dropdown-item" href="accessoire.html">Accessoire VIP&ensp;<i class="fa fa-star" aria-hidden="true"></i></a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="categorie.html">Autres Catégories</a>
                </div>
                </li>
                
                
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="categorie.html" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Achat&ensp;
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="ferraille.html">Les Enchères</a>
                    
                <a class="dropdown-item" href="musee.html">Achetez-le maintenant</a>
                    
                <a class="dropdown-item" href="accessoire.html">Meilleures offres</a>
                
                    </div>
                </li>
                
            <li class="nav-item">
                <a class="nav-link" href="#">Les Meilleures Ventes&ensp;<i class="fa fa-heart" aria-hidden="true"></i></a>
            </li>
        </ul><hr>
        </div>
    </nav>
