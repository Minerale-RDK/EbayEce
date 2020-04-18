<?php

include('../bases/header.php');

?>

<body>

<?php


include('../bases/menu.php');

require('../bases/bdd.php');

if ($db_found)  
        {
            $id = $_GET['id']; 
            $sql = "DELETE FROM items WHERE IDItem = '$id'";
            $req = mysqli_query($db_handle, $sql);
            if(!$req){
                echo '<div class="container">
                <div class="row">
                <div class="col-lg-10 col-xl-9 mx-auto" >
                <br><br>      
                <div class="alert alert-danger" role="alert">Impossible de supprimer l\'item. </div>
            </div>
            </div>
            </div>';
            }     
            else{
                
            echo '<div class="container">
                <div class="row">
                <div class="col-lg-10 col-xl-9 mx-auto" >
                <br><br>      
                <div class="alert alert-success" role="alert">Item supprimé avec succès. </div>
            </div>
            </div>
            </div>';
            
            }
            

        }



?>

</body>



<?php

include('../bases/footer.php');

?>