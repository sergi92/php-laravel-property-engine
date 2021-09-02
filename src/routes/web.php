<?php

use Illuminate\Support\Facades\Routes;
use Illuminate\Support\Facades\Redis;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;

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


Route::get('/send-email', function () {
    Mail::to('enric.malras@gmail.com')->send(new TestMail);
});

Route::get('/', function () {
    return view('welcome');
});


Route::get('/store', function() {
    Redis::set('foo', 'bar');
});

Route::get('/retrieve', function() {
    return Redis::get('foo');
});
