@if(count($breadcrumb))


<nav class="mb-4">
    <ol class="flex flex-wrap">
        @foreach ($breadcrumb as $item)


<li class="text-sm leading-normal text-slate-700 {{!$loop->first ? "pl-2 before:float-left pr-2 before:content-['/']":''}}">
            @isset($item['route'])
            <a href="{{$item['route']}}" class="opacity-50" href="">
                {{$item['name']}}</a>

            @else
            {{$item['name']}}
            @endisset

        </li>


        @endforeach
    </ol>
    @if(count($breadcrumb)>1)
    <h6 class="font-bold">
        {{end($breadcrumb)['name']}}
    </h6>
    @endif
</nav>
@endif