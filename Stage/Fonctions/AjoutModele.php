<?php
    include('connexion.php');

    if(isset($_POST['Marque_Batterie'])){
        $Marque = $_POST['Marque_Batterie'];
    }
    
    if(isset($_POST['Modele_Batterie'])){
        $Modele = $_POST['Modele_Batterie'];
    }

    if(isset($_POST['Dimensions'])){
        $Dim = $_POST['Dimensions'];
    }

    if(isset($_POST['Amperage'])){
        $Amp = $_POST['Amperage'];
    }

    if(isset($_POST['id_systeme'])) {
        $id_systeme = $_POST['id_systeme'];
    }

    try{
        $req = $pdo->prepare('INSERT IGNORE INTO modele_batterie (Marque_Batterie, Modele_Batterie, Dimensions, Amperage) value (?,?,?,?)');
        $req->execute(array($Marque, $Modele, $Dim, $Amp));
    } catch(PDOException $e){
        echo $e->getMessage();
    }

    header("Location: ../AjoutBatterie.php?id_systeme={$id_systeme}");
    exit();
?>