<?php
include('connexion.php');

if(isset($_POST['ArchiverSysteme'])){
    if(isset($_POST['id_systeme'])){
        $id_systeme = $_POST['id_systeme'];
    }
    $req = $pdo->prepare('UPDATE systemes SET Archive_Systeme = 1 WHERE Id_Systeme = :id_systeme');
    $req->bindParam('id_systeme', $id_systeme, PDO::PARAM_INT);
    $req->execute();
    header("Location: ../index.php");
    exit();
}
?>