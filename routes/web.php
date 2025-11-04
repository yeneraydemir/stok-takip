<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Products\Index as ProductsIndex;
use App\Livewire\Products\Form  as ProductsForm;
use App\Livewire\Dashboard\Overview as DashboardOverview;
use App\Livewire\Stock\History as StockHistory;
use App\Http\Controllers\ProfileController;

Route::get('/', fn() => view('welcome'));

Route::middleware(['auth','verified'])->group(function () {
    Route::get('/dashboard', DashboardOverview::class)->name('dashboard');

    Route::get('/profile', [ProfileController::class,'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class,'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class,'destroy'])->name('profile.destroy');

    Route::get('/products', ProductsIndex::class)->name('products.index');
    Route::get('/products/create', ProductsForm::class)->name('products.create');
    Route::get('/products/{product}/edit', ProductsForm::class)->name('products.edit');

    Route::get('/stock/history', StockHistory::class)->name('stock.history');
});

require __DIR__.'/auth.php';
