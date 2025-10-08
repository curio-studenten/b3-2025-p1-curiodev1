<?php
// Controleer of er een bericht (ok of err) is meegegeven via de URL
$ok = $_GET['ok'] ?? null;
$err = $_GET['err'] ?? null;
?>
<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Takenlijst - Overzicht</title>
</head>
<body>
  <h1>Takenlijst</h1>

  <?php if ($ok): ?>
    <p>✅ De taak is succesvol toegevoegd.</p>
  <?php endif; ?>

  <?php if ($err): ?>
    <p style="color:red;">❌ <?= htmlspecialchars($err) ?></p>
  <?php endif; ?>

  <p><a href="create.php">Nieuwe taak maken</a></p>

  <p>Hier kun je later een lijst met alle taken tonen.</p>
</body>
</html>
