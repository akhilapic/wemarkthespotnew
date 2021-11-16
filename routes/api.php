<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
header('Access-Control-Allow-Origin:  *');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



//------------------------craated by akhil---------------start
Route::post('/user_register', 'App\Http\Controllers\Api\userController@userRegister');
Route::post('/login', 'App\Http\Controllers\Api\userController@logincheck');
Route::post('/forgot_password', 'App\Http\Controllers\Api\userController@forgotPassword');
Route::post('/password_verification', 'App\Http\Controllers\Api\userController@passwordVerification');
Route::post('/password_update', 'App\Http\Controllers\Api\userController@passwordUpdate'); 
Route::post('/edit', 'App\Http\Controllers\Api\userController@edit'); 
Route::post('/profile_update', 'App\Http\Controllers\Api\userController@profile_update'); 
Route::get('/get_allusers', 'App\Http\Controllers\Api\userController@get_allusers'); 
Route::post('/guestuser', 'App\Http\Controllers\Api\userController@guestuser');

Route::post('/forgot_password_verify', 'App\Http\Controllers\Api\userController@forgetpasswordVerification');


//-----------------------------------end-------------------------------------------------------------------

Route::post('/email_verification', 'App\Http\Controllers\Api\userController@emailVerification');
Route::post('/email_sent_otp', 'App\Http\Controllers\Api\userController@emailSentOtp');
