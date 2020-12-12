<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/reviews', 'ReviewController@index')->name('reviews.index');
Route::post('/review/store', 'ReviewController@store')->name('review.store')
    ->middleware('my.auth');

Route::group([
    'middleware' => 'my.auth',
    'prefix' => 'user',
    'as' => 'user.',
    'namespace' => 'User'
], function () {
    Route::resource('proposal', 'ProposalController');
});

Route::group([
    'middleware' => 'admin.auth',
    'prefix' => 'superadmin',
    'as' => 'admin.',
    'namespace' => 'Admin'
], function () {

    Route::resource('category', 'CategoryController');

    Route::resource('proposal', 'ProposalController');

    Route::get('proposal/solved/{proposal}', 'ProposalController@solvedShow')
        ->name('proposal.solved.show');

    Route::get('proposal/work/{proposal}', 'ProposalController@inWorkShow')
        ->name('proposal.work.show');

    Route::match(['put', 'patch'], 'proposal/solved/{proposal}', 'ProposalController@solved')
        ->name('proposal.solved');

    Route::match(['put', 'patch'], '/proposal/work/{proposal}', 'ProposalController@inWork')
        ->name('proposal.work');

    Route::resource('user', 'UserController');
});
