<x-app-layout>
    <x-container class="mt-12">
        <div class="grid grid-cols-3 gap-6">
            <div class="col-span-2">
                @livewire('shipping-addresses')
            </div>

            <div class="col-span-1">
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="bg-gray-800 text-white p-4">
                        <p class="font-semibold">Resumen de Compra</p>
                    </div>
                </div>
            </div>
        </div>
    </x-container>
</x-app-layout>