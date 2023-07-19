<?php
    include('Fonctions/connexion.php');
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Ajouter un entretien</title>
        <link rel="stylesheet" href="style.css">     
</head>
<body>
<div class="AjtEntre">
    <?php
    $id_systeme = $_GET['id_systeme'];
    ?>
        <h1 align="center">Ajout d'un entretien</h1> 
        
            <form class="AjoutAgent" action="Fonctions/AjoutAgent.php" method="post">
                <div>
                    <input type="button" id="boutonAgt" value="Ajouter un nouvel agent">
                    <?php 
                        $id_systeme = $_GET['id_systeme'];
                        echo "<input type='number' value='$id_systeme' name='id_systeme' hidden>";
                    ?>
                    <div id="ajtAgt" hidden>
                        <br>
                        <label for="AjoutAgt">Nom de l'agent :</label>
                        <br>
                        <input type="text" id="AjoutAgt" name="Nom_Agent" >
                        <br>
                        <br>
                        <input type="submit" value="Ajouter" action="Fonctions/AjoutAgent.php" target="">
                    </div>
                </div>
            </form>
            <br>

            <form class="AjoutEntretien" action="Fonctions/AjouterEntretien.php" method="POST">
                <label for="agents">Agent(s) ayant effectué(s) l'entretien :</label>
                <select id="agents" name="Id_Agent" required>
                    <option disabled selected>Veuillez sélectionner un Agent</option>
                    <?php
                    $stmt = $pdo->prepare('SELECT Id_Agent, Nom_Agent FROM agents ORDER BY Id_Agent ASC');
                    $stmt->execute();
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $row["Id_Agent"] . "'>" . $row["Nom_Agent"] . "</option>";
                    }
                    ?>
                </select>

                <?php
                $id_systeme = $_GET['id_systeme'];
                echo "<input type='number' value='$id_systeme' name='id_systeme' hidden>";
                ?>

                <br>
                <br>

                <label for="date">Date de l'entretien :</label>
                <input type="date" id="date" name="Date_Entretien" required>

                <br>
                <br>

                <label for="rapport">Rapport de l'entretien :</label>

                <br>

                <textarea id="rapport" name="Rapport_Entretien" required></textarea>

                <br>
                <br>

                <label for="Probleme_Entretien">Problème rencontré lors de l'entretien ?</label>
                    
                <div>
                    <div>
                        <input type="radio" id="oui" name="Probleme_Entretien" value="1">
                        <label for="oui">Oui</label>
                    </div>
                    <div>
                        <input type="radio" id="non" name="Probleme_Entretien" value="0" checked>
                        <label for="non">Non</label>
                    </div>
                </div>

                <br>

                <div id="detProb" hidden="true">
                    <label for="details">Détails problème(s) :</label>
                    <br>
                    <textarea id="details" name="Description_Probleme_Entretien"></textarea>
                </div>

                <input type="submit" id="AgentEnregist" value="Enregistrer" action="Fonctions/AjouterEntretien.php" disabled>

            </form>
            <br>
            <?php echo "<a href='DetailsSystemes.php?id_systeme={$id_systeme}' align='center'>Retour</a>"?>
    </div>               
    <script>
        let radioOui = document.getElementById("oui");
        let radioNon = document.getElementById("non");
        let sectionDetails = document.getElementById("detProb");

        function afficherDetails() {
        sectionDetails.hidden = !radioOui.checked;
        }

        radioOui.addEventListener("change", afficherDetails);
        radioNon.addEventListener("change", afficherDetails);


        const boutonAgt = document.getElementById("boutonAgt");
        const ajtAgt = document.getElementById("ajtAgt");

        boutonAgt.addEventListener("click", function() {
        ajtAgt.removeAttribute("hidden");
        });

        const selectElement = document.getElementById('agents');
        const Enregis = document.getElementById('AgentEnregist');
        const initialValue = selectElement.value;

        selectElement.addEventListener('change', function() {
        Enregis.disabled = selectElement.value === initialValue;
        });
    </script>
</body>
</html>