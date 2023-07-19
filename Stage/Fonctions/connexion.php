<?php
    try{
    $pdo = new PDO("mysql:host=localhost;dbname=mairie", "root", "");
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
?>