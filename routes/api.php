<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Controllers\UserController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\CiudadController;
use App\Http\Controllers\AdafruitController;
use App\Http\Controllers\CasaController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\Grupos_UsuariosController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'App\Http\Controllers\UserController@register');
Route::post('login', 'App\Http\Controllers\UserController@authenticate');

Route::group(['middleware' => ['jwt.verify']], function() {

    Route::post('user','App\Http\Controllers\UserController@getAuthenticatedUser');

        Route::group(['prefix'=>'estados'], function () {
        Route::get('Get', [EstadoController::class, 'Get']);
        Route::post('Post', [EstadoController::class, 'Post']);
        Route::put('Put/{id}', [EstadoController::class, 'Put']);
        Route::delete('Delete/{id}', [EstadoController::class, 'Delete']);
    });
        Route::group(['prefix'=>'ciudades'], function () {
        Route::get('Get', [CiudadController::class, 'Get']);
        Route::post('Post', [CiudadController::class, 'Post']);
        Route::put('Put/{id}', [CiudadController::class, 'Put']);
        Route::delete('Delete/{id}', [CiudadController::class, 'Delete']);
    });
    Route::group(['prefix'=>'casas'], function () {
        Route::get('Get', [CasaController::class, 'Get']);
        Route::post('Post', [CasaController::class, 'Post']);
        Route::put('Put/{id}', [CasaController::class, 'Put']);
        Route::delete('Delete/{id}', [CasaController::class, 'Delete']);
    });   
    // Groups Feeds
    Route::get('/getGruposFeed',[GroupsController::class, 'getGruposFeed']);
});
//Temperatura *********************************************************************
Route::get('/InsertarTemperatura',[AdafruitController::class, 'InsertarTemperatura']);
Route::get('/Get_AllTemperatura',[AdafruitController::class, 'Get_AllTemperatura']);

//Humedad *********************************************************************
Route::get('/InsertarHumedad',[AdafruitController::class, 'InsertarHumedad']);
Route::get('/GetHumedad',[AdafruitController::class, 'GetHumedad']);

//Humo
Route::get('/InsertarHumo',[AdafruitController::class, 'InsertarHumo']);
Route::get('/GetHumo',[AdafruitController::class, 'GetHumo']);

//Ultrasonico
Route::get('/InsertarMovimiento',[AdafruitController::class, 'InsertarMovimiento']);
Route::get('/GetMovimiento',[AdafruitController::class, 'GetMovimiento']);

//Servomotor Cochera *********************************************************************
Route::get('/GetServomotor',[AdafruitController::class, 'GetServomotor']);
Route::post('/PostServo',[AdafruitController::class, 'PostServo']);

//Luminosidad *********************************************************************
Route::get('/InsertarLuminosidad',[AdafruitController::class, 'InsertarLuminosidad']);
Route::get('/GetLuminosidad',[AdafruitController::class, 'GetLuminosidad']);

Route::post('/createGrupo',[AdafruitController::class, 'createGrupo']);
Route::post('/createFeed',[AdafruitController::class, 'createFeed']);
Route::post('/AsignarUsuarios_Grupo',[Grupos_UsuariosController::class, 'Post']);