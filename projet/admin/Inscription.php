<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "client";


$conn = mysqli_connect($servername, $username, $password, $dbname);
// Vérification de la connexion
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Récupération des données du formulaire
if(isset($_POST['Nom_Client']))
{
    $Nom = $_POST['Nom_Client'];
}
else{
	echo"non définie";
}
if(isset($_POST['Prenom_Client']))
{
    $Prenom = $_POST['Prenom_Client'];
}
if(isset($_POST['Anniv_Client']))
{
    $Anniv = $_POST['Anniv_Client'];
}
if(isset($_POST['Email_Client']))
{
    $Email = $_POST['Email_Client'];
}
if(isset($_POST['Adresse_Client']))
{
    $Adresse = $_POST['Adresse_Client'];
}
if(isset($_POST['Ville_Client']))
{
    $Ville = $_POST['Ville_Client'];
}
if(isset($_POST['CP_Client']))
{
    $CP = $_POST['CP_Client'];
}
if(isset($_POST['Mdp_Client']))
{
    $Mdp = $_POST['Mdp_Client'];
}

// Requête d'insertion
$sql = "INSERT INTO clients (Nom_Client, Prenom_Client, Anniv_Client, Email_Client, Adresse_Client, Ville_Client, CP_Client, Mdp_Client)
        VALUES ('$Nom', '$Prenom', '$Anniv', '$Email', '$Adresse', '$Ville', '$CP', '$Mdp')";

if (mysqli_query($conn, $sql)) {
    echo "Nouveau client ajouté avec succès";
} else {
    echo "Erreur : " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

?>
