<?php
session_start();

if($_SESSION['statut'] == "membre"){

    header('location : ../index.php');

}
else{
    echo ' test';
}

include ('../bases/header.php');
?>

<body>
    <p><h1>Bienvenue admin !</h1></p>
</body>
</html>