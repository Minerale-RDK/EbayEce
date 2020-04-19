<?php

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

if($_SESSION['statut'] == "vendeur"){
    $variablesession = $_SESSION['id'];
}
elseif($_SESSION['statut'] == "administrateur"){
    $variablesession = "1";
}
else{
    echo "Merci de vous connecter à un compte vendeur";
    include('../comptes/login.php');
    exit;
}

//fonction de frankbecu trouvée sur frankbecu.unblog.fr

function rrmdir($newdir) {
    if (is_dir($newdir)) { // si le paramètre est un dossier
        $objects = scandir($newdir); // on scan le dossier pour récupérer ses objets
        foreach ($objects as $object) { // pour chaque objet
             if ($object != "." && $object != "..") { // si l'objet n'est pas . ou ..
                  if (filetype($newdir."/".$object) == "dir") rmdir($newdir."/".$object);else unlink($newdir."/".$object); // on supprime l'objet
                 }
        }
        reset($objects); // on remet à 0 les objets
        rmdir($newdir); // on supprime le dossier
        }
    }

$nom = addslashes(isset($_POST["Nom"])? $_POST["Nom"] : "");
$description = addslashes(isset($_POST["description"])? $_POST["description"] : "");
$categorie = isset($_POST["categorie"])? $_POST["categorie"] : "";
$enchere = isset($_POST["enchere"])? $_POST["enchere"] : "";
$meilleurof = isset($_POST["meilleurof"])? $_POST["meilleurof"] : "";
$achatim = isset($_POST["achatim"])? $_POST["achatim"] :"";
$prix = isset($_POST["prix"])? $_POST["prix"] :"";
$date1 = isset($_POST["date1"])? $_POST["date1"] :"";
$erreur = array();
$prix2 = isset($_POST["prix2"])? $_POST["prix2"] :"";


$date2 = strtotime($date1);
$date3 =time();



$avendre = "1";
$avendre1 = (int)$avendre;
$variablesessionint = (int)$variablesession;

require('../bases/bdd.php');


