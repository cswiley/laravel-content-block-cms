<?php

Route::middleware(['web', 'auth'])->group(function () {
    Route::resource(config('cms.prefix'), '\Cswiley\Cms\CmsController');
});


