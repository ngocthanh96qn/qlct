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
    return redirect()->route('home');
});


Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->middleware('verified')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'menu','as'=>'menu.'],function (){  //các route về menu
	//menu setup
	Route::get('setup/token', 'ConfigSystemController@getToken')->name('setup_token');
    Route::get('setup/ia', 'ConfigSystemController@getPageIa')->name('setup_ia');	
    Route::get('setup/page', 'ConfigSystemController@getPage')->name('setup_page');	
    //menu dăng bài
    Route::get('post/Article', 'PostArticle@createPost')->name('postArticle');
    //menu showlist
    Route::get('show/page', 'Statisticle@showPage')->name('ShowPage');
    	
});
//các route menu cấu hình 
Route::post('setup/token', 'ConfigSystemController@storeToken')->name('set_token');	
Route::post('setup/ia', 'ConfigSystemController@storeIa')->name('set_ia');	
Route::post('setup/page', 'ConfigSystemController@storePage')->name('set_page');

////các route menu đăng bài post 

Route::post('post/Article','PostArticle@PostToPage')->name('PostToPage');	
Route::get('delete/Article/{id}','PostArticle@DeletePost')->name('DeletePost');	
Route::post('/post/review','PostArticle@ReviewPost')->name('ReviewPost'); //api
// Route Thống kê
Route::post('/statisticle/page','Statisticle@StatisticleGetPage')->name('StatisticleGetPage'); //api
Route::post('/statisticle/view/page','Statisticle@viewPage')->name('ViewPage'); //post view page


////Test
Route::post('/test','Test@upPhoto')->name('testPost');
Route::get('/get','Test@getPage');




