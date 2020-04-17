<?php

if(!isset($_SESSION)) { 
        
    session_start(); 

}

// https://www.youtube.com/watch?v=kkkQoGEzP0w&t=411s

$prenom = isset($_POST["Prénom"])? $_POST["Prénom"] : ""; 
$nom = isset($_POST["Nom"])? $_POST["Nom"] : "";
$login = isset($_POST["Identifiant"])? $_POST["Identifiant"] : "";
$email = isset($_POST["email"])? $_POST["email"] : "";
$pwd = isset($_POST["pwd"])? $_POST["pwd"] : "";
$pwd2 = isset($_POST["pwd2"])? $_POST["pwd2"] : "";
$cgv = isset($_POST["CGV"])? $_POST["CGV"] :"";
$ban = isset($_POST["cover"])? $_POST["cover"] :"";

$erreur = array();

require('../bases/bdd.php');

if($db_found){

    if (!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W)#', $pwd) || strlen($pwd)<8) {

        array_push($erreur, "Le mot de passe n'est pas conforme. Il doit faire au moins 8 caractères et contenir au moins une majuscule, un chiffre et un cractère spécial");

    }  

if ($pwd != $pwd2) {
   array_push($erreur, "Les mots de passes sont différents.");
}

$table_verif = array('acheteurs', 'vendeurs');
$verif = [
    [$login, 'login'],
    [$email, 'email'],
];

foreach($table_verif as &$bdd){

    foreach($verif as list($a, $b)){
        $sql = "SELECT * FROM $bdd ";
        $req = mysqli_query($db_handle, $sql);
        if ($a != "") 
        {
            $sql .= " WHERE $b LIKE '%$a%'";
        }
        $result = mysqli_query($db_handle, $sql);
        //regarder s'il y a de résultat
        if (mysqli_num_rows($result) != 0) 
        {
            array_push($erreur, $a.' est déjà pris. Veuillez choisir un autre '.$b);
        }
    }
}
    

if(!empty($_FILES)){
    $file_name = $_FILES['fichier']['name'];
    $file_extension = strrchr($file_name,".");

    $file_tmp_name = $_FILES['fichier']['tmp_name'];
    $file_dest = '../files/'.$login;

    $extensions_autorisees = array('.jpg', '.jpeg', '.png');

    if($_FILES['fichier']['size']>1000000){
        array_push($erreur, "La taille du fichier est supérieur à 1Mo");
    }
}
    

if (sizeof($erreur) == 0) {
    mkdir($file_dest, 0700);
    $file_dest = $file_dest.'/'.$file_name;
    if(move_uploaded_file($file_tmp_name, $file_dest)){
        $file_name = 'avatar'.$file_extension;
        $new_file_dest ='../files/'.$login.'/'.$file_name;
        rename($file_dest, $new_file_dest);
    }
    $sqlInsert = "INSERT INTO vendeurs(login, pwd, Nom, Prenom, email, name, file_url, cover_url) 
    VALUES ('$login', '$pwd', '$nom', '$prenom', '$email', '$file_name','$new_file_dest','$ban')";
    $result = mysqli_query($db_handle, $sqlInsert);
    if (!$result){
        die("impossible d ajouter cet enregistrement");
    }
    include('validation_compte.php');
    exit; 
}
else {
    foreach($erreur as &$valeur){
        echo '<div class="alert alert-danger" role="alert">Erreur : '.$valeur.'</div>';
    }
    include('CreationVendeur.php');
    exit; 
}
}
?>