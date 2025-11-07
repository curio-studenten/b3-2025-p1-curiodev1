<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Takenlijst</title>

    <?php require_once '../head.php'; ?>

</head>

<body class="tasks_index_body">

    <section class="header">
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

        <div class="overview_done_wrapper">
            <div class="overview_done_link2">
                <a href="overview.php">>Klik hier voor de overzicht van de taken die To-Do & Doing zijn</a>
            </div>
        </div>
        <div class="overview_done_wrapper">
            <div class="overview_done_link">
                <a href="done.php">>Klik hier voor de overzicht van de taken die <span>Done</span> zijn</a>
            </div>
        </div>
                <div class="afdeling_info">
            <div class="afdeling_link">
                <a href="afdeling.php">>Klik hier voor de overzicht van de <span>Afdeling</span> te zien</a>
            </div>
        </div>

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
                <?php foreach ($items as $item): ?>
                    <?php if ($item['status'] == "todo"): ?>
                        <div class="todo_main">
                            <p><span>Titel:</span> <?= ($item['titel']); ?></p>
                            <p><span>Afdeling:</span> <?= ($item['afdeling']); ?></p>
                            <p><span>Beschrijving:</span> <?= ($item['beschrijving']); ?></p>
                            <a href="edit.php?id=<?= $item['id']; ?>">Bekijk inhoud of pas aan</a>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>

            </div>
        </div>
        <div class="doing_container">
            <h2>Doing</h2>
            <div class="doing_tasks">
               <?php foreach ($items as $item): ?>
                    <?php if ($item['status'] == "doing"): ?>
                        <div class="todo_main">
                            <p><span>Titel:</span> <?= ($item['titel']); ?></p>
                            <p><span>Afdeling:</span> <?= ($item['afdeling']); ?></p>
                            <p><span>Beschrijving:</span> <?= ($item['beschrijving']); ?></p>
                            <a href="edit.php?id=<?= $item['id']; ?>">Bekijk inhoud of pas aan</a>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="done_container">
            <h2>Done</h2>
            <div class="done_tasks">
                <div class="done_main">
                    <?php foreach ($items as $item): ?>
                        <?php if ($item['status'] == "done"): ?>
                            <div class="todo_main">
                                <p><span>Titel:</span> <?= ($item['titel']); ?></p>
                                <p><span>Afdeling:</span> <?= ($item['afdeling']); ?></p>
                                <p><span>Beschrijving:</span> <?= ($item['beschrijving']); ?></p>
                                <a href="edit.php?id=<?= $item['id']; ?>">Bekijk inhoud of pas aan</a>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>


    <div class="new-task">
        <p><a href="create.php" class="btn btn-primary">➕ Nieuwe taak maken</a></p>
    </div>



</body>

</html>