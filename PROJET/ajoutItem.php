<?php

$nom = isset($_POST["Nom"])? $_POST["Nom"] : "";
$description = isset($_POST["Description"])? $_POST["Description"] : "";
$categorie = isset($_POST["categorie"])? $_POST["categorie"] : "";
$enchere = isset($_POST["enchere"])? $_POST["enchere"] : "";
$meilleurof = isset($_POST["meilleurof"])? $_POST["meilleurof"] : "";
$vip = isset($_POST["vip"])? $_POST["vip"] :"";
$prix = isset($_POST["prix"])? $_POST["prix"] :"";
$erreur = "";

$database = "ebayece";

$db_handle = mysqli_connect('localhost:3308', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);



if($_FILES['photo']['name'][0] != "" || $_FILES['photo']['name'][1] != "" || $_FILES['photo']['name'][2] != "" || $_FILES['photo']['name'][3] != ""){
    
    
    $timestamp = microtime();
    $file_dest = 'files/imgitem/'.$timestamp;
    mkdir($file_dest, 0700, true);
    $extensions_autorisees = array('.jpg', '.jpeg', '.png', '.PNG','.JPEG','.JPG', '.mp4', '.MP4','.avi','.AVI',';mkv','.MKV');

    for($i = 0; $i < count($_FILES['photo']['name']) ; $i++)
    {   
        if($_FILES['photo']['name'][$i] != "")
        {
        $file_name = $_FILES['photo']['name'][$i];
        $file_tmp_name = $_FILES['photo']['tmp_name'][$i];
        $file_dest = 'files/imgitem/'.$timestamp;
        $newdir = 'files/imgitem/'.$timestamp;
        $file_extension = strrchr($file_name,".");
        $file_dest = $file_dest.'/'.$file_name;

        //echo $_FILES['photo']['name'][$i];
        //echo $file_extension;
        if(in_array($file_extension, $extensions_autorisees))
        {
            if(move_uploaded_file($file_tmp_name, $file_dest))
            {
                $file_name = 'photo'.$i.$file_extension;
                $new_file_dest ='files/imgitem/'.$timestamp.'/'.$file_name;
                rename($file_dest, $new_file_dest);
                echo 'Fichier enregistré avec succès<br>';
            }
            else 
            {
                echo "il y a un pb";
            }
        }
        else {
            echo '<strong>Seuls les photos aux formats jpg, jpeg ou png sont acceptées</strong>';

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
               rrmdir($newdir); 
            include('nouvelitem.php');
            
            exit;
        }
    } 
    }   

}
else{
    echo "Merci de mettre au moins une photo ou vidéo";
}


?>