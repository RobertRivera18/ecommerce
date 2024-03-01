<x-admin-layout :breadcrumb="[
    [
        'name'=>'Dashboard',
        'route'=>route('admin.dashboard'),
],
[
    'name'=>'Familias',
    'route'=>route('admin.families.index'),
],
[
    'name'=>$family->name
]
]">

    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{route('admin.families.update',$family)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <x-label class="mb-2">
                    Nombre
                </x-label>
                <x-input class="w-full" placeholder="Ingrese el nombre de la familia de productos" name="name"
                    value="{{old('name',$family->name)}}" />
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

        </form>
    </div>

    <form action="{{route('admin.families.destroy',$family)}}" method="POST" id="deleteForm">
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
                     Swal.fire({
                       title: "Eliminado!",
                       text: "La familia ha sido Eliminada",
                       icon: "success"
                     });
                  document.getElementById('deleteForm').submit();
    
  }
});

        }
    </script>
    @endpush


</x-admin-layout>