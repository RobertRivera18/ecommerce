<x-admin-layout :breadcrumb="[
    [
        'name'=>'Dashboard',
        'route'=>route('admin.dashboard'),
],
[
    'name'=>'Categorias',
    'route'=>route('admin.categories.index'),
],
[
    'name'=>'Nuevo'
]
]">

    <form action="{{route('admin.categories.store')}}" method="POST">
        @csrf
        <div class="bg-white rounded-lg shadow p-6">
            <x-validation-errors class="mb-4"/>
            <div class="mb-4">
                <x-label class="mb-2">Familias</x-label>
                <x-select name="family_id" id="">
                    @foreach($families as $family)
                          <option value="{{$family->id}}">{{$family->name}}</option>
                    @endforeach
                </x-select>
            </div>
            <div class="mb-4">
                <x-label class="mb-2">
                    Nombre
                </x-label>
                <x-input class="w-full" placeholder="Ingrese el nombre de la Categoria de Productos" name="name"
                    value="{{old('name')}}" />
            </div>

            <div class="flex justify-end">
                <x-button>
                    Guardar
                </x-button>
            </div>
        </div>
    </form>
</x-admin-layout>