<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Nieuwe taak aanmaken</title>
  <link rel="stylesheet" href="../css/create.css">
</head>
<body>
  <div class="container">
    <h1>Nieuwe taak aanmaken</h1>

    <form action="../backend/tasksController.php" method="post">
      <input type="hidden" name="action" value="create">

      <label for="titel">Titel:</label>
      <input type="text" id="titel" name="titel" placeholder="" required>

      <label for="beschrijving">Beschrijving:</label>
      <textarea id="beschrijving" name="beschrijving" placeholder="Beschrijf wat er moet gebeuren..." required></textarea>

      <label for="afdeling">Afdeling:</label>
      <select id="afdeling" name="afdeling" required>
        <option value="">-- Kies afdeling --</option>
        <option value="personeel">Personeel</option>
        <option value="horeca">Horeca</option>
        <option value="techniek">Techniek</option>
        <option value="inkoop">Inkoop</option>
        <option value="klantenservice">Klantenservice</option>
        <option value="groen">Groen</option>
      </select>

      <div class="buttons">
        <button type="submit">Opslaan</button>
        <a href="index.php" class="cancel">Annuleren</a>
      </div>
    </form>
  </div>
</body>
</html>
