<div>
    <form wire:submit="save">
        <div class="bg-white rounded-lg shadow p-6">
            <x-validation-errors class="mb-4" />
    
            <div class="mb-4">
                <x-label class="mb-2">
                    Familias
                </x-label>

                <x-select class="w-full" wire:model.live="subcategory.family_id">
                    <option class="text-gray-700 " value="">
                        --Selecciona una Familia--
                </option>
                    @foreach ($families as $family)
                    <option value="{{$family->id}}">
                        {{$family->name}}
                    </option>
                    @endforeach
                </x-select>
            </div>

            <div class="mb-4">
                <x-label class="mb-2">
                    Categorias
                </x-label>

                <x-select name="category_id" class="w-full" wire:model.live="subcategory.category_id">
                    <option value="">
                            --Selecciona una Categoria--
                    </option>
                    @foreach ($this->categories as $category)
                    <option value="{{$category->id}}"
                        @selected(old('category_id'))
                        >
                        {{$category->name}}
                    </option>
                    @endforeach
                </x-select>
            </div>


            <div class="mb-4">
                <x-label class="mb-2">
                    Nombre
                </x-label>
        <x-input class="w-full" placeholder="Ingrese el nombre de la Subcategoria de Productos" wire:model="subcategory.name" />
            </div>

            <div class="flex justify-end">
                <x-button>
                    Guardar
                </x-button>
            </div>
        </div>
    </form>

</div>