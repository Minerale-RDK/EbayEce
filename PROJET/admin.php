<html>
<head>
<title>Connexion Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> <link rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css/login.css" />
</head>

<body>
    <div class="col-6" id="Cadre1"> 
        <div calss="col-7" id="Cadre2"> 
            <br>
            <h1>Bonjour</h1>
            <h4><br>Bienvenue sur la page de connexion administrateur<br><h4>
                <br>
                <div class="row">
                <form action="connexionAdmin.php" method="post" class="col-md4 ml-auto mr-auto">  
                    <table>
                        <tr>
                            <td style="padding-bottom: 12px;"><input type="text" name="identifiant" placeholder="Identifiant" style="text-align: center;"/></td>
                        </tr>
                        <tr>
                            <td style="padding-bottom: 12px;"><input type="password" name="passw" placeholder="Mot de passe" style="text-align: center;"/></td>
                        </tr>
                        <tr>
                            <td colspan="2" >
                                <input type="submit" id="bttnconnex" value="Connexion" ; />
                            </td>
                        </tr>
                    </table>
                </form>
                </div>
        </div>
    </div>

</body>

</html>
