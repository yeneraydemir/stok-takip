document.addEventListener('DOMContentLoaded', () => {
  const html = document.documentElement;

  // ----- THEME -----
  const themeBtn = document.getElementById('themeButton');
  const themeIcon = document.getElementById('themeIcon');

  const paintIcon = () => {
    const isDark = html.classList.contains('dark');
    themeIcon.innerHTML = isDark
      ? '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M6.76 4.84l-1.8-1.79-1.41 1.41 1.79 1.8 1.42-1.42zM12 7a5 5 0 100 10 5 5 0 000-10zM4 12H1m22 0h-3M12 1v3M12 20v3"/></svg>'
      : '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/></svg>';
  };

  const saved = localStorage.getItem('theme');
  if (saved === 'dark' || (saved === null && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    html.classList.add('dark');
  }
  paintIcon();

  themeBtn?.addEventListener('click', () => {
    html.classList.toggle('dark');
    localStorage.setItem('theme', html.classList.contains('dark') ? 'dark' : 'light');
    paintIcon();
  });

  // ----- SIDEBAR (mobil) -----
  const sidebar = document.getElementById('sidebar');
  const openBtn  = document.getElementById('menuButton');
  const closeBtn = document.getElementById('closeSidebar');
  const backdrop = document.getElementById('backdrop');

  const openSidebar = () => {
    sidebar.classList.remove('-translate-x-full');
    backdrop.classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
  };
  const closeSidebarFn = () => {
    sidebar.classList.add('-translate-x-full');
    backdrop.classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
  };

  openBtn?.addEventListener('click', openSidebar);
  closeBtn?.addEventListener('click', closeSidebarFn);
  backdrop?.addEventListener('click', closeSidebarFn);
  window.addEventListener('resize', () => { if (window.innerWidth >= 768) closeSidebarFn(); });
});
