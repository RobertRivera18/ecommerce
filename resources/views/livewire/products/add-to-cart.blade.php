<x-container>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="grid md:grid-cols-2 gap-6">
            <div class="col-span-1">
                <figure class="mb-2">
                    <img class=" rounded-xl aspect-[16/9] w-full object-cover object-center" src="{{$product->image}}"
                        alt="">
                </figure>

                <div class="text-sm">
                    {{$product->description}}
                </div>
            </div>
            <div class="cols-span-1">
                <h1 class="text-lg text-gray-600 mb-1">{{$product->name}}</h1>

                <div class="flex  items-center space-x-2 mb-4">
                    <ul class="flex space-x-1 text-sm">
                        <li>
                            <i class="fa fa-star text-yellow-400"></i>
                        </li>
                        <li>
                            <i class="fa fa-star text-yellow-400"></i>
                        </li>
                        <li>
                            <i class="fa fa-star text-yellow-400"></i>
                        </li>

                        <li>
                            <i class="fa fa-star text-yellow-400"></i>
                        </li>

                    </ul>

                    <p class="text-sm text-gray-700">4.5 (55)</p>
                </div>
                <p class="font-semibold text-xl text-gray-700">
                    ${{$product->price}}
                </p>

                <div class="flex items-center space-x-6 mb-6" x-data="{
                       qty:@entangle('qty'),
                }">
                    <button
                        class="text-white bg-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-md text-sm px-4 py-2.5 text-center" 
                          x-on:click="qty=qty-1"
                          x-bind:disabled="qty==1"
                        >
                        -
                    </button>
                    <span x-text="qty" class="inline-block w-2 text-center"></span>
                    <button
                        class="text-white bg-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-md text-sm px-4 py-2.5 text-center "
                        x-on:click="qty=qty+1">
                        +
                    </button>
                </div>

                <button
                    class=" w-full mb-4 text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Agregar al carrito
                </button>

                <div class="flex text-gray-700 items-center space-x-4">
                    <i class="fa fa-truck-fast text-lg"></i>
                    <p>Entrega a domicilio</p>
                </div>


            </div>
        </div>
</x-container>