<?php

    require_once("php/pdo.php");

    $stmt = PDO->prepare("SELECT EquipeID_domicile, EquipeID_visiteur, idLigue, Date FROM Matchs");
    $stmt->execute();

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
        <h1>Malambet</h1>
        <nav>
            <a href="#">Inscription</a>
            <a href="#">Connexion</a>
        </nav>
    </header>

    
    <div class="container">

        <aside class="aside">
            <h2>Nos Compétition</h2>
            <input type="button" name="N_ldc" id="I_ldc" value="ligue des Champions">
            <input type="button" name="N_bundes" id="I_bundes" value="Bundesliga">
            <input type="button" name="N_l1" id="I_l1" value="Ligue 1 Mcdonald's">
        </aside>
        
        <main>
            <div>
                <h1>Top Match</h1>
            </div>
                        
            <!-- liste des matchs -->
            <!-- doit se générer automatiquement en php -->
<!--             
            <div class="match">
                <div>
                    <p>InfoCompete date</p>
                    <p>équipe1 heure équipe2</p>
                </div>
                
                <div>
                    <button id="I_Victoire1" name="N_Victoire1">
                        Equipe 1
                        <br>
                        <span>1.40</span>
                    </button>
                    
                    <button id="I_Nul" name="N_Nul">
                        nul
                        <br>
                        <span>1.40</span>
                    </button>
                    
                    <button id="I_Victoire2" name="équipe2">
                        Equipe 2
                        <br>
                        <span>1.40</span>
                    </button>
                </div>
                
            </div>
            
            
            <div class="match">
                <div>
                    <p>InfoCompete date</p>
                    <p>équipe1 heure équipe2</p>
                </div>
                
                <div>
                    <button id="I_Victoire1" name="N_Victoire1">
                        Equipe 1
                        <br>
                        <span>1.40</span>
                    </button>
                    
                    <button id="I_Nul" name="N_Nul">
                        nul
                        <br>
                        <span>1.40</span>
                    </button>
                    
                    <button id="I_Victoire2" name="équipe2">
                        Equipe 2
                        <br>
                        <span>1.40</span>
                    </button>
                </div>
                
            </div> -->
            
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
            

            echo "<div class='match'>";
            echo '<a href="#" class="link">';
            echo "<div>";
            echo "<p>". $stmtLigue['nomLigue'] . " " . $date . "</p>";
            echo '<p>'. $EquipeDomicile['NomEquipe'] . " " . $heure. ":".$minute. " " . $EquipeVisiteur['NomEquipe'] . '</p>';
            echo'</a>';
            echo "</div>";

            echo "<div>";
            echo '<button id="I_'.$row['EquipeID_domicile'].'." name="N_'.$row['EquipeID_domicile'].'">';
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


        </main>
        
        <aside class="aside2">
            <h2>Mes paris</h2>
        </aside>

    </div>
        
        <footer>

    </footer>
</body>

</html>