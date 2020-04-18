<?php

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    include('../bases/header.php');
    require('boutique.php');
?>
<head>
    <link rel="stylesheet" type="text/css" href="../css/compte.css">

</head> 
<body>
   
        <?php 
            include ("../bases/menu.php");
            $id = $_GET['id'];
            include ("../bases/bdd.php");
            $sql = "SELECT * FROM vendeurs WHERE IDVendeur = '$id'";
            $result = mysqli_query($db_handle, $sql);
            $data = mysqli_fetch_assoc($result);
            $sql2 = "SELECT * FROM items WHERE IDVendeur = $id AND avendre = 0";
            $result2 = mysqli_query($db_handle, $sql2);
        ?>
    
        <br><h1 style="text-align: center">Bienvenue sur le compte vendeur de <?= $data['login']?></h1><br>
        <h4 style="text-align: center">Nombre de ventes réalisées : <?= mysqli_num_rows($result2)?></h4><br>
        <td style="vertical-align:middle;text-align:center;">
        <div style="position:relative;">
         
            <img src="../<?=$data['cover_url']?>" id="cover" class="img-thumbnail" alt="cover.jpg"> 
            <img src="../<?=$data['file_url']?>" id="avatar" class="img-thumbnail" alt="avatar">
        
        </div>
        </td><br>
    <div class="objets">
        <?php

            $sql = "SELECT * FROM items WHERE IDVendeur = $id AND avendre = 1";
            $result = mysqli_query($db_handle, $sql);
            $titre_boutique = 'La Boutique de '.$data['login'].'';
            $titre_historique = 'Les ventes de '.$data['login'].'';
            $msg_erreurh = "Aucun objet vendu";
            $msg_erreurb = "Aucun objet en vente";

            $vendu = 1;

            maboutique($titre_boutique, $msg_erreurb, $result);
            echo '<br><br>';
            maboutique($titre_historique, $msg_erreurh, $result2, $vendu);
        

        
        ?>
    </div>  
<?php
    include('../bases/footer.php');
?>
</body>
</html>

