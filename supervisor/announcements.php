<?php
declare(strict_types=1);

require_once __DIR__ . '/../config/bootstrap.php';

$user = sams_authenticated_user();
if (!$user || (($user['role'] ?? null) !== 'supervisor')) {
    header('Location: ../login.php');
    exit;
}

$pdo = sams_pdo();
$stmt = $pdo->prepare("SELECT id, title, body, audience, is_active, created_at FROM announcements WHERE is_active = 1 AND audience IN ('supervisors','all') ORDER BY created_at DESC LIMIT 100");
$stmt->execute();
$announcements = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];

function h(?string $s): string { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Announcements — Supervisor</title>
  <link rel="stylesheet" href="../assets/css/sams-shell.css" />
  <link rel="stylesheet" href="../assets/css/notifications-shell.css?v=20260926" />
  <link rel="stylesheet" href="../assets/css/sams-dark-mode.css?v=20260926" />
  <style>
    body{font-family:Inter,Arial,Helvetica,sans-serif;background:var(--color-bg-app, #f8fafc)}
    .container{max-width:960px;margin:24px auto;padding:0 24px}
    .ann{background:#fff;border:1px solid var(--color-border, #e2e8f0);padding:20px;border-radius:12px;margin-bottom:14px;box-shadow:0 1px 3px rgba(16,24,40,.04)}
    .ann h3{margin:0 0 6px;color:#0f172a;font-size:18px}
    .ann .meta{color:#64748b;font-size:13px;margin-bottom:10px}
    .ann .body{color:#334155;line-height:1.55;font-size:14px}
    .empty-state{padding:36px;text-align:center;color:#64748b;background:#fff;border:1px dashed #cbd5e1;border-radius:12px}
  </style>
</head>
<body>
  <div class="shell">
    <?php $sidebarRole = 'supervisor'; require __DIR__ . '/../includes/sidebar.php'; ?>
    <main class="main">
      <header class="topbar" role="banner">
        <div>
          <div class="topbar__title">Announcements</div>
          <div class="topbar__sub">Supervisor Portal · Important notices and broadcast updates</div>
        </div>
        <div class="topbar__right">
          <button class="topbar__notif-btn" type="button" aria-label="Notifications">
            <svg viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" fill="#4A5565"/></svg>
          </button>
        </div>
      </header>
      <section class="page">
        <div class="container">
          <?php if (empty($announcements)): ?>
            <div class="empty-state">No announcements at this time.</div>
          <?php else: ?>
            <?php foreach ($announcements as $a): ?>
              <article class="ann">
                <h3><?php echo h($a['title']); ?></h3>
                <div class="meta"><?php echo h($a['created_at']); ?> • Audience: <?php echo h($a['audience']); ?></div>
                <div class="body"><?php echo nl2br(h($a['body'])); ?></div>
              </article>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </section>
    </main>
  </div>
  <script src="../assets/js/admin-notifications.js?v=20260922"></script>
<script src="../assets/js/sams-theme.js?v=20260926"></script>
</body>
</html>
