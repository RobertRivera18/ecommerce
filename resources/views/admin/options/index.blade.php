<x-admin-layout :breadcrumb="[
    [
        'name'=>'Dashboard',
        'route'=>route('admin.dashboard'),
],
[
        'name'=>'Opciones'
],

]">

@livewire('admin.options.manage-options')
</x-admin-layout>