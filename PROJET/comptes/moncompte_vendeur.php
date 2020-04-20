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
            include ("../bases/menu_comptevendeur.php");
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


    <div class="objets"><br><br>
        <?php

        $sql = "SELECT * FROM items WHERE IDVendeur = $id AND avendre = 1";
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
        echo '<br><br>';

        $sql = "SELECT * FROM meilleuroffre WHERE IDVendeur = $id AND accepte = 0 AND nbtry<11";
        $result = mysqli_query($db_handle, $sql);

        $titre = "Mes négociations en cours";
        $msg_erreurb = "Aucune négotiation en cours";

        $vendu = 3;

        if(mysqli_num_rows($result) == 0){

            maboutique($titre, $msg_erreurb, $result);

        }else {
            $i=4;
            $id_item = array();

            while ($data = mysqli_fetch_assoc($result)) {
                array_push($id_item, array($data['IDItem'], $data['tour'], $data['IDAcheteur'],$data['prixprop']));
            }
            $id_verif = array();
            foreach($id_item as list($a, $b, $c, $prix)){
                $sql = "SELECT * FROM items WHERE IDItem = $a AND avendre = 1";
                $result = mysqli_query($db_handle, $sql);
                if(mysqli_num_rows($result) != 0){

                    $sql2 = "SELECT login FROM acheteurs WHERE IDAcheteur = $c";
                    $result = mysqli_query($db_handle, $sql2);
                    $data = mysqli_fetch_assoc($result);
                    array_push($id_verif, array($a ,$b, $c, $prix, $data['login'] ));
            
                }
            }
            if(sizeof($id_verif) == 0){

                maboutique($titre, $msg_erreurb, $result);

            }else{
            echo '<h1 style="margin-left: 15px;">'.$titre.' ('.sizeof($id_verif) .')</h1><br>';
            $nbr = sizeof($id_verif);
            foreach($id_verif as list($a, $b, $c, $prix, $login)){
                $sql = "SELECT * FROM items WHERE IDItem = $a AND avendre = 1";
                $result = mysqli_query($db_handle, $sql);
                $data = mysqli_fetch_assoc($result);

                if ($i%4 == 0){

                    echo '<div class="card-deck">';
                    item($data, $vendu, $b ,$login ,$c, $prix);
                            
                }
                else{
                    
                    item($data, $vendu, $b ,$login ,$c ,$prix);

                }
                $i++;
                $nbr = $nbr - 1;
                if($nbr == 0 || $i%4 == 0){
                    echo '</div><br>';
                }
                

            }

            }

        }

        echo '<br><br>';

    $sql = "SELECT * FROM meilleuroffre WHERE IDVendeur = $id AND accepte = 1";
    $result = mysqli_query($db_handle, $sql);
    $sql2 = "SELECT * FROM encheres WHERE IDVendeur = $id AND win = 1";
    $result2 = mysqli_query($db_handle, $sql);

    $id_item = array();
    $id_b = array();

    while ($data2 = mysqli_fetch_assoc($result2)) {
        $idacht = $data2['IDAcheteur'];
        $idd = $data2['IDItem'];
        $sql = "SELECT * FROM items WHERE IDItem = $idd AND avendre = 2";
        $result = mysqli_query($db_handle, $sql);
        if(mysqli_num_rows($result) != 0){
            $data = mysqli_fetch_assoc($result);
            array_push($id_b, array($data['IDItem']), $data['IDAcheteur']);
        }
    }

    $titre = "En attente du paiement de l'acheteur";



    if(mysqli_num_rows($result) != 0 || sizeof(id_b) != 0){

        $i=4;

        while ($data = mysqli_fetch_assoc($result)) {
            $idacht = $data['IDAcheteur'];
            $sql2 = "SELECT * FROM acheteurs WHERE IDAcheteur = $idacht";
            $result = mysqli_query($db_handle, $sql2);
            $data2 = mysqli_fetch_assoc($result);
            array_push($id_item, array($data['IDItem'], $data2['login'], 1));
        }
        foreach ($id_b as list($a, $b)){
            $sql = "SELECT * FROM acheteurs WHERE IDAcheteur = $b";
            $result = mysqli_query($db_handle, $sql);
            $data = mysqli_fetch_assoc($result);
            array_push($id_item, array($a, $data['login'], 2));
        }

        echo '<h1 style="margin-left: 15px;">'.$titre.' ('.sizeof($id_item).')</h1><br>';
        $nbr = sizeof($id_item);
        foreach($id_item as list($a, $login, $type)){
            $sql = "SELECT * FROM items WHERE IDItem = $a AND avendre = $type";
            $result = mysqli_query($db_handle, $sql);

            $data = mysqli_fetch_assoc($result);

            if($type == 1){$vendu = 3;}
            if($type == 2){$vendu = 4;}

            $b=3;

            if ($i%4 == 0){

                echo '<div class="card-deck">';
                item($data, $vendu, $b, $login);
                        
            }
            else{
                
                item($data, $vendu, $b, $login);

            }
            $i++;
            $nbr = $nbr - 1;
            if($nbr == 0 || $i%4 == 0){
                echo '</div><br>';
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

