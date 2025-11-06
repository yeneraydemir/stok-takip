<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'tailwind';

    public string $search = '';
    public int $perPage = 10;

    // URL ile senkron (page/search/perPage'ı linke yaz)
    protected $queryString = [
        'search'  => ['except' => ''],
        'perPage' => ['except' => 10],
        'page'    => ['except' => 1],
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatedPerPage(): void
    {
        $this->resetPage();
    }

    public function delete(int $id): void
    {
        Product::findOrFail($id)->delete();
        session()->flash('ok', 'Ürün silindi.');
        $this->resetPage();
    }

    public function render()
    {
        $products = Product::query()
            ->when($this->search !== '', function ($q) {
                $q->where(function ($qq) {
                    $qq->where('sku',  'like', "%{$this->search}%")
                       ->orWhere('name', 'like', "%{$this->search}%");
                });
            })
            ->orderBy('name')
            ->paginate($this->perPage);

    return view('livewire.products.index', compact('products'))
        ->layout('layouts.admin', ['title' => 'Ürünler']);
    }
}
