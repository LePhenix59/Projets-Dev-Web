<?php
include('connexion.php');

if(isset($_POST['archive_batterie'])){
    $id_systeme = $_POST['id_systeme'];
    $id_batterie = $_POST['id_batterie'];
    $req = $pdo->prepare('UPDATE batteries SET Archive_Batterie = 1 WHERE Id_Batterie = :id_batterie');
    $req->bindParam(':id_batterie', $id_batterie, PDO::PARAM_INT);
    $req->execute();
    header("Location: ../DetailsSystemes.php?id_systeme={$id_systeme}");
    exit();
}
?>