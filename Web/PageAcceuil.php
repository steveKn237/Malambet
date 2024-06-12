<?php

    require_once("php/pdo.php");
    require_once("php/crud.php");

    parse_str(file_get_contents("php://input"), $body);

    if(count($body) > 0){
        if($body['username'] != null)
            $uid = $body['username'];
        else{
            $username = $body['username'];
            $stmt = PDO->prepare("SELECT UserID FROM Utilisateurs WHERE Nom=:username");
            $stmt->bindParam(":username", $username, PDO::PARAM_STR);
            $stmt->execute();
            list($uid) = $stmt->fetch();
        }
    }


    if($_GET != null){
        $idL = filter_input(INPUT_GET, "idLigue");
        $stmt = PDO->prepare("SELECT MatchID, EquipeID_domicile, EquipeID_visiteur, idLigue, Date FROM Matchs WHERE idLigue = :idL");
        $stmt->bindParam(":idL", $idL);
    }
    else{
        $stmt = PDO->prepare("SELECT MatchID, EquipeID_domicile, EquipeID_visiteur, idLigue, Date FROM Matchs");
    }

    $stmt->execute();

    $submit = null;
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Malambet</title>
    <link rel="stylesheet" href="css/acceuil.css">
</head>

<body>
    <header>
        <img src="img/logo.png" alt="logo malambet">
        <!-- <h1>Malambet</h1> -->
        <nav>
            <a href="inscription.php">Inscription</a>
            <a href="connection.php">Connexion</a>
        </nav>
    </header>

    
    <div class="container">

        <aside class="aside">
            <h2>Nos Compétition</h2>
            <input type="button" onclick="selectMatch(1)" name="N_AllMatch" id="I_AllMatch" value="Tout les matchs">
            <input type="button" onclick="selectMatch(2)" name="N_ldc" id="I_ldc" value="ligue des Champions">
            <input type="button" onclick="selectMatch(3)" name="N_bundes" id="I_bundes" value="Bundesliga">
            <input type="button" onclick="selectMatch(4)" name="N_l1" id="I_l1" value="Ligue 1 Mcdonald's">
        </aside>
        
        <main>
            <div>
                <h1>Top Match</h1>
            </div>
        <?php

        foreach($stmt as $row){

            $stmtED = PDO->prepare("SELECT NomEquipe, Acronyme FROM Equipes WHERE EquipeID = '".$row['EquipeID_domicile']."'");
            $stmtED->execute();

            $EquipeDomicile = $stmtED->fetch();

            $stmtEA = PDO->prepare("SELECT NomEquipe, Acronyme FROM Equipes WHERE EquipeID = '".$row['EquipeID_visiteur']."'");
            $stmtEA->execute();

            $EquipeVisiteur = $stmtEA->fetch();


            list($date, $heure) = explode(" ", $row['Date']);
            list($heure, $minute) = explode(":", $heure, -1);

            $stmtLigue = PDO->prepare("SELECT nomLigue, Acronyme FROM Ligue WHERE idLigue = '" . $row['idLigue']."'");
            $stmtLigue->execute();

            $stmtLigue = $stmtLigue->fetch();

            $coteWin = 1.40;
            

            echo "<div class='match'>";
            echo sprintf('<a href="PageMatch.php?idMatch=%s', $row['MatchID'].'" class="link">');
            echo "<div>";
            echo "<p>". $stmtLigue['nomLigue'] . " " . $date . "</p>";
            echo '<p>'. $EquipeDomicile['NomEquipe'] . " " . $heure. ":".$minute. " " . $EquipeVisiteur['NomEquipe'] . '</p>';
            echo'</a>';
            echo "</div>";

            echo "<div>";
            if(isset($uid)){
                echo '<button id="I_'.$row['EquipeID_domicile'].'" name="N_'.$row['EquipeID_domicile'].'" onclick="afficherMontant()">';
                $submit = filter_input(INPUT_POST, "submit");

                if(isset($submit)){
                    $price = filter_input(INPUT_POST, "prix");
                    createBet($uid, null, $row['MatchID'], $row['EquipeID_domicile'],$coteWin, $price);
                }
            }
            echo isset($uid)?   :'<button id="I_'.$row['EquipeID_domicile'].'" name="N_'.$row['EquipeID_domicile'].'">';
            echo $EquipeDomicile['Acronyme'];
            echo "<br>";
            echo "<span>1.40</span>";
            echo "</button>";

            echo '<button id="I_Nul." name="N_Nul">';
            echo 'Nul';
            echo "<br>";
            echo "<span>1.40</span>";
            echo "</button>";

            echo '<button id="I_'.$row['EquipeID_visiteur'].'." name="N_'.$row['EquipeID_visiteur'].'">';
            echo $EquipeVisiteur['Acronyme'];
            echo "<br>";
            echo "<span>1.40</span>";
            echo "</button>";
            echo "</div>";
            echo "</div>";
            
        }

        ?>

        <form action="" method="post" id="montant" style="display: none; width:50px; position:absolute;">
            <label for="prix">Prix</label>
            <input type="text" name="prix" id="prix">
            <input type="text" name="username" style="display: none;" value="<?=isset($uid)?$uid :""?>">
            <input type="submit" name="submit" value="Envoyer">
        </form>
        </main>
        
        <aside class="aside2" id="mesParis">
            <h2>Mes paris</h2>
        </aside>

    </div>
        
    <footer>
        <div>
            <p>À propos
            </p>
        </div>
        <div>
            <p>Réseaux sociaux</p>
        </div>
        <div>
            <p>&copy; Copyright all right reserved, Conti, Ferreira, Ndombe</p>
        </div>
    </footer>
</body>
<script>    
    function afficherMontant(){
        montant.style.display = "flex";
    }
</script>
<script src="js/script.js"></script>
</html>