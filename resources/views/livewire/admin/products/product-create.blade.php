<div>

    <form wire:submit="store">
        <figure class="mb-4 relative">
            <div class="absolute top-8 right-8">
                <label class="flex items-center px-4 py-2 rounded-lg bg-white cursor-pointer text-gray-700"><i
                        class="fas fa-camera mr-2"></i>
                    Actualizar Imagen
                    <input type="file" class="hidden" accept="image/*" wire:model="image">
                </label>
            </div>
            <img class="aspect-[16/9] object-cover object-center w-full rounded-lg"
                src="{{$image ? $image->temporaryUrl():asset('img/no-image.png')}}" alt="">
        </figure>

        <x-validation-errors :errors="$errors"/>


        <div class="bg-white rounded-lg shadow p-6">
            <div class="mb-4">
                <x-label class="mb-1">
                    Codigo
                </x-label>
                <x-input class="w-full" wire:model="product.sku"
                    placeholder="Por favor ingrese el codigo del Producto" />
            </div>

            <div class="mb-4">
                <x-label class="mb-1">
                    Nombre
                </x-label>
                <x-input class="w-full" wire:model="product.name"
                    placeholder="Por favor ingrese el nombre del Producto" />
            </div>

            <div class="mb-4">
                <x-label class="mb-1">
                    Descripcion
                </x-label>
                <x-textarea wire:model="product.description" class="w-full"
                    placeholder="Por favor ingrese la descripcion del Producto">

                </x-textarea>

            </div>

            <div class="mb-4">
                <x-label class="mb-1">
                    Familias
                </x-label>

                <x-select class="w-full" wire:model.live="family_id">
                    <option value="" disabled>--Selecciona una familia--</option>
                    @foreach ($families as $family)
                    <option value="{{$family->id}}">
                        {{$family->name}}
                    </option>
                    @endforeach
                </x-select>
            </div>

            <div class="mb-4">
                <x-label class="mb-1">
                    Categorias
                </x-label>

                <x-select class="w-full" wire:model.live="category_id">
                    <option value="" disabled>--Selecciona una Categoria--</option>
                    @foreach ($this->categories as $category)
                    <option value="{{$category->id}}">
                        {{$category->name}}
                    </option>
                    @endforeach
                </x-select>
            </div>


            <div class="mb-4">
                <x-label class="mb-1">
                    Subcategorias
                </x-label>

                <x-select class="w-full" wire:model.live="product.subcategory_id">
                    <option value="" disabled>--Selecciona una Subcategoria--</option>
                    @foreach ($this->subcategories as $subcategory)
                    <option value="{{$subcategory->id}}">
                        {{$subcategory->name}}
                    </option>
                    @endforeach
                </x-select>
            </div>

            <div class="mb-4">
                <x-label class="mb-1">
                    Precio
                </x-label>
                
                <x-input
                  type="number"
                  step="0.01"
                  wire:model="product.price"
                  class="w-full"
                  placeholder="Ingrese el precio del producto"
                 >  
                </x-input>
            </div>

            <div class="flex justify-end">
                <x-button>Guardar</x-button>
            </div>
        </div>

    </form>

    
</div>