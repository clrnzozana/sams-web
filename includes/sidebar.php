<?php
$sidebarRole = strtolower((string) ($sidebarRole ?? 'admin'));
$sidebarActive = (string) ($sidebarActive ?? 'dashboard');
$sidebarBadgeMap = (array) ($sidebarBadgeMap ?? []);

if (!function_exists('sams_sidebar_icon')) {
    function sams_sidebar_icon(string $key, bool $active): string
    {
        $stroke = $active ? 'var(--nu-navy)' : 'rgba(255,255,255,0.9)';
        $fill = $active ? 'var(--nu-navy)' : 'none';

        return match ($key) {
            'dashboard' => '<svg viewBox="0 0 20 20" aria-hidden="true"><rect x="2.25" y="2.25" width="6.5" height="6.5" rx="1.5" fill="'.$fill.'" stroke="'.$stroke.'" stroke-width="1.4"/><rect x="11.25" y="2.25" width="6.5" height="3.5" rx="1.5" fill="'.$fill.'" stroke="'.$stroke.'" stroke-width="1.4"/><rect x="11.25" y="8.25" width="6.5" height="9.5" rx="1.5" fill="'.$fill.'" stroke="'.$stroke.'" stroke-width="1.4"/><rect x="2.25" y="11.25" width="6.5" height="6.5" rx="1.5" fill="'.$fill.'" stroke="'.$stroke.'" stroke-width="1.4"/></svg>',
            'home' => '<svg viewBox="0 0 20 20" aria-hidden="true"><path d="M3.5 9.25L10 3.75L16.5 9.25V16.5H12.5V11.5H7.5V16.5H3.5V9.25Z" fill="'.$fill.'" stroke="'.$stroke.'" stroke-width="1.3" stroke-linejoin="round"/></svg>',
            'applications' => '<svg viewBox="0 0 20 20" aria-hidden="true"><path d="M5.75 2.75H12.5L15.75 6V15.5A1.75 1.75 0 0 1 14 17.25H5.75A1.75 1.75 0 0 1 4 15.5V4.5A1.75 1.75 0 0 1 5.75 2.75Z" fill="'.$fill.'" stroke="'.$stroke.'" stroke-width="1.3" stroke-linejoin="round"/><path d="M12.5 2.75V6.25H15.75" fill="'.$fill.'" stroke="'.$stroke.'" stroke-width="1.3" stroke-linejoin="round"/><path d="M7 9.5H13M7 12.5H11" stroke="'.$stroke.'" stroke-width="1.3" stroke-linecap="round"/></svg>',
            'scheduling' => '<svg viewBox="0 0 20 20" aria-hidden="true"><rect x="2.75" y="4.25" width="14.5" height="12.5" rx="2" fill="'.$fill.'" stroke="'.$stroke.'" stroke-width="1.3"/><path d="M6 2.5V6M14 2.5V6M2.75 8.5H17.25" stroke="'.$stroke.'" stroke-width="1.3" stroke-linecap="round"/></svg>',
            'attendance' => '<svg viewBox="0 0 20 20" aria-hidden="true"><circle cx="10" cy="10" r="6.5" fill="'.$fill.'" stroke="'.$stroke.'" stroke-width="1.3"/><path d="M10 6V10.25L12.75 12.5" stroke="'.$stroke.'" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>',
            'reports' => '<svg viewBox="0 0 20 20" aria-hidden="true"><path d="M5 15.5V10.5M10 15.5V6.5M15 15.5V3.5" stroke="'.$stroke.'" stroke-width="1.5" stroke-linecap="round"/><path d="M3 16.5H17" stroke="'.$stroke.'" stroke-width="1.3" stroke-linecap="round"/></svg>',
            'evaluation' => '<svg viewBox="0 0 20 20" aria-hidden="true"><path d="M10 2.5L11.95 6.6L16.5 7.15L13.25 10.4L14.1 15L10 12.7L5.9 15L6.75 10.4L3.5 7.15L8.05 6.6L10 2.5Z" fill="'.$fill.'" stroke="'.$stroke.'" stroke-width="1.2" stroke-linejoin="round"/></svg>',
            'announcements' => '<svg viewBox="0 0 20 20" aria-hidden="true"><path d="M4.5 12.5H3.5A1.5 1.5 0 0 1 2 11V8.5A1.5 1.5 0 0 1 3.5 7H4.5L8 4.5V15.5L4.5 12.5Z" fill="'.$fill.'" stroke="'.$stroke.'" stroke-width="1.3" stroke-linejoin="round"/><path d="M8 7.5H12.5A2.5 2.5 0 0 1 15 10V11A2.5 2.5 0 0 1 12.5 13.5H8" fill="'.$fill.'" stroke="'.$stroke.'" stroke-width="1.3" stroke-linejoin="round"/></svg>',
            'students' => '<svg viewBox="0 0 20 20" aria-hidden="true"><circle cx="10" cy="6.6" r="2.8" fill="'.$fill.'" stroke="'.$stroke.'" stroke-width="1.3"/><path d="M4 15.5C4.8 13 7.2 11.5 10 11.5C12.8 11.5 15.2 13 16 15.5" fill="none" stroke="'.$stroke.'" stroke-width="1.3" stroke-linecap="round"/></svg>',
            'supervisors' => '<svg viewBox="0 0 20 20" aria-hidden="true"><circle cx="8" cy="7" r="2.8" fill="'.$fill.'" stroke="'.$stroke.'" stroke-width="1.3"/><path d="M3.5 15.5C4.15 13.25 6.1 11.7 8.5 11.7C10.9 11.7 12.85 13.25 13.5 15.5" fill="none" stroke="'.$stroke.'" stroke-width="1.3" stroke-linecap="round"/><path d="M12.5 5.5H16.25V9.25" stroke="'.$stroke.'" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>',
            'meetings' => '<svg viewBox="0 0 20 20" aria-hidden="true"><rect x="3" y="4" width="14" height="12" rx="2" fill="'.$fill.'" stroke="'.$stroke.'" stroke-width="1.3"/><path d="M3 8H17M7 2.5V5.5M13 2.5V5.5" stroke="'.$stroke.'" stroke-width="1.3" stroke-linecap="round"/></svg>',
            'nfc_kiosk' => '<svg viewBox="0 0 20 20" aria-hidden="true"><rect x="3" y="5" width="14" height="10" rx="2" fill="'.$fill.'" stroke="'.$stroke.'" stroke-width="1.3"/><path d="M7.5 9.5H12.5" stroke="'.$stroke.'" stroke-width="1.3" stroke-linecap="round"/><path d="M10 7V12" stroke="'.$stroke.'" stroke-width="1.3" stroke-linecap="round"/></svg>',
            'profile' => '<svg viewBox="0 0 20 20" aria-hidden="true"><circle cx="10" cy="6.5" r="2.8" fill="'.$fill.'" stroke="'.$stroke.'" stroke-width="1.3"/><path d="M4 15.5C4.8 13.2 7.2 11.8 10 11.8C12.8 11.8 15.2 13.2 16 15.5" fill="none" stroke="'.$stroke.'" stroke-width="1.3" stroke-linecap="round"/></svg>',
            'notifications' => '<svg viewBox="0 0 20 20" aria-hidden="true"><path d="M10 3.5A4 4 0 0 0 6 7.5V10L4.5 12.5V13.5H15.5V12.5L14 10V7.5A4 4 0 0 0 10 3.5Z" fill="'.$fill.'" stroke="'.$stroke.'" stroke-width="1.3" stroke-linejoin="round"/><path d="M8.25 15.5C8.6 16.4 9.2 17 10 17C10.8 17 11.4 16.4 11.75 15.5" fill="none" stroke="'.$stroke.'" stroke-width="1.3" stroke-linecap="round"/></svg>',
            'logout' => '<svg viewBox="0 0 20 20" aria-hidden="true"><path d="M7.5 5.5V3.75A1.75 1.75 0 0 1 9.25 2H14.5A1.75 1.75 0 0 1 16.25 3.75V16.25A1.75 1.75 0 0 1 14.5 18H9.25A1.75 1.75 0 0 1 7.5 16.25V14.5" fill="none" stroke="'.$stroke.'" stroke-width="1.3" stroke-linecap="round"/><path d="M10 10H16.5M13.5 7.5L16.5 10L13.5 12.5" fill="none" stroke="'.$stroke.'" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>',
            default => '<svg viewBox="0 0 20 20" aria-hidden="true"><circle cx="10" cy="10" r="6.5" fill="'.$fill.'" stroke="'.$stroke.'" stroke-width="1.3"/></svg>',
        };
    }
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
        ['key' => 'profile', 'href' => 'profile.php', 'label' => 'Profile'],
    ],
    'student' => [
        ['key' => 'dashboard', 'href' => 'dashboard.php', 'label' => 'Dashboard'],
        ['key' => 'schedule', 'href' => 'schedule.php', 'label' => 'Schedule'],
        ['key' => 'attendance', 'href' => 'attendance.php', 'label' => 'Attendance'],
        ['key' => 'availability', 'href' => 'availability.php', 'label' => 'Availability'],
        ['key' => 'announcements', 'href' => 'announcements.php', 'label' => 'Announcements'],
        ['key' => 'profile', 'href' => 'profile.php', 'label' => 'Profile'],
    ],
];

