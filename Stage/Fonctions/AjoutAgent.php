<?php
    include('connexion.php');

    if(isset($_POST['Nom_Agent'])){
        $Nom = $_POST['Nom_Agent'];
    }

    if(isset($_POST['id_systeme'])) {
        $id_systeme = $_POST['id_systeme'];
    }

    try{
        $req = $pdo->prepare('INSERT IGNORE INTO agents (Nom_Agent) value (?)');
        $req->execute(array($Nom));
    } catch(PDOException $e){
        echo $e->getMessage();
    }

    header("Location: ../AjoutEntretien.php?id_systeme={$id_systeme}");
    exit();
?>