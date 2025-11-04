<div class="max-w-xl mx-auto p-6">
    <form wire:submit.prevent="save" class="space-y-4">
        <div>
            <label class="block mb-1">SKU</label>
            <input type="text" wire:model="sku" class="border rounded w-full px-3 py-2">
            @error('sku') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="block mb-1">Ad</label>
            <input type="text" wire:model="name" class="border rounded w-full px-3 py-2">
            @error('name') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
        </div>

        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="block mb-1">Birim</label>
                <input type="text" wire:model="unit" class="border rounded w-full px-3 py-2">
                @error('unit') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>
            <div>
                <label class="block mb-1">Fiyat</label>
                <input type="number" step="0.01" wire:model="price" class="border rounded w-full px-3 py-2">
                @error('price') <div class="text-red-600 text-sm">{{ $message }}</div> @enderror
            </div>
        </div>

        <div class="flex gap-2">
            <button class="rounded bg-blue-600 text-white px-4 py-2">Kaydet</button>
            <a href="{{ route('products.index') }}" class="rounded bg-gray-200 px-4 py-2">Vazgeç</a>
        </div>
    </form>
</div>
