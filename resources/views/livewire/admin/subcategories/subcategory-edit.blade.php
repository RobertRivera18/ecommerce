<div>
    <form wire:submit="save">
        <div class="bg-white rounded-lg shadow p-6">
            <x-validation-errors class="mb-4" />

            <div class="mb-4">
                <x-label class="mb-2">
                    Familias
                </x-label>

                <x-select class="w-full" wire:model.live="subcategoryEdit.family_id">
                    <option class="text-gray-700" disabled value="">
                        --Selecciona una Familia--
                    </option>

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

                <x-select name="category_id" class="w-full" wire:model.live="subcategoryEdit.category_id">
                    <option value="" disabled>
                        --Selecciona una Categoria--
                    </option>
                    @foreach ($this->categories as $category)
                    <option value="{{$category->id}}" @selected(old('category_id'))>
                        {{$category->name}}
                    </option>
                    @endforeach
                </x-select>
            </div>


            <div class="mb-4">
                <x-label class="mb-2">
                    Nombre
                </x-label>
                <x-input class="w-full" placeholder="Ingrese el nombre de la Subcategoria de Productos"
                    wire:model="subcategoryEdit.name" />
            </div>

            <div class="flex justify-end">
                <x-danger-button onclick="confirmDelete()">
                    Eliminar
                </x-danger-button>

                <x-button class="ml-2">
                    Actualizar
                </x-button>
            </div>
        </div>
    </form>

    <form action="{{route('admin.subcategories.destroy',$subcategory)}}" method="POST" id="deleteForm">
        @csrf
        @method('DELETE')

    </form>

@push('js')
<script>
    function confirmDelete(){
        Swal.fire({
               title: "Estas Seguro?",
               text: "¡No podrás revertir esto!",
               icon: "warning",
               showCancelButton: true,
               confirmButtonColor: "#3085d6",
               cancelButtonColor: "#d33",
               confirmButtonText: "¡Sí, Eliminalo",
               cancelButtonText:'Cancelar'
             }).then((result) => {
               if (result.isConfirmed) {
              document.getElementById('deleteForm').submit();

                  }
               });
                    }
</script>
 @endpush
</div>