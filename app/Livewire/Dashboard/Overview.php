<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Product;
use App\Models\StockMovement;

class Overview extends Component
{
    public array $stats = [];
    public $recent = [];

    public function render()
    {
        $this->stats = [
            'products' => Product::count(),
            'in'  => (int) StockMovement::where('type', 'in')->sum('quantity'),
            'out' => (int) StockMovement::where('type', 'out')->sum('quantity'),
            'low' => 0, // ürün tablosunda "stock" kolonu yoksa şimdilik 0
        ];

        $this->recent = StockMovement::with(['product','user'])
            ->latest()->limit(10)->get();

        return view('livewire.dashboard.overview', [
            'stats'  => $this->stats,
            'recent' => $this->recent,
        ])->layout('components.admin.layout', ['title' => 'Dashboard']);
    }
}
