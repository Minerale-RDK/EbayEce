<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 

    }

    include('../bases/header.php');
?>

    
<body>
    <?php 
            include("../bases/menu.php");
      ?>

<div class="container">
        <div class="row">
        <div class="col-lg-10 col-xl-9 mx-auto" >
        <br><br>      
        <div class="alert alert-success" role="alert">Compte enregistré avec succès. <a href="login.php" class="alert-link">Cliquez ici</a> pour vous connecter</div>
    </div>
    </div>
    </div>
            
</body>
</html>