<?php

function item($data, $vendu){

    echo '<div class="card" style="max-width: 25%;">
                <div class="card-img-top">';
    if($vendu == 0){

        echo '<a href="../items/produit.php?id='.$data['IDItem'].'">
            <img src="'.$data['chemindossier'].'/photo0.jpg"  class="img-thumbnail" >
            </a>
            </div>
            <div class="card-body">
            <h5 class="card-title">'.$data['nomitem'].'</h5>
            <p class="card-text">Description : '.$data['description'].'</p>
            </div>
            <div class="card-footer">
            <small class="text-muted">Catégorie : '.$data['categorie'].'</small>
            </div></div>';

    }elseif($vendu == 1){

        echo '<img src="'.$data['chemindossier'].'/photo0.jpg"  class="img-thumbnail" >
            </div>
            <div class="card-body">
            <h5 class="card-title">'.$data['nomitem'].'</h5>
            <p class="card-text">Description : '.$data['description'].'</p>
            </div>
            <div class="card-footer">
            <small class="text-muted">Prix de la vente : '.$data['prix'].' €</small>
            </div></div>';

    }
                

}

function maboutique($titre, $message_error, $result, $vendu=0){

    $i=4;
    $nbr=mysqli_num_rows($result);
    echo '<h1>'.$titre.' ('.$nbr.')</h1><br>';
            
    if ($nbr == 0) {
        echo "<h5>'.$message_error.'</h5>";
    } 
    else 
    {
        while ($data = mysqli_fetch_assoc($result)) 
        {
            if ($i%4 == 0){

                echo '<div class="card-deck">';
                item($data, $vendu);
                        
            }
            elseif(($i-1)%4 == 0 || ($i-2)%4 == 0){

                item($data, $vendu);

            }
            else{
                
                item($data, $vendu);

            }
            $i++;
            $nbr = $nbr - 1;
            if($nbr == 0 || $nbr%4 == 0){
                echo '</div>';
            }
            
        }  
            
    }
}
?>