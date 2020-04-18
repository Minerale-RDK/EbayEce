<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 

    }
    include('../bases/header.php');
?>

<body>

    <?php 
        include ("../bases/menu.php");
        $id = $_GET['id'];

        require('../bases/bdd.php');


    if ($db_found)  
    {
        $ids = array_keys($_SESSION['panier']);
        echo $ids;
        $sql = "SELECT * FROM items WHERE IDItem = '$ids'";
        $req = mysqli_query($db_handle, $sql);

        $data = mysqli_fetch_assoc($req);
    }
        
        
        
        
    ?>
    
    <br><br>

    <?php

    include('../bases/footer.php');

    ?>

</body>
</html>