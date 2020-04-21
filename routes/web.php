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

Route::get('/question/index', 'QuestionController@index')->name('question.index');
Route::get('/question/show/{id}', 'QuestionController@show')->name('question.show');

Route::get('/question/add', 'QuestionController@add')->name('question.add');
Route::post('/question/create', 'QuestionController@create')->name('question.create');

Route::get('/question/edit/{id}', 'QuestionController@edit')->name('question.edit');
Route::post('/question/update/{id}', 'QuestionController@update')->name('question.update');

Route::get('/question/delete/{id}', 'QuestionController@delete')->name('question.delete');

Route::get('/question/vote_up/{id}', 'QuestionController@voteUp')->name('question.vote_up');
Route::get('/question/vote_down/{id}', 'QuestionController@voteDown')->name('question.vote_down');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::post('/profile/update', 'ProfileController@updateProfile')->name('profile.update');
