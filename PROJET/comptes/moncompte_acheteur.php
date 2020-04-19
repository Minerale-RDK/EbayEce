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

    $titre = "Mes négociations réussies à payer";

    $vendu = 2;

    if(mysqli_num_rows($result) != 0){

        $i=4;
        $id_item = array();

        while ($data = mysqli_fetch_assoc($result)) {
            array_push($id_item, array($data['IDItem']));
        }
        echo '<h1 style="margin-left: 15px;">'.$titre.' ('.sizeof($id_item).')</h1><br>';
        foreach($id_item as &$a){
            $sql = "SELECT * FROM items WHERE IDItem = $a AND avendre = 1";
            $result = mysqli_query($db_handle, $sql);

            $data = mysqli_fetch_assoc($result);

            $b=3;

            if ($i%4 == 0){

                echo '<div class="card-deck">';
                item($data, $vendu, $b);
                        
            }
            else{
                
                item($data, $vendu, $b);

            }
            $i++;
            $nbr = $nbr - 1;
            if($nbr == 0 || $nbr%4 == 0){
                echo '</div>';
            }
        }
    }

            echo '<br><br>';

    $sql = "SELECT * FROM meilleuroffre WHERE IDAcheteur = $id AND accepte = 0 AND nbtry<11";
    $result = mysqli_query($db_handle, $sql);

    $titre = "Mes négociations en cours";
    $msg_erreurb = "Aucune négotiation en cours";

    $vendu = 2;

    if(mysqli_num_rows($result) == 0){

        maboutique($titre, $msg_erreurb, $result);

    }else {
        $i=4;
        $id_item = array();

        while ($data = mysqli_fetch_assoc($result)) {
            array_push($id_item, array($data['IDItem'], $data['tour']));
        }
        $id_verif = array();
        foreach($id_item as list($a, $b)){
            $sql = "SELECT * FROM items WHERE IDItem = $a AND avendre = 1";
            $result = mysqli_query($db_handle, $sql);
            if(mysqli_num_rows($result) != 0){

                array_push($id_verif, array($a, $b));
        
            }
        }
        if(sizeof($id_verif) == 0){

            maboutique($titre, $msg_erreurb, $result);
    
        }else{
        echo '<h1 style="margin-left: 15px;">'.$titre.' ('.sizeof($id_verif) .')</h1><br>';
        foreach($id_verif as list($a, $b)){
            $result = mysqli_query($db_handle, $sql);
            $data = mysqli_fetch_assoc($result);

            if ($i%4 == 0){

                echo '<div class="card-deck">';
                item($data, $vendu, $b);
                        
            }
            else{
                
                item($data, $vendu, $b);

            }
            $i++;
            $nbr = $nbr - 1;
            if($nbr == 0 || $nbr%4 == 0){
                echo '</div>';
            }

        }

        }

    }

    

    include ("../bases/footer.php");
?>

</body>