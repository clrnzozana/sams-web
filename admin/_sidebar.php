<?php
$sidebarRole = 'admin';
$sidebarActive = (string) ($activeAdminNav ?? '');
$sidebarBadgeMap = [
    'applications' => (int) ($pendingApplications ?? 0),
];
?>
<link rel="stylesheet" href="../assets/css/admin-shell.css?v=20260922" />
<link rel="stylesheet" href="../assets/css/sams-dark-mode.css?v=20260926" />
<?php require __DIR__ . '/../includes/sidebar.php'; ?>
<script src="../assets/js/admin-notifications.js?v=20260922" defer></script>
<script src="../assets/js/sams-theme.js?v=20260926" defer></script>