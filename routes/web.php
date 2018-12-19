<?php
use App\Institution;
use Illuminate\Support\Facades\Input;
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

//Root gets the index
Route::get('/', 'PostController@index');

Route::get('/about', 'HomeController@about')->name('about');

//Authenticates all the routes from make::auth command
Auth::routes();

Route::get('/home', 'PostController@index')->name('home');

Route::get('/add', 'HomeController@add')->name('add');
Route::post('/add', 'PostController@store')->name('add');

Route::get('/modify/{institution}', 'PostController@edit')->name('modify-institution');
Route::post('/modify/{institution}', 'PostController@update')->name('modify-institution');;

Route::resource('institutions','PostController');

Route::get('/import', 'HomeController@import')->name('import');
Route::post('/import', 'PostController@import');


Route::post('/delete/{deleteID}', 'PostController@destroy')->name('delete-deleteID');

Route::post('/search', 'PostController@search')->name('search');

Route::get('/export', 'PostController@exportData')->name('export');
