<?php
declare(strict_types=1);
require_once __DIR__ . '/config/bootstrap.php';

// Only allow from local testing
$remote = $_SERVER['REMOTE_ADDR'] ?? '';
if (!in_array($remote, ['127.0.0.1', '::1', 'localhost'], true)) {
    http_response_code(403);
    exit('Forbidden');
}

$role = (string) ($_GET['role'] ?? 'admin');
$pdo = sams_pdo();

if ($role === 'admin') {
    $stmt = $pdo->query("SELECT * FROM users WHERE role = 'admin' LIMIT 1");
    $u = $stmt->fetch(PDO::FETCH_ASSOC);
    sams_login([
        'id' => (int) $u['user_id'],
        'role' => 'admin',
        'email' => $u['email'],
        'first_name' => $u['first_name'],
        'last_name' => $u['last_name'],
    ]);
    header('Location: admin/dashboard.php');
    exit;
}

if ($role === 'supervisor') {
    $stmt = $pdo->query("SELECT * FROM users WHERE role = 'supervisor' LIMIT 1");
    $u = $stmt->fetch(PDO::FETCH_ASSOC);
    sams_login([
        'id' => (int) $u['user_id'],
        'role' => 'supervisor',
        'email' => $u['email'],
        'first_name' => $u['first_name'],
        'last_name' => $u['last_name'],
        'office_name' => 'ITSO Office',
    ]);
    header('Location: supervisor/dashboard.php');
    exit;
}

if ($role === 'student') {
    $stmt = $pdo->query("SELECT * FROM users WHERE role = 'student' LIMIT 1");
    $u = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt2 = $pdo->prepare("SELECT student_id, student_id_number FROM students WHERE user_id = ? LIMIT 1");
    $stmt2->execute([$u['user_id']]);
    $st = $stmt2->fetch(PDO::FETCH_ASSOC);
    sams_login([
        'id' => (int) $u['user_id'],
        'role' => 'student',
        'email' => $u['email'],
        'first_name' => $u['first_name'],
        'last_name' => $u['last_name'],
        'student_id' => $st['student_id_number'] ?? '2021-2',
    ]);
    header('Location: students/dashboard.php');
    exit;
}

header('Location: index.php');
exit;
