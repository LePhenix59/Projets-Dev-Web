<?php
include('connexion.php');


if(isset($_POST['submit'])){  

    $dossier = "../Images/Boitiers/";
    $ImgName = $_FILES['fichier']['name'];
    $FileLoc = $_FILES['fichier']['tmp_name'];
    $FileType = $_FILES['fichier']['type'];
    $ImgExtension = pathinfo($ImgName, PATHINFO_EXTENSION);
    $ImgUniqueName = uniqid().'.'.$ImgExtension;
    $deplacerIMG = move_uploaded_file($FileLoc, $dossier.$ImgUniqueName);

    $dossier2 = "../Factures/";
    $FactureName = $_FILES['Facture']['name'];
    $FactureLoc = $_FILES['Facture']['tmp_name'];
    $FactureType = $_FILES['Facture']['type'];
    $FactureExtension = pathinfo($FactureName, PATHINFO_EXTENSION);
    $FactureUniqueName = uniqid().'.'.$FactureExtension;
    $deplacerFacture = move_uploaded_file($FactureLoc, $dossier2.$FactureUniqueName);

    $dossier3 = "../Notices/";
    $NoticeName = $_FILES['Notice']['name'];
    $NoticeLoc = $_FILES['Notice']['tmp_name'];
    $NoticeType = $_FILES['Notice']['type'];
    $NoticeExtension = pathinfo($NoticeName, PATHINFO_EXTENSION);
    $NoticeUniqueName = uniqid().'.'.$NoticeExtension;
    $deplacerNotice = move_uploaded_file($NoticeLoc, $dossier3.$NoticeUniqueName);

    if(isset($_POST['Reference_Systeme'])){
        $ref = $_POST['Reference_Systeme'];
    }

    if(isset($_POST['Date_Achat_Systeme'])){
        $dateAchat = $_POST['Date_Achat_Systeme'];
    }

    if(isset($_POST['Date_Installation_Systeme'])){
        $dateInstall = $_POST['Date_Installation_Systeme'];
    }
    
    if(isset($_POST['Date_Fin_Garantie'])){
        $dateFinGar = $_POST['Date_Fin_Garantie'];
    }

    if(isset($_POST['Acces_Systeme'])){
        $Acces = $_POST['Acces_Systeme'];
    }

    if(isset($_POST['Alarme_Systeme'])){
        $alarme = $_POST['Alarme_Systeme'];
    }

    if(isset($_POST['Nb_Agent_Entretien'])){
        $NbAgent = $_POST['Nb_Agent_Entretien'];
    }    

    if(isset($_POST['Id_Batiment'])){
        $idBat = $_POST['Id_Batiment'];
    } 

    if(isset($_POST['Id_Modele_Systeme'])){
        $IdModeleSys = $_POST['Id_Modele_Systeme'];
    }

    $req = $pdo->prepare('INSERT IGNORE INTO systemes (Reference_Systeme, Date_Achat_Systeme, Date_Installation_Systeme, Facture_Systeme, Date_Fin_Garantie_Systeme, Acces_Systeme, Alarme_Systeme, Notice_Systeme, Nb_Agent_Entretien, Img_Systeme, Id_Batiment, Id_Modele_Systeme) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)');
    $req->execute(array($ref, $dateAchat, $dateInstall, $FactureUniqueName, $dateFinGar, $Acces, $alarme, $NoticeUniqueName, $NbAgent, $ImgUniqueName, $idBat, $IdModeleSys));
    header("Location: ../ListeSysteme.php?id_batiment={$idBat}");
    exit();
}
?>
