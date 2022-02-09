<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
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

Route::middleware(['api'])->namespace('App\Http\Controllers\Api')->prefix('authentication')->group(function(){
    /**
     * Signup an account
     */
    Route::post('register',[UserController::class,"register"])->name("register");
    /**
     * Verify the email
     */
    Route::post('registration/verify/email',"UserController@emailVerification")->name("emailVerification");
    /**
     * Verify the phone
     */
    
    Route::post('registration/verify/phone',"UserController@phoneVerification")->name("phoneVerification");

    Route::post('password/request/reset/byemail',"UserController@passwordRequestResetByemail")->name("passwordRequestResetByemail");
    Route::post('password/request/reset/change',"UserController@passwordRequestResetChange")->name("passwordRequestResetChange");

    Route::prefix('login')->group(function(){
        /**
         * Signin an account
         */
        Route::post('',[UserController::class,"login"])->name("login");
        /**
         * Third party authentication
         */
        /**
         * Facebook authentication
         */
        Route::post('facebook',"UserController@facebookAuthentication")->name("gacebookAuthentication");
        /**
         * Google authentication
         */
        Route::post('google',"UserController@googleAuthentication")->name("googleAuthentication");
        /**
         * Apple authentication
         */
        Route::post('apple',"UserController@appleAuthentication")->name("appleAuthentication");

    });
});

Route::middleware('auth:api')->namespace('\App\Http\Controllers\Api')->prefix('authentication')->group(function(){
    /**
     * Signup an account
     */
    Route::get('profile/information/read',[UserController::class,"getProfile"])->name("getProfile");
    Route::post('request/update/phone',"UserController@sendCodeForPhoneVerification")->name("sendCodeForPhoneVerification");
    Route::post('update/phone',"UserController@updatePhone")->name("updatePhone");
    Route::post('request/update/email',"UserController@sendCodeForEmailVerification")->name("sendCodeForEmailVerification");
    Route::post('update/email',"UserController@updateEmail")->name("updateEmail");
    Route::post('profile/username/update',"UserController@updateUsername")->name("updateUsername");
    Route::post('profile/information/update',"UserController@updateProfileInformation")->name("updateProfileInformation");
    Route::post('profile/picture/update',"UserController@updateProfilePicture")->name("updateProfilePicture");
    Route::post('password/profile/change',"UserController@passwordProfileChange")->name("passwordProfileChange");

    Route::post('logout',"UserController@logout")->name("logout");
});
