<?php

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    include('../bases/header.php');
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
        <br><h1 style="text-align: center">Nombre de ventes réaliséee : <?= mysqli_num_rows($result2)?></h1><br>
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
            $i=4;
            $nbr=mysqli_num_rows($result);
    
            echo '<h2>   La Boutique '.$data['login'].' - '.$nbr;
            if($nbr<2){echo ' produit en vente</h2><br>';}else{echo ' produits en vente</h2><br>';}
        
        
        
        
        if ($nbr == 0) {
            echo "Aucun produit en vente";
        } 
        else 
        {
            while ($data = mysqli_fetch_assoc($result)) 
            {
                if ($i%4 == 0){
                    echo '<div class="card-deck"><div class="card" style="max-width: 25%;">
                    <div class="card-img-top">
                    <a href="../items/produit.php?id='.$data['IDItem'].'">
                    <img src="'.$data['chemindossier'].'/photo0.jpg"  class="img-thumbnail" >
                    </a>
                    </div>
                    <div class="card-body">
                    <h5 class="card-title">'.$data['nomitem'].'</h5>
                    <p class="card-text">Description : '.$data['description'].'</p>
                    </div>
                    <div class="card-footer">
                    <small class="text-muted">Catégorie : '.$data['categorie'].'</small>
                    </div></div>';
                            
                }
                elseif(($i-1)%4 == 0){
                    echo '<div class="card" style="max-width: 25%;">
                    <div class="card-img-top">
                    <a href="../items/produit.php?id='.$data['IDItem'].'">
                    <img src="'.$data['chemindossier'].'/photo0.jpg"  class="img-thumbnail" >
                    </a>
                    </div>
                    <div class="card-body">
                    <h5 class="card-title">'.$data['nomitem'].'</h5>
                    <p class="card-text">Description : '.$data['description'].'</p>
                    </div>
                    <div class="card-footer">
                    <small class="text-muted">Catégorie : '.$data['categorie'].'</small>
                    </div></div>';
                }
                elseif(($i-2)%4 == 0){
                    echo '<a href="../items/produit.php?id='.$data['IDItem'].'"><div class="card" style="max-width: 25%;">
                    <div class="card-img-top">
                    <a href="../items/produit.php?id='.$data['IDItem'].'">
                    <img src="'.$data['chemindossier'].'/photo0.jpg"  class="img-thumbnail" >
                    </a>
                    </div>
                    <div class="card-body">
                    <h5 class="card-title">'.$data['nomitem'].'</h5>
                    <p class="card-text">Description : '.$data['description'].'</p>
                    </div>
                    <div class="card-footer">
                    <small class="text-muted">Catégorie : '.$data['categorie'].'</small>
                    </div></div>';
                }
                else{
                    echo '<div class="card" style="max-width: 25%;">
                    <div class="card-img-top">
                    <a href="../items/produit.php?id='.$data['IDItem'].'">
                    <img src="'.$data['chemindossier'].'/photo0.jpg"  class="img-thumbnail" >
                    </a>
                    </div>
                    <div class="card-body">
                    <h5 class="card-title">'.$data['nomitem'].'</h5>
                    <p class="card-text">Description : '.$data['description'].'</p>
                    </div>
                    <div class="card-footer">
                    <small class="text-muted">Catégorie : '.$data['categorie'].'</small>
                    </div></div>';
                }
                $i++;
                $nbr = $nbr - 1;
                if($nbr == 0 || $nbr%4 == 0){
                    echo '</div>';
                }
                
            }  
                
        }

        
        ?>
    </div>  
<?php
    include('../bases/footer.php');
?>
</body>
</html>

