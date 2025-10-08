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

     <div class="table_container">
        <?php
        require_once '../backend/conn.php';
        $query = "SELECT * FROM taken WHERE status != 'done' ";
        $statement = $conn->prepare($query);
        $statement->execute();
        $taken = $statement->fetchAll(PDO::FETCH_ASSOC);

        
        ?>

        <table>
            <tr>
                <th>Titel</th>
                <th>Afdeling</th>
                <th>Status</th>


            </tr>
            <?php foreach($taken as $taak):?>
                <tr>
                    <td><?php echo $taak['titel']; ?></td>
                    <td><?php echo $taak['afdeling']; ?></td>
                    <td><?php echo $taak['status']; ?></td>
                </tr>
            
            <?php endforeach; ?>
        </table>
     </div>

</body>
</html>