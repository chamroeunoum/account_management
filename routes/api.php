<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\Book\BookController;

// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
// header('Access-Control-Allow-Headers: Content-Type, X-Auth-Token, Origin, Authorization');
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
    Route::post('register',[AuthenticationController::class,"register"])->name("register");
    /**
     * Verify the email
     */
    Route::post('registration/verify/email',"AuthenticationController@emailVerification")->name("emailVerification");
    /**
     * Verify the phone
     */
    
    Route::post('registration/verify/phone',"AuthenticationController@phoneVerification")->name("phoneVerification");

    Route::post('password/request/reset/byemail',"AuthenticationController@passwordRequestResetByemail")->name("passwordRequestResetByemail");
    Route::post('password/request/reset/change',"AuthenticationController@passwordRequestResetChange")->name("passwordRequestResetChange");

    Route::group(['prefix' => 'login','middleware' => 'throttle:5,10' ],function(){
        /**
         * Signin an account
         */
        Route::post('',[AuthenticationController::class,"login"])->name("login");
        /**
         * Third party authentication
         */
        /**
         * Facebook authentication
         */
        Route::post('facebook',"AuthenticationController@facebookAuthentication")->name("gacebookAuthentication");
        /**
         * Google authentication
         */
        Route::post('google',"AuthenticationController@googleAuthentication")->name("googleAuthentication");
        /**
         * Apple authentication
         */
        Route::post('apple',"AuthenticationController@appleAuthentication")->name("appleAuthentication");

    });
});

Route::middleware('auth:api')->namespace('\App\Http\Controllers\Api')->prefix('authentication')->group(function(){
    /**
     * Signup an account
     */
    Route::get('profile/information/read',[AuthenticationController::class,"getProfile"])->name("getProfile");
    Route::post('request/update/phone',"AuthenticationController@sendCodeForPhoneVerification")->name("sendCodeForPhoneVerification");
    Route::post('update/phone',"AuthenticationController@updatePhone")->name("updatePhone");
    Route::post('request/update/email',"AuthenticationController@sendCodeForEmailVerification")->name("sendCodeForEmailVerification");
    Route::post('update/email',"AuthenticationController@updateEmail")->name("updateEmail");
    Route::post('profile/username/update',"AuthenticationController@updateUsername")->name("updateUsername");
    Route::post('profile/information/update',"AuthenticationController@updateProfileInformation")->name("updateProfileInformation");
    Route::post('profile/picture/update',"AuthenticationController@updateProfilePicture")->name("updateProfilePicture");
    Route::post('password/profile/change',"AuthenticationController@passwordProfileChange")->name("passwordProfileChange");

    Route::post('logout',"AuthenticationController@logout")->name("logout");

});

Route::middleware('auth:api')->namespace('\App\Http\Controllers\Api')->prefix('users')->group(function(){
    /**
     * Signup an account
     * Methods to apply for each of the CRUD operations
     * Create => POST
     * Read => GET
     * Update => PUT
     * Delete => DELETE
     */

    /**
     * Get all records
     */
    Route::get('',"UserController@index")->name("userList");
    /**
     * Get a record with id
     */
    Route::get('{id}/read',"UserController@read")->name("userRead");
    /**
     * Create a record
     */
    Route::post('',"UserController@create")->name("userCreate");
    /**
     * Update a reccord with id
     */
    Route::put('',"UserController@update")->name("userUpdate");
    /**
     * Delete a record
     */
    Route::delete('users/{id}',"UserController@delete")->name("userDelete");
    /**
     * Update password of the user within admin
     */
    Route::put('password/change',"UserController@passwordChange")->name("userUpdatePassword");

    /**
     * Check Email, Phone, User whether it does exists
     */
    Route::get('email/exist','UserController@checkExistingEmail')->name('checkExistingEmail');
    Route::get('phone/exist','UserController@checkExistingPhone')->name('checkExistingPhone');
    Route::get('username/exist','UserController@checkExistingUsername')->name('checkExistingUsername');

    Route::get('email/exist/butnot/{id}','UserController@checkExistingEmailAndExcludeUser')->name('checkExistingEmailAndExcludeUser');
    Route::get('phone/exist/butnot/{id}','UserController@checkExistingPhoneAndExcludeUser')->name('checkExistingPhoneAndExcludeUser');
    Route::get('username/exist/butnot/{id}','UserController@checkExistingPhoneAndExcludeUser')->name('checkExistingUsernameAndExcludeUser');

    /**
     * Activate, Deactivate account
     */
    Route::put('{id}/activate','UserController@activate')->name('userActivate');
    Route::put('{id}/deactivate','UserController@deactivate')->name('userDeactivate');
});


