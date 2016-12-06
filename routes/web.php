<?php use Illuminate\Routing\Router;

/**
 *
 * @var Router $router
 *
 */

$router->group(['middleware' => 'web'], function (Router $router) {

    $adminRoute = config('webed.admin_route');

    $moduleRoute = 'caching';

    /**
     * Admin routes
     */
    $router->group(['prefix' => $adminRoute . '/' . $moduleRoute], function (Router $router) use ($adminRoute, $moduleRoute) {
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
});
