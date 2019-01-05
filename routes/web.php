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

Route::get('/', function () {
    return redirect('home');
});

Auth::routes();
Route::post('/attachment/upload', 'AttachmentController@upload');
Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/queues/{queue}', 'QueueController@show');

    Route::get('/queues/create', 'QueueController@create');
    Route::post('/queues/create', 'QueueController@store');

    Route::post('/tickets/create', 'TicketController@store');
    Route::get('/tickets/{ticket}', 'TicketController@show')->name('ticket');
    Route::post('/tickets/{ticket}/close', 'TicketController@close');
    Route::post('/tickets/{ticket}/reopen', 'TicketController@reopen');
    Route::post('/tickets/{ticket}/priority', 'TicketController@updatePriority');
    Route::post('/tickets/{ticket}/rename', 'TicketController@rename');

    Route::post('/note/create', 'NoteController@create');
    Route::post('/note/delete', 'NoteController@delete');

    //Route::post('/attachment/upload', 'AttachmentController@upload');

    Route::get('/account', 'AccountController@showMyAccount');
    Route::post('/account', 'AccountController@update');
    Route::post('/account/password', 'AccountController@changePassword');

    Route::get('/users/{user}', 'UserController@show');
    Route::get('/users/new', 'UserController@new');

    Route::get('/users', 'UserController@index');
});

Route::post('webhooks/prometheus', function(Request $request)
{
    file_put_contents('prometheus.log', print_r($request, 1));
});