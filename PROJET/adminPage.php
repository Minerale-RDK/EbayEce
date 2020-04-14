<?php
session_start();

if($_SESSION['statut'] == "membre"){

    header('location : index.php');

}
else{
    echo ' test';
}
?>
<html>
<head>
<title>Connexion</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> <link rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/login.css" />
</head>
<body>
    <p><h1>Bienvenue admin !</h1></p>
</body>
</html>