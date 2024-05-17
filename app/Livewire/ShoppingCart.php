<?php

namespace App\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;


class ShoppingCart extends Component
{

    public function mount(){
        Cart::instance('shopping');
    }

    public function render()
    {
        return view('livewire.shopping-cart');
    }
}
