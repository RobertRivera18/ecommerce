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
    'name'=>$subcategory->name
]
]">

   @livewire('admin.subcategories.subcategory-edit',compact('subcategory'))
</x-admin-layout>