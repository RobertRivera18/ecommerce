<div>
    <section class="bg-white rounded-lg shadow-lg overflow-hidden">
        <header class=" bg-gray-900 px-4 py-2">
            <h2 class="text-white text-md">
                Direcciones de envio Guardadas
            </h2>
        </header>
        <div class="p-4">

            <x-validation-errors class="mb-4" />
            @if ($newAddress)
            <div class="grid grid-cols-4 gap-2">
                <div class="col-span-1">
                    <x-select wire:model="createAddress.type">
                        <option value="">Tipo de Direccion</option>
                        <option value="1">Domicilio</option>
                        <option value="2">Oficina</option>
                    </x-select>
                </div>
                <div class="col-span-3">
                    <x-input wire:model="createAddress.description" class="w-full" type="text"
                        placeholder="Nombre de la direccion" />
                </div>

                <div class="col-span-2">
                    <x-input wire:model="createAddress.ciudad" class="w-full" type="text" placeholder="Ciudad" />
                </div>

                <div class="col-span-2">
                    <x-input wire:model="createAddress.reference" class="w-full" type="text" placeholder="Referencia" />
                </div>
            </div>
            <hr class="my-4">

            <div x-data="{
                receiver: @entangle('createAddress.receiver'),
                receiver_info: @entangle('createAddress.receiver_info'),
            }" x-init="
                 $watch('receiver', value =>{
                       if(value == 1){
                        receiver_info.name = '{{auth()->user()->name}}';
                        receiver_info.last_name = '{{auth()->user()->last_name}}';
                        receiver_info.document_type = '{{auth()->user()->document_type}}';
                        receiver_info.document_number = '{{auth()->user()->document_number}}';
                        receiver_info.phone = '{{auth()->user()->phone}}';
                       }else{
                             receiver_info.name = '';
                             receiver_info.last_name = '';
                             receiver_info.document_number = '';
                             receiver_info.phone = '';
                             
                       }
                 })
            ">
                <p class="font-semibold mb-2">Quíen recibira el pedido?</p>
                <div class="flex space-x-2">
                    <label class="flex items-center">
                        <input x-model="receiver" type="radio" value="1" class="mr-1" />
                        Sere yo
                    </label>
                    <label class="flex items-center">
                        <input x-model="receiver" type="radio" value="2" class="mr-1" />
                        Otra persona
                    </label>
                </div>

                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <x-input x-model="receiver_info.name" x-bind:disabled="receiver==1" class="w-full" type="text"
                            placeholder="Nombres" />
                    </div>
                    <div>
                        <x-input x-bind:disabled="receiver==1" x-model="receiver_info.last_name" class="w-full"
                            type="text" placeholder="Apellidos" />
                    </div>

                    <div>
                        <div class="flex space-x-2">
                            <x-select>
                                @foreach (\App\Enums\TypeOfDocument::cases() as $item)
                                <option value="{{$item->value}}">
                                    {{$item->name}}
                                </option>
                                @endforeach
                            </x-select>
                            <x-input x-model="receiver_info.document_number" class="w-full"
                                placeholder="Numero de Documento" />
                        </div>
                    </div>
                    <div>
                        <x-input x-model="receiver_info.phone" type="text" class="w-full"
                            placeholder="Numero Celular" />
                    </div>

                    <div>
                        <button wire:click="$set('newAddress',false)"
                            class=" w-full hover:bg-red-700 border hover:text-white border-red-700 bg-transparent flex items-center justify-center mb-4 text-black  focus:ring-4 focus:outline-none focus:ring-gray-400 font-semibold rounded-lg text-base px-6 py-3 hover:border-transparent">
                            Cancelar
                        </button>
                    </div>
                    <div>
                        <button wire:click="store"
                            class="hover:bg-gray-700 border hover:text-white border-gray-700 bg-transparent flex items-center justify-center w-full  mb-4 text-black  focus:ring-4 focus:outline-none focus:ring-gray-400 font-semibold rounded-lg text-base px-6 py-3 hover:border-transparent">
                            Guardar
                        </button>
                    </div>
                </div>
            </div>
            @else


            @if ($addresses->count())
            <ul class="grid grid-cols-3 gap-4 ">
                @foreach ($addresses as $address)
                <li class="{{$address->default ?'bg-purple-200':'bg-white'}} rounded-lg shadow"
                     wire:key="addresses-{{$address->id}}">
                    <div class="p-4 flex items-center">
                        <div>
                            <i class="fas fa-house text-xl text-gray-900"></i>
                        </div>
                        <div class="flex-1 mx-4 text-xs">
                              <p class="text-gray-800">{{$address->type ==1 ?'Domicilio':'Oficina'}}</p>
                              <p class="font-semibold">{{$address->ciudad}}</p>
                              <p class="font-semibold">{{$address->description}}</p>
                              <p class="font-semibold">{{$address->receiver_info['name']}}</p>
                        </div>
                        <div class="text-xs text-gray-800 flex flex-col">
                            <button wire:click="setDefaultAddress({{$address->id}})"><i class="fas fa-star"></i></button>
                           <button><i class="fas fa-pencil"></i></button>
                           <button wire:click="deleteAddress({{$address->id}})"><i class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
            @else
            <p class="text-center">No se han encontrado direcciones</p>
            @endif

            <button
                class="hover:bg-gray-700 mt-2 border hover:text-white border-gray-700 bg-transparent flex items-center justify-center w-full  mb-4 text-black  focus:ring-4 focus:outline-none focus:ring-gray-400 font-semibold rounded-lg text-base px-6 py-3 hover:border-transparent"
                wire:click="set('newAddress',true)">Agregar
                <i class="fas fa-plus ml-2"></i></button>
            @endif
        </div>
    </section>
</div>