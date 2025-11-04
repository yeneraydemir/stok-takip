<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $search = '';
    public int $perPage = 10;

    protected $queryString = ['search'];

    public function updatingSearch() { $this->resetPage(); }

    public function delete(int $id): void
    {
        Product::findOrFail($id)->delete();
        session()->flash('ok', 'Ürün silindi.');
    }

    public function render()
    {
        $q = Product::query();

        if ($this->search !== '') {
            $q->where(function ($qq) {
                $qq->where('sku', 'like', "%{$this->search}%")
                  ->orWhere('name', 'like', "%{$this->search}%");
            });
        }

        $products = $q->orderBy('name')->paginate($this->perPage);

        return view('livewire.products.index', compact('products'))
            ->layout('components.admin.layout');
    }
}
