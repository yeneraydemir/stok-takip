<div class="space-y-6">
  <h1 class="text-3xl font-bold">Stok Hareketleri</h1>

  <div class="flex items-center gap-3">
    <input type="text" placeholder="Hareket ara..." wire:model.live.debounce.300ms="search"
           class="bg-neutral-900 border border-white/10 rounded px-3 py-2 w-full">
  </div>

  <div class="rounded-2xl bg-neutral-800/60 border border-white/10 overflow-x-auto">
    <table class="min-w-full text-sm">
      <thead class="text-neutral-300">
        <tr class="text-left">
          <th class="p-3">İşlem No</th>
          <th class="p-3">Ürün</th>
          <th class="p-3">Tip</th>
          <th class="p-3">Miktar</th>
          <th class="p-3">Kullanıcı</th>
          <th class="p-3">Tarih</th>
          <th class="p-3">Not</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-white/10">
        @forelse($items as $i)
          <tr>
            <td class="p-3">#{{ $i->id }}</td>
            <td class="p-3">{{ $i->product?->name ?? '—' }}</td>
            <td class="p-3">
              <span class="px-2 py-0.5 rounded text-xs {{ $i->type==='in'?'bg-emerald-600/20 text-emerald-300':'bg-rose-600/20 text-rose-300' }}">
                {{ strtoupper($i->type) }}
              </span>
            </td>
            <td class="p-3">{{ number_format($i->quantity,3,',','.') }}</td>
            <td class="p-3">{{ $i->user?->name ?? '—' }}</td>
            <td class="p-3">{{ $i->created_at?->format('d.m.Y H:i') }}</td>
            <td class="p-3">{{ $i->note }}</td>
          </tr>
        @empty
          <tr><td class="p-3 text-neutral-400" colspan="7">Kayıt yok.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div>{{ $items->links() }}</div>
</div>
