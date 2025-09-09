<?php
// Expect these (optional) vars from the page: $crumbs (array) & $activeLabel (string)
$crumbs = $crumbs ?? [
  ['label' => 'Home',    'href' => site_url('')],
  ['label' => 'Students','href' => site_url('users')],
];
$activeLabel = $activeLabel ?? 'Register';
?>
<section class="py-6 border-b border-slate-200/60 bg-[image:var(--tw-gradient-stops)] [--tw-gradient-from:theme(colors.indigo.50)] [--tw-gradient-to:theme(colors.white)] bg-heroA bg-blend-normal dark:bg-[#0f172a] dark:border-slate-700"
         style="background-image: radial-gradient(1200px 400px at 10% -10%, #e0e7ff55 0, transparent 60%), radial-gradient(1000px 400px at 90% -10%, #bae6fd55 0, transparent 60%);">
  <div class="max-w-6xl mx-auto px-4">
    <div class="flex flex-wrap items-center justify-between gap-3">
      <div class="flex items-center gap-3">
        <span class="px-3 py-1.5 rounded-full text-sm border border-indigo-200 bg-indigo-50 text-indigo-600 dark:bg-slate-800 dark:border-slate-600 dark:text-indigo-200 inline-flex items-center">
          <svg class="w-4 h-4 mr-1" viewBox="0 0 24 24" fill="currentColor"><path d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4 8 5.79 8 8s1.79 4 4 4zm0 2c-3.33 0-10 1.67-10 5v1h20v-1c0-3.33-6.67-5-10-5z"/></svg>
          New Student
        </span>
        <nav aria-label="breadcrumb" class="text-sm text-slate-600 dark:text-slate-300">
          <ol class="flex items-center gap-2">
            <?php foreach ($crumbs as $i => $c): ?>
              <li><a class="hover:underline" href="<?= $c['href']; ?>"><?= htmlspecialchars($c['label'], ENT_QUOTES, 'UTF-8'); ?></a></li>
              <li>/</li>
            <?php endforeach; ?>
            <li class="font-medium text-slate-800 dark:text-slate-100"><?= htmlspecialchars($activeLabel, ENT_QUOTES, 'UTF-8'); ?></li>
          </ol>
        </nav>
      </div>

      <!-- Edit ID moved here -->
      <form class="w-full sm:w-auto"
            onsubmit="event.preventDefault(); if (eid && eid.value) location.href='<?= site_url('users'); ?>/'+encodeURIComponent(eid.value)+'/edit';">
        <div class="flex items-stretch">
          <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-slate-300 bg-white text-slate-700 dark:bg-[#0b1220] dark:border-slate-700 dark:text-slate-200">
            Edit&nbsp;ID
          </span>
          <input id="eid" type="number" min="1" placeholder="e.g., 1"
                 class="border border-slate-300 rounded-r-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-300 dark:bg-[#0b1220] dark:border-slate-700 dark:text-slate-100 placeholder-slate-400 w-44"/>
          <button class="ml-2 inline-flex items-center gap-2 px-3 py-2 rounded-full bg-amber-500 text-white hover:bg-amber-600 transition"
                  type="submit" aria-label="Go to Edit">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"><path d="M3 17.25V21h3.75l11.06-11.06-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41L18.37 3.29a.9959.9959 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>
            <span>Go</span>
          </button>
        </div>
      </form>
    </div>
  </div>
</section>
