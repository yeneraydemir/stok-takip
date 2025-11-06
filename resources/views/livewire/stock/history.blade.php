<div class="space-y-6">
  <div class="flex items-center justify-between">
    <h1 class="text-3xl font-bold">Stok Hareketleri</h1>
  </div>

  <div class="rounded-2xl bg-neutral-800/60 border border-white/10 p-4">
    <div class="flex gap-3 flex-wrap">
      <input
        type="text"
        wire:model.debounce.400ms="search"
        placeholder="Ürün / SKU / Kullanıcı ara…"
        class="w-72 rounded-md bg-neutral-900 border-white/10 text-sm"
      />

      <select wire:model="type" class="rounded-md bg-neutral-900 border-white/10 text-sm">
        <option value="">Tümü</option>
        <option value="in">Giriş</option>
        <option value="out">Çıkış</option>
      </select>

      <select wire:model="perPage" class="rounded-md bg-neutral-900 border-white/10 text-sm">
        <option value="10">10 satır</option>
        <option value="25">25 satır</option>
        <option value="50">50 satır</option>
      </select>
    </div>
  </div>

  <div class="rounded-2xl bg-neutral-800/60 border border-white/10 overflow-x-auto">
    <table class="min-w-full text-sm">
      <thead class="text-neutral-300">
        <tr class="text-left">
          <th class="py-3 px-4">İşlem No</th>
          <th class="py-3 px-4">Ürün</th>
          <th class="py-3 px-4">Tip</th>
          <th class="py-3 px-4">Miktar</th>
          <th class="py-3 px-4">Kullanıcı</th>
          <th class="py-3 px-4">Tarih</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-white/10">
        @forelse ($items as $m)
          <tr>
            <td class="py-3 px-4">#TRX-{{ $m->id }}</td>
            <td class="py-3 px-4">{{ $m->product->name ?? '-' }}</td>
            <td class="py-3 px-4">
              @if($m->type === 'in')
                <span class="rounded px-2 py-0.5 bg-emerald-500/15 text-emerald-300">Giriş</span>
              @else
                <span class="rounded px-2 py-0.5 bg-rose-500/15 text-rose-300">Çıkış</span>
              @endif
            </td>
            <td class="py-3 px-4">{{ $m->type === 'in' ? '+' : '-' }}{{ $m->quantity }}</td>
            <td class="py-3 px-4">{{ $m->user->name ?? '-' }}</td>
            <td class="py-3 px-4">{{ optional($m->created_at)->format('d.m.Y H:i') }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="py-6 px-4 text-neutral-400">Henüz hareket yok.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div>
    {{ $items->links() }}
  </div>
</div>
