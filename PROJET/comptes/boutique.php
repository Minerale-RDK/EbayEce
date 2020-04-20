<?php

function item($data, $vendu, $meilleureoffre=0 ,$login="", $id_ach=0 ,$prix=0){

    $dossier = $data['chemindossier'];
    $files = glob("$dossier/*photo*"); 
    
    $extfile = $files[0];
    echo '<div class="card" style="max-width: 23%;">
                <div class="card-img-top">';
    if($vendu == 0){

        echo '<a href="../items/produit.php?id='.$data['IDItem'].'">
            <img src="'.$extfile.'"  style="width:100%; " class="img-thumbnail" >
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

        echo '<img src="'.$extfile.'" style="width:100%;" class="img-thumbnail" >
            </div>
            <div class="card-body">
            <h5 class="card-title">'.$data['nomitem'].'</h5>
            <p class="card-text">Description : '.$data['description'].'</p>
            </div>
            <div class="card-footer">
            <small class="text-muted">Prix de la vente : '.$data['prix'].' €</small>
            </div></div>';

    }elseif($vendu == 2){

        echo '<a href="../achat/offre.php?id='.$data['IDItem'].'">
            <img src="'.$extfile.'" style="width:100%;" class="img-thumbnail" >
            </a>
            </div>
            <div class="card-body">
            <h5 class="card-title">'.$data['nomitem'].'</h5>';
        if($meilleureoffre == 1 || $meilleureoffre == 2){
            if($meilleureoffre == 2){
                echo '<p class="card-text">Votre dernière offre : '.$prix.' €</p>
                </div>
                <div class="card-footer">
                <small class="text-muted">Meilleure offre en cours : le vendeur est entrain d\'étudier votre offre';
            }elseif($meilleureoffre == 1){
                echo ' <p class="card-text">Dernière offre du vendeur : '.$prix.' €</p>
                </div>
                <div class="card-footer">
                <small class="text-muted">Meilleure offre en cours : le vendeur vous a envoyé une contre offre';
            }
        }elseif($meilleureoffre == 3){
            echo'Le vendeur a accepté votre offre. Vous pouvez l\'ajouté à votre panier.';
        }
            echo'</small> </div></div>';

    }elseif($vendu == 3){
        if($meilleureoffre == 1 || $meilleureoffre == 2){
        echo '<a href="../achat/offre.php?id='.$data['IDItem'].'&idach='.$id_ach.'">
            <img src="'.$extfile.'" style="width:100%;" class="img-thumbnail" >
            </a>
            </div>
            <div class="card-body">
            <h5 class="card-title">'.$data['nomitem'].'</h5>';
            if($meilleureoffre == 2){
                echo '<p class="card-text">Dernière offre de l\'acheteur : '.$prix.' €</p>
                </div>
                <div class="card-footer">
                <small class="text-muted">'.$login.' vous a envoyé une offre';
            }elseif($meilleureoffre == 1){
                echo '<p class="card-text">Votree dernière offre : '.$prix.' €</p>
                </div>
                <div class="card-footer">
                <small class="text-muted">'.$login.' est entrain d\'étudier votre offre';
            }
        }elseif($meilleureoffre == 3){
            echo'<img src="'.$extfile.'" style="width:100%;" class="img-thumbnail" >
            </div>
            <div class="card-body">
            <h5 class="card-title">'.$data['nomitem'].'</h5>
            <p class="card-text">Meilleure offre de '.$login.' acceptée</p>
            </div>
            <div class="card-footer">
            <small class="text-muted">En attente du paiement de '.$login;
        }
            echo'</small> </div></div>';

    }elseif($vendu == 4){

        echo '<a href="../achat/enchere.php?id='.$data['IDItem'].'">
            <img src="'.$extfile.'" style="width:100%;" class="img-thumbnail" >
            </a>
            </div>
            <div class="card-body">
            <h5 class="card-title">'.$data['nomitem'].'</h5>';
            if($meilleureoffre == 1){
                echo '<p class="card-text">Vous avez la meilleure enchère : '.$prix.' €</p>
                </div>
                <div class="card-footer">';
                
            }elseif($meilleureoffre == 0){
                echo ' <p class="card-text">Un utilisateur a fait une offre supérieur à : '.$prix.' €</p>
                <p>Vous n\'avez plus la meilleure enchère. Faites-en une nouvelle !</p>
                </div>
                <div class="card-footer">';
                
            }elseif($meilleureoffre == 3){
                echo ' <p class="card-text"> Félicitations ! Vous avez gagné l\'enchère au prix de : '.$prix.' €</p>
                <p>Vous n\'avez plus qu\'à ajouter le produit dans votre panier !</p>
                </div>
                <div class="card-footer">';
            }

            echo'<small class="text-muted">Enchères</small> </div></div>';

        
    }elseif($vendu == 4){

        echo '<a href="../achat/enchere.php?id='.$data['IDItem'].'">
            <img src="'.$extfile.'" style="width:100%;" class="img-thumbnail" >
            </a>
            </div>
            <div class="card-body">
            <h5 class="card-title">'.$data['nomitem'].'</h5>
            <p class="card-text"> Félicitations ! Votre produit s\'est vendu au enchères au prix de : '.$prix.' €</p>
                <p>'.$login.' procède au paiement !</p>
                </div>
                <div class="card-footer"><div class="card-footer"><small class="text-muted">Enchères</small> </div></div>';

        
    }         

}

function maboutique($titre, $message_error, $result, $vendu=0){

    $i=4;
    $nbr=mysqli_num_rows($result);
    echo '<h1 style="margin-left: 15px;">'.$titre.' ('.$nbr.')</h1><br>';
            
    if ($nbr == 0) {
        echo '<h5 style="margin-left: 30px;">'.$message_error.'</h5>';
    } 
    else 
    {
        while ($data = mysqli_fetch_assoc($result)) 
        {
            if ($i%4 == 0){

                echo '<div class="card-deck">';
                item($data, $vendu);
                        
            }
            else{
                
                item($data, $vendu);

            }
            $i++;
            $nbr = $nbr - 1;
            if($nbr == 0 || $i%4 == 0){
                echo '</div><br>';
            }
            
        }  
            
    }
}
?>