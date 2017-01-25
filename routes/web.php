<?php
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

$adminRoute = config('webed.admin_route');

$moduleRoute = 'caching';

/**
 * Admin routes
 */
Route::group(['prefix' => $adminRoute . '/' . $moduleRoute], function (Router $router) use ($adminRoute, $moduleRoute) {
    $router->get('', 'CachingController@getIndex')
        ->name('admin::webed-caching.index.get')
        ->middleware('has-permission:view-caching');

    $router->get('clear-cms-cache', 'CachingController@getClearCmsCache')
        ->name('admin::webed-caching.clear-cms-cache.get')
        ->middleware('has-permission:clear-cache');

    $router->get('refresh-compiled-views', 'CachingController@getRefreshCompiledViews')
        ->name('admin::webed-caching.refresh-compiled-views.get')
        ->middleware('has-permission:clear-cache');
});
