<?php

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

Route::get(LaravelLocalization::transRoute('inscription'), function () {
    return redirect(route('home'));
})->name('terms');


Route::group(
  [
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localize', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'soon']
  ],
  function () {


      Auth::routes();
      Route::get('register/verify/{token}', 'Auth\RegisterController@verify')->name('verify');


      Route::get('/soon', function () {
          return View::make('soon');

      })->name('soon');


      Route::group(
        [
          'middleware' => ['saveLang']
        ],
        function () {


            Route::get('/', function () {
                return View::make('welcome');
            })->name('home');


            Route::post('/', function () {

                $sondage = new App\Sondage;
                $sondage->sond = implode(",",request("sondage"));
                $sondage->save();

                return View::make('welcome');
            })->name('home');



            Route::get(LaravelLocalization::transRoute('routes.help'), function () {
                return View::make('help');
            })->name('help');

            Route::get(LaravelLocalization::transRoute('routes.legal'), function () {
                return View::make('legal');
            })->name('legal');

            Route::get(LaravelLocalization::transRoute('routes.terms'), function () {
                return View::make('terms');
            })->name('terms');


            Route::resource('/events', 'EventController');
            Route::resource('/invitations', 'InvitationController');
            Route::post('/events/{id}/participate', 'EventController@participate')->name('events.participate');
            Route::get('/events/{id}/request/{request_id}/{action}', 'EventController@requestAction')->name('events.requestaction');


            route::get('/conversations', 'ConversationsController@index')->name('conversations');
            route::get('/conversations/{user}', 'ConversationsController@index');
//            route::get('/conversations/{user}', 'ConversationsController@show')
//                ->middleware('can:talkTo,user')
//                ->name('conversations.show');
//            route::post('/conversations/{user}', 'ConversationsController@store')
//                ->middleware('can:talkTo,user');


            Route::get('/password', 'PasswordController@edit')->name('password.edit');
            Route::patch('/password', 'PasswordController@update')->name('password.update');
            Route::get('/profile', 'ProfileController@edit')->name('profile.edit');

            Route::get('/profile/delete', 'ProfileController@delete')->name('profile.delete');
            Route::get('/profile/{id}', 'ProfileController@show')->name('profile.show');
            Route::patch('/profile', 'ProfileController@update')->name('profile.update');


            Route::get('/admin', 'AdminController@index')->name('admin.index');
            Route::get('/admin/export/users', 'AdminController@exportUsers')->name('admin.export.users');
            Route::get('/admin/export/events', 'AdminController@exportEvents')->name('admin.export.events');


            Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function () {

                Route::resource('/events', 'DashboardEventController');
                Route::get('/events/{id}/delete', 'DashboardEventController@destroy')->name('dashboard.events.delete');


            });

        }
      );
  }
);

