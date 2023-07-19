<?php
    include('Fonctions/connexion.php');
	if(isset($_GET['s']) AND !empty($_GET['s']))
	{
		$cherche = htmlspecialchars($_GET['s']);
		$References = $pdo->query('SELECT Reference_Systeme FROM systemes WHERE Reference_Systeme LIKE "%'.$cherche.'%" ORDER BY Id_Systeme ASC');
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Résultats de recherche</title>
		<link rel="stylesheet" href="style.css">
	</head>
	<body>
		<form class="Recherche" methode="GET" align="center">
        	<input type="search" name="s" placeholder="Rechercher une référence">
        	<input type="submit" name="rechercher">
	    </form>
		<h1 align="center"	>Résultats de recherche pour "<?php echo $_GET['s']; ?>"</h1>
		<div class="retour">
    	<?php
		    $stmt = $pdo->prepare("SELECT * FROM systemes WHERE Reference_Systeme LIKE :query");
			$stmt->bindValue(':query', "%".$_GET['s']."%");
	    	$stmt->execute();

			while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) 
            {
				if($row['Archive_Systeme'] == 0){
					$filename = $row['Img_Systeme'];
					$filepath = "Images/Boitiers/$filename";
					$nom = $row['Reference_Systeme'];
					if (file_exists($filepath)) 
					{
						echo "<div class='photoSyst'><a href='DetailsSystemes.php?id_systeme={$row['Id_Systeme']}'><img src='$filepath'><div class='nom'>$nom</div></a></div>";
					}
				}
    		}	
	    ?> 	
    	</div>
    	<div align="center">
			<br><br>
			<a href="index.php">Retour à la liste des Batiments</a>
		</div>
	</body>
</html>
