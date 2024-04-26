<div class="bg-white py-12">
    <x-container class="flex px-4">
        <aside class="w-52 flex-shrink-0">
            <ul class="space-y-4">
                @foreach ($options as $option)
                <li>
                    <button
                        class="px-4 py-2 bg-gray-200 w-full text-left text-gray-700 flex justify-between items-center">
                        {{$option->name}}
                        <i class="fas fa-angle-down"></i>
                    </button>

                    <ul class="mt-2 space-y-2">
                        @foreach ($option->features as $feature)
                        <li>
                            <label class="inline-flex items-center">
                                <x-checkbox class="mr-2"/>
                                {{$feature->description}}
                            </label>
                        </li>
                        @endforeach
                    </ul>
                </li>
                @endforeach
            </ul>


        </aside>

        <div class="flex-1">

        </div>


    </x-container>
</div>