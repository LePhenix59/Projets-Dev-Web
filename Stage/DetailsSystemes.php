<?php
	include('Fonctions/connexion.php');
?>
<!DOCTYPE html>
<html>
    <head>
	    <title>Details Systèmes</title>
	    <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <H1>Caractèristiques du systeme</H1>
        <div class="Details">
	    <?php
            $id_systeme = $_GET['id_systeme'];

            $stmt1 = $pdo->prepare('SELECT * FROM systemes WHERE Id_Systeme = :id_systeme');
            $stmt2 = $pdo->prepare('SELECT * FROM batteries WHERE Id_Systeme = :id_systeme');
            $stmt3 = $pdo->prepare('SELECT * FROM entretien WHERE Id_Systeme = :id_systeme');
            $stmt4 = $pdo->prepare('SELECT * FROM systemes WHERE Id_Systeme = :id_systeme');

            $stmt1->bindParam(':id_systeme', $id_systeme, PDO::PARAM_INT);
            $stmt2->bindParam(':id_systeme', $id_systeme, PDO::PARAM_INT);
            $stmt3->bindParam(':id_systeme', $id_systeme, PDO::PARAM_INT); 
            $stmt4->bindParam(':id_systeme', $id_systeme, PDO::PARAM_INT);
            
            $stmt1->execute();
            $stmt2->execute();
            $stmt3->execute();
            $stmt4->execute();

            $stmt6 = $pdo->prepare('SELECT Id_Modele_Systeme FROM systemes WHERE Id_Systeme = :id_systeme');
            $stmt6->bindParam(':id_systeme', $id_systeme, PDO::PARAM_INT);
            $stmt6->execute();
            $id_mod_sys_result = $stmt6->fetch(PDO::FETCH_ASSOC);

            $id_mod_sys_value = $id_mod_sys_result['Id_Modele_Systeme'];

            $stmt5 = $pdo->prepare('SELECT * FROM modele_systeme WHERE Id_Modele_Systeme = :id_mod_sys');
            $stmt5->bindParam(':id_mod_sys', $id_mod_sys_value, PDO::PARAM_INT);
            $stmt5->execute();


            echo "<ul>";

            while($row = $stmt5->fetch(PDO::FETCH_ASSOC))
            {
                $idModel = $row['Id_Modele_Systeme'];
                $TypeSyst = $row['Type_Systeme'];
                $MarqueSyst = $row['Marque_Systeme'];
                $ModeleSyst = $row['Modele_Systeme'];
                $NbBatt = $row['Nb_Batteries'];
                echo "<li><h4>Id du systeme : </h4>$idModel</li>";
                echo "<li><h4>Type de systeme : </h4>$TypeSyst</li>";
                echo "<li><h4>Marque du systeme : </h4>$MarqueSyst</li>";
                echo "<li><h4>Modele du systeme : </h4>$ModeleSyst</li>";
                echo "<li><h4>Nombre de batteries : </h4>$NbBatt</li>";
            }


            while($row = $stmt4->fetch(PDO::FETCH_ASSOC))
            {
                $filename = $row['Img_Systeme'];
			    $filepath = "Images/Boitiers/$filename";
                $filename2 = $row['Facture_Systeme'];
                $filepath2 = "Factures/$filename2";
                $filename3 = $row['Notice_Systeme'];
                $filepath3 = "Notices/$filename3";
    			$nom_systeme = $row['Reference_Systeme'];
                $date_install = $row['Date_Installation_Systeme'];
                $Acces = $row['Acces_Systeme'];
                $Alarme = $row['Alarme_Systeme'];
                $Nb_Agent = $row['Nb_Agent_Entretien'];
                $date_achat = $row['Date_Achat_Systeme'];
                $date_fin_gar = $row['Date_Fin_Garantie_Systeme'];
                $Facture = $row['Facture_Systeme'];
                $Notice = $row['Notice_Systeme'];
                echo "<li><h4>Image du Systeme : <img src='$filepath' class='photoDetail'></h4></li>";
                echo "<li><h4>Référence du syteme : </h4>$nom_systeme</li>";
                echo "<li><h4>Date d'installation : </h4>$date_install</li>";
                echo "<li><h4>Accès au systeme : </h4>$Acces</li>";
                echo "<li><h4>L'alarme se déclenche-t-elle à l'ouverture du boitier ?</h4>";
                if ($Alarme == 0) {
                    echo "non";
                } else {
                    echo "oui";
                }
                echo "</li>";
                echo "<li><h4>Nombre d'agents necessaires à l'entretien : </h4>$Nb_Agent</li>";
                echo "<li><h4>Date d'achat du systeme : </h4>$date_achat</li>";
                echo "<li><h4>Date de fin de garantie du systeme : </h4>$date_fin_gar</li>";
                echo "<li><h4>Facture du syteme : </h4><a href='$filepath2'>$Facture</a></li>";
                echo "<li><h4>Notice du systeme : </h4><a href='$filepath3'>$Notice</a></li>";

            }
            echo "<h1>Entretiens efféctués sur le systeme</h1>";
            ?>
            
            <table>
                <thead>
                    <tr>
                        <th>Date de l'entretien</th>
                        <th>Rapport de l'entretien</th>
                        <th>Problème rencontré</th>
                        <th>Détails du problème</th>
                        <th>Agent ayant effectué l'entretien</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                while($entretien = $stmt3->fetch()){
                    $stmt_agent = $pdo->prepare('SELECT * FROM agents  WHERE Id_Agent = :id_agent');
                    $stmt_agent->bindParam(':id_agent', $entretien['Id_Agent'], PDO::PARAM_INT); 
                    $stmt_agent->execute();
                    $agent = $stmt_agent->fetch();

                    echo '<tr>';
                    echo '<td>'.$entretien['Date_Entretien'].'</td>';
                    echo '<td>'.$entretien['Rapport_Entretien'].'</td>';
                    echo '<td>';
                    if ($entretien['Probleme_Entretien'] == 0) {
                        $probleme = "non";
                    } else {
                        $probleme = "oui";
                    }
                    echo $probleme;
                    echo '</td>';
                    echo '<td>'.$entretien['Description_Probleme_Entretien'].'</td>';
                    echo '<td>'.$agent['Nom_Agent'].'</td>';
                    echo '</tr>';
                } ?>
                </tbody>
            </table>
            <?php echo "<a href='AjoutEntretien.php?id_systeme={$id_systeme}'>Ajouter un entretien</a>";?> 
            <h1>Caractéristiques de la ou des batterie(s)</h1>
            <table>
            <thead>
                <tr>
                <th>Marque</th>
                <th>Modèle</th>
                <th>Dimensions</th>
                <th>Amperage</th>
                <th>Date Achat</th>
                <th>Date d'installation</th>
                <th>Date Fin Garantie</th>
                <th>Facture Batterie</th>
                <th>Notice Batterie</th>
                <th></th>
                <th></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                while ($batterie = $stmt2->fetch()) {   
                    $stmt_modele = $pdo->prepare('SELECT * FROM modele_batterie WHERE Id_Modele_Batterie = :id_modele');
                    $stmt_modele->bindParam(':id_modele', $batterie['Id_Modele_Batterie'], PDO::PARAM_INT);
                    $stmt_modele->execute();
                    $stmt_facture = $pdo->prepare('SELECT * FROM facture_batterie WHERE Id_Batterie = :id_batterie');
                    $stmt_facture->bindParam(':id_batterie', $batterie['Id_Batterie'], PDO::PARAM_INT);
                    $stmt_facture->execute();
                    $facture = $stmt_facture->fetch();
                    $modele = $stmt_modele->fetch();
                                
                    if ($batterie['Archive_Batterie'] == 0) {
                        echo '<tr>';
                        $id_batterie = $batterie['Id_Batterie'];
                        $id_systeme = $batterie['Id_Systeme'];
                        echo '<td hidden>' . $batterie['Id_Batterie'] . '</td>';
                        echo '<td>' . $modele['Marque_Batterie'] . '</td>';
                        echo '<td>' . $modele['Modele_Batterie'] . '</td>';
                        echo '<td>' . $modele['Dimensions'] . '</td>';
                        echo '<td>' . $modele['Amperage'] . '</td>';
                        echo '<td>' . $facture['Date_Achat_Batterie'] . '</td>';
                        echo '<td>' . $batterie['Date_Installation_Batterie'] . '</td>';
                        echo '<td>' . $facture['Date_Fin_Garantie'] . '</td>';
                        echo '<td><a href="./Factures/' . $facture['Facture_Batterie'] . '">' . $facture['Facture_Batterie'] . '</a></td>';
                        echo '<td><a href="./Notices/' . $batterie['Notice_Batterie'] . '">' . $batterie['Notice_Batterie'] . '</a></td>';
                        echo '<td>
                                <form method="POST" action="Fonctions/ArchiverBatt.php">
                                    <input type="number" name="id_systeme" value="' . $batterie['Id_Systeme'] . '" hidden>
                                    <input type="number" name="id_batterie" value="' . $batterie['Id_Batterie'] . '" hidden>
                                    <input type="submit" name="archive_batterie" value="Archiver">
                                </form>
                            </td>';

                        echo "<td><a href='ModifierBatt.php?id_batterie={$id_batterie}'>Modifier</a></td>";
                        echo '</tr>';
                    }
                } 
            ?>

                </tbody>
            </table>

                    <?php 
                    echo "<a href='AjouterBatterie.php?id_systeme={$id_systeme}'>Ajouter une batterie</a>";
                    echo "</ul>";
                    ?>
                    <br>
                    <?php 
                        echo "<form method='POST' action='Fonctions/ArchiverSysteme.php'> 
                        <input type='number' value='$id_systeme' name='id_systeme' hidden>
                        <input type='submit' id='ArchiverSyst' name='ArchiverSysteme' value='Archiver le systeme' action='Fonctions/ArchiverSysteme.php'>
                        </form>" 
                    ?>
                    <br>
                    <br>
                    <a href="index.php">Retour à la liste des bâtiments</a>
        </div>
    </body>
</html>