Route::middleware('auth:api')->namespace('\App\Http\Controllers\Api\Book')->prefix('books')->group(function(){
    Route::get('', 'BookController@index');
    Route::get('{id}', 'BookController@read')->where('id', '[0-9]+');
    Route::get('{id}/structure', 'BookController@structure')->where('id', '[0-9]+');
    Route::get('{id}/kunties', 'BookController@kunties')->where('id', '[0-9]+');
    Route::get('{id}/matikas', 'BookController@matikas')->where('id', '[0-9]+');
    Route::get('{id}/matras', 'MatraController@ofBook')->where('id', '[0-9]+');
    Route::get('exists', 'BookController@exists');
    /** Mini display */
    Route::get('compact', "BookController@compactList");

    Route::post('', 'BookController@store');
    Route::post('{id}/save/structure', 'BookController@saveStructure')->where('id', '[0-9]+');
    Route::post('removefile', 'BookController@removefile');

    Route::put('', 'BookController@update')->where('id', '[0-9]+');
    Route::post('upload', 'BookController@upload');
    /** Activate / Deactivate the data for using */
    Route::put('{id}/activate', 'BookController@active')->where('id', '[0-9]+');
    Route::put('{id}/deactivate', 'BookController@unactive')->where('id', '[0-9]+');

    Route::delete('{id}', 'BookController@delete')->where('id', '[0-9]+');

});

Route::middleware('auth:api')->namespace('\App\Http\Controllers\Api\Book')->prefix('books/kunties')->group(function(){
    Route::get('', 'KuntyController@index');
    Route::get('{id}', 'KuntyController@read')->where('id', '[0-9]+');
    Route::get('{id}/structure', 'KuntyController@structure')->where('id', '[0-9]+');
    Route::get('{id}/matikas', 'KuntyController@matikas')->where('id', '[0-9]+');
    Route::get('{id}/chapters', 'KuntyController@chapters')->where('id', '[0-9]+');
    Route::get('exists', 'KuntyController@exists');
    /** Mini display */
    Route::get('compact', "KuntyController@compactList");

    Route::post('', 'KuntyController@store');
    Route::post('{id}/save/structure', 'KuntyController@saveStructure')->where('id', '[0-9]+');

    Route::put('', 'KuntyController@update')->where('id', '[0-9]+');
    /** Activate / Deactivate the data for using */
    Route::put('{id}/activate', 'KuntyController@active')->where('id', '[0-9]+');
    Route::put('{id}/deactivate', 'KuntyController@unactive')->where('id', '[0-9]+');

    Route::delete('{id}', 'KuntyController@delete')->where('id', '[0-9]+');

});

Route::middleware('auth:api')->namespace('\App\Http\Controllers\Api\Book')->prefix('books/matikas')->group(function(){
    Route::get('', 'MatikaController@index');
    Route::get('{id}', 'MatikaController@read')->where('id', '[0-9]+');
    Route::get('{id}/structure', 'MatikaController@structure')->where('id', '[0-9]+');
    Route::get('{id}/chapters', 'MatikaController@chapters')->where('id', '[0-9]+');
    Route::get('exists', 'MatikaController@exists');
    /** Mini display */
    Route::get('compact', "MatikaController@compactList");

    Route::post('', 'MatikaController@store');
    Route::post('{id}/save/structure', 'MatikaController@saveStructure')->where('id', '[0-9]+');

    Route::put('', 'MatikaController@update')->where('id', '[0-9]+');
    /** Activate / Deactivate the data for using */
    Route::put('{id}/activate', 'MatikaController@active')->where('id', '[0-9]+');
    Route::put('{id}/deactivate', 'MatikaController@unactive')->where('id', '[0-9]+');

    Route::delete('{id}', 'MatikaController@delete')->where('id', '[0-9]+');

});

Route::middleware('auth:api')->namespace('\App\Http\Controllers\Api\Book')->prefix('books/chapters')->group(function(){
    Route::get('', 'ChapterController@index');
    Route::get('{id}', 'ChapterController@read')->where('id', '[0-9]+');
    Route::get('{id}/structure', 'ChapterController@structure')->where('id', '[0-9]+');
    Route::get('{id}/parts', 'ChapterController@parts')->where('id', '[0-9]+');
    Route::get('exists', 'ChapterController@exists');
    /** Mini display */
    Route::get('compact', "ChapterController@compactList");

    Route::post('create', 'ChapterController@store');
    Route::post('{id}/save/structure', 'ChapterController@saveStructure')->where('id', '[0-9]+');

    Route::post('update', 'ChapterController@update')->where('id', '[0-9]+');
    /** Activate / Deactivate the data for using */
    Route::put('{id}/activate', 'ChapterController@active')->where('id', '[0-9]+');
    Route::put('{id}/deactivate', 'ChapterController@unactive')->where('id', '[0-9]+');

    Route::delete('{id}', 'ChapterController@delete')->where('id', '[0-9]+');

});

