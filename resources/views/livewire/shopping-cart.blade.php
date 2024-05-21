
    <div class="grid grid-cols-1 lg:grid-cols-7 gap-6">
        <div class="lg:col-span-5">
            <div class="flex justify-between mb-2">
                <h1 class="text-lg">Carrito de compras ({{Cart::count()}})</h1>
                <button
                    class="font-semibold text-gray-600 underline hover:text-red-600 hover:no-underline cursor-pointer"
                     wire:click="destroy"
                    >
                    <i class="fas fa-trash"></i>
                    Limpiar Carrito
                </button>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-6">
                <ul class="space-y-4">
                    @forelse (Cart::content() as $item)
                    <li class="lg:flex">
                        <img class="w-full lg:w-36 aspect-[16/9] rounded-lg object-cover object-center mr-2"
                            src="{{$item->options->image}}" alt="">

                        <div class="w-80">
                            <p class="text-sm">
                                <a href="{{route('products.show',$item->id)}}">
                                    {{$item->name}}</a>
                            </p>

                            <button
                                class="bg-red-100 hover:bg-red-200 text-red-800 text-xs font-semibold rounded px-2.5 py-0.5"
                                wire:click="remove('{{$item->rowId}}')">
                                <i class="fa fa-xmark"></i>
                                Quitar
                            </button>
                        </div>
                        <p>
                            ${{$item->price}}
                        </p>

                        <div class="ml-auto space-x-3 flex items-center">
                            <button
                                class="text-white bg-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm px-4 py-2 transition duration-150 ease-in-out"
                                wire:click="decrease('{{$item->rowId}}')"
                               >
                                -
                            </button>
                            <span class="inline-block w-8 text-center text-lg font-semibold">{{$item->qty}}</span>
                            <button
                                class="text-white bg-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm px-4 py-2 transition duration-150 ease-in-out"
                                wire:click="increase('{{$item->rowId}}')">
                                +
                            </button>
                        </div>
                        
                    </li>
                    @empty
                    <p class="text-center">
                        No hay productos en el carrito.
                    </p>
                    @endforelse


                </ul>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-lg px-6 py-4">
                <div class="flex justify-between mb-2 font-semibold">
                    <p>
                        Total:
                    </p>
                    <p>
                     ${{Cart::subtotal()}}
                    </p>
                </div>
                <button class=" block w-full mb-4 text-white bg-gradient-to-r from-gray-700 to-gray-900 hover:from-gray-600 hover:to-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-400 font-semibold rounded-lg text-base px-6 py-3 transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-105">Continuar Compra</button>
            </div>
        </div>

    </div>
