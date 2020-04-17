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

$nom = isset($_POST["Nom"])? $_POST["Nom"] : "";
$description = isset($_POST["Description"])? $_POST["Description"] : "";
$categorie = isset($_POST["categorie"])? $_POST["categorie"] : "";
$enchere = isset($_POST["enchere"])? $_POST["enchere"] : "";
$meilleurof = isset($_POST["meilleurof"])? $_POST["meilleurof"] : "";
$achatim = isset($_POST["achatim"])? $_POST["achatim"] :"";
$prix = isset($_POST["prix"])? $_POST["prix"] :"";
$date1 = isset($_POST["date1"])? $_POST["date1"] :"";
$erreur = "";
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
                    
                    $file_name = 'photo'.$a.$file_extension;
                    $new_file_dest ='../files/imgitem/'.$timestamp.'/'.$file_name;
                    rename($file_dest, $new_file_dest);
                    //echo $a;
                    $a++;
                    //echo 'Fichier enregistré avec succès<br>';
                }
                else{
                     $file_name = 'video'.$i.$file_extension;
                    $new_file_dest ='../files/imgitem/'.$timestamp.'/'.$file_name;
                    rename($file_dest, $new_file_dest);
                   // echo 'Fichier enregistré avec succès<br>';
                    
                }
            }
            else 
            {
                echo "impossible d ajouter cet enregistrement, video ou image trop volumineuse";
                rrmdir($chemindossier);
                include('nouvelitem.php');
                exit;
            }
        }
        else {
            echo '<strong>Seuls les photos aux formats jpg, jpeg ou png sont acceptées</strong>';

            
            
               rrmdir($newdir); 
            include('nouvelitem.php');
            
            exit;
        }
    } 
    }   

}
else{
    echo "Merci de mettre au moins une photo ou vidéo";
    include('nouvelitem.php');
    exit;
}
 
    

    if (!empty($enchere) && !empty($meilleurof)) {
    $erreur .= "Vous ne pouvez pas choisir enchères et meilleur offre en même temps. <br>"; 
   }
    if ($achatim == "achatim" && empty($prix)) {
       $erreur .= "Merci d'indiquer un prix d'achat immédiat. <br>"; 
   }
  
    if ($enchere == "enchere" && empty($prix2)) {
       $erreur .= "Merci d'indiquer un prix d'enchère minimum. <br>";
   } 
    if (!empty($enchere) && empty($date1)) {
    $erreur .= "Merci d'indiquer une date de fin pour les enchères. <br>";
    }

    if($date1 != "" && $date2 < $date3) {
        $erreur .= "La date de fin d'enchere est inférieure à la date actuelle. <br>";
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
        $erreur .= "Merci de choisir au moins un type de vente <br>";
    }

    if (!empty($prix) && !is_numeric($prix))
    {
        $erreur .= "Merci de saisir un prix valide.<br>";
    }

    if (!empty($prix2) && !is_numeric($prix2))
    {
        $erreur .= "Merci de saisir un prix valide.<br>";
    }

    $intvente = (int)$typevente;
    $prix1 = (int)$prix;
    $prix3 = (int)$prix2;

    
  
    if ($erreur == "") {
        

        
       $sql = "INSERT INTO items (nomitem, description, chemindossier, typevente, prix, categorie, datefin, IDVendeur, avendre, prixench) VALUES ('$nom', '$description', '$chemindossier', '$intvente', '$prix1', '$categorie', '$date2', '$variablesessionint', '$avendre1', '$prix3')";
       $result = mysqli_query($db_handle, $sql);
       if (!$result){
           echo "impossible d ajouter cet enregistrement, video ou image trop volumineuse";
           rrmdir($chemindossier);
           include('nouvelitem.php');

       }

       echo '<div style="text-align: center";><h1>L\'item a bien été mis en vente !</h1></div> <br> <div style="text-align: center";><a href="../bases/index.php">Retour à lacceuil</a>';     
   }
       else {
       echo "Erreur : $erreur";
       rrmdir($chemindossier);
       include('nouvelitem.php');
       exit; 
       }


?>