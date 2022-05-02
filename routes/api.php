<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\HControllers\UserController;
use App\Http\Controllers\AdafruitController;
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
    Route::post('/logout', [UserController::class, 'logout']);
   //Temperatura ********************************************************************* 
    Route::group(['prefix'=>'temperatura'], function () {
        Route::get('InsertarTemperatura', [AdafruitController::class, 'InsertarTemperatura']);
        Route::get('GetTemperatura', [AdafruitController::class, 'GetTemperatura']);
        Route::delete('Delete/{id}', [AdafruitController::class, 'Delete']);
    }); 
    //Humedad *********************************************************************
    Route::group(['prefix'=>'humedad'], function () {
        Route::get('InsertarHumedad', [AdafruitController::class, 'InsertarHumedad']);
        Route::get('GetHumedad', [AdafruitController::class, 'GetHumedad']);
        Route::delete('Delete/{id}', [AdafruitController::class, 'Delete']);
    }); 
    //Humo
    Route::group(['prefix'=>'humo'], function () {
        Route::get('InsertarHumo', [AdafruitController::class, 'InsertarHumo']);
        Route::get('GetHumo', [AdafruitController::class, 'GetHumo']);
        Route::delete('Delete/{id}', [AdafruitController::class, 'Delete']);
    }); 
    //Ultrasonico
    Route::group(['prefix'=>'ultrasonico'], function () {
        Route::get('InsertarMovimiento', [AdafruitController::class, 'InsertarMovimiento']);
        Route::get('GetMovimiento', [AdafruitController::class, 'GetMovimiento']);
        Route::delete('Delete/{id}', [AdafruitController::class, 'Delete']);
    }); 
    //Servomotor Cochera *********************************************************************
    Route::group(['prefix'=>'servomotor'], function () {
        Route::get('GetServomotor', [AdafruitController::class, 'GetServomotor']);
        Route::post('PostServo', [AdafruitController::class, 'PostServo']);
        Route::delete('Delete/{id}', [AdafruitController::class, 'Delete']);
    });
    //Grupos *********************************************************************************
    Route::group(['prefix'=>'grupos'], function () {
        Route::post('createGrupo', [AdafruitController::class, 'createGrupo']);
        Route::post('createFeed', [AdafruitController::class, 'createFeed']);
        Route::post('AsignarUsuarios_Grupo', [Grupos_UsuariosController::class, 'Post']);
        Route::delete('deleteGrupo/{id}', [AdafruitController::class, 'deleteGrupo']);
    });
}); 