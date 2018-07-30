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
    Route::get('list', 'CandidateController@index')->name('candidate.list');

    Route::get('new', 'CandidateController@store')->name('candidate.new');

    Route::post('new', 'CandidateController@postStore')->name('candidate.postNew');

    Route::get('test','CandidateController@test');

    Route::get('edit/{id}','CandidateController@update')->name('candidate.edit');
    Route::post('edit','CandidateController@updatePost')->name('candidate.postEdit');

    Route::get('test', 'CandidateController@test');

    Route::post('import', 'CandidateController@importExcel')->name('candidate.excel.import');

    Route::group(['prefix' => 'ajax'], function() {
        Route::post('show', 'CandidateController@showAjax')->name('candidate.ajax.show');

        Route::post('search','CandidateController@searchAjax')->name('candidate.ajax.search');

        Route::post('delete', 'CandidateController@destroyAjax')->name('candidate.ajax.delete');
    });
});

Route::group(['prefix' => 'career'], function() {
    Route::get('list', 'CareerController@index')->name('career.list');

    Route::get('new', 'CareerController@store')->name('career.new');
    Route::post('new', 'CareerController@storePost');

    Route::get('delete/{id}', 'CareerController@destroy');

    Route::get('edit/{id}', 'CareerController@update');

    Route::post('edit/{id}', 'CareerController@updatePost');


    Route::get('test',function(){

    });

    Route::group(['prefix' => 'ajax'], function() {
        Route::post('new', 'CareerController@storePostAjax')->name('ajax.career.create');

        Route::post('edit','CareerController@updatePostAjax')->name('ajax.career.update');

        Route::get('delete/{id}','CareerController@destroyAjax');

        Route::get('select2Search','CareerController@searchSelect2Ajax')->name('ajax.career.search');

    });

});

Route::group(['prefix' => 'source'], function() {
    Route::get('list', 'SourceController@index')->name('source.list');

    Route::get('new', 'SourceController@store')->name('source.new');
    Route::post('new', 'SourceController@postStore');

    Route::get('delete/{id}', 'SourceController@destroy');

    Route::post('edit}', 'SourceController@postUpdate');

    Route::group(['prefix' => 'ajax'], function() {

        Route::post('new', 'SourceController@storePostAjax')->name('ajax.source.create');

        Route::post('edit', 'SourceController@updatePostAjax');

        Route::post('delete', 'SourceController@destroyAjax');

        Route::get('select2Search','SourceController@searchSelect2Ajax')->name('source.ajax.search');

    });

});

Route::group(['prefix' => 'skill'], function() {
    Route::get('list', 'SkillController@index')->name('skill.list');

    Route::get('new', 'SkillController@store')->name('skill.new');
    Route::post('new', 'SkillController@postStore');

    Route::get('delete/{id}', 'SkillController@destroy');

    Route::get('edit/{id}', 'SkillController@update');
    Route::post('edit/{id}', 'SkillController@postUpdate');

    Route::group(['prefix' => 'ajax'], function() {

        Route::post('new', 'SkillController@storePostAjax')->name('ajax.skill.create');

        Route::post('edit', 'SkillController@updatePostAjax');

        Route::post('delete', 'SkillController@destroyAjax');

        Route::get('select2Search','SkillController@searchAjaxSelect2')->name('ajax.skill.search');

    });
});

Route::group(['prefix' => 'location'], function() {

    Route::group(['prefix' => 'ajax'], function() {

        Route::get('select2Search', 'LocationController@searchAjaxSelect2')->name('ajax.location.search');
        
        Route::post('test','LocationController@test');


    });
});

Route::group(['prefix' => 'diary'], function() {

    Route::get('elastic','DiaryController@test_elastic');

    Route::group(['prefix' => 'ajax'], function() {

        Route::post('list','DiaryController@index')->name('diary.ajax.list');

        Route::get('listCandidateType','DiaryController@indexCandidateType')->name('diary.ajax.listCandidateType');

        Route::post('new','DiaryController@storeAjax')->name('diary.ajax.new');

        Route::post('delete','DiaryController@destroyAjax')->name('diary.ajax.delete');


    });
});

Route::group(['prefix'=>'book'],function (){
    Route::get('search','BookController@index');
    Route::post('search','BookController@index')->name('book.search');
    Route::post('store','BookController@store')->name('book.store');

    Route::get('copyto','BookController@copyToElastic');
});

