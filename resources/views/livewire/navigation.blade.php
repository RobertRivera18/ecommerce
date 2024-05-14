<div x-data="{ open: false }">
    <!-- Encabezado -->
    <header class="bg-blue-800">
        <x-container class="px-4 py-4">
            <div class="flex justify-between space-x-8">
                <button class="text-xl md:text-3xl" x-on:click="open=true">
                    <i class="fas fa-bars text-white"></i>
                </button>
                <h1 class="text-white">
                    <a href="/" class="inline-flex flex-col items-end">
                        <span class="md:text-3xl text-xl leading-4 md:leading-6 font-semibold">
                            Ecommerce
                        </span class="text-xs">
                        <span>Tienda Online</span>
                    </a>
                </h1>

                <div class="flex-1 hidden md:block">
                    <x-input oninput="search(this.value)" class="w-full"
                        placeholder="Buscar por Producto, Tienda o marca" />
                </div>

                <div class="flex items-center  space-x-4 md:space-x-8">
                    <x-dropdown>
                        <x-slot name="trigger">
                            @auth
                            <button
                                class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                <img class="h-8 w-8 rounded-full object-cover"
                                    src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>
                            @else
                            <buttom class="text-lg md:text-xl">
                                <i class="fas fa-user text-white"></i>
                            </buttom>
                            @endauth

                        </x-slot>
                        <x-slot name="content">
                            @guest

                            <div class="px-4 py-2">
                                <div class="flex justify-center">
                                    <a class="px-4 py-1 bg-blue-700 text-white font-semibold rounded-lg"
                                        href="{{route('login')}}">Iniciar Sesión</a>
                                </div>
                                <p class="text-sm text-center mt-2">
                                    ¿No tienes Cuenta? <a class="text-blue-600 hover:underline"
                                        href="{{route('register')}}">Registrate</a>
                                </p>

                            </div>
                            @else
                            <x-dropdown-link href="{{route('profile.show')}}">
                                Mi perfil
                            </x-dropdown-link>
                            <div class="border-t border-gray-200"></div>
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                            @endguest
                        </x-slot>
                    </x-dropdown>

                    <buttom class="text-lg md:text-lg">
                        <i class="fas fa-shopping-cart text-white"></i>
                    </buttom>
                </div>
            </div>

            <div class="mt-4 md:hidden">
                <x-input class="w-full" placeholder="Buscar por Producto, Tienda o marca" />
            </div>
        </x-container>
    </header>

    <!-- Menú lateral -->
    <div x-show="open" x-on:click="open = false" class="fixed top-0 left-0 inset-0 bg-black bg-opacity-25 z-10">
        <div class="fixed top-0 left-0 z-20 flex h-screen w-screen">
            <!-- Contenido del menú -->
            <div class="w-full md:w-80 h-screen bg-white">
                <!-- Encabezado del menú -->
                <div class="px-4 py-3 bg-blue-700 text-white font-semibold">
                    <div class="flex justify-between items-center">
                        <span class="text-lg">Tienda LuxuruShop</span>
                        <button x-on:click="open = false">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- Lista de categorías -->
                <div class="h-[calc(100vh-52px)] overflow-auto">
                    <ul>
                        @foreach($families as $family)
                        <li wire:mouseover="$set('family_id',{{$family->id}})">
                            <a href="{{route('families.show',$family)}}"
                                class="flex items-center justify-between px-4 py-4 text-gray-700 hover:bg-blue-200">
                                {{$family->name}}
                                <i class="fa-solid fa-angle-right"></i>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Contenido principal -->
            <div class="w-80 xl:w-[57rem] pt-[52px] hidden md:block">
                <!-- Contenido de la categoría seleccionada -->
                <div class=" bg-white h-[calc(100vh-52px)] overflow-auto px-6 py-8">
                    <div class="mb-8 flex justify-between">
                        <p class="border-b-[3px] border-lime-400 uppercase text-xl font-semibold pb-1">
                            {{$this->familyName}}</p>
                        <a href="{{route('families.show',$family_id)}}"
                            class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Ver
                            Todo</a>
                    </div>
                    <!-- Lista de categorías y subcategorías -->
                    <ul class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                        @foreach ($this->categories as $category)
                        <li>
                            <a href="{{route('categories.show',$category)}}" class="text-blue-600 font-semibold text-lg">{{$category->name}}</a>
                            <ul class="mt-4 space-y-2">
                                @foreach($category->subcategories as $subcategory)
                                <li>
                                    <a href="{{route('subcategories.show',$subcategory)}}"
                                        class=" text-sm text-gray-700 hover:text-blue-600">{{$subcategory->name}}</a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @push('js')
    <script>
        function search(value){
          Livewire.dispatch('search',{
            search:value
          })
       }
    </script>
    @endpush
</div>