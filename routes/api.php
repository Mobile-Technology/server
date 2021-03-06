<?php

use App\Http\Controllers\UserController;
use App\Models\Room;
use App\Models\RoomPlay;
use App\Models\User;
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

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::resource('users', UserController::class);
Route::post('login', [App\Http\Controllers\API\UserController::class,'login']);
Route::post('register', [App\Http\Controllers\API\UserController::class,'register']);

Route::group(['middleware' => 'auth:api'], function(){
	Route::post('details', [App\Http\Controllers\API\UserController::class,'details']);
	Route::post('updateProfile', [App\Http\Controllers\API\UserController::class,'updateProfile']);
	Route::post('updatePassword', [App\Http\Controllers\API\UserController::class,'updatePassword']);
	Route::post('logout', [App\Http\Controllers\API\UserController::class,'logout']);
});

Route::resource('rooms', App\Http\Controllers\API\RoomAPIController::class);


Route::resource('room_plays', App\Http\Controllers\API\RoomPlayAPIController::class);

Route::resource('log_activities', App\Http\Controllers\API\LogActivityAPIController::class);
Route::get('userRoom/{id}', function ($id) {
    $data = RoomPlay::where('user_id',$id)->where('status',0)->first();
    if ($data!=null) {
        return $data->room_id;
    }
    return 'Null';
});

Route::get('rooms/detail/{id}', function ($id) {
    $data = Room::find($id);
    return $data;
});

Route::get('users/status/{id}/{no}', function ($id,$no) {
    $data = User::find($id)->update(['status'=>$no]);
    return $data;
});

Route::get('roomPlay/{id}/{roomId}', function ($id,$roomId) {
    $data = RoomPlay::where('user_id',$id)->where('room_id',$roomId)->first();
    if ($data!=null) {
        return $data->id;
    }
    return 'Null';
});
