<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Landing</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Tailwind config (must precede CDN for your background utilities to work) -->
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
</head>

<body class="min-h-screen flex flex-col text-text bg-brand dark:bg-[#0b1220] dark:text-[#e5e7eb]">
    <?php /* Auth-aware main nav + mobile drawer */ include APP_DIR . '/views/templates/nav_head.php'; ?>

    <?php
    // Page hero setup (re-uses the dynamic hero with Edit ID in the hero bar)
    // These variables are optional; page_hero.php has sensible defaults.
    $crumbs = [
        ['label' => 'Home', 'href' => site_url('')],
    ];
    $activeLabel     = 'Dashboard';
    $heroBadgeLabel  = 'Quick Actions';  // the small pill on the left
    $showEditId      = true;             // keep the Edit ID control in the hero
    include APP_DIR . '/views/templates/page_hero.php';
    ?>

    <!-- Main -->
    <main class="max-w-6xl mx-auto px-4 py-6 md:py-10 flex-1">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- View Students -->
            <div class="rounded-xl2 bg-white dark:bg-[#0f172a] border border-slate-100 dark:border-slate-700 shadow-card dark:shadow-cardDark">
                <div class="p-6 text-center flex flex-col h-full">
                    <div class="text-4xl mb-2">
                        <!-- list icon -->
                        <svg class="w-10 h-10 mx-auto" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M3 5h18v2H3V5zm0 6h18v2H3v-2zm0 6h12v2H3v-2z" />
                        </svg>
                    </div>
                    <h5 class="text-lg font-semibold mb-1">View Students</h5>
                    <p class="text-slate-500 dark:text-slate-400 mb-4">Browse the full list.</p>
                    <a href="<?= site_url('users'); ?>"
                        class="mt-auto inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-full bg-indigo-600 text-white hover:bg-indigo-700 transition">
                        Go to Users
                    </a>
                </div>
            </div>

            <!-- Create Student -->
            <div class="rounded-xl2 bg-white dark:bg-[#0f172a] border border-slate-100 dark:border-slate-700 shadow-card dark:shadow-cardDark">
                <div class="p-6 text-center flex flex-col h-full">
                    <div class="text-4xl mb-2">
                        <!-- add person -->
                        <svg class="w-10 h-10 mx-auto" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M15 12c2.76 0 5-2.24 5-5S17.76 2 15 2 10 4.24 10 7s2.24 5 5 5zm-4 1c-3.31 0-10 1.66-10 5v2h14v-2c0-3.34-6.69-5-10-5zM20 14h-2v-2h-2v2h-2v2h2v2h2v-2h2v-2z" />
                        </svg>
                    </div>
                    <h5 class="text-lg font-semibold mb-1">Add Student</h5>
                    <p class="text-slate-500 dark:text-slate-400 mb-4">Register a new student.</p>
                    <!-- keep POST target as-is -->
                    <form action="<?= site_url('users/create'); ?>" method="POST" class="mt-auto">
                        <button type="submit"
                            class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-full bg-emerald-600 text-white hover:bg-emerald-700 transition">
                            Create User
                        </button>
                    </form>
                </div>
            </div>

            <!-- Edit Student -->
            <div class="rounded-xl2 bg-white dark:bg-[#0f172a] border border-slate-100 dark:border-slate-700 shadow-card dark:shadow-cardDark">
                <div class="p-6 text-center flex flex-col h-full">
                    <div class="text-4xl mb-2">
                        <!-- pencil -->
                        <svg class="w-10 h-10 mx-auto" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a1.003 1.003 0 0 0 0-1.42L18.37 3.29a1.003 1.003 0 0 0-1.42 0l-1.83 1.83 3.75 3.75 1.84-1.83z" />
                        </svg>
                    </div>
                    <h5 class="text-lg font-semibold mb-1">Edit Student</h5>
                    <p class="text-slate-500 dark:text-slate-400 mb-4">Go directly to edit page by ID.</p>

                    <!-- Do not change: same id/action/method/names -->
                    <form id="editForm" action="<?= site_url('users/1/edit'); ?>" method="GET"
                        class="flex items-stretch gap-2 justify-center">
                        <input id="editId" type="number" name="id" class="w-28 md:w-36 rounded-md border border-slate-300 bg-white text-text placeholder-slate-400 py-2 px-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-300 dark:bg-[#0b1220] dark:border-slate-700 dark:text-slate-100"
                            placeholder="Enter ID" min="1" required>
                        <button type="submit"
                            class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-full bg-amber-500 text-white hover:bg-amber-600 transition">
                            Go
                        </button>
                    </form>

                    <hr class="my-4 border-slate-200 dark:border-slate-700">
                    <a href="<?= site_url('users/1/edit'); ?>"
                        class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-full border border-amber-500 text-amber-600 hover:bg-amber-50 dark:hover:bg-amber-900/10 transition">
                        Edit User #1 (example)
                    </a>
                </div>
            </div>
        </div>
    </main>

    <!-- Keep your tiny helper for the edit form behavior exactly the same -->
    <script>
        (function() {
            const form = document.getElementById('editForm');
            const input = document.getElementById('editId');
            if (!form || !input) return;

            form.addEventListener('submit', function(e) {
                e.preventDefault();
                const id = (input.value || '').trim();
                if (!id) {
                    alert('Please enter a user ID.');
                    return;
                }
                window.location.href = "<?= site_url('users'); ?>/" + encodeURIComponent(id) + "/edit";
            });
        })();
    </script>
</body>

</html>