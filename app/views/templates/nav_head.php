<!-- app\views\templates\nav_head.php -->
<?php
// Make sure this file *starts* with `<?php` (no stray text/HTML before it)

$isLoggedIn = (function_exists('logged_in') && logged_in()) ? true : false;

$userId   = function_exists('get_user_id') ? (int) get_user_id() : 0;
$username = function_exists('get_username') ? (string) get_username($userId) : '';
$initials = strtoupper(substr($username !== '' ? $username : 'U', 0, 1));
?>

<!-- Mobile Drawer -->
<div id="sidebar" class="fixed inset-y-0 left-0 w-72 -translate-x-full transition-transform duration-200 ease-out bg-white dark:bg-[#0f172a] border-r border-slate-200 dark:border-slate-700 z-50">
  <div class="h-16 flex items-center justify-between px-4 border-b border-slate-200 dark:border-slate-700">
    <a class="flex items-center gap-2 font-semibold" href="<?= site_url(''); ?>">
      <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-indigo-600 text-white">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 3L1 9l11 6 9-4.909V17h2V9L12 3z"/></svg>
      </span>
      <span>Student Manager</span>
    </a>
    <button id="btnCloseSidebar" class="inline-flex items-center justify-center w-9 h-9 rounded-md hover:bg-slate-100 dark:hover:bg-slate-800" aria-label="Close menu">
      <svg class="w-6 h-6 text-slate-700 dark:text-slate-200" viewBox="0 0 24 24" fill="currentColor"><path d="M19 6.41 17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/></svg>
    </button>
  </div>
  <div class="p-4 space-y-1">
    <a href="<?= site_url(''); ?>" class="block px-3 py-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800">Home</a>
    <a href="<?= site_url('users'); ?>" class="block px-3 py-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800">Students</a>
    <a href="<?= site_url('users/create'); ?>" class="block px-3 py-2 rounded-lg text-indigo-600 hover:bg-indigo-50 dark:hover:bg-slate-800">Register</a>
    <div class="border-t border-slate-200 dark:border-slate-700 my-2"></div>
    <?php if ($isLoggedIn): ?>
      <div class="px-3 py-2 text-sm text-slate-600 dark:text-slate-300">Signed in as <span class="font-medium"><?= htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?></span></div>
      <a href="<?= site_url('users/'.$userId); ?>" class="block px-3 py-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800">Profile</a>
      <a href="<?= site_url('users/'.$userId.'/edit'); ?>" class="block px-3 py-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800">Settings</a>
      <a href="<?= site_url('auth/logout'); ?>" class="block px-3 py-2 rounded-lg text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20">Logout</a>
    <?php else: ?>
      <a href="<?= site_url('auth/login'); ?>" class="block px-3 py-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800">Login</a>
      <a href="<?= site_url('auth/register'); ?>" class="block px-3 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700">Register</a>
    <?php endif; ?>
  </div>
</div>

<!-- Scrim -->
<div id="scrim" class="fixed inset-0 bg-black/40 hidden z-40"></div>

