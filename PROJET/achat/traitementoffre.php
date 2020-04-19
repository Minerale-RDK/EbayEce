<?php

include('../bases/header.php');

if(!isset($_SESSION)){
    session_start();
}

echo '<body>';

$montant2 = isset($_POST["montant"]) ? $_POST["montant"] : "inutile";

$montant = (int)$montant2;

$idItem1 = isset($_GET['id'])? $_GET['id'] : "";
$idCustomer = isset($_GET['idach'])? $_GET['idach'] : "";
$idItem = (int)$idItem1;

if(!isset($_POST['Accepter']) && !isset($_POST['Refuser'])){
    if($montant2 == "" || !is_numeric($montant))
{
    echo '<div class="alert alert-danger" role="alert">Erreur : Merci de rentrer un montant valide.</div>';
    include('offre.php');
    exit;
}

}



    require('../bases/bdd.php');

    include('../bases/menu.php');

    

    if($db_found){

        // CAS OU L'ACHETEUR FAIT UNE OFFRE

        if($_SESSION['statut'] == "acheteur"){

            $sqlRechercheOffre = "SELECT nbtry, prixprop FROM meilleuroffre WHERE IDAcheteur = '".$_SESSION['id']."' AND IDItem = '".$idItem."'";//toutes les données de l'offre
            $resultRechercheOffre = mysqli_query($db_handle, $sqlRechercheOffre);
            $dataOffre = mysqli_fetch_assoc($resultRechercheOffre);

            $sqlRechercheItem = "SELECT IDVendeur, nomitem FROM items WHERE IDItem = '".$idItem."'";// on a toutes les données relatives à l'item
            $resultRechercheItem = mysqli_query($db_handle, $sqlRechercheItem);
            $dataItem = mysqli_fetch_assoc($resultRechercheItem);

            $idVendeur1 = $dataItem['IDVendeur']; //On récupére l'id du vendeur
            $idAcheteur1 = $_SESSION['id']; //On récupére l'id de l'acheteur

            $idVendeur = (int)$idVendeur1;
            $idAcheteur = (int)$idAcheteur1;

            $sqlRechercheVendeur = "SELECT Prenom, email FROM vendeurs WHERE IDVendeur = '".$idVendeur."'";//On a toutes les données du vendeur
            $resultRechercheVendeur =mysqli_query($db_handle, $sqlRechercheVendeur);
            $dataVendeur = mysqli_fetch_assoc($resultRechercheVendeur);

            $sqlRechercheAcheteur = "SELECT login FROM acheteurs WHERE IDAcheteur = '".$idAcheteur."'";//On a toutes les données de l'acheteur
            $resultRechercheAcheteur =mysqli_query($db_handle, $sqlRechercheAcheteur);
            $dataAcheteur = mysqli_fetch_assoc($resultRechercheAcheteur);




            if(empty($dataOffre)){

                
                $insertNewOffre = "INSERT INTO meilleuroffre (nbtry, prixprop, IDAcheteur, IDItem, IDVendeur, tour, accepte) VALUES (1, '$montant', '$idAcheteur', '$idItem', '$idVendeur', 2, 0)";
                $resultInsertNew = mysqli_query($db_handle, $insertNewOffre);

                if(!$resultInsertNew){
                    echo '<div class="alert alert-danger" role="alert">Erreur : Erreur lors de l\'insertion dans la base de données.</div>';
                    include('offre.php');
                    exit;
                }
                else{
                $to = $dataVendeur['email'];
                $subject = "Nouvelle offre"; 
                $PrenomVendeur = $dataVendeur['Prenom'];
                $nomItem = $dataItem['nomitem'];
                include('mails/mailoffrevendeur.php');
                mail($to, $subject, $msg, $headers);
                echo '<div class="alert alert-success" role="alert">Votre offre a bien été soumise au vendeur !</div>';
                include('../bases/index.php');
                exit;
                }

            }
            elseif(isset($_POST['Accepter'])){

                echo "test 1";


                $sqlAccept = "UPDATE meilleuroffre SET accepte ='1' WHERE IDAcheteur = '".$idAcheteur."' AND IDItem = '".$idItem."'";
                $resultAccept = mysqli_query($db_handle, $sqlAccept);
                if(!$resultAccept){
                    echo '<div class="alert alert-danger" role="alert">Erreur : Erreur pour accepter l\'offre par l\'acheteur.</div>';
                    include('offre.php');
                    exit;
                }
                else{
                    $prixprop = $dataOffre['prixprop'];
                    $sqlUpdatePrix = "UPDATE items SET prix = '".$prixprop."' WHERE IDItem = '".$idItem."'";
                    $resultUpPrix = mysqli_query($db_handle, $sqlUpdatePrix);
                    if(!$resultUpPrix){
                        echo '<div class="alert alert-danger" role="alert">Erreur : Erreur pour mise à jour prix.</div>';
                    include('offre.php');
                    exit;
                    }
                    else{
                        $to = $dataVendeur['email'];
                    $subject = "Offre acceptée !";
                    $PrenomVendeur = $dataVendeur['Prenom'];
                    $nomItem = $dataItem['nomitem']; 
                    $loginAcheteur = $dataAcheteur['login'];
                    include('mails/mailacceptevendeur.php');
                    echo '<div class="alert alert-success" role="alert">Vous avez accepté l\'offre ! Merci de procéder au paiement :)</div>';
                    include('../achat/offre.php?id='.$idItem.'');
                    exit;
                    }                    
                }
                }
            elseif(isset($_POST['CO'])){

                echo "test3";
                $nbTry2 = $dataOffre['nbtry'];
                $nbTry = (int)$nbTry2;
                $nbTry++;
                $sqlCO = "UPDATE meilleuroffre SET prixprop = '".$montant."', nbtry = '".$nbTry."', tour = '2'  WHERE IDAcheteur = '".$idAcheteur."' AND IDItem = '".$idItem."'";
                $resultCO = mysqli_query($db_handle, $sqlCO);
                if(!$resultCO){
                    echo '<div class="alert alert-danger" role="alert">Erreur : Erreur pour soumettre contre-offre.</div>';
                    include('offre.php');
                    exit;
                }
                else{
                    echo '<div class="alert alert-success" role="alert">Votre offre a bien été transmise au vendeur.</div>';
                    include('../bases/index.php');
                    exit;
                }
                }
            elseif(isset($_POST['refuser'])){
                $nbTry2 = $dataOffre['nbtry'];
                $nbTry = (int)$nbTry2;
                $nbTry++;
                $sqlRefus = "UPDATE meilleuroffre SET nbtry = '".$nbTry."'  WHERE IDAcheteur = '".$idAcheteur."' AND IDItem = '".$idItem."'";
                $resultRefus = mysqli_query($db_handle, $sqlRefus);
                if(!$resultRefus){
                    echo '<div class="alert alert-danger" role="alert">Erreur : Erreur pour refuser la dernière offre.</div>';
                    include('offre.php');
                    exit;
                }
                else{
                    echo '<div class="alert alert-success" role="alert">Votre refus a bien été enregistré. Vous ne pourrez plus négocier pour cette offre.</div>';
                    include('../bases/index.php');
                    exit;
                }
            }

        }
        elseif($_SESSION['statut'] == "vendeur" || $_SESSION['statut'] == "administrateur"){


            $sqlRechercheOffre = "SELECT * FROM meilleuroffre WHERE IDAcheteur = '".$idCustomer."' AND IDItem = '".$idItem."'";//toutes les données de l'offre
            $resultRechercheOffre = mysqli_query($db_handle, $sqlRechercheOffre);
            $dataOffre = mysqli_fetch_assoc($resultRechercheOffre);


            $sqlRechercheItem = "SELECT * FROM items WHERE IDItem = '".$idItem."'";// on a toutes les données relatives à l'item
            $resultRechercheItem = mysqli_query($db_handle, $sqlRechercheItem);
            $dataItem = mysqli_fetch_assoc($resultRechercheItem);
            

            if($_SESSION['statut'] == "vendeur"){
                $idVendeur = $_SESSION['id'];
            }
            else{
                $idVendeur = "1";
            }
             
            $sqlRechercheVendeur = "SELECT * FROM vendeurs WHERE IDVendeur = '".$idVendeur."'";//On a toutes les données du vendeur
            $resultRechercheVendeur =mysqli_query($db_handle, $sqlRechercheVendeur);
            $dataVendeur = mysqli_fetch_assoc($resultRechercheVendeur);

            $sqlRechercheAcheteur = "SELECT * FROM acheteurs WHERE IDAcheteur = '".$idCustomer."'";//On a toutes les données de l'acheteur
            $resultRechercheAcheteur =mysqli_query($db_handle, $sqlRechercheAcheteur);
            $dataAcheteur = mysqli_fetch_assoc($resultRechercheAcheteur);

            if(isset($_POST['Accepter'])){
                $idAcheteur1 = $dataAcheteur['IDAcheteur'];
                $idAcheteur = (int)$idAcheteur1;
                $sqlAccept = "UPDATE meilleuroffre SET accepte ='1' WHERE IDAcheteur = '".$idAcheteur."' AND IDItem = '".$idItem."'";
                $resultAccept = mysqli_query($db_handle, $sqlAccept);
                if(!$resultAccept){
                    echo '<div class="alert alert-danger" role="alert">Erreur : Erreur pour accepter l\'offre par le vendeur.</div>';
                    include('offre.php');
                    exit;
                }
                else{
                    $prixprop = $dataOffre['prixprop'];
                    $sqlUpdatePrix = "UPDATE items SET prix = '".$prixprop."' WHERE IDItem = '".$idItem."'";
                    $resultUpPrix = mysqli_query($db_handle, $sqlUpdatePrix);
                    if(!$resultUpPrix){
                        echo '<div class="alert alert-danger" role="alert">Erreur : Erreur pour mise à jour prix.</div>';
                    include('offre.php');
                    exit;
                    }
                    else{
                        $to = $dataAcheteur['email'];
                    $subject = "Offre acceptée !";
                    $PrenomAcheteur = $dataAcheteur['Prenom'];
                    $nomItem = $dataItem['nomitem']; 
                    $loginAcheteur = $dataAcheteur['login'];
                    $loginVendeur = $dataVendeur['login'];
                    include('mails/mailaccepteacheteur.php');
                    mail($to, $subject, $msg, $headers);
                    echo '<div class="alert alert-success" role="alert">Vous avez accepté l\'offre ! Nous allons notifier '.$loginAcheteur.' par e-mail :)</div>';
                    include('../bases/index.php');
                    exit;
                    }                    
                }

            }
            elseif(isset($_POST['CO2'])){

                echo"test6";
                $nbTry2 = $dataOffre['nbtry'];
                $nbTry = (int)$nbTry2;
                $nbTry++;
                $sqlCO = "UPDATE meilleuroffre SET prixprop = '".$montant."', nbtry = '".$nbTry."', tour = '1'  WHERE IDAcheteur = '".$idCustomer."' AND IDItem = '".$idItem."'";
                $resultCO = mysqli_query($db_handle, $sqlCO);
                if(!$resultCO){
                    echo '<div class="alert alert-danger" role="alert">Erreur : Erreur pour soumettre contre-offre.</div>';
                    include('offre.php');
                    exit;
                }
                else{
                    echo '<div class="alert alert-success" role="alert">Votre offre a bien été transmise à l\'acheteur.</div>';
                    include('../bases/index.php');
                    exit;
                }

            }

        }


    include('../bases/footer.php');


    }

 



?>