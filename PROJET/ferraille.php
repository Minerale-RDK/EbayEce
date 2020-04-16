
<html>

    <head>
    <title>Ebay ECE - Trésor ou feraille</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@700&display=swap" rel="stylesheet">
 
<!--    <link rel="stylesheet" type="text/css" href="css/styles.css">-->
    <style>
        
      
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@500&family=Nunito:wght@700;600&family=Overlock:wght@700&display=swap');

a:hover{font-weight:bold;
        color :#c30052}
        
/*a:{font-family: 'Montserrat', sans-serif;
    font-family: 'Overlock', cursive;
    font-family: 'Nunito', sans-serif;}*/
           
h3{ 
/*   font-family: 'Overlock', cursive;*/
    font-family: 'Nunito', sans-serif;
}
        
        
        .thumbnail:hover .img-thumbnail {
  opacity: 0.6;
}


/*        font-family: 'Montserrat', sans-serif;*/
        
        
</style>
</head> 
    
    
<body>
    

        <?php 
            include ("menu.php");
        ?>
    
        <?php

        $database = "ebayece";
        
        $db_handle = mysqli_connect('localhost:3308', 'root', '');
        $db_found = mysqli_select_db($db_handle, $database);

        if ($db_found)  
        {
            $cat = $_GET['cat'];

            if($cat == "FoT")
            {
                $sqlcompte = "SELECT COUNT(*) FROM items WHERE categorie='FoT' AND avendre =1";
                $sql = "SELECT * FROM items WHERE categorie='FoT' AND avendre = 1";
                $titre = "Découvrez nos articles de la feraille au trésor.";
            }
            elseif($cat == "BpM")
            {
                $sqlcompte = "SELECT COUNT(*) FROM items WHERE categorie='BpM' AND avendre =1";
                $sql = "SELECT * FROM items WHERE categorie='BpM' AND avendre = 1";
                $titre = "Nos articles qui ont leur place dans un musée.";
            }
            elseif($cat == "vip")
            {
                $sqlcompte = "SELECT COUNT(*) FROM items WHERE categorie='vip' AND avendre =1";
                $sql = "SELECT * FROM items WHERE categorie='vip' AND avendre = 1";
                $titre = "Les accessoires pour VIP.";
            }
            elseif($cat == "atim")
            {
                $sqlcompte = "SELECT COUNT(*) FROM items WHERE typevente='1' OR typevente='4' OR typevente='5' AND avendre =1";
                $sql = "SELECT * FROM items WHERE typevente='1' OR typevente='4' OR typevente='5' AND avendre = 1";
                $titre = "Achat immédiat, pour ne rien rater.";
            }
            elseif($cat == "ench")
            {
                $sqlcompte = "SELECT COUNT(*) FROM items WHERE typevente='2' OR typevente='4' AND avendre =1";
                $sql = "SELECT * FROM items WHERE typevente='2' OR typevente='4' AND avendre = 1";
                $titre = "La salle des enchères.";
            }
            elseif($cat == "mof")
            {
                $sqlcompte = "SELECT COUNT(*) FROM items WHERE typevente='3' OR typevente='5' AND avendre =1";
                $sql = "SELECT * FROM items WHERE typevente='3' OR typevente='5' AND avendre = 1";
                $titre = "Négociez avec le vendeur.";
            }

            else
            {
                echo '<h1>Ne joue pas avec l\'url ou j\'appelle la police de l\'internet !</h1>';
            }

            
            $reqcompte = mysqli_query($db_handle, $sqlcompte);
            $resultat=mysqli_fetch_row($reqcompte);
             $resultat[0];
            $i =3;
            
            
            $req = mysqli_query($db_handle, $sql);
            
            echo '<div class="container" style="margin-top: 90px">
            <h3 style="text-align: center">'.$titre.'</h3><br><br>';
            while( $data = mysqli_fetch_assoc($req)){
                
      extract($data);
        if ($i%3 == 0){
            echo '<div class="row">
                <div class="col-md-4">
                    <div class="thumbnail">
                        <a href="produit.php?id='.$IDItem.'" target="_blank" style="text-decoration:none; color: #a20038; text-hover:black">
                            
                            <img src="'.$chemindossier.'/photo0"   style="width:330px; height:200px" class="img-thumbnail" >
                        
                        <div class="caption" style="font-size:larger; text-align:center">
                        <p>'.$nomitem.'</p>
                        </div>
                        </a>
                        </div>
                        </div>';
                    }
                    elseif(($i-1)%3 == 0){
                        echo '<div class="col-md-4">
                        <div class="thumbnail">
                        <a href="produit.php?id='.$IDItem.'" target="_blank" style="text-decoration:none; color: #a20038; text-hover:black">
                        <img src="'.$chemindossier.'/photo0" class="img-thumbnail" style="width:330px; height:200px;">
                        <div class="caption" style="font-size:larger; text-align:center; ">
                        <p>'.$nomitem.'</p>
                        </div>
                        </a>
                        </div>
                        </div>';
                    }
                    else{
                        echo '<div class="col-md-4">
                        <div class="thumbnail">
                        <a href="produit.php?id='.$IDItem.'" target="_blank" style="text-decoration:none; color: #a20038; text-hover:black">
                        <img src="'.$chemindossier.'/photo0" class="img-thumbnail" style="width:330px; height:200px;">
                        <div class="caption" style="font-size:larger; text-align:center; ">
                        <p>'.$nomitem.'</p>
                        </div>
                        </a>
                        </div>
                        </div>
                        </div>';
                    }
                    $i++;
                
            } 
            echo '</div> </div>'; 
        }
        else{
            echo "erreur";
        }



        ?>
    
    
    <?php
    include('footer.php');
    ?>

     
</body>
   
</html>