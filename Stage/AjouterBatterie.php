<?php
    include('Fonctions/connexion.php');
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Ajouter une batterie</title>
        <link rel="stylesheet" href="style.css">      
    </head>
    <body>
        <h1 align="center">Ajout d'une batterie</h1>

        <?php
        $id_systeme = $_GET['id_systeme'];
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
                    <?php 
                        $id_systeme = $_GET['id_systeme'];
                        echo "<input type='number' name='id_systeme' value='$id_systeme' hidden>";
                    ?>

                    <input type="submit" value="Enregistrer">
                </div>
            </form>

            <br>

            <form class="AjoutBatterie" method="POST" enctype="multipart/form-data" action="Fonctions/AjoutBatterie.php">

                <label for="Element">Modèle de la batterie à ajouter :</label>
                <select id="Element" name="Id_Modele_Batterie" required>
                    <option disabled selected>Veuillez sélectionner un modèle de batterie</option>
                    <?php
                    $stmt = $pdo->prepare('SELECT Id_Modele_Batterie, Modele_Batterie, Marque_Batterie FROM Modele_Batterie ORDER BY Id_Modele_Batterie ASC');
                    $stmt->execute();
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $row["Id_Modele_Batterie"] . "'>" . $row["Marque_Batterie"] . "-" . $row["Modele_Batterie"] . "</option>";
                    }
                    ?>
                </select>
                
                <?php 
                    $id_systeme = $_GET['id_systeme'];
                    echo "<input type='number' name='id_systeme' value='$id_systeme' hidden>";
                ?>
                <br>
                <br>
                <label for="DateAchat">Date d'achat de la batterie : </label>
                <input type="date" id="DateAchat" name="Date_Achat_Batterie" required>
                <br>
                <br>
                
                <label for="dateInstall">Date d'installation de la batterie :</label>
                <input type="date" id="dateInstall" name="Date_Installation_Batterie" required>
                <br>
                <br>
                
                <label for="dateFinGar">Date de fin de garantie de la batterie :</label>
                <input type="date" id="dateFinGar" name="Date_Fin_Garantie" required>
                <br>
                <br>
                
                <label for="Facture">Facture de la batterie :</label>
                <input type="file" id="Facture" name="Facture" required>
                <br>
                <br>
                <label for="Notice">Notice de la Batterie : </label>
                <input type="file" id="Notice" name="Notice">
                <br>
                <br>
                <input type="submit" id="Enregist" value="Enregistrer" name="submit" action="Fonctions/AjoutBatterie.php" disabled>
            </form>
        </div>
        <br>
        <br>
        <div class="BoutonAjtBatt" align="center">
            <?php 
            echo "<a href='DetailsSystemes.php?id_systeme={$id_systeme}'>Retour</a>";
            ?>
        </div>
        <script>
            const selectElement = document.getElementById('Element');
            const Enregis = document.getElementById('Enregist');
            const initialValue = selectElement.value;
            selectElement.addEventListener('change', function() {
            Enregis.disabled = selectElement.value === initialValue;
            });

            const boutonAjoutMod = document.getElementById("boutonAjoutMod");
            const AjtMod = document.getElementById("AjtMod");
            boutonAjoutMod.addEventListener("click", function() {
            AjtMod.removeAttribute("hidden"); 
            });
        </script>    
    </body>
</html>
