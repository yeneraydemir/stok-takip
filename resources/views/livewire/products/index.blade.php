<div class="max-w-5xl mx-auto p-6">
    @if (session('ok'))
        <div class="mb-4 rounded bg-green-100 p-3 text-green-800">
            {{ session('ok') }}
        </div>
    @endif

    <div class="flex items-center justify-between mb-4 gap-3">
        <input type="text" class="border rounded px-3 py-2 w-full"
               placeholder="Ara: SKU / Ad"
               wire:model.live.debounce.300ms="search">
        <a href="{{ route('products.create') }}"
           class="shrink-0 inline-block rounded bg-blue-600 text-white px-4 py-2">Yeni Ürün</a>
    </div>

    <div class="overflow-x-auto border rounded">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-50">
                <tr class="text-left">
                    <th class="p-3">SKU</th>
                    <th class="p-3">Ad</th>
                    <th class="p-3">Birim</th>
                    <th class="p-3">Fiyat</th>
                    <th class="p-3">Eldeki</th>
                    <th class="p-3 w-40">İşlem</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $p)
                    <tr class="border-t">
                        <td class="p-3">{{ $p->sku }}</td>
                        <td class="p-3">{{ $p->name }}</td>
                        <td class="p-3">{{ $p->unit }}</td>
                        <td class="p-3">{{ number_format($p->price,2,',','.') }}</td>
                        <td class="p-3">{{ number_format($p->on_hand,3,',','.') }}</td>
                        <td class="p-3 flex gap-2">
                            <a href="{{ route('products.edit', $p) }}"
                               class="rounded bg-amber-500 text-white px-3 py-1">Düzenle</a>
                            <button wire:click="delete({{ $p->id }})"
                                    onclick="return confirm('Silinsin mi?')"
                                    class="rounded bg-red-600 text-white px-3 py-1">Sil</button>
                        </td>
                    </tr>
                @empty
                    <tr><td class="p-3" colspan="6">Kayıt yok.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>
