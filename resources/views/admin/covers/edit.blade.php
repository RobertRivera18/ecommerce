
<x-admin-layout :breadcrumb="[
    [
        'name'=>'Dashboard',
        'route'=>route('admin.dashboard'),
],
[
         'name'=>'Portadas',
         'route'=>route('admin.covers.index'),
],
[
         'name'=>'Editar'
]
]">

<form action="{{route('admin.covers.update',$cover)}}" 
method="POST"
enctype="multipart/form-data"
>
@csrf
@method('PUT')
<figure class="relative mb-4">
  <div class="absolute top-8 right-8">
      <label class="flex items-center px-2 py-1 rounded-lg bg-white cursor-pointer text-gray-700"><i
              class="fas fa-camera mr-2"></i>
          Actualizar Imagen
          <input 
                type="file" 
                class="hidden" 
                accept="image/*" 
                name="image" 
                onchange="previewImage(event, '#imgPreview')">
      </label>
  </div>
  <img src="{{$cover->image}}" class="aspect-[3/1] w-full object-cover object-center rounded-lg"
      id="imgPreview" alt="Portada">
</figure>

<x-validation-errors class="mb-4" :errors="$errors"/>

<div class="mb-4">
  <x-label>
      Titulo
  </x-label>
  <x-input class="w-full" value="{{old('title',$cover->title)}}" name="title"
      placeholder="Por favor ingrese el titulo de la imagen" />
</div>

<div class="mb-4">
  <x-label>
      Fecha de Inicio
  </x-label>
  <x-input type="date" class="w-full" value="{{old('start_at',$cover->start_at->format('Y-m-d'))}}" name="start_at" />
</div>

<div class="mb-4">
  <x-label>
      Fecha fin(opcional)
  </x-label>
  <x-input type="date" class="w-full" value="{{old('end_at',$cover->end_at ? $cover->end_at->format('Y-m-d'):'')}}" name="end_at" />
</div>

<div class="mb-4 flex space-x-2">
  <label>
      <x-input type="radio" name="is_active" value="1" :checked="$cover->is_active ==1"
      />
      Activo
  </label>

  <label>
      <x-input type="radio" name="is_active" value="0" :checked="$cover->is_active ==0"/>
      Inactivo
  </label>
</div>

<div class="flex justify-end">
      <x-button>
          Actualizar Portada
      </x-button>
</div>
</form>

@push('js')
<script>
function previewImage(event, querySelector){
//Recuperamos el input que desencadeno la acción
const input = event.target;
//Recuperamos la etiqueta img donde cargaremos la imagen
$imgPreview = document.querySelector(querySelector);
// Verificamos si existe una imagen seleccionada
if(!input.files.length) return
//Recuperamos el archivo subido
file = input.files[0];
//Creamos la url
objectURL = URL.createObjectURL(file);
//Modificamos el atributo src de la etiqueta img
$imgPreview.src = objectURL;
}
</script>
@endpush
</x-admin-layout>