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

Route::get('/', 'CandidateController@index');

Route::group(['prefix' => 'candidate'], function() {
    Route::get('list', 'CandidateController@index');

    Route::get('new', 'CandidateController@store');
});

Route::group(['prefix' => 'career'], function() {
    Route::get('list', 'CareerController@index');

    Route::get('new', 'CareerController@store');
    Route::post('new', 'CareerController@storePost');

    Route::get('delete/{id}', 'CareerController@destroy');

    Route::get('edit/{id}', 'CareerController@update');

    Route::post('edit/{id}', 'CareerController@updatePost');

    Route::group(['prefix' => 'ajax'], function() {
        Route::post('new', 'CareerController@storePostAjax')->name('ajax.career.create');

        Route::get('list', 'CareerController@indexAjax');

        Route::get('edit/{id}','CareerController@showAjax');

        Route::post('edit','CareerController@updatePostAjax')->name('ajax.career.update');

    });

});

Route::group(['prefix' => 'source'], function() {
    Route::get('list', 'SourceController@index');

    Route::get('new', 'SourceController@store');
    Route::post('new', 'SourceController@postStore');

    Route::get('delete/{id}', 'SourceController@destroy');

    Route::post('edit}', 'SourceController@postUpdate');




});

Route::group(['prefix' => 'skill'], function() {
    Route::get('list', 'SkillController@index');

    Route::get('new', 'SkillController@store');
    Route::post('new', 'SkillController@postStore');

    Route::get('delete/{id}', 'SkillController@destroy');

    Route::get('edit/{id}', 'SkillController@update');
    Route::post('edit/{id}', 'SkillController@postUpdate');
});

