<?php

$prenom = isset($_POST["Prénom"])? $_POST["Prénom"] : ""; 
$nom = isset($_POST["Nom"])? $_POST["Nom"] : "";
$login = isset($_POST["Identifiant"])? $_POST["Identifiant"] : "";
$email = isset($_POST["email"])? $_POST["email"] : "";
$pwd = isset($_POST["pwd"])? $_POST["pwd"] : "";
$pwd2 = isset($_POST["pwd2"])? $_POST["pwd2"] : "";
$cgv = isset($_POST["CGV"])? $_POST["CGV"] :"";
$erreur = "";

$database = "ebayece";

$db_handle = mysqli_connect('localhost:3308', 'root', '');
$db_found = mysqli_select_db($db_handle, $database);

$dossier = 'upload/';
$fichier = basename($_FILES['avatar']['name']);
$taille_maxi = 100000;
$taille = filesize($_FILES['avatar']['tmp_name']);
$extensions = array('.png', '.gif', '.jpg', '.jpeg');
$extension = strrchr($_FILES['avatar']['name'], '.'); 

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

if ($erreur == "") {
    $sqlInsert = "INSERT INTO acheteurs (login, pwd, Nom, Prenom, email) VALUES ('$login', '$pwd', '$nom', '$prenom', '$email')";
    $result = mysqli_query($db_handle, $sqlInsert);
    if (!$result){
        die("impossible d ajouter cet enregistrement");
    }
    echo "Votre compte a bien été créer !";
}
    else {
    echo "Erreur : $erreur";
    include('CreationAcheteur.html');
    exit; 
    }

if(isset($_FILES['avatar'])){ 
    $dossier = 'upload/';
    $fichier = basename($_FILES['avatar']['name']);
    if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
    {
        echo 'Upload effectué avec succès !';
    }
    else //Sinon (la fonction renvoie FALSE).
    {
        echo 'Echec de l\'upload !';
    }
}

//Début des vérifications de sécurité...
if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
{
     $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc...';
}
if($taille>$taille_maxi)
{
     $erreur = 'Le fichier est trop gros...';
}
if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
{
     //On formate le nom du fichier ici...
     $fichier = strtr($fichier, 
          'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
          'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
     $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
     if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
     {
          echo 'Upload effectué avec succès !';
     }
     else //Sinon (la fonction renvoie FALSE).
     {
          echo 'Echec de l\'upload !';
     }
}
else
{
     echo $erreur;
}

?>