<!doctype html>
<html lang="tr" class="h-full">
<head>
  <!-- LAYOUT HEAD HIT -->
  @vite(['resources/css/app.css','resources/js/app.js'])

  @php
      $manifestPath = public_path('build/manifest.json');
      $man = file_exists($manifestPath) ? json_decode(file_get_contents($manifestPath), true) : null;
      $cssFile = $man['resources/css/app.css']['file'] ?? null;
      $jsFile  = $man['resources/js/app.js']['file'] ?? null;
  @endphp
  @if($cssFile)
    <link rel="stylesheet" href="{{ asset('build/'.$cssFile) }}">
    <!-- CSS: {{ asset('build/'.$cssFile) }} -->
  @endif
  @if($jsFile)
    <script type="module" src="{{ asset('build/'.$jsFile) }}"></script>
    <!-- JS: {{ asset('build/'.$jsFile) }} -->
  @endif
</head>
<body class="h-full antialiased">
<div class="min-h-screen bg-neutral-900 text-neutral-100">
  <div class="flex">
    {{-- Sidebar --}}
    <aside class="hidden md:flex md:flex-col md:w-72 bg-neutral-950/90 border-r border-white/10 fixed inset-y-0">
      <div class="px-5 py-4 border-b border-white/10">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
          <div class="h-9 w-9 rounded-xl bg-indigo-600 grid place-items-center font-semibold">SP</div>
          <div>
            <div class="font-semibold">StokPro</div>
            <div class="text-xs text-neutral-400">Envanter Yönetimi</div>
          </div>
        </a>
      </div>

      <nav class="p-3 space-y-1 overflow-y-auto">
        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/10 {{ request()->routeIs('dashboard') ? 'bg-white/10' : '' }}">
          <span>🏠</span> <span>Dashboard</span>
        </a>

        <a href="{{ route('products.index') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/10 {{ request()->routeIs('products.*') ? 'bg-white/10' : '' }}">
          <span>📦</span> <span>Ürünler</span>
        </a>

        <a href="{{ route('stock.history') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/10 {{ request()->routeIs('stock.*') ? 'bg-white/10' : '' }}">
          <span>📈</span> <span>Stok Hareketleri</span>
        </a>
      </nav>

      <div class="mt-auto p-3 border-t border-white/10">
        <div class="flex items-center gap-3">
          <div class="h-9 w-9 rounded-lg bg-neutral-800 grid place-items-center">
            {{ strtoupper(auth()->user()->name[0] ?? 'U') }}
          </div>
          <div class="text-sm">
            <div class="font-medium truncate max-w-[12rem]">{{ auth()->user()->name }}</div>
            <div class="text-neutral-400 text-xs">Giriş yapıldı</div>
          </div>
          <form method="POST" action="{{ route('logout') }}" class="ml-auto">
            @csrf
            <button class="text-sm rounded px-3 py-1 bg-white/10 hover:bg-white/20">Çıkış</button>
          </form>
        </div>
      </div>
    </aside>

    {{-- Content --}}
    <main class="flex-1 w-full md:ml-72">
      <div class="px-6 py-6">
        {{ $slot }}
      </div>
    </main>
  </div>
</div>

@livewireScripts
</body>
</html>
