<?php
$sidebarRole = strtolower((string) ($sidebarRole ?? 'admin'));
$sidebarActive = (string) ($sidebarActive ?? '');
$sidebarBadgeMap = (array) ($sidebarBadgeMap ?? []);

if (!function_exists('sams_sidebar_icon')) {
    function sams_sidebar_icon(string $key): string
    {
        $iconNames = [
            'dashboard' => 'layout-dashboard',
            'home' => 'layout-dashboard',
            'applications' => 'clipboard-list',
            'scheduling' => 'calendar-days',
            'schedule' => 'calendar-days',
            'availability' => 'clock',
            'attendance' => 'circle-check',
            'reports' => 'chart-bar',
            'evaluation' => 'star-outline',
            'announcements' => 'megaphone',
            'students' => 'users-round',
            'supervisors' => 'user-check',
            'meetings' => 'calendar-clock',
            'nfc_kiosk' => 'scan-line',
            'profile' => 'user-round',
            'notifications' => 'bell',
            'logout' => 'log-out',
            'shuffle_requests' => 'shuffle',
        ];

        require_once __DIR__ . '/icon.php';
        return sams_icon($iconNames[$key] ?? 'circle-help', '');
    }
}

$routeKey = pathinfo((string) ($_SERVER['SCRIPT_NAME'] ?? ''), PATHINFO_FILENAME);
$routeAliases = [
    'application_view' => 'applications',
    'application' => 'applications',
    'documents' => 'applications',
    'evaluation_detail' => 'evaluation',
    'report_detail' => 'reports',
    'student_detail' => 'students',
    'student_profile' => 'students',
    'attendance_history' => 'attendance',
];
$routeKey = $routeAliases[$routeKey] ?? $routeKey;
if ($sidebarActive === '') {
    $sidebarActive = $routeKey;
}

$navMap = [
    'admin' => [
        ['key' => 'dashboard', 'href' => 'dashboard.php', 'label' => 'Dashboard'],
        ['key' => 'applications', 'href' => 'applications.php', 'label' => 'Applications'],
        ['key' => 'scheduling', 'href' => 'scheduling.php', 'label' => 'Scheduling'],
        ['key' => 'attendance', 'href' => 'attendance.php', 'label' => 'Attendance'],
        ['key' => 'nfc_kiosk', 'href' => 'nfc_kiosk.php', 'label' => 'NFC Kiosk'],
        ['key' => 'evaluation', 'href' => 'evaluation.php', 'label' => 'Evaluation'],
        ['key' => 'reports', 'href' => 'reports.php', 'label' => 'Reports'],
        ['key' => 'announcements', 'href' => 'announcements.php', 'label' => 'Announcements'],
        ['key' => 'supervisors', 'href' => 'supervisors.php', 'label' => 'Supervisors'],
        ['key' => 'meetings', 'href' => 'meetings.php', 'label' => 'Meetings'],
        ['key' => 'students', 'href' => 'students.php', 'label' => 'Students'],
        ['key' => 'shuffle_requests', 'href' => 'shuffle_requests.php', 'label' => 'Shuffle Requests'],
    ],
    'supervisor' => [
        ['key' => 'dashboard', 'href' => 'dashboard.php', 'label' => 'Dashboard'],
        ['key' => 'attendance', 'href' => 'attendance.php', 'label' => 'Attendance'],
        ['key' => 'students', 'href' => 'students.php', 'label' => 'Students'],
        ['key' => 'evaluation', 'href' => 'evaluation.php', 'label' => 'Evaluation'],
        ['key' => 'reports', 'href' => 'reports.php', 'label' => 'Reports'],
        ['key' => 'announcements', 'href' => 'announcements.php', 'label' => 'Announcements'],
    ],
    'student' => [
        ['key' => 'dashboard', 'href' => 'dashboard.php', 'label' => 'Dashboard'],
        ['key' => 'schedule', 'href' => 'schedule.php', 'label' => 'Schedule'],
        ['key' => 'attendance', 'href' => 'attendance_history.php', 'label' => 'Duty-Hour Report'],
        ['key' => 'availability', 'href' => 'availability.php', 'label' => 'Availability'],
        ['key' => 'announcements', 'href' => 'announcements.php', 'label' => 'Announcements'],
    ],
];

$footerNav = [
    ['key' => 'profile', 'href' => 'profile.php', 'label' => 'Profile'],
    ['key' => 'logout', 'href' => 'logout.php', 'label' => 'Logout'],
];

$roleNav = $navMap[$sidebarRole] ?? $navMap['admin'];
?>
<aside class="sidebar sidebar--<?= htmlspecialchars($sidebarRole, ENT_QUOTES, 'UTF-8') ?>" id="sidebar" aria-label="<?= htmlspecialchars(ucfirst($sidebarRole), ENT_QUOTES, 'UTF-8') ?> navigation">
    <div class="sidebar__header">
        <div class="sidebar__brand">
            <div class="sidebar__logo" aria-hidden="true">
                <span class="sidebar__logo-text">NU</span>
            </div>
            <div class="sidebar__brand-info">
                <span class="sidebar__app-name">SA System</span>
                <span class="sidebar__app-sub"><?= ucfirst($sidebarRole) ?> Portal</span>
            </div>
        </div>
    </div>

    <nav class="sidebar__nav" aria-label="Portal menu">
        <div class="sidebar__section-label">Main menu</div>
        <ul class="nav__list">
            <?php foreach ($roleNav as $item): ?>
                <?php $isActive = $sidebarActive === $item['key']; ?>
                <li class="nav__item">
                    <a href="<?= htmlspecialchars($item['href'], ENT_QUOTES, 'UTF-8') ?>" class="nav__link<?= $isActive ? ' nav__link--active' : '' ?>"<?= $isActive ? ' aria-current="page"' : '' ?>>
                        <span class="nav__icon" aria-hidden="true"><?= sams_sidebar_icon($item['key']) ?></span>
                        <span class="nav__label"><?= htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8') ?></span>
                        <?php if (!empty($sidebarBadgeMap[$item['key']])): ?>
                            <span class="nav__badge"><?= htmlspecialchars((string) $sidebarBadgeMap[$item['key']], ENT_QUOTES, 'UTF-8') ?></span>
                        <?php endif; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>

    <div class="sidebar__footer">
        <?php if ($sidebarRole === 'student' && (!empty($sidebarUserName) || !empty($sidebarUserId))): ?>
            <div class="sidebar__user">
                <span class="sidebar__user-label">Logged in as</span>
                <?php if (!empty($sidebarUserName)): ?><span class="sidebar__user-name"><?= htmlspecialchars((string) $sidebarUserName, ENT_QUOTES, 'UTF-8') ?></span><?php endif; ?>
                <?php if (!empty($sidebarUserId)): ?><span class="sidebar__user-id">Student ID: <?= htmlspecialchars((string) $sidebarUserId, ENT_QUOTES, 'UTF-8') ?></span><?php endif; ?>
            </div>
        <?php endif; ?>
        <div class="sidebar__section-label">Account</div>
        <ul class="nav__list">
            <?php foreach ($footerNav as $item): ?>
                <?php $isActive = $sidebarActive === $item['key']; ?>
                <li class="nav__item">
                    <a href="<?= htmlspecialchars($item['href'], ENT_QUOTES, 'UTF-8') ?>" class="nav__link<?= $isActive ? ' nav__link--active' : '' ?>"<?= $isActive ? ' aria-current="page"' : '' ?>>
                        <span class="nav__icon" aria-hidden="true"><?= sams_sidebar_icon($item['key']) ?></span>
                        <span class="nav__label"><?= htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8') ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</aside>
