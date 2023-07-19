<?php
	include('Fonctions/connexion.php');
	if(isset($_GET['s']) AND !empty($_GET['s']))
	{
		$cherche = htmlspecialchars($_GET['s']);
		$References = $pdo->query('SELECT Reference_Systeme FROM systemes WHERE Reference_Systeme LIKE "%'.$cherche.'%" ORDER BY Id_Systeme ASC');
		header("Location: Recherche.php?s=$cherche");
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Affichage des bâtiments</title>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<form class="Recherche" methode="GET" align="center">
        	<input type="search" name="s" placeholder="Rechercher une référence">
        	<input type="submit" name="rechercher">
	    </form>
		<div class="retour">
			<?php
				$stmt = $pdo->prepare("SELECT * FROM batiments");
				$stmt->execute();

				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) 
				{
					$filename = $row['Img_Batiment'];
					$filepath = "Images/Batiments/$filename";
					$nom = $row['Nom_Batiment'];
					echo "<div class='photo'><a href='ListeSysteme.php?id_batiment={$row['Id_Batiment']}'><img src='$filepath'><div class='nom'>$nom</div></a></div>";
				}
			?>
		</div>
	</body>
</html>