<x-app-layout>
    <x-container class="mt-12">
        <div class="grid grid-cols-3 gap-6">
            <div class="col-span-2">
                @livewire('shipping-addresses')
            </div>

            <div class="col-span-1">
                <div class="bg-white rounded-lg shadow overflow-hidden mb-4">
                    <div class="bg-gray-800 text-white p-4 flex justify-between items-center">
                        <p class="font-semibold">Resumen de Compra ({{Cart::instance('shopping')->count()}})</p>
                        <a href="{{route('cart.index')}}">
                            <i class="fas fa-shopping-cart"></i>
                        </a>
                    </div>

                    <div class="p-4 text-gray-600">
                        <ul>
                            @foreach (Cart::content() as $item)
                            <li class="flex items-center space-x-4 gap-6">
                                <figure class="shrink">
                                    <img class="h-12 aspect-square rounded-lg" src="{{$item->options->image}}" alt="">
                                </figure>
                                <div class="flex-1">
                                    <p class="text-sm">{{$item->name}}</p>
                                    <p>${{$item->price}}</p>
                                </div>
                                <div>
                                   <p>{{$item->qty}}</p>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        <hr class="my-4">
                        <div class="flex justify-between">
                            <p class="text-lg">
                                Total
                            </p>
                            <p>
                                ${{Cart::subtotal()}}
                            </p>
                        </div>
                    </div>
                </div>
                <a class="block w-full mb-4 text-white bg-gradient-to-r from-gray-700 to-gray-900 hover:from-gray-600 hover:to-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-400 font-semibold rounded-lg text-base px-6 py-3 transition duration-300 ease-in-out" href="">Siguiente</a>
            </div>
        </div>
    </x-container>
</x-app-layout>