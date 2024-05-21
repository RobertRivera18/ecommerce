<?php

namespace App\Livewire\Products;

use Livewire\Component;
use CodersFree\Shoppingcart\Facades\Cart;

class AddToCart extends Component
{

    public $product;
    public $qty = 1;

    public function add_to_cart()
    {
        Cart::instance('shopping');
        Cart::add([
            'id' => $this->product->id,
            'name' => $this->product->name,
            'qty' => $this->qty,
            'price' => $this->product->price,
            'options' => [
                'image' => $this->product->image,
                'sku' => $this->product->sku,
                'features' => []
            ]
        ]);

        if (auth()->check()) {
            Cart::store(auth()->id());
        }

        $this->dispatch('cartUpdate',Cart::count());
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
        return view('livewire.products.add-to-cart');
    }
}
