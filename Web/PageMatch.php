<?php

require_once("php/pdo.php");

$idMatch = filter_input(INPUT_GET, 'idMatch');

$stmtMatch = PDO->prepare("SELECT MatchID, EquipeID_domicile, EquipeID_visiteur, idLigue, Date FROM Matchs WHERE MatchID ='" . $idMatch . "'");
$stmtMatch->execute();


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Malambet</title>
    <link rel="stylesheet" href="css/acceuil.css">
    <link rel="stylesheet" href="css/match.css">
</head>

<body>
    <header>
        <a href="PageAcceuil.php"><img src="img/logo.png" alt="logo malambet"></a>
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
            <?php

            foreach ($stmtMatch as $row) {

                $stmtED = PDO->prepare("SELECT NomEquipe, Acronyme, Logo FROM Equipes WHERE EquipeID = '" . $row['EquipeID_domicile'] . "'");
                $stmtED->execute();

                $EquipeDomicile = $stmtED->fetch();

                $stmtEA = PDO->prepare("SELECT NomEquipe, Acronyme, Logo FROM Equipes WHERE EquipeID = '" . $row['EquipeID_visiteur'] . "'");
                $stmtEA->execute();

                $EquipeVisiteur = $stmtEA->fetch();


                list($date, $heure) = explode(" ", $row['Date']);
                list($heure, $minute) = explode(":", $heure, -1);

                $stmtLigue = PDO->prepare("SELECT nomLigue, Acronyme FROM Ligue WHERE idLigue = '" . $row['idLigue'] . "'");
                $stmtLigue->execute();

                $stmtLigue = $stmtLigue->fetch();
            }
            ?>

            <section>
                <div id="Competition">
                    <p><?= $stmtLigue['nomLigue'] ?></p>
                </div>

                <div>
                    <article class="artLogo">
                        <img src="<?= $EquipeDomicile['Logo'] ?>" alt="logo du <?= $EquipeDomicile['NomEquipe'] ?>" class="IMAGE">
                        <!-- <br> -->
                        <p><?= $EquipeDomicile['NomEquipe'] ?></p>
                    </article>

                    <article id="ArtDateHeure">
                        <h2 id="heure"><?= $heure . ":" . $minute ?></h2>
                        <p><?= $date ?></p>
                    </article>

                    <article class="artLogo">
                        <img src="<?= $EquipeVisiteur['Logo'] ?>" alt="<?= $EquipeVisiteur['NomEquipe'] ?>" class="IMAGE">
                        <br>
                        <p><?= $EquipeVisiteur['NomEquipe'] ?></p>
                    </article>
                </div>


            </section>

            <section>
                <p>Resultat (temps reglementaire)</p>

                <div>

                    <button id="<?= 'I_' . $row['EquipeID_domicile'] ?>" name="<?= 'N_' . $row['EquipeID_domicile'] ?>">
                        <?= $EquipeDomicile['Acronyme'] ?>
                        <br>
                        <span>1.40</span>
                    </button>

                    <button id="<?= 'I_' . $row['EquipeID_domicile'] ?>" name="<?= 'N_' . $row['EquipeID_domicile'] ?>">
                        NUL
                        <br>
                        <span>1.40</span>
                    </button>

                    <button id="<?= 'I_' . $row['EquipeID_domicile'] ?>" name="<?= 'N_' . $row['EquipeID_domicile'] ?>">
                        <?= $EquipeVisiteur['Acronyme'] ?>
                        <br>
                        <span>1.40</span>
                    </button>


                </div>
            </section>

            <section>
                <h2>Nombre de but dans le match</h2>

                <div id="But">

                    <div class="AfficheBut">

                        <button>
                            +0.5 but
                            <br>
                            cote : 1.40
                        </button>

                        <button>
                            +1.5 but
                            <br>
                            cote : 1.40
                        </button>

                        <button>
                            +2.5 but
                            <br>
                            cote : 1.40
                        </button>

                        <button>
                            +3.5 but
                            <br>
                            cote : 1.40
                        </button>

                        <button>
                            +4.5 but
                            <br>
                            cote : 1.40
                        </button>

                        <button>
                            +5.5 but
                            <br>
                            cote : 1.40
                        </button>
                    </div>

                    <div class="AfficheBut">
                        <button>
                            -0.5 but
                            <br>
                            cote : 1.40
                        </button>

                        <button>
                            -1.5 but
                            <br>
                            cote : 1.40
                        </button>

                        <button>
                            -2.5 but
                            <br>
                            cote : 1.40
                        </button>

                        <button>
                            -3.5 but
                            <br>
                            cote : 1.40
                        </button>

                        <button>
                            -4.5 but
                            <br>
                            cote : 1.40
                        </button>

                        <button>
                            -5.5 but
                            <br>
                            cote : 1.40
                        </button>
                    </div>


                </div>


            </section>


        </main>

        <aside class="aside2">
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
<script src="js/script.js"></script>
</html>