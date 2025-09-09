<?php
// Defensive defaults (do NOT rename — these are used by your backend)
$users   = isset($users)   && is_array($users) ? $users : [];
$page    = isset($page)    ? (string)$page    : '';
$info    = isset($info)    ? (string)$info    : '';
$total   = isset($total)   ? (int)$total      : count($users);
$perPage = isset($perPage) ? (int)$perPage    : 10;

// Preserve current search query (kept as-is)
$currentQ = isset($_GET['q']) ? trim((string)$_GET['q']) : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Users</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Tailwind config must come BEFORE the CDN script (keep this order) -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        text: '#0f172a',
                        muted: '#64748b',
                        muted2: '#94a3b8',
                        primary600: '#2563eb',
                        primary200: '#e0e7ff',
                    },
                    boxShadow: {
                        card: '0 10px 30px rgba(15, 23, 42, .08)',
                        cardDark: '0 10px 30px rgba(0, 0, 0, .35)',
                    },
                    borderRadius: {
                        'xl2': '18px',
                    },
                    backgroundImage: {
                        brand: 'linear-gradient(135deg, #eef2ff 0%, #f8fafc 30%, #f6f7fb 100%)',
                        heroA: 'radial-gradient(1200px 400px at 10% -10%, #e0e7ff55 0, transparent 60%)',
                        heroB: 'radial-gradient(1000px 400px at 90% -10%, #bae6fd55 0, transparent 60%)',
                    }
                }
            },
            darkMode: 'media'
        }
    </script>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Active page button */
        .tw-pager li.is-active>a {
            background-color: #2563eb;
            /* primary600 */
            color: #fff;
            border-color: #2563eb;
            box-shadow: 0 0 0 .2rem rgba(37, 99, 235, .15);
        }

        /* Focus ring */
        .tw-pager a:focus {
            outline: 2px solid transparent;
            box-shadow: 0 0 0 .2rem rgba(37, 99, 235, .25);
        }

        /* Dark mode tweaks */
        @media (prefers-color-scheme: dark) {
            .tw-pager li.is-active>a {
                background-color: #2563eb;
                border-color: #2563eb;
                color: #fff;
            }
        }
    </style>

</head>

