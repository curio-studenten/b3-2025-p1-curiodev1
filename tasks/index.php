<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8">
  <title>Taken-Index</title>
    
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
    <div class="kanban_container">
        <div class="todo_container">
            <h2>To-Do</h2>

            <div class="todo_tasks">
                    <?php 

                    require_once '../backend/conn.php';

                    $query = "SELECT * FROM taken";

                    $statement = $conn->prepare($query);
                    $statement->execute();

                    $items = $statement->fetchAll(PDO::FETCH_ASSOC);

                    ?>
                    <?php foreach($items as $item): ?>
                        <div class="todo_main">
                            <p><span>Titel:</span> <?php echo htmlspecialchars($item['titel']); ?></p>
                            <p><span>Afdeling:</span> <?php echo htmlspecialchars($item['afdeling']); ?></p>
                            <p><span>Beschrijving:</span> <?php echo htmlspecialchars($item['beschrijving']); ?></p>
                        </div>
                    <?php endforeach; ?>
                
            </div>
        </div>
        <div class="doing_container">
            <h2>Doing</h2>
            <div class="doing_tasks">

                
                <div class="doing_main">
                    
                    
                </div>
            </div>
        </div>
        <div class="done_container">
            <h2>Done</h2>
            <div class="done_tasks">
                <div class="done_main">

                </div>
            </div>
        </div>
    </div>


    <div class="new-task">
        <p><a href="create.php" class="btn btn-primary">➕ Nieuwe taak maken</a></p>
    </div>
    

    
</body>
</html>
