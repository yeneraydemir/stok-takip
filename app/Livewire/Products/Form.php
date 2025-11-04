<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Livewire\Component;

class Form extends Component
{
    public ?Product $product = null;

    public string $sku = '';
    public string $name = '';
    public string $unit = 'adet';
    public float $price = 0.0;

    public function mount(Product $product = null): void
    {
        if ($product && $product->exists) {
            $this->product = $product;
            $this->sku   = $product->sku;
            $this->name  = $product->name;
            $this->unit  = $product->unit;
            $this->price = (float) $product->price;
        }
    }

    protected function rules(): array
    {
        $id = $this->product?->id ?? 'NULL';
        return [
            'sku'   => "required|string|max:100|unique:products,sku,{$id}",
            'name'  => 'required|string|max:255',
            'unit'  => 'required|string|max:16',
            'price' => 'nullable|numeric|min:0',
        ];
    }

    public function save()
    {
        $data = $this->validate();

        $model = $this->product ?? new Product();
        $model->fill($data)->save();

        session()->flash('ok', 'Ürün kaydedildi.');
        return redirect()->route('products.index');
    }

    public function render()
    {
return view('livewire.products.form')
    ->layout('components.admin.layout', ['title' => 'Ürün Oluştur/Düzenle']);
    }
}