<body class="min-h-screen flex flex-col text-text bg-brand dark:bg-[#0b1220] dark:text-[#e5e7eb]">

    <?php /* Top navigation (auth-aware) */ include APP_DIR . '/views/templates/nav_head.php'; ?>

    <?php
    // Page hero (dynamic, shared)
    // You can pass any crumbs; we’ll show Users as active.
    $crumbs = [
        ['label' => 'Home',   'href' => site_url('')],
        ['label' => 'Users',  'href' => site_url('users')],
    ];
    $activeLabel = 'Users';
    // If your page_hero supports feature flags:
    $badgeText   = 'Directory';
    $showEditId  = true; // show global Edit ID control in the hero
    include APP_DIR . '/views/templates/page_hero.php';
    ?>

    <main class="max-w-6xl mx-auto px-4 py-6 md:py-8 w-full flex-1">

        <!-- Top toolbar: totals, search, per-page, create -->
        <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div class="text-sm text-slate-600 dark:text-slate-300">
                <span class="inline-flex items-center rounded-full bg-slate-100 dark:bg-slate-800 px-2 py-0.5 text-slate-700 dark:text-slate-200 mr-2">
                    <?php echo (int)$total; ?>
                </span>
                total users
                <?php if ($info): ?>
                    <span class="ml-2 text-slate-400 dark:text-slate-400">• <?php echo htmlspecialchars($info, ENT_QUOTES, 'UTF-8'); ?></span>
                <?php endif; ?>
            </div>

            <div class="flex flex-wrap items-center gap-2">
                <!-- Search (names/params kept the same) -->
                <form method="get" class="flex items-center gap-2">
                    <input
                        type="text"
                        name="q"
                        value="<?php echo htmlspecialchars($currentQ, ENT_QUOTES, 'UTF-8'); ?>"
                        placeholder="Search name or email…"
                        class="w-56 rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-[#0f172a] px-3 py-2 text-sm shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 text-text dark:text-slate-100 placeholder-slate-400" />
                    <!-- Keep per_page when searching -->
                    <input type="hidden" name="per_page" value="<?php echo (int)$perPage; ?>" />
                    <button
                        type="submit"
                        class="inline-flex items-center rounded-full bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700 transition">
                        Search
                    </button>
                    <?php if ($currentQ !== ''): ?>
                        <a href="<?php echo site_url('users') . '?per_page=' . (int)$perPage; ?>"
                            class="text-sm text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-200">
                            Clear
                        </a>
                    <?php endif; ?>
                </form>

                <!-- Per-page selector -->
                <form method="get" class="flex items-center gap-2">
                    <input type="hidden" name="q" value="<?php echo htmlspecialchars($currentQ, ENT_QUOTES, 'UTF-8'); ?>" />
                    <label for="per_page" class="text-sm text-slate-600 dark:text-slate-300">Rows/page</label>
                    <select
                        id="per_page"
                        name="per_page"
                        class="rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-[#0f172a] px-2 py-2 text-sm shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 text-text dark:text-slate-100"
                        onchange="this.form.submit()">
                        <?php foreach ([5, 10, 20, 50] as $n): ?>
                            <option value="<?php echo $n; ?>" <?php echo ($perPage === $n ? 'selected' : ''); ?>>
                                <?php echo $n; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </form>

                <!-- Create button (unchanged action/method) -->
                <form action="<?php echo site_url('users/create'); ?>" method="post">
                    <button
                        type="submit"
                        class="inline-flex items-center rounded-full bg-emerald-600 px-4 py-2 text-sm font-medium text-white hover:bg-emerald-700 transition">
                        + Create
                    </button>
                </form>
            </div>
        </div>

        <!-- Table -->
        <div class="mt-4 overflow-hidden rounded-xl2 border border-slate-100 dark:border-slate-700 bg-white dark:bg-[#0f172a] shadow-card dark:shadow-cardDark">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-700">
                    <thead class="bg-slate-50 dark:bg-[#0b1220]">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600 dark:text-slate-300 w-20">ID</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600 dark:text-slate-300">First Name</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600 dark:text-slate-300">Last Name</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600 dark:text-slate-300">Email</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600 dark:text-slate-300">Username</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600 dark:text-slate-300 w-64">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700 bg-white dark:bg-[#0f172a]">
                        <?php if (empty($users)): ?>
                            <tr>
                                <td colspan="6" class="px-4 py-10 text-center text-slate-500 dark:text-slate-400">No records found.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($users as $u): ?>
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/40">
                                    <td class="px-4 py-3 font-medium text-slate-800 dark:text-slate-100">
                                        <?php echo htmlspecialchars($u['id'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
                                    </td>
                                    <td class="px-4 py-3 text-slate-800 dark:text-slate-100">
                                        <?php echo htmlspecialchars($u['fname'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
                                    </td>
                                    <td class="px-4 py-3 text-slate-800 dark:text-slate-100">
                                        <?php echo htmlspecialchars($u['lname'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
                                    </td>
                                    <td class="px-4 py-3">
                                        <?php $em = $u['email'] ?? ''; ?>
                                        <a class="text-indigo-600 dark:text-indigo-400 hover:underline" href="mailto:<?php echo htmlspecialchars($em, ENT_QUOTES, 'UTF-8'); ?>">
                                            <?php echo htmlspecialchars($em, ENT_QUOTES, 'UTF-8'); ?>
                                        </a>
                                    </td>
                                    <td class="px-4 py-3 text-slate-800 dark:text-slate-100">
                                        <?php echo htmlspecialchars($u['username'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex flex-wrap items-center gap-2">
                                            <a
                                                href="<?php echo site_url('users/' . urlencode($u['id'] ?? '')); ?>"
                                                class="inline-flex items-center rounded-md border border-slate-300 dark:border-slate-600 bg-white dark:bg-[#0f172a] px-3 py-1.5 text-sm text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800">
                                                View
                                            </a>
                                            <a
                                                href="<?php echo site_url('users/' . urlencode($u['id'] ?? '') . '/edit'); ?>"
                                                class="inline-flex items-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm text-white hover:bg-indigo-700">
                                                Edit
                                            </a>
                                            <form
                                                action="<?php echo site_url('users/' . urlencode($u['id'] ?? '') . '/delete'); ?>"
                                                method="post"
                                                onsubmit="return confirm('Delete this user?');">
                                                <button
                                                    type="submit"
                                                    class="inline-flex items-center rounded-md bg-rose-600 px-3 py-1.5 text-sm text-white hover:bg-rose-700">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Footer: pagination from your Pagination->paginate() -->
            <div class="flex flex-col items-center justify-between gap-3 border-t border-slate-100 dark:border-slate-700 p-4 md:flex-row">
                <div class="text-sm text-slate-500 dark:text-slate-400">
                    <?php if ($total > 0): ?>
                        <span class="font-medium"><?php echo (int)$total; ?></span> total •
                    <?php endif; ?>
                    <?php echo htmlspecialchars($info, ENT_QUOTES, 'UTF-8'); ?>
                </div>
                <div class="text-sm">
                    <?php echo $page; ?>
                </div>
            </div>
        </div>

        <p class="text-center mt-6 text-sm text-slate-400 dark:text-slate-500">LavaLust • Users</p>
    </main>

    <!-- Little nicety: keep the create-page’s behavior consistent -->
    <script>
        // optional helpers here if needed
    </script>
</body>

</html>