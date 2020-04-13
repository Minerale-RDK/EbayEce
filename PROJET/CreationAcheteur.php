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
    session_start();
        $_SESSION['login'] = $login;
        $_SESSION['staut'] = "membre";
    echo '<div style="text-align: center";><h1>Votre compte a bien été créer !</h1></div> <br> <div style="text-align: center";><a href="index.php">Retour à lacceuil</a>';
    
    
}
    else {
    echo "Erreur : $erreur";
    include('CreationAcheteur.html');
    exit; 
    }

?>