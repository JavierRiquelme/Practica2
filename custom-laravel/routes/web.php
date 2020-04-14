<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/admin', function(){
	if(!auth()->check()){
		throw new \App\Exceptions\HackerAlertException();
		
	}
});

Route::get('/{id}', function(\Illuminate\Http\Request $request, $id){
	return \App\User::findOrFail($id);
});

Route::middleware('test')->get('/', function () {
    //return view('welcome');

    /*$medium=resolve('medium-php-sdk');
    dd($medium);*/

    //dd(session()->get('test'));
});

Route::get('/custom', function(){	
	//dd(config('app.developers'));
	//dd(config('blog.administrators'));
	//dd(env('APP_CREATOR')); no recomendado
	dd(config('blog.creator'));
});

Auth::routes();

/*Route::get('/register', function(){
	return 'register user';
});*/

Route::get('/home', 'HomeController@index')->name('home');
