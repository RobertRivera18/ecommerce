<x-container>
    <div class="bg-white rounded-lg shadow p-6">
        <div class="grid md:grid-cols-2 gap-6">
            <div class="col-span-1">
                <figure>
                    <img class=" rounded-xl aspect-[16/9] w-full object-cover object-center" src="{{$this->variants->image}}"
                        alt="">
                </figure>


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
                <p class="font-semibold text-xl text-gray-700 ml-8">
                    ${{$product->price}}
                </p>

                <div class="flex items-center space-x-6 mb-6" x-data="{
                       qty:@entangle('qty'),
                }">
                    <button
                        class="text-white bg-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-md text-sm px-4 py-2.5 text-center"
                        x-on:click="qty=qty-1" x-bind:disabled="qty==1">
                        -
                    </button>
                    <span x-text="qty" class="inline-block w-2 text-center"></span>
                    <button
                        class="text-white bg-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-md text-sm px-4 py-2.5 text-center "
                        x-on:click="qty=qty+1">
                        +
                    </button>
                </div>

                <div class="flex flex-wrap">
                    @foreach ($product->options as $option)
                    <div class="mr-4 mb-4">
                        <p class="font-semibold text-lg mb-2">
                            {{$option->name}}
                        </p>

                        <ul class="flex items-center space-x-4">
                            @foreach ($option->pivot->features as $feature)
                            <li>

                                @switch($option->type)
                                @case(1)
                                <button
                                    class=" w-20 h-8 font-semibold text-sm rounded-lg {{$selected_features[$option->id]==$feature['id'] ? 'bg-blue-600 text-white':'border border-gray-200 text-gray-700'}} "
                                    wire:click="$set('selected_features.{{$option->id}}',{{$feature['id']}})">
                                    {{$feature['value']}}
                                </button>
                                @break
                                @case(2)


                                <div class="p-0.5 border-2 rounded-lg flex items-center -mt-1.5 {{$selected_features[$option->id]==$feature['id'] ? 'border-blue-600':'border-transparent'}}">
                                    <button class="w-20 h-8 rounded-lg border border-gray-200"
                                        style="background-color: {{$feature['value']}}"
                                        wire:click="$set('selected_features.{{$option->id}}',{{$feature['id']}})"
                                        >

                                    </button>
                                </div>
                                @default

                                @endswitch

                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endforeach
                </div>


                <button
                    class=" w-full mb-4 text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                    wire:click="add_to_cart" wire:loading.attr="disabled"
                    >
                    Agregar al carrito
                </button>
                <div class="text-sm mb-4">
                    {{$product->description}}
                </div>

                <div class="flex text-gray-700 items-center space-x-4">
                    <i class="fa fa-truck-fast text-lg"></i>
                    <p>Entrega a domicilio</p>
                </div>


            </div>
        </div>
</x-container>