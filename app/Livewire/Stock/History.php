<?php

namespace App\Livewire\Stock;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\StockMovement;

class History extends Component
{
    use WithPagination;

    public string $search = '';
    public string $type = ''; // '', 'in', 'out'
    public int $perPage = 10;

    protected $queryString = ['search', 'type'];

    public function updatingSearch() { $this->resetPage(); }
    public function updatingType() { $this->resetPage(); }

    public function render()
    {
        $q = StockMovement::query()
            ->with(['product', 'user'])
            ->latest();

        if ($this->search !== '') {
            $s = $this->search;
            $q->where(function ($qq) use ($s) {
                $qq->whereHas('product', function ($qp) use ($s) {
                    $qp->where('name', 'like', "%{$s}%")
                       ->orWhere('sku', 'like', "%{$s}%");
                })->orWhereHas('user', function ($qu) use ($s) {
                    $qu->where('name', 'like', "%{$s}%");
                });
            });
        }

        if (in_array($this->type, ['in','out'], true)) {
            $q->where('type', $this->type);
        }

        $items = $q->paginate($this->perPage);

        return view('livewire.stock.history', compact('items'))
            ->layout('layouts.admin', ['title' => 'Stok Hareketleri']);
    }
}
