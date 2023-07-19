<?php
    include('Fonctions/connexion.php');
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Modifier batterie</title>
        <link rel="stylesheet" href="style.css">     
    </head>
    <body>
        <h1 align="center">Modifier une batterie</h1>

        <?php
        $id_batterie = $_GET['id_batterie'];
        ?>
        <div align="center">

            <form class="AjoutModele" method="POST">
                <input type="button" id="boutonAjoutMod" value="Ajouter un nouveau modele" >
                <div class="AjoutModele" id="AjtMod" hidden>
                    <br>
                    <label for="MarqueModele">Marque du modèle : </label>
                    <br>
                    <input type="text" id="MarqueModele" name="Marque_Batterie">
                    <br>
                    <br>
                    <label for="Modele">Modèle de batterie : </label>
                    <br>
                    <input type="text" id="Modele" name="Modele_Batterie">
                    <br>
                    <br>
                    <label for="DimModele">Dimensions du modèle :</label>
                    <br>
                    <input type="text" id="DimModele" name="Dimensions">
                    <br>
                    <br>
                    <label for="AmperModele">Amperage du modèle : </label>
                    <br>
                    <input type="text" id="AmperModele" name="Amperage">
                    <br>
                    <br>


                    <input type="submit" value="Enregistrer">
                </div>
            </form>

            <br>

            <form class="AjoutBatterie" method="POST" enctype="multipart/form-data" action="Fonctions/ModifierBatterie.php">

                <label for="modele">Modèle de la batterie à ajouter :</label>
                <select id="modele" name="Id_Modele_Batterie">
                    <option>Veuillez sélectionner un modèle de batterie</option>
                    <?php
                    $stmt = $pdo->prepare('SELECT Id_Modele_Batterie, Modele_Batterie FROM Modele_Batterie ORDER BY Id_Modele_Batterie ASC');
                    $stmt->execute();
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $row["Id_Modele_Batterie"] . "'>" . $row["Modele_Batterie"] . "</option>";
                    }
                    ?>
                </select>
                
                <?php
                    $id_batterie = $_GET['id_batterie'];
                    echo "<input type='number' name='id_batterie' value='$id_batterie' hidden>";
                    
                    $stmt2 = $pdo->prepare('SELECT * FROM batteries WHERE Id_Batterie = ?');
                    $stmt2->execute(array($id_batterie));
                    $row = $stmt2->fetch();
                    $id_systeme = $row['Id_Systeme'];
                    
                    echo "<input type='number' name='id_systeme' value='$id_systeme' hidden>";  
                ?>
                <br><br>
                <label for="DateAchat">Date d'achat de la batterie : </label>
                <input type="date" id="DateAchat" name="Date_Achat_Batterie">
                <br><br>
               
                <label for="dateInstall">Date d'installation de la batterie :</label>
                <input type="date" id="dateInstall" name="Date_Installation_Batterie">
                <br><br>
                
                <label for="dateFinGar">Date de fin de garantie de la batterie :</label>
                <input type="date" id="dateFinGar" name="Date_Fin_Garantie">
                <br><br>
         
                <label for="Facture">Facture de la batterie :</label>
                <input type="file" id="Facture" name="Facture">
                <br><br>

                <label for="Notice">Notice de la Batterie : </label>
                <input type="file" id="Notice" name="Notice">
                <br><br>

                <input type="submit" value="Enregistrer" name="submit" action="Fonctions/ModifierBatterie.php">
            </form>
        </div>
        <div align="center">
            <br>
            <?php echo "<a href='DetailsSystemes.php?id_systeme={$id_systeme}'>Retour</a>"?>
        </div>
        <script> 
            const boutonAjoutMod = document.getElementById("boutonAjoutMod");
            const AjtMod = document.getElementById("AjtMod");
            boutonAjoutMod.addEventListener("click", function() {
              AjtMod.removeAttribute("hidden");
            });
        </script>
    </body>

</html>

