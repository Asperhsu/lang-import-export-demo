<?php

Route::get('/', 'HomeController@index')->name('home');
Route::get('/files', 'HomeController@files')->name('files');

Route::prefix('lang')->group(function () {
    Route::post('/clear', 'LangController@clear')->name('lang.clear');
    Route::post('/download', 'LangController@download')->name('lang.download');
    Route::post('/store', 'LangController@store')->name('lang.store');
});

Route::resource('translation', 'TranslationController', ['only' => ['index', 'store']]);

Route::prefix('export')->group(function () {
    Route::post('/upload', 'ExportController@upload')->name('export.upload');
    Route::post('/download', 'ExportController@download')->name('export.download');
});

Route::prefix('import')->group(function () {
    Route::post('/upload', 'ImportController@upload')->name('import.upload');
});