Route::middleware('auth:api')->namespace('\App\Http\Controllers\Api\Book')->prefix('books/parts')->group(function(){
    Route::get('', 'PartController@index');
    Route::get('{id}', 'PartController@read')->where('id', '[0-9]+');
    Route::get('{id}/structure', 'PartController@structure')->where('id', '[0-9]+');
    Route::get('{id}/sections', 'PartController@sections')->where('id', '[0-9]+');
    Route::get('exists', 'PartController@exists');
    /** Mini display */
    Route::get('compact', "PartController@compactList");

    Route::post('', 'PartController@store');
    Route::post('{id}/save/structure', 'PartController@saveStructure')->where('id', '[0-9]+');

    Route::put('', 'PartController@update')->where('id', '[0-9]+');
    /** Activate / Deactivate the data for using */
    Route::put('{id}/activate', 'PartController@active')->where('id', '[0-9]+');
    Route::put('{id}/deactivate', 'PartController@unactive')->where('id', '[0-9]+');

    Route::delete('{id}', 'PartController@delete')->where('id', '[0-9]+');

});

Route::middleware('auth:api')->namespace('\App\Http\Controllers\Api\Book')->prefix('books/sections')->group(function(){
    Route::get('', 'SectionController@index');
    Route::get('{id}', 'SectionController@read')->where('id', '[0-9]+');
    Route::get('{id}/structure', 'SectionController@structure')->where('id', '[0-9]+');
    Route::get('exists', 'SectionController@exists');
    /** Mini display */
    Route::get('compact', "SectionController@compactList");

    Route::post('', 'SectionController@store');
    Route::post('{id}/save/structure', 'SectionController@saveStructure')->where('id', '[0-9]+');

    Route::put('', 'SectionController@update')->where('id', '[0-9]+');
    /** Activate / Deactivate the data for using */
    Route::put('{id}/activate', 'SectionController@active')->where('id', '[0-9]+');
    Route::put('{id}/deactivate', 'SectionController@unactive')->where('id', '[0-9]+');

    Route::delete('{id}', 'SectionController@delete')->where('id', '[0-9]+');

});

Route::middleware('auth:api')->namespace('\App\Http\Controllers\Api\Book')->prefix('books/types')->group(function(){
    Route::get('', 'TypeController@index');
    Route::post('create', 'TypeController@store');
    Route::post('update', 'TypeController@update');
    Route::get('{id}/read', 'TypeController@read');
    Route::delete('{id}/delete', 'TypeController@delete');
    Route::get('{id}/structure', 'TypeController@structure');
    Route::post('{id}/save/structure', 'TypeController@saveStructure');

    Route::put('exists', 'TypeController@exists');

    /** Activate / Deactivate the data for using */
    Route::put('{id}/activate', 'TypeController@active');
    Route::put('{id}/deactivate', 'TypeController@unactive');

    /** Mini display */
    Route::get('compact', "TypeController@compactList");
});
Route::middleware('auth:api')->namespace('\App\Http\Controllers\Api\Book')->prefix('books/matras')->group(function(){
    Route::get('', 'MatraController@index');
    Route::post('', 'MatraController@store');
    Route::put('', 'MatraController@update');
    Route::get('{id}', 'MatraController@read')->where('id', '[0-9]+');
    Route::delete('{id}', 'MatraController@delete')->where('id', '[0-9]+');
    Route::put('exists', 'MatraController@exists');

    /** Activate / Deactivate the data for using */
    Route::put('{id}/activate', 'MatraController@active')->where('id', '[0-9]+');
    Route::put('{id}/deactivate', 'MatraController@unactive')->where('id', '[0-9]+');
    /** Mini display */
    Route::get('compact', "MatraController@compactList");
});

