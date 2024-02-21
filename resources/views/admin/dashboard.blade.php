<x-admin-layout :breadcrumb="[
    [
        'name'=>'Dashboard',
        'route'=>route('admin.dashboard')
]

]">
    <div class="grid grid-cols-1 lg:grid-cols-2  gap-6">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex items-center">
                <img class="h-12 w-12 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                    alt="{{ Auth::user()->name }}" />
                <div class="ml-4 flex-1">
                    <h2 class="text-lg font-semibold">
                        Bienvenido, {{auth()->user()->name}}
                    </h2>
                    <form action="{{route('logout')}} " method="POST">
                        @csrf
                        <button class="text-sm hover:text-blue-500">Cerrar Sesion</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow-lg p-6 flex items-center justify-center">
            <h2 class="text-xl font-semibold">
                LuxursuShop
            </h2>
        </div>
    </div>
</x-admin-layout>