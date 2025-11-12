<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../tasks/login.php');
    exit;
}

if (!isset($_POST['csrf_token'], $_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
    $_SESSION['errors'] = ['Ongeldige sessie.'];
    header('Location: ../tasks/login.php');
    exit;
}

$identifier = trim($_POST['identifier'] ?? '');
$password   = $_POST['password'] ?? '';
$remember   = !empty($_POST['remember']);

$errors = [];
if ($identifier === '' || strlen($identifier) < 3) {
    $errors[] = 'Vul een geldige gebruikersnaam in.';
}
if ($password === '' || strlen($password) < 6) {
    $errors[] = 'Wachtwoord is verplicht.';
}

if ($errors) {
    $_SESSION['errors'] = $errors;
    $_SESSION['old'] = ['identifier' => $identifier, 'remember' => $remember];
    header('Location: ../tasks/login.php');
    exit;
}

require_once 'conn.php';

$stmt = $conn->prepare('SELECT id, naam, username, password FROM users WHERE username = :u LIMIT 1');
$stmt->execute([':u' => $identifier]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user || !password_verify($password, $user['password'])) {
    $_SESSION['errors'] = ['Combinatie gebruikersnaam/wachtwoord klopt niet.'];
    $_SESSION['old'] = ['identifier' => $identifier, 'remember' => $remember];
    header('Location: ../tasks/login.php');
    exit;
}

session_regenerate_id(true);

$_SESSION['user'] = [
    'id'       => $user['id'],
    'naam'     => $user['naam'],
    'username' => $user['username'],
];

if ($remember) {
    setcookie(session_name(), session_id(), [
        'expires'  => time() + 60 * 60 * 24 * 7,
        'path'     => '/',
        'secure'   => false,
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
}

unset($_SESSION['csrf_token']);
header('Location: ../index.php');
exit;