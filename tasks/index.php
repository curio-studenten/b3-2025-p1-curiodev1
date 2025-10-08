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
            
            </nav>
        </div>
        
        </header>
    </section>
    <div class="kanban_container">
        <div class="todo_container">

        </div>
        <div class="doing_container">

        </div>
        <div class="done_container">
            
        </div>
    </div>


    <div class="new-task">
        <p><a href="create.php" class="btn btn-primary">➕ Nieuwe taak maken</a></p>
    </div>
</body>
</html>
