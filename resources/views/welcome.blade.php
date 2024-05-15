<x-app-layout>

  @push('css')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  @endpush

  <div class="swiper mb-12">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
      <!-- Slides -->
      @foreach ($covers as $cover)
      <div class="swiper-slide">
        <img src="{{$cover->image}}" class="w-full aspect-[3/1] object-cover object-center">
      </div>
      @endforeach

    </div>
    <!-- If we need pagination -->
    <div class="swiper-pagination"></div>

    <!-- If we need navigation buttons -->
    <div class="swiper-button-prev"></div>
    <div class="swiper-button-next"></div>
  </div>

  <x-container class="p-6">
    <h1 class="text-2xl text-gray-700 mb-4 text-center">Ultimos Productos</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      @foreach ($lastProducts as $product)
      {{-- <article class="bg-white rounded-lg shadow overflow-hidden">
        <img class="w-full h-48 object-cover object-center" src="{{$product->image}}" alt="">
        <div class="p-4">
          <h1 class="text-md mb-2 font- text-gray-700 line-clamp-2 min-h-[56px]">{{$product->name}}</h1>
          <p class="text-gray-600 mb-4">${{$product->price}}</p>
          <a href="#"
            class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Ver más
            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
              fill="none" viewBox="0 0 14 10">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M1 5h12m0 0L9 1m4 4L9 9" />
            </svg>
          </a>
        </div>
      </article> --}}

      <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <a  href="{{route('products.show',$product)}}">
          <img class="overflow-hidden object-cover object-center p-4 rounded-lg " src="{{$product->image}}" alt="{{$product->name}}" />
        </a>
        <div class="px-5 pb-5">
          <a href="{{route('products.show',$product)}}">
            <h5 class="text-md tracking-tight text-gray-900 dark:text-white">{{$product->name}}</h5>
          </a>
        
          <div class="flex items-center justify-between">
            <span class="text-lg font-bold text-gray-900 dark:text-white">${{$product->price}}</span>
            <a href="{{route('products.show',$product)}}"
              class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Ver más</a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </x-container>




  @push('js')
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  <script>
    const swiper = new Swiper('.swiper', {
  // Optional parameters
  loop: true,
  autoplay:{
    delay:8000
  }
}

  // If we need pagination
  pagination: {
    el: '.swiper-pagination',
  },

  // Navigation arrows
  navigation: {
    nextEl: '.swiper-button-next',
    prevEl: '.swiper-button-prev',
  },
});
  </script>
  @endpush

</x-app-layout>