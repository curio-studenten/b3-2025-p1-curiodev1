<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overview</title>
    <?php require_once '../head.php'; ?>



</head>

<body class="tasks_index_body">

    <div class="overview_h1">
        <h1>Taken met status To-Do & Doing</h1>
    </div>

    <div class="taak_link_wrapper">
        <div class="link_taak">
            <a href="index.php">>Terug naar de takenlijst</a>
        </div>
    </div>

    <div class="table_container">
        <?php
        require_once '../backend/conn.php';
        $query = "SELECT * FROM taken WHERE status != 'done' ORDER BY deadline ASC";
        $statement = $conn->prepare($query);
        $statement->execute();
        $taken = $statement->fetchAll(PDO::FETCH_ASSOC);


        ?>

        <table>
            <tr>
                <th>Titel</th>
                <th>Afdeling</th>
                <th>Status</th>
                <th>Deadline</th>
                <th>Edit</th>


            </tr>
            <?php foreach ($taken as $taak): ?>
                <tr>
                    <td><?php echo $taak['titel']; ?></td>
                    <td><?php echo $taak['afdeling']; ?></td>
                    <td><?php echo $taak['status']; ?></td>
                    <td><?php echo $taak['deadline']; ?></td>
                    <td><a href="edit.php?id=<?php echo $taak['id']; ?>">aanpassen</a></td>

                </tr>


            <?php endforeach; ?>
        </table>
    </div>


</body>

</html>