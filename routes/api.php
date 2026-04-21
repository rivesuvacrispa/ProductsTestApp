<?php

use App\Http\Controllers\ProductsController;

Route::prefix('v1')->group(function () {

   Route::prefix('products')->group(function () {

       Route::get('list', [ProductsController::class, 'list']);

   });

});