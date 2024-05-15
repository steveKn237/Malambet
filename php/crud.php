<?php
require_once("pdo.php");

function userExist($uid){
    PDO->prepare("SELECT ");
    
};

function createUser($uid, $pwd){
    if(userExist($uid))
        return false;
    PDO->exec("INSERT INTO Utilisateurs(Nom, Mdp) VALUES('$uid', '$pwd')");
};
?>