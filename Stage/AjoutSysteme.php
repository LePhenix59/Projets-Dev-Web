<?php
    include('Fonctions/connexion.php');
?>

<!DOCTYPE HTML>
<html>
    <head>
        <title>Ajouter d'un systeme</title>
        <link rel="stylesheet" href="style.css">  
    </head>
    <body>
        <h1 align="center">Ajout d'un système</h1>
        <?php
        $id_batiment = $_GET['id_batiment'];
       
        ?>
        <div align="center">
            <form class="AjoutModele" action="Fonctions/AjoutModeleSysteme.php" method="POST">
                <input type="button" id="boutonAjoutMod" value="Ajouter un nouveau modele">
                <div class="AjoutModele" id="AjtMod" hidden>
                    <br>
                    <label for="TypeSyst">Type de systeme : </label>
                    <br>
                    <input type="text" id="TypeSyst" name="Type_Systeme">
                    <br>
                    <br>
                    <label for="Marque">Marque du systeme : </label>
                    <br>
                    <input type="text" id="Marque" name="Marque_Systeme">
                    <br>
                    <br>
                    <label for="ModeleSyst">Modele du systeme :</label>
                    <br>
                    <input type="text" id="ModeleSyst" name="Modele_Systeme">
                    <br>
                    <br>
                    <?php echo"<input type='number' name='id_batiment' value='$id_batiment' hidden>";?>
                    <label for="NbBatt">Nombre de batterie : </label>
                    <br>
                    <input type="number" id="NbBatt" name="Nb_Batteries">
                    <br>
                    <br>
                    <input type="submit" value="Enregistrer" name="submit" action="Fonctions/AjoutModele.php">
                </div>
            </form>
            <form class="AjoutSysteme" method="POST" enctype="multipart/form-data" action="Fonctions/AjouterSysteme.php">
                <?php 
                echo "<input type='number' name='id_systeme' value='$id_batiment' hidden>";
                ?>

                <br>
                <label for="Modele">Modele du systeme :</label>
                <select id="Modele" name="Id_Modele_Systeme" required>
                    <option disabled selected>Veuillez selectionner un modele de systeme</option>
                    <?php
                    $stmt = $pdo->prepare('SELECT Id_Modele_Systeme, Modele_Systeme, Marque_Systeme FROM modele_systeme ORDER BY Id_Modele_Systeme ASC');
                    $stmt->execute();
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        echo "<option value='".  $row['Id_Modele_Systeme'] . "'>" .$row['Marque_Systeme'] ."-". $row['Modele_Systeme'] . "</option>";
                    }
                    ?>
                </select>
                <br>
                <br>
                <label for="Ref">Référence du systeme : </label>
                <input type="text" id="Ref" name="Reference_Systeme" required>
                <br>
                <br>
                <label for="DateAchat">Date d'achat du systeme : </label>
                <input type="date" id="DateAchat" name="Date_Achat_Systeme" required>
                <br>
                <br>
                <label for="DateInstall">Date d'installation du systeme : </label>
                <input type="date" id="DateInstall" name="Date_Installation_Systeme" required>
                <br>
                <br> 
                <label for="Facture">Séléctionner Facture du systeme : </label>
                <input type="file" id="Facture" name="Facture" required>
                <br>
                <br>
                <label for="Garantie">Date de fin de garantie du systeme :</label>
                <input type="date" id="Garantie" name="Date_Fin_Garantie" required>
                <br>
                <br>
                <label for="Acces">Acces au systeme :</label>
                <textarea id="Acces" name="Acces_Systeme"></textarea>
                <br>
                <br>
                <label>L'alarme se déclanche t-elle lors de l'ouverture ?</label>
                <div>
                    <div>
                        <input type="radio" id="oui" name="Alarme_Systeme" value="1">
                        <label for="oui">Oui</label>
                    </div>
                    <div>
                        <input type="radio" id="non" name="Alarme_Systeme" value="0" checked>
                        <label for="non">Non</label>
                    </div>
                </div>
                <br>
                <label for="NbAgent">Combien d'agents pour l'entretien ?</label>
                <input type="number" id="NbAgent" name="Nb_Agent_Entretien" required>
                <br>
                <br>
                <label for="Image">Séléctionner l'image du systeme : </label>
                <input type="file" id="Image" name="fichier" required>
                <br>
                <br>
                <label for="Notice">Notice du systeme : </label>
                <input type="file" id="Notice" name="Notice">

                <?php echo"<input type='number' id='' name='Id_Batiment' value='$id_batiment' hidden>";?>
                <br>
                <br>
                <input type="submit" id="Enregist" name="submit" value="Enregistrer" action="Fonctions/AjouterSysteme.php" disabled>
            </form>
            
        </div>
        <br>
        <br>
        <div align="center">
            <?php echo "<a href='ListeSysteme.php?id_batiment={$id_batiment}'>Retour</a>"?>
        </div>
        <script>
            const boutonAjtMod = document.getElementById("boutonAjoutMod");
            const AjtMod = document.getElementById("AjtMod");
            boutonAjtMod.addEventListener("click", function() {
                AjtMod.removeAttribute("hidden");
            });

            const selectElem = document.getElementById('Modele');
            const Enregistrer = document.getElementById('Enregist');
            const initialValue = selectElem.value;
            selectElem.addEventListener('change', function() {
                Enregistrer.disabled = selectElem.value === initialValue;
            });
        </script>
    </body>
</html>