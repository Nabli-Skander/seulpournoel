<?php

use App\Event;
use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('events', function () {
    //  return Event::select('id', DB::raw('CONCAT(city, " ", postal_code) as address'))->get();
    return Event::select('id', DB::raw('longitude, latitude'))->get();
});

Route::post('infobox', function (Request $request) {
    $event = Event::find($request->post('id'));
    return View::make('api.infobox', compact('event'));
});

Route::group(['middleware' => ['auth:api']],function(){

    Route::get('/conversations', 'Api\ConversationsController@index');
    Route::get('/conversations/{user}', 'Api\ConversationsController@show')->middleware('can:talkTo,user');
    Route::post('/conversations/{user}', 'Api\ConversationsController@store')->middleware('can:talkTo,user');
    Route::post('/messages/{message}','Api\MessagesController@read')->middleware('can:read,message');

});