Route::middleware('auth:api')->namespace('\App\Http\Controllers\Api\Task')->prefix('tasks')->group(function(){
    /**
     * Methods to apply for each of the CRUD operations
     * Create => POST
     * Read => GET
     * Update => PUT
     * Delete => DELETE
     */

    /**
     * Get all records
     */
    Route::get('',"TaskController@index")->name("taskList");
    /**
     * Get a record with id
     */
    Route::get('{id}/read',"TaskController@read")->name("taskRead");
    /**
     * Create a record
     */
    Route::post('',"TaskController@create")->name("taskCreate");
    /**
     * Update a reccord with id
     */
    Route::put('',"TaskController@update")->name("taskUpdate");
    /**
     * Delete a record
     */
    Route::delete('users',"TaskController@delete")->name("taskDelete");

    /**
     * Activate, Deactivate account
     */
    Route::put('activate','TaskController@activate')->name('taskActivate');
    Route::put('deactivate','TaskController@deactivate')->name('taskDeactivate');

    Route::put('start','TaskController@startTask')->name('taskStart');
    Route::put('end','TaskController@endTask')->name('taskEnd');
    Route::put('pending','TaskController@pendingTask')->name('taskPending');
    Route::put('continue','TaskController@continueTask')->name('taskContinue');
    /**
     * Get number of the tasks base on it status
     */
    Route::get('total_number_of_each_status',function(Request $request){
        return response()->json([
            'new' => \App\Models\Task\Task::getTotalNewTasks() ,
            'in_progress' => \App\Models\Task\Task::getTotalInProgressTasks() ,
            'pending' => \App\Models\Task\Task::getTotalPendingTasks() ,
            'ended' => \App\Models\Task\Task::getTotalEndedTasks()
        ],200);
    });
    Route::get('total_number_of_new',function(Request $request){
        return \App\Models\Task\Task::getTotalNewTasks();
    });
    Route::get('total_number_of_in_progress',function(Request $request){
        return \App\Models\Task\Task::getTotalInProgressTasks();
    });
    Route::get('total_number_of_pending',function(Request $request){
        return \App\Models\Task\Task::getTotalPendingTasks();
    });
    Route::get('total_number_of_ended',function(Request $request){
        return \App\Models\Task\Task::getTotalEndedTasks();
    });
    /**
     * Get total earn
     */
    Route::get('total_earn',function(){
        return \App\Models\Task\Task::getTotalEarn();
    });
    Route::get('total_earn_by_month_of_year/{date}',function(){
        return \App\Models\Task\Task::getTotalEarn($date);
    });
    Route::get('total_earn_between/{start}/{end}',function(){
        return \App\Models\Task\Task::getTotalEarn($start,$end);
    });
    /**
     * Get total expense
     */
    Route::get('total_expense',function(){
        return \App\Models\Task\Task::getTotalExpense();
    });
    Route::get('total_expense_by_month_of_year/{date}',function(){
        return \App\Models\Task\Task::getTotalExpenseByMonthOfYear($date);
    });
    Route::get('total_expense_between/{start}/{end}',function(){
        return \App\Models\Task\Task::getTotalExpenseBetween($start,$end);
    });
    /**
     * Get total expense and earn
     */
    /**
     * Total tasks, expense, earn by day
     */
    Route::get('total_tasks_earn_expense',function(Request $request){
        return response()->json([
            'new' => \App\Models\Task\Task::getTotalNewTasks() ,
            'progress' => \App\Models\Task\Task::getTotalInProgressTasks() ,
            'pending' => \App\Models\Task\Task::getTotalPendingTasks() ,
            'ended' => \App\Models\Task\Task::getTotalEndedTasks() ,
            'earn' => \App\Models\Task\Task::getTotalEarn() ,
            'expense' => \App\Models\Task\Task::getTotalExpense()
        ],200);
    });
    Route::get('total_tasks_earn_expense_by_day',function(Request $request){
        return response()->json([
            'new' => \App\Models\Task\Task::getNewTasks()->where('created_at','like',\Carbon\Carbon::now()->format('Y-m-d')."%")->count() ,
            'progress' => \App\Models\Task\Task::getInProgressTasks()->where('created_at','like',\Carbon\Carbon::now()->format('Y-m-d')."%")->count() ,
            'pending' => \App\Models\Task\Task::getPendingTasks()->where('created_at','like',\Carbon\Carbon::now()->format('Y-m-d')."%")->count() ,
            'ended' => \App\Models\Task\Task::getEndedTasks()->where('created_at','like',\Carbon\Carbon::now()->format('Y-m-d')."%")->count() ,
            'earn' => number_format( \App\Models\Task\Task::getTotalEarnBetween(\Carbon\Carbon::now()->format('Y-m-d'),\Carbon\Carbon::now()->format('Y-m-d'))->sum('total'),2,'.',',' ) ,
            'expense' => number_format( \App\Models\Task\Task::getTotalExpenseBetween(\Carbon\Carbon::now()->format('Y-m-d'),\Carbon\Carbon::now()->format('Y-m-d'))->sum('total'),2,'.',',' )
        ],200);
    });
});

/**
 * Webapp APInav
 */
Route::middleware('api')->namespace('\App\Http\Controllers\Api\Webapp\Book')->prefix('webapp')->group(function(){
    /**
     * Regulators
     */
    Route::prefix('books')->group(function(){
        Route::get('', 'BookController@index');
        Route::get('{id}', 'BookController@read')->where('id', '[0-9]+');
        Route::get('exists', 'BookController@exists');
        /** Mini display */
        Route::get('compact', "BookController@compactList");
    });

    /**
     * Matras
     */
    Route::prefix('matras')->group(function(){
        Route::get('', 'MatraController@index');
        Route::get('{id}', 'MatraController@read')->where('id', '[0-9]+');
        Route::get('exists', 'MatraController@exists');
        /** Mini display */
        Route::get('compact', "MatraController@compactList");
    });
});