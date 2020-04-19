<?php

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    include('../bases/header.php');
    require('boutique.php');
?>
<head>
 <script type="text/javascript">

    function masquer_div(id)
  {
    if (document.getElementById(id).style.display == 'none')
    {
        document.getElementById(id).style.display = 'block';
    }else{
        document.getElementById(id).style.display = 'none';
    }
   
  }

 </script>
 </head>   
<body>
   
<?php 
    if(!empty($_GET['vendeur'])){
        echo '<div class="alert alert-success" role="alert"><i class="fa fa-check" aria-hidden="true"></i>
      &ensp;Le compte de '.$_GET['vendeur'].' a bien été supprimé !</div>';
    }
    include ("../bases/menu.php");
    include ("../bases/bdd.php");
    $sql2 = "SELECT * FROM items WHERE IDVendeur = 1 AND avendre = 0";
    $result2 = mysqli_query($db_handle, $sql2);
    $solde = 0;
    while ($data2 = mysqli_fetch_assoc($result2)) {
        $solde += $data2['prix'];
    }
?>

<br><h1 style="text-align: center"> Bienvenue sur votre compte Administrateur <?= $_SESSION['login']?></h1><br>
<h4 style="text-align: center">Nombre de ventes réalisées : <?= mysqli_num_rows($result2)?></h4><br>
<h4 style="text-align: center"> Mon solde : <?= $solde?> €</h3><br>
<div class="col;" style="text-align: center">
    <a href="../comptes/CreationVendeur.php"  class="btn btn-outline-info" role="button" style="text-align: center">Ajouter un fournisseur</a>
    &ensp;
    <button class="btn btn-outline-info" role="button" onclick="masquer_div('valid');" style="text-align: center">Supprimer un fournisseur</a>
</div><br><br>

<div class="container" id="valid" style="display:none">
    <div calss="row"> 
            <div class="col-lg-10 col-xl-9 mx-auto" >
               <div class="card card-signin flex-row my-5" >
                   <div class="card-body" >
            
                <h4 class="card-header text-center" >Supprimer un fournisseur</h4>
              <br>
                
            <form class="col-md4 ml-auto mr-auto" action="deletevendeur.php" method="post" enctype="multipart/form-data" >       
                       
            <div class="form-label-group">
                <label for="identifiant">Login : </label>
                <input type="text" class="form-control" name="identifiant" id="identifiant" aria-describedby="nameHelp" placeholder="Login du fournisseur" required autofocus>
                <br>
            </div>
            
            <div class="form-label-group">
                <label for="mdp">Adresse email :</label>
                <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Email du fournisseur" required autofocus><br>
            </div>

            <div class="form-label-group">
                <label for="mdp">Nom :</label>
                <input type="text" class="form-control" name="nom" id="nom" aria-describedby="nomHelp" placeholder="Nom de famille du fournisseur" required autofocus><br>
            </div><br>
               
                    <input type="submit" id="bttnconnex" value="Supprimer le vendeur" class="btn btn-lg btn-primary btn-block ">
                    
                <br>
            </form>
</div></div></div></div>
</div><br>

<?php

    $sql = "SELECT * FROM items WHERE IDVendeur = 1 AND avendre = 1";
    $result = mysqli_query($db_handle, $sql);
    $result2 = mysqli_query($db_handle, $sql2);

    $titre_boutique = "Mes objets en ventes";
    $titre_historique = "Mes objets vendus";
    $msg_erreurh = "Aucun objet vendu";
    $msg_erreurb = "Aucun objet en vente";

    $vendu =1;

    maboutique($titre_boutique, $msg_erreurb, $result);
    echo '<br><br>';
    maboutique($titre_historique, $msg_erreurh, $result2, $vendu);

    include ("../bases/footer.php");
?>

</body>