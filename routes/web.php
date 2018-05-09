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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user', 'UsersController@index')->name('admin');
Route::get('/account', 'UsersController@account')->name('account');
Route::get('/createPrivateSet', 'WordSetController@createPrivateSet')->name('createPrivateSet');
Route::get('/showCategories', 'CategoryController@showCategories')->name('showCategories');
Route::post('/storePrivateSet', 'WordSetController@storePrivateSet')->name('storePrivateSet');
Route::get('/showPrivateSet', 'WordSetController@showPrivateSet')->name('showPrivateSet');
Route::post('/learn/{id}', 'LearnController@index')->name('learn');
Route::post('/wordsetEdit/{id}', 'WordSetController@wordsetEdit')->name('wordsetEdit');
Route::post('/respondToLearn', 'LearnController@respondToLearn')->name('respondToLearn');
Route::post('/respondToCheck', 'LearnController@respondToCheck')->name('respondToCheck');
Route::post('/respondToAlg3', 'LearnController@respondToAlg3')->name('respondToAlg3');
Route::post('/challange/{id}', 'LearnController@challange')->name('challange');
Route::post('/respondToChallange', 'LearnController@respondToChallange')->name('respondToChallange');
Route::post('/addPrivilige/{id}', 'PriviligesController@addPrivilige')->name('addPrivilige');
Route::post('/removePrivilige/{id}', 'PriviligesController@removePrivilige')->name('removePrivilige');

Auth::routes();


Route::get('/', function () {
    return view('welcome');
});

Route::resource('users','UsersController');
Route::resource('wordset','WordSetController');
Route::resource('category','CategoryController');
Route::resource('subcategory','SubcategoryController');