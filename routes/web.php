<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductoController;
use App\Http\Controllers\Admin\EntradaController;
use App\Http\Controllers\Admin\VentaController;
use App\Http\Controllers\Admin\CategoriaController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'rol:admin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    });
});

Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');
Route::get('/productos/crear', [ProductoController::class, 'create'])->name('productos.create');
Route::post('/productos', [ProductoController::class, 'store'])->name('productos.store');

Route::middleware(['auth', 'rol:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('productos', ProductoController::class);
});

Route::middleware(['auth', 'rol:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('categorias', CategoriaController::class);
    });


Route::middleware(['auth', 'rol:admin'])->prefix('admin')->group(function () {
    Route::get('/entradas/create', [EntradaController::class, 'create'])
        ->name('admin.entradas.create');
    Route::post('/entradas', [EntradaController::class, 'store'])
        ->name('admin.entradas.store');
});

Route::prefix('admin')->middleware(['auth', 'rol:admin'])->as('admin.')->group(function () {
    // Rutas personalizadas primero
    Route::get('ventas/pdf', [VentaController::class, 'exportPDF'])->name('ventas.pdf');

    // Rutas CRUD de ventas
    Route::resource('ventas', VentaController::class);
});

require __DIR__.'/auth.php';
