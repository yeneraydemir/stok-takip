<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Product;
use App\Models\StockMovement;

class Overview extends Component
{
    public function render()
    {
        $stats = [
            'products' => Product::count(),
            'in'  => (float) StockMovement::where('type','in')->sum('quantity'),
            'out' => (float) StockMovement::where('type','out')->sum('quantity'),
            // basit örnek: elde stoku 0 veya altı olan ürün sayısı
            'low' => Product::all()->filter(fn($p) => $p->on_hand <= 0)->count(),
        ];

        $recent = StockMovement::with(['product','user'])->latest()->limit(10)->get();

        return view('livewire.dashboard.overview', compact('stats','recent'))
            ->layout('components.admin.layout');
    }
}
