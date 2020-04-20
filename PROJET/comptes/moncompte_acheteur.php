<?php

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    include("../bases/header.php");
    require('boutique.php');
    include ("../bases/menu.php");
    include ("../bases/bdd.php");

    $id = $_SESSION['id'];
    $sql = "SELECT * FROM items WHERE IDAcheteur = $id";
    $result = mysqli_query($db_handle, $sql);
    $solde = 0;
    while ($data = mysqli_fetch_assoc($result)) {
        $solde += $data['prix'];
    }
?>

<body>

<br><h1 style="text-align: center"> Bienvenue sur votre compte <?= $_SESSION['login']?></h1><br>
<h4 style="text-align: center">Nombre d'achats réalisés : <?= mysqli_num_rows($result)?></h4><br>
<h4 style="text-align: center"> Dépenses totales : <?= $solde?> €</h3><br><br><br>

<?php

    $result = mysqli_query($db_handle, $sql);

    $titre_boutique = "Mes achats réalisés";
    $msg_erreurb = "Aucun objet n'a été acheté";

    $vendu =1;

    maboutique($titre_boutique, $msg_erreurb, $result, $vendu);

    echo '<br><br>';

    $sql = "SELECT * FROM meilleuroffre WHERE IDAcheteur = $id AND accepte = 1";
    $result = mysqli_query($db_handle, $sql);

    $sql2 = "SELECT * FROM encheres WHERE IDAcheteur = $id AND win = 1";
    $result2 = mysqli_query($db_handle, $sql2);

    $titre = "Mes négociations réussies à payer";


    if(mysqli_num_rows($result) != 0 || mysqli_num_rows($result2) != 0){

        $i=4;
        $id_item = array();

        while ($data = mysqli_fetch_assoc($result)) {
            array_push($id_item, array($data['IDItem'], 1));
        }
        while ($data2 = mysqli_fetch_assoc($result2)) {
            $sql = "SELECT * FROM items WHERE IDItem = $a AND avendre = 2";
            $result = mysqli_query($db_handle, $sql);
            $data = mysqli_fetch_assoc($result);
            array_push($id_item, array($data['IDItem'], 2));
        }
        $nbr = sizeof($id_item);
        echo '<h1 style="margin-left: 15px;">'.$titre.' ('.sizeof($id_item).')</h1><br>';
        foreach($id_item as list($a, $type)){
 
            $sql = "SELECT * FROM items WHERE IDItem = $a AND avendre = $type";
            $result = mysqli_query($db_handle, $sql);
            $data = mysqli_fetch_assoc($result);
            if($type == 1){$vendu = 2;}
            if($type == 2){$vendu = 4;}

            if ($i%4 == 0){

                echo '<div class="card-deck">';
                item($data, $vendu, 3);
                        
            }
            else{
                
                item($data, $vendu, 3);

            }
            $i++;
            $nbr = $nbr - 1;
            if($nbr == 0 || $i%4 == 0){
                echo '</div><br>';
            }
        }
    }

            echo '<br><br>';

    $sql = "SELECT * FROM meilleuroffre WHERE IDAcheteur = $id AND accepte = 0 AND nbtry<11";
    $result = mysqli_query($db_handle, $sql);
    $sql2 = "SELECT * FROM encheres WHERE IDAcheteur = $id ";
    $result2 = mysqli_query($db_handle, $sql2);

    $titre = "Mes négociations en cours";
    $msg_erreurb = "Aucune négotiation en cours";


    if(mysqli_num_rows($result) == 0 && mysqli_num_rows($result2) == 0){

        maboutique($titre, $msg_erreurb, $result);

    }else {
        $i=4;
        $id_item_ench = array();

        while ($data = mysqli_fetch_assoc($result)) {
            array_push($id_item, array($data['IDItem'], $data['tour'], $data['prixprop']));
        }
        while ($data = mysqli_fetch_assoc($result2)) {
            array_push($id_item_ench, array($data['IDItem'], $data['win'], $data['prixench']));
        }
        $id_verif = array();
        foreach($id_item as list($a, $b, $prix)){
            $sql = "SELECT * FROM items WHERE IDItem = $a AND avendre = 1";
            $result = mysqli_query($db_handle, $sql);
            if(mysqli_num_rows($result) != 0){

                array_push($id_verif, array($a, $b, $prix, "offre"));
        
            }
        }
        foreach($id_item_ench as list($a, $b, $prix)){
            $sql = "SELECT * FROM items WHERE IDItem = $a AND avendre = 1";
            $result = mysqli_query($db_handle, $sql);
            if(mysqli_num_rows($result) != 0){

                array_push($id_verif, array($a, $b, $prix, "ench"));
        
            }
        }
        if(sizeof($id_verif) == 0){

            maboutique($titre, $msg_erreurb, $result);
    
        }else{
        echo '<h1 style="margin-left: 15px;">'.$titre.' ('.sizeof($id_verif) .')</h1><br>';
        $nbr = sizeof($id_verif);
        foreach($id_verif as list($a, $b, $prix, $type)){
            if($type == "offre"){

                $vendu = 2;

            }elseif($type == "ench"){

                $vendu = 4;

            }

            $sql = "SELECT * FROM items WHERE IDItem = $a AND avendre = 1";
            $result = mysqli_query($db_handle, $sql);
            $data = mysqli_fetch_assoc($result);

            if ($i%4 == 0){

                echo '<div class="card-deck">';
                item($data, $vendu, $b, "", 0,$prix);
                        
            }
            else{
                
                item($data, $vendu, $b ,"", 0,$prix);

            }
            $i++;
            $nbr = $nbr - 1;
            if($nbr == 0 || $i%4 == 0){
                echo '</div><br>';
            }

        }

        }

    }

    

    include ("../bases/footer.php");
?>

</body>