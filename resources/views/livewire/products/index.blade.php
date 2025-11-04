<div class="space-y-6">
  <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">
    <h1 class="text-2xl font-semibold">Ürünler</h1>

    <div class="flex items-center gap-2">
      <input
        type="text"
        placeholder="Ara: ad / SKU"
        class="bg-neutral-800/60 border border-white/10 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
        wire:model.debounce.400ms="search"
      />

      <select
        class="bg-neutral-800/60 border border-white/10 rounded-lg px-2 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
        wire:model="perPage"
        title="Sayfa başına"
      >
        <option value="10">10</option>
        <option value="25">25</option>
        <option value="50">50</option>
      </select>

      <a href="{{ route('products.create') }}"
         class="ml-2 inline-flex items-center justify-center rounded-lg bg-indigo-600 hover:bg-indigo-500 px-3 py-2 text-sm font-medium">
        + Yeni Ürün
      </a>
    </div>
  </div>

  @if (session('ok'))
    <div class="rounded-lg border border-emerald-500/30 bg-emerald-500/10 px-3 py-2 text-sm text-emerald-300">
      {{ session('ok') }}
    </div>
  @endif

  <div class="rounded-2xl bg-neutral-800/60 border border-white/10">
    <div class="p-4 border-b border-white/10 text-neutral-300 text-sm">
      Toplam: {{ $products->total() }} kayıt
    </div>

    <div class="p-4 overflow-x-auto">
      <table class="min-w-full text-sm">
        <thead class="text-neutral-300">
          <tr class="text-left">
            <th class="py-2 pr-4">Ad</th>
            <th class="py-2 pr-4">SKU</th>
            <th class="py-2 pr-4">Kategori</th>
            <th class="py-2 pr-4">Oluşturulma</th>
            <th class="py-2 pr-4 text-right">İşlem</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-white/10">
          @forelse ($products as $p)
            <tr>
              <td class="py-2 pr-4">{{ $p->name ?? '-' }}</td>
              <td class="py-2 pr-4">{{ $p->sku ?? '-' }}</td>
              <td class="py-2 pr-4">{{ $p->category ?? '-' }}</td>
              <td class="py-2 pr-4">{{ optional($p->created_at)->format('d.m.Y H:i') }}</td>
              <td class="py-2 pr-0">
                <div class="flex items-center gap-2 justify-end">
                  <a href="{{ route('products.edit', $p) }}"
                     class="text-indigo-400 hover:underline">Düzenle</a>

                  <button
                    class="text-red-400 hover:underline"
                    wire:click="delete({{ $p->id }})"
                    onclick="if(!confirm('Silinsin mi?')) { event.stopImmediatePropagation(); }"
                  >
                    Sil
                  </button>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td class="py-3 text-neutral-400" colspan="5">Henüz ürün yok.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="p-4 border-t border-white/10">
      {{ $products->onEachSide(1)->links() }}
    </div>
  </div>
</div>
