<?php
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=mairie', 'root', '');
    } catch(PDOException $e) {
        echo $e->getMessage();
    }   

    if(isset($_POST['Id_Agent'])) {
        $IdAgent = $_POST['Id_Agent'];
    }

    if(isset($_POST['Date_Entretien'])) {
        $Date = $_POST['Date_Entretien'];
    }

    if(isset($_POST['Rapport_Entretien'])) {
        $Rapport = $_POST['Rapport_Entretien'];
    }

    if(isset($_POST['Probleme_Entretien'])) {
        $Probleme = $_POST['Probleme_Entretien'];
    }

    if(isset($_POST['Description_Probleme_Entretien'])) {
        $Detail = $_POST['Description_Probleme_Entretien'];
    }

    if(isset($_POST['id_systeme'])) {
        $id_systeme = $_POST['id_systeme'];
    }

    try {
        $req = $pdo->prepare("INSERT IGNORE INTO entretien (Date_Entretien, Rapport_Entretien, Probleme_Entretien, Description_Probleme_Entretien, Id_Systeme, Id_Agent) VALUES (?,?,?,?,?,?)");
        $req->execute(array($Date, $Rapport, $Probleme, $Detail, $id_systeme, $IdAgent));
    } catch(PDOException $e) {
        echo $e->getMessage();
    }

    header("Location: ../DetailsSystemes.php?id_systeme={$id_systeme}");
    exit();
?>
