<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/login', function () {
//     return view('login');
// });
// Route::get('/dashboard', function () {
//     return view('dashboard');
// });


//Routes Iniciar Sesión
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::get('/dashboard', [AuthController::class, 'dashboard']);
Route::post('/userLogin', [AuthController::class, 'loginUser'])->name('loginUser'); 

//Route para cerrar sesión
Route::get('/signout', [AuthController::class, 'signOut'])->name('signout');


//Routes Registro
Route::get('/registro', [AuthController::class, 'registro'])->name('registro-usuario');
Route::post('/registrar', [AuthController::class, 'registroUsuario'])->name('registroUsuario'); 


//auth Redes Sociales

Route::get('login/facebook', [AuthController::class ,'redirectToProvider'])->name('login.redSocial');

Route::get('login/facebook/callback', [AuthController::class, 'handleProviderCallback']);