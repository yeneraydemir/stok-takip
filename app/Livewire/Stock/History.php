<?php

namespace App\Livewire\Stock;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\StockMovement;

class History extends Component
{
    use WithPagination;

    public string $search = '';

    public function updatingSearch(){ $this->resetPage(); }

    public function render()
    {
        $q = StockMovement::with(['product','user'])->latest();
        if ($this->search !== '') {
            $q->where('note','like',"%{$this->search}%");
        }
        $items = $q->paginate(20);

        return view('livewire.stock.history', compact('items'))
            ->layout('components.admin.layout');
    }
}
