<?php
    require_once("const.php");
    define("PDO", new PDO('mysql:host=localhost;dbname=Malambet', UID, PWD));
    PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>