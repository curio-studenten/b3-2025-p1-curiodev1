<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overview</title>
    <?php require_once '../head.php'; ?>



</head>
<body class="tasks_index_body">
    <section class="header_tasks">
        <header>
        <div class="wrapper">
            <img class="header_logo" src="../img/logo-big-v2.png" alt="">
            <nav>
            <a href="../index.php">Home</a>
            <a href="index.php">Takenlijst</a>
            <a href="overview.php">Overview</a> 
            </nav>
        </div> 
        </header>
    </section>

    <div class="overview_h1">
        <h1>Taken met status Done</h1>
    </div>

     <div class="table_container">
        <?php
        require_once '../backend/conn.php';
        $query = "SELECT * FROM taken WHERE status = 'done' ";
        $statement = $conn->prepare($query);
        $statement->execute();
        $taken = $statement->fetchAll(PDO::FETCH_ASSOC);

        
        ?>

        <table>
            <tr>
                <th>Titel</th>
                <th>Afdeling</th>
                <th>Status</th>
                <th>Edit</th>


            </tr>
            <?php foreach($taken as $taak):?>
                <tr>
                    <td><?php echo $taak['titel']; ?></td>
                    <td><?php echo $taak['afdeling']; ?></td>
                    <td><?php echo $taak['status']; ?></td> 
                    <td><a href="edit.php?id=<?php echo $taak['id']; ?>">aanpassen</a></td>

                </tr>

            
            <?php endforeach; ?>
        </table>
     </div>
    <div class="overview_done_wrapper">
        <div class="overview_done_link2">
            <a href="overview.php">Klik hier voor de overzicht van de taken die To-Do & Doing zijn</a>
        </div>
     </div>
</body>
</html>