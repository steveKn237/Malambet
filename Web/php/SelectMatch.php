<?php

require_once('pdo.php');

$typeMatch = filter_input(INPUT_GET, "Competition");

switch ($typeMatch){
    case "allMatch":
        $stmt = PDO->prepare("SELECT * FROM Ligue");
        $stmt->execute();
        $stmt = $stmt->fetchAll();
        header(sprintf('location: ../PageAcceuil.php'));
        break;
    case "ldc":
        $stmt = PDO->prepare("SELECT * FROM Ligue WHERE Acronyme = 'LDC'");
        $stmt->execute();
        $stmt = $stmt->fetch();
        header(sprintf('location: ../PageAcceuil.php?idLigue=%s', $stmt['idLigue']));
        break;
    case "bundes":
        $stmt = PDO->prepare("SELECT * FROM Ligue WHERE Acronyme = 'Bundes'");
        $stmt->execute();
        $stmt = $stmt->fetch();
        header(sprintf('location: ../PageAcceuil.php?idLigue=%s', $stmt['idLigue']));
        break;
    case "L1":
        $stmt = PDO->prepare("SELECT * FROM Ligue WHERE Acronyme = 'L1'");
        $stmt->execute();
        $stmt = $stmt->fetch();
        header(sprintf('location: ../PageAcceuil.php?idLigue=%s', $stmt['idLigue']));
        break;
}

