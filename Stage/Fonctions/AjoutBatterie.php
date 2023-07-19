<?php
    include('connexion.php');

    if(isset($_POST['submit'])){ 
        if(isset($_POST['Date_Installation_Batterie'])){
            $Date = $_POST['Date_Installation_Batterie'];
        }

        if(isset($_POST['id_systeme'])) {
            $id_systeme = $_POST['id_systeme'];
        }

        if(isset($_POST['Id_Modele_Batterie'])) {
            $id_Modele = $_POST['Id_Modele_Batterie'];
        }

        if(isset($_POST['Date_Achat_Batterie'])) {
            $DateAchat = $_POST['Date_Achat_Batterie'];
        }

        if(isset($_POST['Date_Fin_Garantie'])) {
            $DateFinGar = $_POST['Date_Fin_Garantie'];
        }

        

        $dossier = "../Notices/";
        $NoticeName = $_FILES['Notice']['name'];
        $NoticeLoc = $_FILES['Notice']['tmp_name'];
        $NoticeExt = pathinfo($NoticeName, PATHINFO_EXTENSION);
        $NoticeNewName = uniqid().'.'.$NoticeExt;
        $deplacerNotice = move_uploaded_file($NoticeLoc, $dossier.$NoticeNewName);
        
        $dossier2 = "../Factures/";
        $FactureName = $_FILES['Facture']['name'];
        $FactureLoc = $_FILES['Facture']['tmp_name'];
        $FactureExt = pathinfo($FactureName, PATHINFO_EXTENSION);
        $FactureNewName = uniqid().'.'.$FactureExt;
        $deplacerFacture = move_uploaded_file($FactureLoc, $dossier2.$FactureNewName);

        try{
            $req = $pdo->prepare("INSERT IGNORE INTO batteries (Date_Installation_Batterie, Notice_Batterie, Id_Systeme, Id_Modele_Batterie) VALUES (?,?,?,?)");
            $req->execute(array($Date, $NoticeNewName, $id_systeme, $id_Modele));
            $id_batterie = $pdo->lastInsertId();
        } catch(PDOException $e){
            echo $e->getMessage();
        }

        try{
            $req2 = $pdo->prepare("INSERT IGNORE INTO facture_batterie (Date_Achat_Batterie, Date_Fin_Garantie, Facture_Batterie, Id_Batterie) VALUES (?,?,?,?)");
            $req2->execute(array($DateAchat, $DateFinGar, $FactureNewName, $id_batterie));
        } catch(PDOException $e){
            echo $e->getMessage();
        }
        header("Location: ../DetailsSystemes.php?id_systeme={$id_systeme}");
        exit();
    }
?>
