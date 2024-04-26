<?php

use App\Models\Product;
use App\Models\Variant;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\WelcomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [WelcomeController::class, 'index'])->name('welcome.index');
Route::get('families/{family}', [FamilyController::class, 'show'])->name('families.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('prueba', function () {


    $product = Product::find(150);
    $features = $product->options->pluck('pivot.features');
    $combinaciones = generarCombinaciones($features);

    $product->variants()->delete();
    foreach ($combinaciones as $combinacion) {
        $variant = Variant::create([
            'product_id' => $product->id
        ]);
        $variant->features()->attach($combinaciones);
    }
    return 'Variantes creadas';
});

function generarCombinaciones($arrays, $indice = 0, $combinacion = [])
{
    if ($indice == count($arrays)) {
        return [$combinacion];
    }
    $resultado = [];
    foreach ($arrays[$indice] as $item) {
        $combinacionTemporal = $combinacion;
        $combinacionTemporal[] = $item['id'];
        $resultado[] = array_merge($resultado, generarCombinaciones($arrays, $indice + 1, $combinacionTemporal));
    }
    return $resultado;
}
