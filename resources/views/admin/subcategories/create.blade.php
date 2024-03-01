<x-admin-layout :breadcrumb="[
    [
        'name'=>'Dashboard',
        'route'=>route('admin.dashboard'),
],
[
    'name'=>'Subcategorias',
    'route'=>route('admin.subcategories.index'),
],
[
    'name'=>'Nuevo'
]
]">

    @livewire('admin.subcategories.subcategory-create')
</x-admin-layout>