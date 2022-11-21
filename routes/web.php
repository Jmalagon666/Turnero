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


Route::resource('turnero',TurneroController::class);
/*Route::get('general', 'App\http\Controllers\TurneroController@generall');*/

/*Route::get('/login', [TurneroController::class,'login'])->name('login');*/
Route::post('/general', [TurneroController::class,'general'])->name('general');
Route::post('/dashboard', [TurneroController::class,'dashboard'])->name('dashboard');
Route::post('/consultaexterna', [TurneroController::class,'consultaexterna'])->name('consultaexterna');
Route::get('/principal', [TurneroController::class,'principal'])->name('principal');
Route::post('/ingresardocumento', [TurneroController::class,'ingresardocumento'])->name('ingresardocumento');
Route::post('/tomardoc_post', 'TurneroController@tomardoc_post');
Route::post('/tomardoc_post', [TurneroController::class,'store'])->name('tomardoc_post');
Route::post('/tomardoc_post', [TurneroController::class,'store'])->name('tomardoc_post');
Route::get('/dashboard', [TurneroController::class,'dashboard'])->name('dashboard');
Route::get('/index', [TurneroController::class,'index'])->name('index');


