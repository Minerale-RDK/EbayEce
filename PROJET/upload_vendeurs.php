<?php

$prenom = isset($_POST["Prénom"])? $_POST["Prénom"] : ""; 
$nom = isset($_POST["Nom"])? $_POST["Nom"] : "";
$login = isset($_POST["Identifiant"])? $_POST["Identifiant"] : "";
$email = isset($_POST["email"])? $_POST["email"] : "";
$pwd = isset($_POST["pwd"])? $_POST["pwd"] : "";
$pwd2 = isset($_POST["pwd2"])? $_POST["pwd2"] : "";
$cgv = isset($_POST["CGV"])? $_POST["CGV"] :"";
$ban = isset($_POST["cover"])? $_POST["cover"] :"";

$erreur = "";

$database = "ebayece";

$db_handle = mysqli_connect('localhost:3308', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

if($db_found){


 if ($prenom == "") { 
 $erreur .= "Prénom est vide. <br>";
 }
 if ($nom == "") {
 $erreur .= "Nom est vide. <br>"; 
}
 if ($cgv =="") {
     $erreur .= "Merci d'accepter les conditions générales de ventes. <br>";
 }
 if ($login == "") {
 $erreur .= "Identifiant est vide. <br>"; 
}
 if ($email == "") {
 $erreur .= "E-mail est vide. <br>"; 
}
 if ($pwd == "") {
    $erreur .= "Mot de passe est vide. <br>"; 
}
}
if ($pwd != $pwd2) {
    $erreur .= "Les mots de passes sont différents. <br>";
}

if(!empty($_FILES)){
    $file_name = $_FILES['fichier']['name'];
    $file_extension = strrchr($file_name,".");

    $file_tmp_name = $_FILES['fichier']['tmp_name'];
    $file_dest = 'files/'.$login;
    if ($login != ""){
        mkdir($file_dest, 0700);
        $file_dest = $file_dest.'/'.$file_name;
    }

    $extensions_autorisees = array('.jpg', '.jpeg', '.png');

    if(in_array($file_extension, $extensions_autorisees)){
        if(move_uploaded_file($file_tmp_name, $file_dest)){
            $file_name = 'avatar'.$file_extension;
            $new_file_dest ='files/'.$login.'/'.$file_name;
            rename($file_dest, $new_file_dest);
            echo 'Fichier enregistré avec succès<br>';
        }
    } else {
        echo '<strong>Seuls les photos aux formats jpg, jpeg ou png sont acceptées</strong>';
        include('CreationVendeur.php');
        exit;
    }
    
} else {
    echo "Erreur : Vous devez mettre une photo pour votre avatar";
    include('CreationVendeur.php');
    exit; 
}

if ($erreur == "") {
    $sqlInsert = "INSERT INTO vendeurs(login, pwd, Nom, Prenom, email, name, file_url, cover_url) 
    VALUES ('$login', '$pwd', '$nom', '$prenom', '$email', '$file_name','$new_file_dest','$ban')";
    $result = mysqli_query($db_handle, $sqlInsert);
    if (!$result){
        die("impossible d ajouter cet enregistrement");
    }
    echo 'Compte enregistré avec succès';
}
else {
    echo "Erreur : $erreur";
    include('CreationVendeur.php');
    exit; 
}

?>