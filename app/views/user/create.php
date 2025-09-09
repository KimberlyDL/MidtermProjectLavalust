<!-- app\views\user\create.php (Tailwind version) -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Register Student</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Tailwind CDN -->
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
    <?php /* include main nav */ include APP_DIR . '/views/templates/nav_head.php'; ?>

    <?php
    // Optional breadcrumbs & active label override (else defaults)
    $crumbs = [
        ['label' => 'Home', 'href' => site_url('')],
        ['label' => 'Students', 'href' => site_url('users')],
    ];
    $activeLabel = 'Register';
    include APP_DIR . '/views/templates/page_hero.php';
    ?>

    <!-- Main -->
    <main class="max-w-6xl mx-auto px-4 my-6 md:my-10 flex-1">
        <div class="flex justify-center">
            <div class="w-full max-w-3xl">
                <!-- Page Title -->
                <header class="mb-4">
                    <h1 class="text-xl font-semibold flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-600" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M19 3H5c-1.1 0-2 .9-2 2v16l7-3 7 3V5c0-1.1-.9-2-2-2z" />
                        </svg>
                        Register Student
                    </h1>
                    <p class="text-slate-500 dark:text-slate-400">Fill out the form to add a new student.</p>
                </header>

                <!-- Flash Alerts (unchanged function output) -->
                <?php flash_alert(); ?>

                <!-- Card -->
                <div class="rounded-xl2 overflow-hidden shadow-card bg-white dark:bg-[#0f172a] dark:shadow-cardDark border border-slate-100 dark:border-slate-700">
                    <div class="px-5 py-3 border-b border-slate-100 dark:border-slate-700 flex items-center justify-between">
                        <div class="flex items-center gap-2 text-slate-600 dark:text-slate-300">
                            <svg class="w-4 h-4 text-indigo-600" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M11 7h2v2h-2V7zm0 4h2v6h-2v-6zm1-9C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z" />
                            </svg>
                            <span class="text-sm">All fields are required</span>
                        </div>
                        <span class="text-sm text-slate-500 dark:text-slate-400">Step 1 of 1</span>
                    </div>

                    <div class="p-5 md:p-8">
                        <!-- Form: names/ids kept identical -->
                        <form action="<?= site_url('users/create'); ?>" method="POST" novalidate>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <!-- Last Name -->
                                <div>
                                    <label for="lName" class="block text-sm font-medium">Last Name</label>
                                    <div class="relative mt-1">
                                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4 8 5.79 8 8s1.79 4 4 4zm0 2c-3.33 0-10 1.67-10 5v1h20v-1c0-3.33-6.67-5-10-5z" />
                                            </svg>
                                        </span>
                                        <input type="text" id="lName" name="lName" placeholder="Dela Cruz" required
                                            class="pl-10 w-full rounded-md border border-slate-300 bg-white text-text placeholder-slate-400 py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-300 dark:bg-[#0b1220] dark:border-slate-700 dark:text-slate-100" />
                                    </div>
                                    <p class="text-sm text-slate-500 mt-1">Surname / Apelyido</p>
                                </div>

                                <!-- First Name -->
                                <div>
                                    <label for="fName" class="block text-sm font-medium">First Name</label>
                                    <div class="relative mt-1">
                                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4 8 5.79 8 8s1.79 4 4 4zm0 2c-3.33 0-10 1.67-10 5v1h20v-1c0-3.33-6.67-5-10-5z" />
                                            </svg>
                                        </span>
                                        <input type="text" id="fName" name="fName" placeholder="Juan" required
                                            class="pl-10 w-full rounded-md border border-slate-300 bg-white text-text placeholder-slate-400 py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-300 dark:bg-[#0b1220] dark:border-slate-700 dark:text-slate-100" />
                                    </div>
                                    <p class="text-sm text-slate-500 mt-1">Given name / Pangalan</p>
                                </div>

                                <!-- Username -->
                                <div>
                                    <label for="username" class="block text-sm font-medium">Username</label>
                                    <div class="relative mt-1">
                                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4 8 5.79 8 8s1.79 4 4 4zm0 2c-3.33 0-10 1.67-10 5v1h20v-1c0-3.33-6.67-5-10-5z" />
                                            </svg>
                                        </span>
                                        <input type="text" id="username" name="username" placeholder="juan123" required
                                            class="pl-10 w-full rounded-md border border-slate-300 bg-white text-text placeholder-slate-400 py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-300 dark:bg-[#0b1220] dark:border-slate-700 dark:text-slate-100" />
                                    </div>
                                    <p class="text-sm text-slate-500 mt-1">Used for login and identification</p>
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="email" class="block text-sm font-medium">Email</label>
                                    <div class="relative mt-1">
                                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M20 4H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
                                            </svg>
                                        </span>
                                        <input type="email" id="email" name="email" placeholder="juan@email.com" required
                                            class="pl-10 w-full rounded-md border border-slate-300 bg-white text-text placeholder-slate-400 py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-300 dark:bg-[#0b1220] dark:border-slate-700 dark:text-slate-100" />
                                    </div>
                                    <p class="text-sm text-slate-500 mt-1">We’ll send a confirmation if needed</p>
                                </div>

                                <!-- Password -->
                                <div>
                                    <label for="password" class="block text-sm font-medium">Password</label>
                                    <div class="relative mt-1">
                                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 17a2 2 0 1 0 .001-3.999A2 2 0 0 0 12 17zm6-7h-1V7a5 5 0 0 0-10 0v3H6c-1.1 0-2 .9-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8c0-1.1-.9-2-2-2zm-9-3a3 3 0 0 1 6 0v3H9V7z" />
                                            </svg>
                                        </span>
                                        <input type="password" id="password" name="password" placeholder="••••••••" required
                                            class="pl-10 w-full rounded-md border border-slate-300 bg-white text-text placeholder-slate-400 py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-300 dark:bg-[#0b1220] dark:border-slate-700 dark:text-slate-100" />
                                    </div>
                                </div>

                                <!-- Confirm Password -->
                                <div>
                                    <label for="password_confirmation" class="block text-sm font-medium">Confirm Password</label>
                                    <div class="relative mt-1">
                                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
                                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12 17a2 2 0 1 0 .001-3.999A2 2 0 0 0 12 17zm6-7h-1V7a5 5 0 0 0-10 0v3H6c-1.1 0-2 .9-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8c0-1.1-.9-2-2-2zm-9-3a3 3 0 0 1 6 0v3H9V7z" />
                                            </svg>
                                        </span>
                                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="••••••••" required
                                            class="pl-10 w-full rounded-md border border-slate-300 bg-white text-text placeholder-slate-400 py-2.5 px-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-300 dark:bg-[#0b1220] dark:border-slate-700 dark:text-slate-100" />
                                    </div>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="flex gap-3 mt-6 pt-2">
                                <button type="submit"
                                    class="inline-flex items-center gap-2 px-5 py-2.5 rounded-full bg-indigo-600 text-white hover:bg-indigo-700 transition">
                                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M9 16.17 4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z" />
                                    </svg>
                                    <span>Submit</span>
                                </button>
                                <a href="<?= site_url('users'); ?>"
                                    class="inline-flex items-center px-5 py-2.5 rounded-full border border-slate-300 text-slate-700 hover:bg-slate-50 dark:border-slate-600 dark:text-slate-200 dark:hover:bg-slate-800 transition">
                                    Cancel
                                </a>
                            </div>
                        </form>
                    </div>

                    <div class="px-5 py-3 border-t border-slate-100 dark:border-slate-700 text-right text-sm text-slate-500 dark:text-slate-400">
                        <span class="inline-flex items-center gap-2">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 2.18L18.09 6 12 8.82 5.91 6 12 3.18zM5 8.28l6 2.64v9.45C7.6 19.12 5 15.26 5 11V8.28zm8 12.09V10.92l6-2.64V11c0 4.26-2.6 8.12-6 9.37z" />
                            </svg>
                            Your submission is transmitted securely.
                        </span>
                    </div>
                </div>

                <!-- Mini footer -->
                <div class="text-center mt-6 text-slate-500 dark:text-slate-400">
                    🎓 Student Manager • Keep records clean &amp; consistent
                </div>
            </div>
        </div>
    </main>

    <!-- Small niceties -->
    <script>
        // Prefill focus + trim on blur
        (function() {
            const f = document.getElementById('fName');
            if (f) setTimeout(() => f.focus(), 200);
            document.querySelectorAll('input[type="text"], input[type="email"]').forEach(el => {
                el.addEventListener('blur', () => el.value = el.value.trim());
            });
        })();
    </script>
</body>

</html>