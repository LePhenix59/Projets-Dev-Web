<?php
include('Fonctions/connexion.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Photos de systèmes</title>
		<link rel="stylesheet" href="style.css">
    </head>
    <body>
       <h1 align='center'>Liste des systèmes</h1>
        <div class="retour">
        	<?php
            $id_batiment = $_GET['id_batiment'];
            $stmt = $pdo->prepare("SELECT * FROM systemes WHERE Id_Batiment = :id_batiment AND Archive_Systeme = 0");
            $stmt->bindParam(':id_batiment', $id_batiment, PDO::PARAM_INT);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) 
            {
                $filename = $row['Img_Systeme'];
                $filepath = "Images/Boitiers/$filename";
				$archive = $row['Archive_Systeme'];
                if($archive == 0)
                {
                    $nom_systeme = $row['Reference_Systeme'];
                    echo "<div class='photoSyst'><a href='DetailsSystemes.php?id_systeme={$row['Id_Systeme']}'><img src='$filepath'><div class='nom'>$nom_systeme</div></a></div>";
                }
            }
        	?> 
        </div>
		<div class="Boutons">
			<br>
        	<?php
            echo "<a href='AjoutSysteme.php?id_batiment={$id_batiment}'>Ajouter un système</a>";
        	?>
    	    <br>
        	<br>
        	<a href="index.php" align="center">Retour à la liste des bâtiments</a>
        </div>
    </body>
</html>
