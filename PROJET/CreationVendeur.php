<!DOCTYPE HTML>
<html>
<html>
<head>
<title>Connexion Vendeur</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> <link rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="CreationAcheteur.css" />
</head>
<body>
    <div class="col-9" id="Cadre1"> 
        <div calss="col-7" id="Cadre2"> 
            <br>
            <h4><br>Bienvenue sur la page de création du compte vendeur<br><h4>
                <br>
                <div class="row">
                    <form action="upload_vendeurs.php" method="post" enctype="multipart/form-data" class="col-md4 ml-auto mr-auto">
                        <div class="form-group">
                            <label for="Prénom">Prénom</label>
                            <input type="text" class="form-control" name="Prénom" id="Prénom" aria-describedby="nameHelp" placeholder="Entrez votre prénom"><br>
                            <label for="Nom">Nom</label>
                            <input type="text" class="form-control" name="Nom" id="Nom" aria-describedby="nameHelp" placeholder="Entrez votre nom"><br>
                            <label for="Nom">Identifiant</label>
                            <input type="text" class="form-control" name="Identifiant" id="Identifiant" aria-describedby="identifiantHelp" placeholder="Entrez votre login"><br>
                            <label for="Nom">Email</label>
                            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Entrez votre adresse email"><br>
                            <label for="Nom">Mot de passe</label>
                            <input type="password" class="form-control" name="pwd" id="pwd" aria-describedby="pwdHelp" placeholder="Entrez votre mot de passe"><br>
                            <label for="Nom">Confirmation mot de passe</label>
                            <input type="password" class="form-control" name="pwd2" id="pwd2" aria-describedby="pwd2Help" placeholder="Veuillez confimer votre mot de passe"><br><br>
                        </div>  
                        <div> 
                            Avatar :  
                            <input size="100" type="file" name="fichier" value="" />
                            <input type="submit" value="Envoyez le fichier" /><br><br>
                        </div>
                        <br><p>Choisissez votre fond préféré</p>
                        <div class="row">
                        <div class="col-4"><br>
                            <div class="list-group" id="list-tab" role="tablist">  
                                <a type="radio" class="list-group-item list-group-item-action active" id="couv1" name="couv1" data-toggle="list" href="#list-home" role="tab" aria-controls="home" value="1">Automne</a>
                                <a type="radio" class="list-group-item list-group-item-action" id="couv2" name="couv2" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile" value="2">Wallpaper</a>
                                <a type="radio" class="list-group-item list-group-item-action" id="couv3" name="couv3" data-toggle="list" href="#list-messages" role="tab" aria-controls="messages" value="3">Flou</a>
                                <a type="radio" class="list-group-item list-group-item-action" id="couv4" name="couv4" data-toggle="list" href="#list-settings" role="tab" aria-controls="settings" value="4">Etoiles</a>
                            </div>
                        </div>
                        <div class="col-4ol">
                            <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list"><img src="images/fonddecouv/1.jpg" alt="automne"></div>
                            <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list"><img src="images/fonddecouv/5.jpg" alt="Wallpaper"/></div>
                            <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list"><img src="images/fonddecouv/3.jpg" alt="Flou"></div>
                            <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list"><img  src="images/fonddecouv/4.jpg" alt="Etoiles"></div>
                            </div><br>
                        </div>
                        </div>
                        <div>
                            <input type="checkbox" id="CGV" name="CGV" value="CGV">
                            <label for="CGV" style="font-size: small;">Acceptez vous les <a href="CGV.htlm">Conditions Générales de Vente </a></label>
                        </div> <br>
                        <button type="submit" id="bttncreation" class="btn btn-primary">Créez votre compte</button>
                    </form>
                </div>
        </div>
    </div>

</body>

</html>



