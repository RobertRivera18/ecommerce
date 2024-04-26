<x-admin-layout :breadcrumb="[
    [
        'name'=>'Dashboard',
        'route'=>route('admin.dashboard'),
],
[
        'name'=>'Productos',
        'route'=>route('admin.products.index')
],
[
        'name'=>'Nuevo'
],
]">


@livewire('admin.products.product-create')

</x-admin-layout>