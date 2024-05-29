<?php

    require_once("php/pdo.php");

    $stmtMatch = PDO->prepare("SELECT EquipeID_domicile, EquipeID_visiteur, idLigue, Date FROM Matchs");
    $stmtMatch ->execute();
    

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
            <?php 
                                    
                foreach($stmtMatch as $row){

                    $stmtED = PDO->prepare("SELECT NomEquipe, Acronyme, Logo FROM Equipes WHERE EquipeID = '".$row['EquipeID_domicile']."'");
                    $stmtED->execute();
        
                    $EquipeDomicile = $stmtED->fetch();
        
                    $stmtEA = PDO->prepare("SELECT NomEquipe, Acronyme, Logo FROM Equipes WHERE EquipeID = '".$row['EquipeID_visiteur']."'");
                    $stmtEA->execute();
        
                    $EquipeVisiteur = $stmtEA->fetch();
        
        
                    list($date, $heure) = explode(" ", $row['Date']);
                    list($heure, $minute) = explode(":", $heure, -1);
        
                    $stmtLigue = PDO->prepare("SELECT nomLigue, Acronyme FROM Ligue WHERE idLigue = '" . $row['idLigue']."'");
                    $stmtLigue->execute();
        
                    $stmtLigue = $stmtLigue->fetch();

                }
            ?>

            <section>
                <div>
                    <p><?= $stmtLigue['nomLigue']?></p>
                </div>

                <div>
                    <article>
                        <img src="<?= $EquipeDomicile['Logo']?>" alt="">
                    </article>

                    <article>
                        <img src="<?php $EquipeVisiteur['Logo']?>" alt="">
                    </article>
                </div>


            </section>


        </main>
        
        <aside class="aside2">
            <h2>Mes paris</h2>
        </aside>

    </div>
        
        <footer>

    </footer>
</body>

</html>