$footerNav = [
    ['key' => 'profile', 'href' => 'profile.php', 'label' => 'Profile'],
    ['key' => 'logout', 'href' => 'logout.php', 'label' => 'Logout'],
];

$roleNav = $navMap[$sidebarRole] ?? $navMap['admin'];
?>
<aside class="sidebar sidebar--<?= htmlspecialchars($sidebarRole, ENT_QUOTES, 'UTF-8') ?>" aria-label="Main navigation">
    <div class="sidebar__header">
        <div class="sidebar__brand">
            <div class="sidebar__logo" aria-hidden="true">
                <img src="<?= htmlspecialchars('../assets/logo.png', ENT_QUOTES, 'UTF-8') ?>" alt="" />
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
                        <span class="nav__icon" aria-hidden="true"><?= sams_sidebar_icon($item['key'], $isActive) ?></span>
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
        <div class="sidebar__section-label">Account</div>
        <ul class="nav__list">
            <?php foreach ($footerNav as $item): ?>
                <?php $isActive = $sidebarActive === $item['key']; ?>
                <li class="nav__item">
                    <a href="<?= htmlspecialchars($item['href'], ENT_QUOTES, 'UTF-8') ?>" class="nav__link<?= $isActive ? ' nav__link--active' : '' ?>"<?= $isActive ? ' aria-current="page"' : '' ?>>
                        <span class="nav__icon" aria-hidden="true"><?= sams_sidebar_icon($item['key'], $isActive) ?></span>
                        <span class="nav__label"><?= htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8') ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</aside>
