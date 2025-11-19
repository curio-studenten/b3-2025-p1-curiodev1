<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}


$user_id = $_SESSION['user']['id'];


require_once '../backend/conn.php';

$query = "SELECT * FROM taken WHERE user = :user"; 
$statement = $conn->prepare($query);
$statement->execute([':user' => $user_id]);
$tasks = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overview</title>
    <?php require_once '../head.php'; ?>
</head>
<body class="tasks_index_body">

    <div class="overview_h1">
        <h1>Taken met status Done</h1>
    </div>

    <div class="taak_link_wrapper">
        <div class="link_taak">
            <a href="index.php">> Terug naar de takenlijst</a>
        </div>
    </div>

    <div class="table_container">
        <table>
            <tr>
                <th>Titel</th>
                <th>Afdeling</th>
                <th>Status</th>
                <th>Deadline</th>
                <th>Edit</th>
            </tr>
            <?php if (!empty($tasks)): ?>
                <?php foreach ($tasks as $taak): ?>
                    <tr>
                        <td><?= htmlspecialchars($taak['titel']); ?></td>
                        <td><?= htmlspecialchars($taak['afdeling']); ?></td>
                        <td><?= htmlspecialchars($taak['status']); ?></td>
                        <td><?= htmlspecialchars($taak['deadline']); ?></td>
                        <td><a href="edit.php?id=<?= $taak['id']; ?>">aanpassen</a></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Geen taken gevonden.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>

</body>
</html>
