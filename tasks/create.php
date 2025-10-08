<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Nieuwe taak aanmaken</title>
</head>

<body>
    <h1>Nieuwe taak aanmaken</h1>

    <form action="../backend/tasksController.php" method="post">
        <input type="hidden" name="action" value="create">

        <label for="titel">Titel:</label><br>
        <input type="text" id="titel" name="titel" required><br><br>

        <label for="beschrijving">Beschrijving:</label><br>
        <textarea id="beschrijving" name="beschrijving" rows="5" cols="40" required></textarea><br><br>

        <label for="afdeling">Afdeling:</label><br>
        <select id="afdeling" name="afdeling" required>
            <option value="">-- Kies afdeling --</option>
            <option value="personeel">Personeel</option>
            <option value="horeca">Horeca</option>
            <option value="techniek">Techniek</option>
            <option value="inkoop">Inkoop</option>
            <option value="klantenservice">Klantenservice</option>
            <option value="groen">Groen</option>
            <option value="sport">Sport</option>

        </select><br><br>

        <button type="submit">Opslaan</button>
        <a href="index.php">Annuleren</a>
    </form>
</body>

</html>