<nav class="sticky top-0 z-50 border-b border-slate-200/70 bg-white/95 backdrop-blur-md text-text dark:bg-[#0f172a] dark:border-slate-700">
  <div class="max-w-6xl mx-auto px-4">
    <div class="flex items-center justify-between h-16">
      <!-- Left: Brand -->
      <div class="flex items-center gap-3">
        <button id="btnOpenSidebar" class="inline-flex md:hidden items-center justify-center w-9 h-9 rounded-md hover:bg-slate-100 dark:hover:bg-slate-800" aria-label="Open menu">
          <!-- Hamburger -->
          <svg class="w-6 h-6 text-slate-700 dark:text-slate-200" viewBox="0 0 24 24" fill="currentColor"><path d="M3 6h18v2H3V6zm0 5h18v2H3v-2zm0 5h18v2H3v-2z"/></svg>
        </button>

        <a class="flex items-center gap-2 font-semibold" href="<?= site_url(''); ?>">
          <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-indigo-600 text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 3L1 9l11 6 9-4.909V17h2V9L12 3z"/><path d="M11 12.84L3.197 8.5 2 9.163l9 4.91 9-4.91-1.197-.663L13 12.84V17h-2v-4.16z"/></svg>
          </span>
          <span>Student Manager</span>
        </a>
      </div>

      <!-- Center: Desktop links -->
      <div class="hidden md:flex items-center gap-6">
        <a href="<?= site_url(''); ?>" class="flex items-center gap-1 text-slate-700 hover:text-slate-900 dark:text-slate-200 dark:hover:text-white">
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 3l9 8h-3v9h-5v-6H11v6H6v-9H3l9-8z"/></svg>
          <span>Home</span>
        </a>
        <a href="<?= site_url('users'); ?>" class="flex items-center gap-1 text-slate-700 hover:text-slate-900 dark:text-slate-200 dark:hover:text-white">
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M3 5h18v2H3V5zm0 6h18v2H3v-2zm0 6h12v2H3v-2z"/></svg>
          <span>Students</span>
        </a>
        <a href="<?= site_url('users/create'); ?>" class="flex items-center gap-1 text-indigo-600 font-medium">
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6z"/></svg>
          <span>Register</span>
        </a>
      </div>

      <!-- Right: Auth / Profile -->
      <div class="flex items-center gap-2">
        <?php if ($isLoggedIn): ?>
          <!-- Profile dropdown -->
          <div class="relative">
            <button id="btnProfile" class="flex items-center gap-2 rounded-full hover:bg-slate-100 dark:hover:bg-slate-800 px-2 py-1">
              <span class="w-8 h-8 rounded-full bg-indigo-600 text-white grid place-items-center text-sm font-semibold"><?= htmlspecialchars($initials, ENT_QUOTES, 'UTF-8'); ?></span>
              <svg class="w-4 h-4 text-slate-600 dark:text-slate-300" viewBox="0 0 24 24" fill="currentColor"><path d="M7 10l5 5 5-5z"/></svg>
            </button>
            <div id="menuProfile" class="hidden absolute right-0 mt-2 w-48 rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-[#0f172a] shadow-lg overflow-hidden">
              <div class="px-3 py-2 text-sm text-slate-600 dark:text-slate-300">
                Signed in as <span class="font-medium"><?= htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?></span>
              </div>
              <div class="border-t border-slate-200 dark:border-slate-700"></div>
              <a href="<?= site_url('users/'.$userId); ?>" class="block px-3 py-2 text-sm hover:bg-slate-50 dark:hover:bg-slate-800">Profile</a>
              <a href="<?= site_url('users/'.$userId.'/edit'); ?>" class="block px-3 py-2 text-sm hover:bg-slate-50 dark:hover:bg-slate-800">Settings</a>
              <div class="border-t border-slate-200 dark:border-slate-700"></div>
              <a href="<?= site_url('auth/logout'); ?>" class="block px-3 py-2 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20">Logout</a>
            </div>
          </div>
        <?php else: ?>
          <!-- Login / Register -->
          <a href="<?= site_url('auth/login'); ?>" class="px-3 py-1.5 rounded-full border border-slate-300 text-slate-700 hover:bg-slate-50 dark:border-slate-600 dark:text-slate-200 dark:hover:bg-slate-800">Login</a>
          <a href="<?= site_url('auth/register'); ?>" class="px-3 py-1.5 rounded-full bg-indigo-600 text-white hover:bg-indigo-700">Register</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>

<script>
// drawer logic
(function(){
  const open  = document.getElementById('btnOpenSidebar');
  const close = document.getElementById('btnCloseSidebar');
  const side  = document.getElementById('sidebar');
  const scrim = document.getElementById('scrim');

  const HIDDEN_CLASS = '-translate-x-full';
  const lock   = () => document.documentElement.classList.add('overflow-hidden');
  const unlock = () => document.documentElement.classList.remove('overflow-hidden');

  function isOpen(){ return !side.classList.contains(HIDDEN_CLASS); }
  function show(){ side.classList.remove(HIDDEN_CLASS); scrim.classList.remove('hidden'); lock(); }
  function hide(){ side.classList.add(HIDDEN_CLASS);   scrim.classList.add('hidden');   unlock(); }
  function toggle(){ isOpen() ? hide() : show(); }

  // Sidebar toggle
  open  && open.addEventListener('click', toggle);
  close && close.addEventListener('click', hide);
  scrim && scrim.addEventListener('click', hide);
  document.addEventListener('keydown', (e) => { if (e.key === 'Escape' && isOpen()) hide(); });

  // Profile dropdown
  const btnProf = document.getElementById('btnProfile');
  const menuProf= document.getElementById('menuProfile');
  if (btnProf && menuProf){
    btnProf.addEventListener('click', () => menuProf.classList.toggle('hidden'));
    document.addEventListener('click', (e) => {
      if (!btnProf.contains(e.target) && !menuProf.contains(e.target)) {
        menuProf.classList.add('hidden');
      }
    });
  }
})();
</script>
