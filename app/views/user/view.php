<!-- app/views/user/view.php (Tailwind version) -->
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>View Student</title>
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
</head>

<body class="min-h-screen flex flex-col text-text bg-brand dark:bg-[#0b1220] dark:text-[#e5e7eb]">
  <?php /* Top navigation with auth/profile */ include APP_DIR . '/views/templates/nav_head.php'; ?>

  <?php
  // Dynamic page hero (same component used across pages)
  $crumbs = [
    ['label' => 'Home',   'href' => site_url('')],
    ['label' => 'Students', 'href' => site_url('users')],
  ];
  $activeLabel = 'View';
  $badgeText   = 'Student Details';
  $showEditId  = true; // keep global Edit ID control available
  include APP_DIR . '/views/templates/page_hero.php';
  ?>

  <!-- Main -->
  <main class="max-w-6xl mx-auto px-4 my-6 md:my-10 w-full flex-1">
    <!-- Header bar with title + actions -->
    <div class="flex items-center justify-between mb-4">
      <h1 class="text-lg md:text-xl font-semibold flex items-center gap-2">
        <!-- small badge-ish icon -->
        <svg class="w-5 h-5 text-indigo-600" viewBox="0 0 24 24" fill="currentColor">
          <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 2.18L18.09 6 12 8.82 5.91 6 12 3.18zM5 8.28l6 2.64v9.45C7.6 19.12 5 15.26 5 11V8.28zm8 12.09V10.92l6-2.64V11c0 4.26-2.6 8.12-6 9.37z" />
        </svg>
        Student #<?= htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8'); ?>
      </h1>
      <div class="flex items-center gap-2">
        <a
          href="<?= site_url('users/' . $user['id'] . '/edit'); ?>"
          class="inline-flex items-center gap-2 rounded-full bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700 transition">
          <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
            <path d="M3 17.25V21h3.75l11.06-11.06-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41L18.37 3.29a.9959.9959 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" />
          </svg>
          Edit
        </a>
        <a
          href="<?= site_url('users'); ?>"
          class="inline-flex items-center rounded-full border border-slate-300 dark:border-slate-600 px-4 py-2 text-sm text-slate-700 dark:text-slate-200 bg-white dark:bg-[#0f172a] hover:bg-slate-50 dark:hover:bg-slate-800 transition">
          Back
        </a>
      </div>
    </div>

    <!-- Card -->
    <div class="rounded-xl2 overflow-hidden shadow-card dark:shadow-cardDark bg-white dark:bg-[#0f172a] border border-slate-100 dark:border-slate-700">
      <div class="px-5 py-3 border-b border-slate-100 dark:border-slate-700">
        <div class="flex items-center gap-2 text-slate-600 dark:text-slate-300">
          <svg class="w-4 h-4 text-indigo-600" viewBox="0 0 24 24" fill="currentColor">
            <path d="M19 3H5c-1.1 0-2 .9-2 2v16l7-3 7 3V5c0-1.1-.9-2-2-2z" />
          </svg>
          <span class="text-sm">Profile Information</span>
        </div>
      </div>

      <div class="p-5 md:p-8">
        <dl class="grid grid-cols-1 sm:grid-cols-3 gap-x-6 gap-y-4">
          <dt class="text-sm font-medium text-slate-500 dark:text-slate-400">First Name</dt>
          <dd class="sm:col-span-2 text-slate-800 dark:text-slate-100">
            <?= htmlspecialchars($user['fname'], ENT_QUOTES, 'UTF-8'); ?>
          </dd>

          <dt class="text-sm font-medium text-slate-500 dark:text-slate-400">Last Name</dt>
          <dd class="sm:col-span-2 text-slate-800 dark:text-slate-100">
            <?= htmlspecialchars($user['lname'], ENT_QUOTES, 'UTF-8'); ?>
          </dd>

          <dt class="text-sm font-medium text-slate-500 dark:text-slate-400">Email</dt>
          <dd class="sm:col-span-2">
            <a class="text-indigo-600 dark:text-indigo-400 hover:underline"
              href="mailto:<?= htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8'); ?>">
              <?= htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8'); ?>
            </a>
          </dd>

          <dt class="text-sm font-medium text-slate-500 dark:text-slate-400">Username</dt>
          <dd class="sm:col-span-2 text-slate-800 dark:text-slate-100">
            <?= htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8'); ?>
          </dd>
        </dl>
      </div>

      <div class="px-5 py-3 border-t border-slate-100 dark:border-slate-700 text-right text-sm text-slate-500 dark:text-slate-400">
        <span class="inline-flex items-center gap-2">
          <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4z" />
          </svg>
          Read-only view
        </span>
      </div>
    </div>

    <div class="text-center mt-6 text-slate-500 dark:text-slate-400">
      🎓 Student Manager • Keep records clean &amp; consistent
    </div>
  </main>
</body>

</html>