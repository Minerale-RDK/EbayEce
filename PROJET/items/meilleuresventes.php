<?php

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    include('../bases/header.php');
    require('boutique.php');
?>
<body>
    
<body>
   
        <?php 
            include ("../bases/menu.php");
            include ("../bases/bdd.php");

            $sql = "SELECT * FROM items ORDER BY prix DESC WHERE avendre = 0";
            $result = mysqli_query($db_handle, $sql2);

            $j = 3;
            echo'<div calss="row"> 
            <div class="col-lg-10 col-xl-9 mx-auto" >
               <div class="card card-signin flex-row my-5" > Les 3 meilleures ventes du sites';
            for($i=0; $i<3 ; $i++){
                $data = mysqli_fetch_assoc($result);
                if ($j%3 == 0){

                    echo '<div class="card-deck">';
                    item($data, 7);
                            
                }
                else{
                    
                    item($data, 7);

                }
                $j++;
                $nbr = $nbr - 1;
                if($nbr == 0 || $j%3 == 0){
                    echo '</div><br>';
                }
            }
        ?>
</div>
                </div>
            </div>
            <?php
            $sql = "SELECT * FROM vendeurs";
            $result = mysqli_query($db_handle, $sql);
            $ids = array();
            while($data = mysqli_fetch_assoc($result)){
                array_push($ids, $data['IDVendeur']);
            }
            $meilleurs_vendeurs = array();
            foreach($ids as &$id){
                $sql = "SELECT * FROM items WHERE IDVendeur = $id AND avendre = 0";
                $result = mysqli_query($db_handle, $sql);
                array_push($meilleurs_vendeurs, array('id' => $id, 'ventes' => mysqli_num_rows($result)));
            }
            $columns = array_column($meilleurs_vendeurs, 'ventes');
            array_multisort($columns, SORT_DESC, $meilleurs_vendeurs);
            array_splice($meilleurs_vendeurs, 3);
            $j = 3;
            echo'<div calss="row"> 
            <div class="col-lg-10 col-xl-9 mx-auto" >
               <div class="card card-signin flex-row my-5" > Les 3 meilleures vendeurs de eBay ECE';
            $vendu = 5;
            foreach($meilleurs_vendeurs as list($id, $ventes)){
                $sql = "SELECT * FROM vendeurs WHERE IDVendeur = $id";
                $result = mysqli_query($db_handle, $sql);
                $data = mysqli_fetch_assoc($result);
                if ($j%3 == 0){

                    echo '<div class="card-deck">';
                    item($data, $vendu, $ventes);
                            
                }
                else{
                    
                    item($data, $vendu, $ventes);

                }
                $j++;
                $nbr = $nbr - 1;
                if($nbr == 0 || $j%3 == 0){
                    echo '</div><br>';
                }
            }
        ?>
</div>
                </div>
            </div>

</body>