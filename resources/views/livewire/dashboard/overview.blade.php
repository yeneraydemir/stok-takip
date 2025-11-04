<div class="space-y-6">
  <div>
    <h1 class="text-3xl font-bold">Dashboard</h1>
    <p class="text-neutral-400">Envanter yönetim sistemine genel bakış</p>
  </div>

  {{-- Stat Kartları --}}
  <div class="grid md:grid-cols-4 gap-4">
    <div class="rounded-2xl bg-neutral-800/60 p-5 border border-white/10">
      <div class="text-neutral-400 text-sm">Toplam Ürün</div>
      <div class="mt-2 text-3xl font-semibold">{{ number_format($stats['products']) }}</div>
    </div>
    <div class="rounded-2xl bg-neutral-800/60 p-5 border border-white/10">
      <div class="text-neutral-400 text-sm">Toplam Giriş</div>
      <div class="mt-2 text-3xl font-semibold">+{{ number_format($stats['in'],0,',','.') }}</div>
    </div>
    <div class="rounded-2xl bg-neutral-800/60 p-5 border border-white/10">
      <div class="text-neutral-400 text-sm">Toplam Çıkış</div>
      <div class="mt-2 text-3xl font-semibold">-{{ number_format($stats['out'],0,',','.') }}</div>
    </div>
    <div class="rounded-2xl bg-neutral-800/60 p-5 border border-white/10">
      <div class="text-neutral-400 text-sm">Düşük/Negatif Stok</div>
      <div class="mt-2 text-3xl font-semibold">{{ number_format($stats['low']) }}</div>
    </div>
  </div>

  {{-- Son Hareketler --}}
  <div class="rounded-2xl bg-neutral-800/60 border border-white/10">
    <div class="p-5 border-b border-white/10 flex items-center justify-between">
      <h2 class="font-semibold text-lg">Son Hareketler</h2>
      <a href="{{ route('stock.history') }}" class="text-sm text-indigo-400 hover:underline">Tümünü gör</a>
    </div>
    <div class="p-5 overflow-x-auto">
      <table class="min-w-full text-sm">
        <thead class="text-neutral-300">
          <tr class="text-left">
            <th class="py-2 pr-4">Ürün</th>
            <th class="py-2 pr-4">Tip</th>
            <th class="py-2 pr-4">Miktar</th>
            <th class="py-2 pr-4">Kullanıcı</th>
            <th class="py-2 pr-4">Tarih</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-white/10">
          @forelse($recent as $m)
            <tr>
              <td class="py-2 pr-4">{{ $m->product?->name ?? '—' }}</td>
              <td class="py-2 pr-4">
                <span class="px-2 py-0.5 rounded text-xs {{ $m->type==='in'?'bg-emerald-600/20 text-emerald-300':'bg-rose-600/20 text-rose-300' }}">
                  {{ strtoupper($m->type) }}
                </span>
              </td>
              <td class="py-2 pr-4">{{ number_format($m->quantity,3,',','.') }}</td>
              <td class="py-2 pr-4">{{ $m->user?->name ?? '—' }}</td>
              <td class="py-2 pr-4">{{ $m->created_at?->format('d.m.Y H:i') }}</td>
            </tr>
          @empty
            <tr><td class="py-3 text-neutral-400" colspan="5">Henüz hareket yok.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
