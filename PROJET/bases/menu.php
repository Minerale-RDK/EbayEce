<?php
        if(!isset($_SESSION)) 
        { 
            session_start(); 

        }
        include(''.$_SERVER['DOCUMENT_ROOT'].'/PROJET/bases/scriptencheres.php');
?>

<link rel="stylesheet" type="text/css" href="/PROJET/css/styles.css"> 

<nav class="navbar navbar-expand-md">
        <?php
        if (isset($_SESSION['login']))
        {
            echo '<a class="navbar-brand">Bonjour  <strong>'.$_SESSION['login'].'</strong></a>';
        }
        else{
            echo '<a class="navbar-brand">Bonjour</a>';
        }           
        ?>
        <?php
        if (isset($_SESSION['statut']) && $_SESSION['statut'] == "acheteur")
        {
            echo '<a class="navbar-brand" href="../comptes/login.php">Vendre&ensp;<i class="fa fa-money" aria-hidden="true"></i></a>
            <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#main-navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="main-navigation">';
        }
        elseif(isset($_SESSION['statut']) && $_SESSION['statut'] == "administrateur")
        {
            echo '<a class="navbar-brand" href="../items/nouvelitem.php">Vendre&ensp;<i class="fa fa-money" aria-hidden="true"></i></a>
            <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#main-navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="main-navigation">';
        }
        elseif (isset($_SESSION['statut']) && $_SESSION['statut'] == "vendeur")
        {
            echo '<a class="navbar-brand" href="../items/nouvelitem.php">Vendre&ensp;<i class="fa fa-money" aria-hidden="true"></i></a>
            <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#main-navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="main-navigation">';
        }
        else{
            echo '<a class="navbar-brand" href="../comptes/login.php">Vendre&ensp;<i class="fa fa-money" aria-hidden="true"></i></a>
            <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#main-navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="main-navigation">';
        }
        ?>


            
                <?php 
                if (isset($_SESSION['statut']) && $_SESSION['statut'] == "acheteur")
                {
                   echo'<ul class="navbar-nav">
                   <li class="nav-item"><a class="nav-link" href="#">
                       Votre Compte&ensp; <i class="fa fa-user" aria-hidden="true"></i></a></li>
                   <li class="nav-item"><a class="nav-link">|</a></li>
                   <li class="nav-item"><a class="nav-link" href="../items/panier.php">
                       Panier&ensp; <i class="fa fa-shopping-basket" aria-hidden="true"></i></a></li>
                   <li class="nav-item"><a class="nav-link">|</a></li>
                   <li class="nav-item"><a class="nav-link" href="../comptes/admin.php">Admin</a></li>
               </ul>';
                }
                elseif(isset($_SESSION['statut']) && $_SESSION['statut'] == "administrateur"){
                    echo '<ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="../comptes/adminPage.php">
                        Votre Compte&ensp; <i class="fa fa-user" aria-hidden="true"></i></a></li>
                    <li class="nav-item"><a class="nav-link">|</a></li>
                    <li class="nav-item"><a class="nav-link" href="../comptes/adminPage.php">Admin</a></li>
                </ul> ';
                }
                elseif (isset($_SESSION['statut']) && $_SESSION['statut'] == "vendeur")
                {
                   echo'<ul class="navbar-nav">
                   <li class="nav-item"><a class="nav-link" href="../comptes/moncompte.php">
                       Votre Compte&ensp; <i class="fa fa-user" aria-hidden="true"></i></a></li>
                   <li class="nav-item"><a class="nav-link">|</a></li>
                   <li class="nav-item"><a class="nav-link" href="../comptes/admin.php">Admin</a></li>
               </ul>';
                }
                else{
                    echo '<ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="../comptes/login.php">
                        Se Connecter&ensp; <i class="fa fa-user" aria-hidden="true"></i></a></li>
                    <li class="nav-item"><a class="nav-link">|</a></li>
                    <li class="nav-item"><a class="nav-link" href="../comptes/login.php">
                        Panier&ensp; <i class="fa fa-shopping-basket" aria-hidden="true"></i></a></li>
                    <li class="nav-item"><a class="nav-link">|</a></li>
                    <li class="nav-item"><a class="nav-link" href="../comptes/admin.php">Admin</a></li>
                </ul> ';
                }
                ?>
                 </div>
    </nav>
    <div>
        <a href="/PROJET/bases/index.php"><img src="/PROJET/images/logo.png" class="logo-accueil"></a>
    </div>
    <nav class="navbar navbar-expand-md navbar-light">
        <div class="navbar-second">
            <hr>
            <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="../bases/index.php">Accueil&ensp;<i class="fa fa-home" aria-hidden="true"></i><span class="sr-only">Accueil</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle"  id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Catégories
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="../items/articles?cat=FoT">Ferraille ou Trésor</a>
                <a class="dropdown-item" href="../items/articles?cat=BpM">Bon pour le Musée</a>
                <a class="dropdown-item" href="../items/articles?cat=vip">Accessoire VIP&ensp;<i class="fa fa-star" aria-hidden="true"></i></a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="categorie.html">Autres Catégories</a>
                </div>
                </li>
                
                
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="categorie.html" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Achat&ensp;
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="../items/articles?cat=ench">Les Enchères</a>
                    
                <a class="dropdown-item" href="../items/articles?cat=atim">Achetez-le maintenant</a>
                    
                <a class="dropdown-item" href="../items/articles?cat=mof">Meilleures offres</a>
                
                    </div>
                </li>
                
            <li class="nav-item">
                <a class="nav-link" href="#">Les Meilleures Ventes&ensp;<i class="fa fa-heart" aria-hidden="true"></i></a>
            </li>
        </ul><hr>
        </div>
    </nav>
