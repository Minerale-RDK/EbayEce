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
            include ("../bases/bdd.php");
            $id = $_SESSION['id'];
            $sql2 = "SELECT * FROM items WHERE IDVendeur = $id AND avendre =0";
            $result2 = mysqli_query($db_handle, $sql2);
            $solde = 0;
            while ($data2 = mysqli_fetch_assoc($result2)) {
                $solde += $data2['prix'];
            }
        ?>
    
    <br><h1 style="text-align: center"> Bienvenue sur votre compte</h1><br>
    <h4 style="text-align: center">Nombre de ventes réalisées : <?= mysqli_num_rows($result2)?></h4><br>
    <h4 style="text-align: center"> Mon solde : <?= $solde?> €</h3><br>
    <td style="vertical-align:middle;text-align:center;">
        <div style="position:relative;">
        <?php 
            echo '<img src="../'.$_SESSION['fond'].'" id="cover" class="img-thumbnail" alt="cover.jpg"> 
            <img src="../'.$_SESSION['avatar'].'" id="avatar" class="img-thumbnail" alt="avatar">';
        ?>
    </td>
    </div>
    <div class="objets"><br><br>
        <?php

        $sql = "SELECT * FROM items WHERE IDVendeur = $id AND avendre = 1";
        $sql2 = "SELECT * FROM items WHERE IDVendeur = $id AND avendre =0";
        $result2 = mysqli_query($db_handle, $sql2);
        $result = mysqli_query($db_handle, $sql);
        $titre_boutique = "Mes objets en ventes";
        $titre_historique = "Mes objets vendus";
        $msg_erreurh = "Aucun objet vendu";
        $msg_erreurb = "Aucun objet en vente";

        $vendu =1;

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

