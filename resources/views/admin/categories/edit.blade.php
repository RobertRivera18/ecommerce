b<x-admin-layout :breadcrumb="[
    [
        'name'=>'Dashboard',
        'route'=>route('admin.dashboard'),
],
[
    'name'=>'Categorias',
    'route'=>route('admin.categories.index'),
],
[
    'name'=>$category->name
]
]">

    <form action="{{route('admin.categories.update',$category)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="bg-white rounded-lg shadow p-6">
            <x-validation-errors class="mb-4" />
            <div class="mb-4">
                <x-label class="mb-2">Familias</x-label>
                <x-select name="family_id" id="">
                    @foreach($families as $family)
                    <option value="{{$family->id}}" @selected(old('family_id')==$family->id)
                        >{{$family->name}}</option>
                    @endforeach
                </x-select>
            </div>
            <div class="mb-4">
                <x-label class="mb-2">
                    Nombre
                </x-label>
                <x-input class="w-full" placeholder="Ingrese el nombre de la Categoria de Productos" name="name"
                    value="{{old('name',$category->name)}}" />
            </div>

            <div class="flex justify-end">
                <form action="">
                    <x-danger-button onclick="confirmDelete()">
                        Eliminar
                    </x-danger-button>

                    <x-button class="ml-2">
                        Actualizar
                    </x-button>
            </div>
        </div>
    </form>


    <form action="{{route('admin.categories.destroy',$category)}}" method="POST" id="deleteForm">
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
</x-admin-layout>