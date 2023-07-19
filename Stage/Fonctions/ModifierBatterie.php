<?php
include('connexion.php');

if (isset($_POST['submit'])) {

    if (isset($_POST['Date_Installation_Batterie'])) {
        $DateInstall = $_POST['Date_Installation_Batterie'];
    }

    if (isset($_POST['id_systeme'])) {
        $id_systeme = $_POST['id_systeme'];
    }

    if (isset($_POST['id_batterie'])) {
        $id_batterie = $_POST['id_batterie'];
    }

    if (isset($_POST['Id_Modele_Batterie'])) {
        $id_Modele = $_POST['Id_Modele_Batterie'];
    }

    if (isset($_POST['Date_Achat_Batterie'])) {
        $DateAchat = $_POST['Date_Achat_Batterie'];
    }

    if (isset($_POST['Date_Fin_Garantie'])) {
        $DateFinGar = $_POST['Date_Fin_Garantie'];
    }

    $dossier2 = "../Factures/";
    $FactureName = $_FILES['Facture']['name'];
    $FactureLoc = $_FILES['Facture']['tmp_name'];
    $FactureType = $_FILES['Facture']['type'];
    $FactureExt = pathinfo($FactureName, PATHINFO_EXTENSION);
    $FactureNewName = uniqid().'.'.$FactureExt;
    $deplacerFacture = move_uploaded_file($FactureLoc, $dossier2 . $FactureNewName);

    $dossier = "../Notices/";
    $NoticeName = $_FILES['Notice']['name'];
    $NoticeLoc = $_FILES['Notice']['tmp_name'];
    $NoticeType = $_FILES['Notice']['type'];
    $NoticeExt = pathinfo($NoticeName, PATHINFO_EXTENSION);
    $NoticeNewName = uniqid().'.'.$NoticeExt;
    $deplacerNotice = move_uploaded_file($NoticeLoc, $dossier . $NoticeNewName);

    $Notice = $_FILES['Notice']['name'];

    try {
        $req = $pdo->prepare("UPDATE batteries SET Date_Installation_Batterie = ?, Notice_Batterie = ?, Id_Systeme = ?, Id_Modele_Batterie = ? WHERE Id_Batterie = ?");
        $req->execute(array($DateInstall, $NoticeNewName, $id_systeme, $id_Modele, $id_batterie));
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    try {
        $req2 = $pdo->prepare("UPDATE facture_batterie SET Date_Achat_Batterie = ?, Date_Fin_Garantie = ?, Facture_Batterie = ? WHERE Id_Batterie = ?");
        $req2->execute(array($DateAchat, $DateFinGar, $FactureNewName, $id_batterie));
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    header("Location: ../DetailsSystemes.php?id_systeme={$id_systeme}");
    exit();
}
?>
