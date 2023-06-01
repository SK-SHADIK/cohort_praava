<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');


    Route::resource('database', DatabaseController::class);
    Route::resource('cohort', CohortController::class);
    Route::resource('event-based-campaign', EventBasedCampaignController::class);

});
