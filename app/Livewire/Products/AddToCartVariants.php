<?php

namespace App\Livewire\Products;

use App\Models\Feature;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Gloudemans\Shoppingcart\Facades\Cart;

class AddToCartVariants extends Component
{
    public $product;
    public $qty;
    public $selected_features = [];

    public function mount()
    {
        foreach ($this->product->options as $option) {
            $features = collect($option->pivot->feature);
            $this->selected_features[$option->id] = $features->first()['id'];
        }
    }

    #[Computed()]
    public function variants()
    {
        $this->product->variants->filter(function ($variant) {
            return !array_diff($variant->feature->pluck('id')->toArray(), $this->selected_features);
        })->first();
    }

    public function add_to_cart()
    {
        Cart::instance('shopping');
        Cart::add([
            'id' => $this->product->id,
            'name' => $this->product->name,
            'qty' => $this->qty,
            'price' => $this->product->price,
            'options' => [
                'image' => $this->variant->image,
                'sku' => $this->variant->sku,
                'features' => Feature::wherIn('id', $this->selected_features)
                    ->pluck('description', 'id')
                    ->toArray()
            ]
        ]);

        if (auth()->check()) {
            Cart::store(auth()->id());
        }

        $this->emit('cartUpdate',Cart::count());
        $this->dispatch('swal', [
            'icon' => 'success',
            'title' => '¡Bien Hecho!',
            'text' => 'El producto se agregó al carrito de compra.',
            'showConfirmButton' => true,
            'confirmButtonText' => 'Continuar comprando',
            'confirmButtonColor' => '#3085d6',
            'timer' => 3000,
            'timerProgressBar' => true,
            'toast' => true,
            'position' => 'top-end'
        ]);
    }


    public function render()
    {
        return view('livewire.products.add-to-cart-variants');
    }
}
