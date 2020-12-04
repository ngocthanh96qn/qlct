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

Route::group(['prefix' => 'menu','as'=>'menu.','middleware' => ['verified']],function (){  //các route về menu
	//menu setup
	Route::get('setup/token', 'ConfigSystemController@getToken')->name('setup_token');
    Route::get('setup/ia', 'ConfigSystemController@getPageIa')->name('setup_ia');	
    Route::get('setup/page', 'ConfigSystemController@getPage')->name('setup_page');	
    //menu dăng bài
    Route::get('post/Article', 'PostArticle@createPost')->name('postArticle');
    //menu showlist
    Route::get('show/page', 'Statisticle@showPage')->name('ShowPage');
    //menu thống kê
    Route::get('statisticle', 'Statisticle@Statisticle')->name('Statisticle');   	
});
//các route menu cấu hình 
Route::post('setup/token', 'ConfigSystemController@storeToken')->middleware('verified')->name('set_token');	
Route::post('setup/ia', 'ConfigSystemController@storeIa')->middleware('verified')->name('set_ia');	
Route::post('setup/page', 'ConfigSystemController@storePage')->middleware('verified')->name('set_page');

////các route menu đăng bài post 

Route::post('post/Article','PostArticle@PostToPage')->middleware('verified')->name('PostToPage');	
Route::get('delete/Article/{id}','PostArticle@DeletePost')->middleware('verified')->name('DeletePost');	
Route::post('/post/review','PostArticle@ReviewPost')->middleware('verified')->name('ReviewPost'); //api
// Route Thống kê
Route::post('/statisticle/page','Statisticle@StatisticleGetPage')->middleware('verified')->name('StatisticleGetPage'); //api
Route::post('/statisticle/view/page','Statisticle@viewPage')->middleware('verified')->name('ViewPage'); //post view page
Route::post('/statisticle/pagination/pre','Statisticle@Pagination')->name('PaginationPre'); //pagination pre
Route::post('/statisticle/pagination/next','Statisticle@Pagination')->name('PaginationNext'); //pagination pre
Route::post('/statisticle/delete','Statisticle@DeletePost')->name('DeletePostPage'); //pagination pre


////Test
Route::get('/test','Test@getPage');
Route::get('/get','Test@getPage');




