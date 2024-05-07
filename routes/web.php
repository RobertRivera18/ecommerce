<?php


use App\Http\Controllers\CategoryController;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\SubcategoryController;

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
Route::get('categories/{category}',[CategoryController::class,'show'])->name('categories.show');
Route::get('subcategories/{subcategory}',[SubcategoryController::class,'show'])->name('subcategories.show');