if($_FILES['photo']['name'][0] != "" || $_FILES['photo']['name'][1] != "" || $_FILES['photo']['name'][2] != "" || $_FILES['photo']['name'][3] != ""){
    
    $a =0;
    $timestamp = microtime();
    global $chemindossier;
    $chemindossier = '../files/imgitem/'.$timestamp;
    $file_dest = '../files/imgitem/'.$timestamp;
    mkdir($file_dest, 0700, true);
    $extensions_autorisees = array('.jpg', '.jpeg', '.png', '.PNG','.JPEG','.JPG', '.mp4', '.MP4','.avi','.AVI',';mkv','.MKV');

    for($i = 0; $i < count($_FILES['photo']['name']) ; $i++)
    {   
        if($_FILES['photo']['name'][$i] != "")
        {
        $file_name = $_FILES['photo']['name'][$i];
        $file_tmp_name = $_FILES['photo']['tmp_name'][$i];
        $file_dest = '../files/imgitem/'.$timestamp;
        $newdir = '../files/imgitem/'.$timestamp;
        $file_extension = strrchr($file_name,".");
        $file_dest = $file_dest.'/'.$file_name;


        if(in_array($file_extension, $extensions_autorisees))
        {
            if(move_uploaded_file($file_tmp_name, $file_dest))
            {
                
                if($file_extension == ".jpg" || $file_extension == ".jpeg" || $file_extension == ".png" || $file_extension == ".JPG" || $file_extension == ".JPEG" || $file_extension == ".PNG"){
                    if($_FILES['photo']['size'][$i]>1000000){
                        array_push($erreur, "La taille d'une photo est supérieur à 1Mo");
                        rrmdir($chemindossier);
                    }else{

                        $file_name = 'photo'.$a.$file_extension;
                        $new_file_dest ='../files/imgitem/'.$timestamp.'/'.$file_name;
                        rename($file_dest, $new_file_dest);
                        $a++;

                    }
                }
                else{
                    if($_FILES['photo']['size'][$i]>2000000){
                        array_push($erreur, "La taille de la vidéo est supérieur à 2Mo");
                        rrmdir($chemindossier);
                    }else{
                        $file_name = 'video'.$i.$file_extension;
                        $new_file_dest ='../files/imgitem/'.$timestamp.'/'.$file_name;
                        rename($file_dest, $new_file_dest);
                    }
                    
                }
            }
        }
        else {
            array_push($erreur, "Uniquement les photos jpg, jpeg et png sont acceptées et les vidéos aux formats mp4, avi et mkv");         
            
            rrmdir($newdir); 
        }
    } 
    }   

}
else{
    array_push($erreur, "Merci de mettre au moins une photo ou vidéo");
}
 
    

    if (!empty($enchere) && !empty($meilleurof)) {
    array_push($erreur, "Vous ne pouvez pas choisir enchères et meilleur offre en même temps."); 
   }
    if ($achatim == "achatim" && empty($prix)) {
        array_push($erreur, "Merci d'indiquer un prix d'achat immédiat."); 
   }
  
    if ($enchere == "enchere" && empty($prix2)) {
        array_push($erreur, "Merci d'indiquer un prix d'enchère minimum.");
   } 
    if (!empty($enchere) && empty($date1)) {
        array_push($erreur,"Merci d'indiquer une date de fin pour les enchères.");
    }

    if(!empty($enchere) && !empty($achatim) && !empty($prix2) && !empty($prix))
    {
        if($prix <= $prix2){
            array_push($erreur, "Le prix de l'achat immédiat doit être supérieur à celui de l'enchère");
        }
    }

    if($date1 != "" && $date2 < $date3) {
        array_push($erreur, "La date de fin d'enchere est inférieure à la date actuelle. ");
    }

    if(!empty($achatim) && empty($meilleurof) && empty($enchere)){
        $typevente = "1";
    }

    if(empty($achatim) && empty($meilleurof) && !empty($enchere)){
        $typevente = "2";
    }

    if(empty($achatim) && !empty($meilleurof) && empty($enchere)){
        $typevente = "3";
    }

    if(!empty($achatim) && empty($meilleurof) && !empty($enchere)){
        $typevente = "4";
    }

    if(!empty($achatim) && !empty($meilleurof) && empty($enchere)){
        $typevente = "5";
    }

    if(empty($achatim) && empty($meilleurof) && empty($enchere)){
        array_push($erreur,"Merci de choisir au moins un type de vente ");
    }

    if (!empty($prix) && !is_numeric($prix))
    {
        array_push($erreur, "Merci de saisir un prix valide.");
    }

    if (!empty($prix2) && !is_numeric($prix2))
    {
        array_push($erreur, "Merci de saisir un prix valide.");
    }

    $intvente = (int)$typevente;
    $prix1 = (int)$prix;
    $prix3 = (int)$prix2;

    
  
    if (empty($erreur)) {
        

        
       $sql = "INSERT INTO items (nomitem, description, chemindossier, typevente, prix, categorie, datefin, IDVendeur, avendre, prixench) VALUES ('$nom', '$description', '$chemindossier', '$intvente', '$prix1', '$categorie', '$date2', '$variablesessionint', '$avendre1', '$prix3')";
       $result = mysqli_query($db_handle, $sql);
       if (!$result){
           echo '<div class="alert alert-danger" role="alert"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
           &ensp;impossible d ajouter cet enregistrement, video ou image trop volumineuse</div>';
           rrmdir($chemindossier);
           include('nouvelitem.php');
           exit;
       }
       $sql = "SELECT * FROM items
       ORDER BY IDItem DESC
       LIMIT 1";
       $req = mysqli_query($db_handle, $sql);
       $data = mysqli_fetch_assoc($req);
       echo '<script language="Javascript"> document.location.replace("produit.php?id='.$data['IDItem'].'&valid=1"); </script>';
       exit;
   }
    else {
        foreach($erreur as &$valeur){
            echo '<div class="alert alert-danger" role="alert"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
            &ensp;Erreur : '.$valeur.'</div>';
        }
       rrmdir($chemindossier);
       include('nouvelitem.php');
       exit; 
    }


?>