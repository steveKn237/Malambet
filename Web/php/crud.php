<?php
require_once("pdo.php");

function userExist($name){
    $stmt = PDO->prepare("SELECT UserID, Nom FROM Utilisateurs");
    $stmt->execute();
    $users = $stmt->fetchAll();
    foreach($users as $user)
    {
        if($name == $user['Nom'])
            return true;
    }
    return "Cet utilisateur n'existe pas";
    $stmt->closeCursor();
};



function createUser($name, $pwd){
    if(is_bool(userExist($name)))
        return "Cet utilisateur existe déjà";

    $pwd = password_hash($pwd, PASSWORD_DEFAULT);
    $stmt = PDO->prepare("INSERT INTO Utilisateurs(Nom, Mdp_hash) VALUES(?, ?)");
    $stmt->execute([$name, $pwd]);
    $stmt->closeCursor();
    return true;
};


function findTeamName($id){

    $stmt = PDO->prepare("SELECT NomEquipe, Acronyme FROM Equipes WHERE EquipeID = $id");

    $stmt->execute();
    $equipe = $stmt->fetchAll();

    $stmt->closeCursor();

    return $equipe;
}


function createBet($uid = null, $name = null, $matchID, $equipeID, $montant, $cote)
{
    if($uid === null && $name === null)
        return false;

    if($uid != null){
        try{
            $stmt = PDO->prepare("INSERT INTO Paris(UserPariID, MatchPariID, EquipeChoisie, Montant_mise, Cote, Statut_pari) VALUES(:uid, :matchID, :equipeID, :montant, :cote, 'en cours') ");
            $stmt->bindParam("uid", $uid, PDO::PARAM_INT);
            $stmt->bindParam("matchID", $matchID, PDO::PARAM_INT);
            $stmt->bindParam("equipeID", $equipeID, PDO::PARAM_INT);
            $stmt->bindParam("montant", $montant, PDO::PARAM_INT);
            $stmt->bindParam("cote", $cote, PDO::PARAM_STR);
            $stmt->execute();
        }
        catch(PDOException){
            return false;
        }
    }
    else if($name != null){
        $stmt = PDO->prepare("SELECT UserID FROM Utilisateurs WHERE Nom = '".$name."'");
        $stmt->execute();
        $uid = $stmt->fetchAll();
        $stmt->closeCursor();
        createBet($uid,null,$matchID,$equipeID,$montant,$cote);
    }
}
?>