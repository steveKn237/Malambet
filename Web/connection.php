<?php

require_once('php/crud.php');

$submit = filter_input(INPUT_POST, "submit");;

if(isset($submit))
{

    $uid = filter_input(INPUT_POST, "loginUsername");
    $pwd = filter_input(INPUT_POST, "loginPassword");

    $result = userExist($uid);
    
    $stmt = PDO->prepare("SELECT Nom, Mdp_hash FROM Utilisateurs WHERE Nom = :Nom");
    $stmt->bindParam(":Nom", $uid);
    $stmt->execute();
    $client = $stmt->fetch();

    // $pwd = hash("sha256", $pwd);

    

    if(!is_bool($result))
        $fail = $result;
    else
    {
        if($client['Nom'] == $uid && password_verify($pwd, $client['Mdp_hash'])){
            echo "<form action='PageAcceuil.php' method='post' id='form'>";
            echo "<input type='text' id='Uid' name='username' value='$uid'>";
            echo "</form>";
        }
    }
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_connexion.css">
    <title>Connexion</title>
</head>

<body>
    <div class="container">
        <h2>Se connecter</h2>
        <form action="" method="POST"> <!-- Modification de l'attribut action -->
            <div class="form-group">
                <label for="loginUsername">Nom d'utilisateur</label>
                <input type="text" id="loginUsername" name="loginUsername" required>
            </div>
            <div class="form-group">
                <label for="loginPassword">Mot de passe</label>
                <input type="password" id="loginPassword" name="loginPassword" required>
            </div>
            <button type="submit" name="submit">Se connecter</button>
        </form>
        <p>Vous n'avez pas de compte? <a href="php/inscription.php">Créez-en un</a>.</p>
        <p><?= isset($fail)? $fail : ""?></p>   
    </div>
</body>
<script>
    let form = document.getElementById('form')

    if(form != null)
        form.submit();
</script>
</html>