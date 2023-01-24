<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\TurneroController;

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

/*Route::get('/', function () {
    return view('turnero.principal');
});*/
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return  redirect()->route('usuario');
})->middleware(['auth', 'verified'])->name('usuario');

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');*/

require __DIR__.'/auth.php';

/*Route::get('/', function () {
    return view('turnero.principal');
});*/

//tunero
Route::resource('turnero',TurneroController::class);
/*Route::get('general', 'App\http\Controllers\TurneroController@generall');*/

//pisos
Route::get('/inicio', [TurneroController::class,'inicio'])->name('inicio');

//piso1
Route::post('/principal_1', [TurneroController::class,'principal_1'])->name('principal_1');
Route::post('/general_1', [TurneroController::class,'general_1'])->name('general_1');
Route::post('/cita', [TurneroController::class,'cita'])->name('cita');
Route::post('/admisiones', [TurneroController::class,'admisiones'])->name('admisiones');
Route::post('/ingresardocumento_1', [TurneroController::class,'ingresardocumento_1'])->name('ingresardocumento_1');


//piso 4

/*Route::get('/login', [TurneroController::class,'login'])->name('login');*/
Route::post('/general', [TurneroController::class,'general'])->name('general');
Route::post('/dashboard', [TurneroController::class,'dashboard'])->name('dashboard');
Route::post('/consultaexterna', [TurneroController::class,'consultaexterna'])->name('consultaexterna');
Route::post('/principal', [TurneroController::class,'principal'])->name('principal');
Route::post('/ingresardocumento', [TurneroController::class,'ingresardocumento'])->name('ingresardocumento');
Route::post('/tomardoc_post', [TurneroController::class,'tomardoc_post'])->name('tomardoc_post');
Route::post('/tomardoc_post_1', [TurneroController::class,'tomardoc_post_1'])->name('tomardoc_post_1');
Route::get('/dashboard', [TurneroController::class,'dashboard'])->name('dashboard');
Route::get('/index', [TurneroController::class,'index'])->name('index');






