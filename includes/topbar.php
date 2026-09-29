<?php
$topbarTitle = (string) ($topbarTitle ?? 'Overview');
$topbarSubtitle = (string) ($topbarSubtitle ?? '');
$topbarBellCount = (int) ($topbarBellCount ?? 0);
$topbarUserName = (string) ($topbarUserName ?? 'User Name');
$topbarUserRole = (string) ($topbarUserRole ?? 'Portal');
?>
<header class="topbar" aria-label="Page header">
    <div class="topbar__heading">
        <h1 class="topbar__title"><?= htmlspecialchars($topbarTitle, ENT_QUOTES, 'UTF-8') ?></h1>
        <?php if ($topbarSubtitle !== ''): ?>
            <div class="topbar__subtitle"><?= htmlspecialchars($topbarSubtitle, ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>
    </div>

    <div class="topbar__actions">
        <button type="button" class="topbar__notif" aria-label="Notifications">
            <svg viewBox="0 0 20 20" aria-hidden="true" focusable="false">
                <path d="M10 2.75A4.25 4.25 0 0 0 5.75 7v2.4L4.5 11.75V12.5h11v-.75l-1.25-2.35V7A4.25 4.25 0 0 0 10 2.75Zm0 14.5a2.2 2.2 0 0 1-2.1-1.5h4.2a2.2 2.2 0 0 1-2.1 1.5Z" fill="currentColor"/>
            </svg>
            <?php if ($topbarBellCount > 0): ?>
                <span class="topbar__notif-dot" aria-label="<?= (int) $topbarBellCount ?> notifications"><?= (int) $topbarBellCount ?></span>
            <?php endif; ?>
        </button>

        <div class="topbar__user" aria-label="Current user">
            <div class="topbar__user-avatar" aria-hidden="true"><?= htmlspecialchars(substr($topbarUserName, 0, 1), ENT_QUOTES, 'UTF-8') ?></div>
            <div class="topbar__user-meta">
                <span class="topbar__user-name"><?= htmlspecialchars($topbarUserName, ENT_QUOTES, 'UTF-8') ?></span>
                <span class="topbar__user-role"><?= htmlspecialchars($topbarUserRole, ENT_QUOTES, 'UTF-8') ?></span>
            </div>
        </div>
    </div>
</header>
