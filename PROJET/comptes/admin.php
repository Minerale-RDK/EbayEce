<?php

include("../bases/header.php");
?>

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
