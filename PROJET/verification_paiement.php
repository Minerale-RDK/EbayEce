<?php

if(!isset($_SESSION)) { 
        
    session_start(); 

}

$num = isset($_POST["num"]) ? $_POST["num"] : "";
$nom = isset($_POST["nom"]) ? $_POST["nom"] : "";
$mois = isset($_POST["mois"]) ? $_POST["mois"] : "";
$annee = isset($_POST["annee"]) ? $_POST["annee"] : "";
$cvv = isset($_POST["cvv"]) ? $_POST["cvv"] : "";
$type = isset($_POST["type"]) ? $_POST["type"] : "";


$database = "ebayece";

$verification = [
    [$num, 'Numero'],
    [$nom, 'Nom'],
    [$mois, 'Mois'], 
    [$annee, 'Annee'], 
    [$cvv, 'CVV'], 
    [$type, 'Type'],
];

$db_handle = mysqli_connect('localhost:3308', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

if ($db_found)
{
    $sql = "SELECT * FROM cartes ";
    $req = mysqli_query($db_handle, $sql);
    $data = mysqli_fetch_assoc($req);

    if ($num != "") 
    {
        $sql .= " WHERE Numero LIKE '%$num%'";
    }
    
    $result = mysqli_query($db_handle, $sql);
    //regarder s'il y a de résultat
    if (mysqli_num_rows($result) == 0) 
    {
        if(is_numeric($num)) {
            echo '<div class="alert alert-danger" role="alert">Carte de crédit non trouvée</div>';
            include('carte_credit.php');
            exit;
        }
        else{
            echo '<div class="alert alert-danger" role="alert">
            Le numéro de la carte doit <strong>uniquement</strong> comporté des chiffres et sans espaces</div>';
            include('carte_credit.php');
            exit;
        }

    } 
    $erreur = array() ;
    foreach ($verification as list($a, $b)) {
        if($a != $data[$b])
        {
            array_push($erreur, $b);
        }
    }
    if($erreur !=  array())
    {
        foreach($erreur as &$value){
            echo '<div class="alert alert-danger" role="alert">'.$value.' n\'est pas valide </div>';
        } 
        include('carte_credit.php');
        exit;
    }
    else{
        include('validation_paiement.php');
        echo '<div class="container">
        <div class="row">
        <div class="col-lg-10 col-xl-9 mx-auto" >
              
              
                <div class="card-body" ><div class="alert alert-success" role="alert">
        <h4 class="alert-heading">Paiement effectué avec succès !</h4>
        <p>Votre item vous appartient dorénavant ! Vous le recevrez d\'ici peu à votre adresse.</p>
        <hr>
        <p class="mb-0">Solde restant sur la carte : '.$data['Argent'].' €</p>
        
        </div>
        </div>
        <br><br>
        <img src="images/livraison.gif" style="margin-left=20px;">
    </div>
    </div>
    </div>';
        exit();
    }

}
else {
    echo '<div class="alert alert-danger" role="alert"> Vous avez oublié un champ.</div>';
    include('carte_credit.php');
    exit;
}

?>