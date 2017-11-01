<?php

//
//Route::middleware([
//    'middleware' => [
//        'web',
//        'auth'
//    ]
//], function () {
//    Route::resource(config('cms.prefix'), '\CameronWiley\Cms\CmsController');
//});

Route::middleware(['web', 'auth'])->group(function () {
    Route::resource(config('cms.prefix'), '\CameronWiley\Cms\CmsController');
});


