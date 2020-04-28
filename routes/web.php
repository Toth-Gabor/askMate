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
// Question routes
Route::get('/question/index/{order_by?}/{order_direction?}', 'QuestionController@index')->name('question.index');
Route::get('/question/show/{id}', 'QuestionController@show')->name('question.show');

Route::get('/question/add', 'QuestionController@add')->name('question.add');
Route::post('/question/create', 'QuestionController@create')->name('question.create');

Route::get('/question/edit/{id}', 'QuestionController@edit')->name('question.edit');
Route::post('/question/update/{id}', 'QuestionController@update')->name('question.update');

Route::get('/question/delete/{id}', 'QuestionController@delete')->name('question.delete');

Route::get('/question/vote_up/{id}', 'QuestionController@voteUp')->name('question.vote_up');
Route::get('/question/vote_down/{id}', 'QuestionController@voteDown')->name('question.vote_down');
// Answer routes
Route::get('/answer/add/{id}', 'AnswerController@add')->name('answer.add');
Route::post('/answer/create/{id}', 'AnswerController@create')->name('answer.create');

Route::get('/answer/edit/{id}', 'AnswerController@edit')->name('answer.edit');
Route::post('/answer/update/{id}', 'AnswerController@update')->name('answer.update');

Route::get('/answer/delete/{id}', 'AnswerController@delete')->name('answer.delete');

Route::get('/answer/vote_up/{id}', 'AnswerController@voteUp')->name('answer.vote_up');
Route::get('/answer/vote_down/{id}', 'AnswerController@voteDown')->name('answer.vote_down');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::post('/profile/update', 'ProfileController@updateProfile')->name('profile.update');
