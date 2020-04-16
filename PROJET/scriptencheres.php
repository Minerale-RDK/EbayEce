<?php

$database = "ebayece";
        
        $db_handle = mysqli_connect('localhost:3308', 'root', '');
        $db_found = mysqli_select_db($db_handle, $database);

        if($db_found){
            $sql = "SELECT * FROM items WHERE typevente='2' AND avendre = 1";
            $req = mysqli_query($db_handle, $sql);

            while( $data = mysqli_fetch_assoc($req)){
            extract($data);

            $ajd = time();
            if($datefin != "0" && $datefin<$ajd && $avendre="1"){
                $avendre1 = 0;
                $sql2 = "UPDATE items SET avendre= '$avendre1' WHERE IDItem = $IDItem";
                $req2 = mysqli_query($db_handle, $sql2);
            }
        }

        }
        else{
            echo "erreur";
        }

?>