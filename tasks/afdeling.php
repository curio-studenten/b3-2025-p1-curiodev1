<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Afdelingen overzicht</title>
    <?php require_once '../head.php'; ?>


</head>

<body class="tasks_index_body">
    
    <div class="afdeling_page">
        <div class="afdeling_header">
            <h1>Overzicht per afdeling</h1>
        </div>

        <div class="back_link_wrap">
            <a href="index.php">> Terug naar de takenlijst</a>
        </div>

        <?php
        require_once '../backend/conn.php';


        $allowed = ['personeel', 'horeca', 'techniek', 'inkoop', 'klantenservice', 'groen'];
        $labels = [
            'personeel' => 'Personeel',
            'horeca' => 'Horeca',
            'techniek' => 'Techniek',
            'inkoop' => 'Inkoop',
            'klantenservice' => 'Klantenservice',
            'groen' => 'Groen',
        ];


        $stmt = $conn->prepare("SELECT id, titel, afdeling, status, beschrijving FROM taken ORDER BY afdeling, status, id DESC");
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $groups = [];
        $counts = [];
        foreach ($allowed as $a) {
            $groups[$a] = [];
            $counts[$a] = ['total' => 0, 'todo' => 0, 'doing' => 0, 'done' => 0];
        }

        foreach ($rows as $r) {
            $dept = $r['afdeling'];
            if (!isset($groups[$dept])) {
                $groups[$dept] = [];
                $counts[$dept] = ['total' => 0, 'todo' => 0, 'doing' => 0, 'done' => 0];
            }
            $groups[$dept][] = $r;
            $counts[$dept]['total']++;
            if (isset($counts[$dept][$r['status']])) {
                $counts[$dept][$r['status']]++;
            }
        }
        ?>

        <div class="afdeling_grid">
            <?php foreach ($allowed as $dept): ?>
                <?php
                $label = $labels[$dept];
                $c = $counts[$dept];
                $listId = 'dept_' . $dept;
                ?>
                <div class="afdeling_card">
                    <h3><?= htmlspecialchars($label) ?></h3>
                    <div class="afdeling_stats">
                        <span class="chip">Totaal: <?= (int)$c['total'] ?></span>
                        <span class="chip">To-Do: <?= (int)$c['todo'] ?></span>
                        <span class="chip">Doing: <?= (int)$c['doing'] ?></span>
                        <span class="chip">Done: <?= (int)$c['done'] ?></span>
                    </div>
                    <div class="afdeling_actions">
                        <button class="afdeling_toggle" type="button" data-toggle="<?= $listId ?>">Toon taken</button>
                    </div>

                    <div id="<?= $listId ?>" class="tasks_list" hidden data-open="0">
                        <?php if (!empty($groups[$dept])): ?>
                            <?php foreach ($groups[$dept] as $t): ?>
                                <div class="task_item">
                                    <p><strong>Titel:</strong> <?= htmlspecialchars($t['titel']) ?></p>
                                    <p><strong>Status:</strong> <?= htmlspecialchars($t['status']) ?></p>
                                    <p><strong>Beschrijving:</strong> <?= htmlspecialchars($t['beschrijving']) ?></p>
                                    <p><a href="edit.php?id=<?= (int)$t['id'] ?>">Bekijk inhoud of pas aan</a></p>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p style="opacity:.9">Geen taken voor deze afdeling.</p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('.afdeling_toggle');
            if (!btn) return;
            const id = btn.getAttribute('data-toggle');
            const panel = document.getElementById(id);
            if (!panel) return;
            const open = panel.getAttribute('data-open') === '1';
            panel.hidden = open;
            panel.setAttribute('data-open', open ? '0' : '1');
            btn.textContent = open ? 'Toon taken' : 'Verberg taken';
        });
    </script>
</body>

</html>