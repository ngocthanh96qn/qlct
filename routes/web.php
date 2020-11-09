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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->middleware('verified')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'menu','as'=>'menu.'],function (){  //các route về menu
	//menu setup
	Route::get('setup/token', function () {
    return view('pages.setup_token');})->name('setup_token');
    Route::get('setup/ia', 'ConfigSystemController@getPageIa')->name('setup_ia');	
    Route::get('setup/page', 'ConfigSystemController@getPage')->name('setup_page');	
    //menu dăng bài
    Route::get('post/Article', 'PostArticle@createPost')->name('postArticle');	
});
//các route menu cấu hình post lên
Route::post('setup/token', 'ConfigSystemController@storeToken')->name('set_token');	
Route::post('setup/ia', 'ConfigSystemController@storeIa')->name('set_ia');	
Route::post('setup/page', 'ConfigSystemController@storePage')->name('set_page');

////các route menu đăng bài post lên
Route::post('post/Article','PostArticle@handleData')->name('handleData');	



////Test
Route::post('/test','Test@upPhoto')->name('testPost');

