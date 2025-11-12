<?php
session_start();
$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];
unset($_SESSION['errors'], $_SESSION['old']);
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <title>Inloggen</title>
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

    <div class="login_container">
        <div class="login_card">
            <h1>Inloggen</h1>
            <p class="sub">Vul uw gegevens in om verder te gaan.</p>

            <?php if (!empty($errors)): ?>
                <div class="form-errors">
                    <ul>
                        <?php foreach ($errors as $msg): ?>
                            <li><?= htmlspecialchars($msg) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="../backend/loginController.php" method="post" autocomplete="on">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
                <div class="form_row">
                    <label for="login_ident">E-mailadres of gebruikersnaam</label>
                    <input type="text" id="login_ident" name="identifier" placeholder="bijv. email@bedrijf.nl of email123"
                        required minlength="3" maxlength="255" autofocus
                        value="<?= htmlspecialchars($old['identifier'] ?? '') ?>">
                </div>

                <div class="form_row">
                    <label for="login_pw">Wachtwoord</label>
                    <div class="pw_wrap">
                        <input type="password" id="login_pw" name="password" placeholder="••••••••"
                            required minlength="6" maxlength="128" autocomplete="current-password">
                        <button type="button" class="pw_toggle" id="togglePw">Toon</button>
                    </div>
                </div>

                <div class="form_inline">
                    <input type="checkbox" id="remember" name="remember" value="1" <?= !empty($old['remember']) ? 'checked' : '' ?>>
                    <label for="remember">Onthoud mij</label>
                </div>

                <div class="form_actions">
                    <button type="submit" class="btn">Inloggen</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        (function() {
            const btn = document.getElementById('togglePw');
            const pw = document.getElementById('login_pw');
            if (!btn || !pw) return;
            btn.addEventListener('click', function() {
                const isPw = pw.type === 'password';
                pw.type = isPw ? 'text' : 'password';
                btn.textContent = isPw ? 'Verberg' : 'Toon';
            });
        })();
    </script>
</body>

</html>