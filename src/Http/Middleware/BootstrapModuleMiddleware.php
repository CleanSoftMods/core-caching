<?php namespace WebEd\Base\Caching\Http\Middleware;

use \Closure;

class BootstrapModuleMiddleware
{
    public function __construct()
    {

    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  array|string $params
     * @return mixed
     */
    public function handle($request, Closure $next, ...$params)
    {
        dashboard_menu()->registerItem([
            'id' => 'webed-caching',
            'priority' => 2,
            'parent_id' => 'webed-configuration',
            'heading' => null,
            'title' => trans('webed-caching::base.admin_menu.caching'),
            'font_icon' => 'fa fa-circle-o',
            'link' => route('admin::webed-caching.index.get'),
            'css_class' => null,
            'permissions' => ['view-cache'],
        ]);

        return $next($request);
    }
}
