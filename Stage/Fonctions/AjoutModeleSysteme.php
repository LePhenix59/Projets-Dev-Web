<?php
include('connexion.php');

if(isset($_POST['submit'])){

    if(isset($_POST['Type_Systeme'])){
        $type = $_POST['Type_Systeme'];
    }

    if(isset($_POST['Marque_Systeme'])){
        $Marque = $_POST['Marque_Systeme'];
    }

    if(isset($_POST['Modele_Systeme'])){
        $Modele= $_POST['Modele_Systeme'];
    }

    if(isset($_POST['Nb_Batteries'])){
        $NbBatt = $_POST['Nb_Batteries'];
    }

    if(isset($_POST['id_batiment'])){
        $id_batiment = $_POST['id_batiment'];
    }

    $req = $pdo->prepare('INSERT IGNORE INTO modele_systeme (Type_Systeme, Marque_Systeme, Modele_Systeme, Nb_Batteries) VALUES (?,?,?,?)');
    $req->execute(array($type, $Marque, $Modele, $NbBatt));
    header("Location: ../AjoutSysteme.php?id_batiment={$id_batiment}");}
    exit();
?>