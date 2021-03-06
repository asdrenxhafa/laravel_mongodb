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

//Route::get('/','QuestionController@index')->middleware('auth');

Auth::routes();

Route::middleware('auth')->group(function(){

    Route::get('/','QuestionController@index');

    Route::resource('questions','QuestionController')->except('show');
    Route::get('questions/{slug}','QuestionController@show')->name('questions.show');

    Route::resource('question.answer','AnswerController')->except(['create', 'show']);
    Route::post('answers/{question_id}','AnswerController@store')->name('answers.store');
    Route::get('answers/{answer}/edit/{question}','AnswerController@edit')->name('answers.edit');
    Route::delete('answers/{answer}','AnswerController@destroy')->name('answers.destroy');
    Route::post('/answers/{answer}/accept', 'AcceptAnswerController')->name('answers.accept');


    Route::post('/questions/{question}/favorites', 'FavoritesController@store')->name('questions.favorite');
    Route::delete('/questions/{question}/favorites', 'FavoritesController@destroy')->name('questions.unfavorite');
    Route::post('/questions/{question}/vote', 'VoteQuestionController');
    Route::post('/answers/{answer}/vote', 'VoteAnswerController');

});


