<?php namespace WebEd\Base\Caching\Http\Controllers;

use WebEd\Base\Http\Controllers\BaseAdminController;

class CachingController extends BaseAdminController
{
    protected $module = 'webed-caching';

    public function __construct()
    {
        parent::__construct();

        $this->breadcrumbs->addLink('Caching', route('admin::webed-caching.index.get'));

        $this->getDashboardMenu($this->module);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {
        $this->setPageTitle('Cache management', 'Manage all cms cache');

        $this->assets->addJavascripts('jquery-datatables');

        return do_filter('webed-caching.index.get', $this)->viewAdmin('index');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getClearCmsCache()
    {
        \Artisan::call('cache:clear');

        flash_messages()
            ->addMessages('Cache cleaned', 'success')
            ->showMessagesOnSession();

        return redirect()->to(route('admin::webed-caching.index.get'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getRefreshCompiledViews()
    {
        \Artisan::call('view:clear');

        flash_messages()
            ->addMessages('Views refreshed', 'success')
            ->showMessagesOnSession();

        return redirect()->to(route('admin::webed-caching.index.get'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getCreateConfigCache()
    {
        \Artisan::call('config:cache');

        flash_messages()
            ->addMessages('Config cache created', 'success')
            ->showMessagesOnSession();

        return redirect()->to(route('admin::webed-caching.index.get'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getClearConfigCache()
    {
        \Artisan::call('config:clear');

        flash_messages()
            ->addMessages('Config cache cleared', 'success')
            ->showMessagesOnSession();

        return redirect()->to(route('admin::webed-caching.index.get'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getOptimizeClass()
    {
        \Artisan::call('optimize');

        flash_messages()
            ->addMessages('Generated optimized class loader', 'success')
            ->showMessagesOnSession();

        return redirect()->to(route('admin::webed-caching.index.get'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getClearCompiledClass()
    {
        \Artisan::call('clear-compiled');

        flash_messages()
            ->addMessages('Optimized class loader cleared', 'success')
            ->showMessagesOnSession();

        return redirect()->to(route('admin::webed-caching.index.get'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getCreateRouteCache()
    {
        \Artisan::call('route:cache');

        flash_messages()
            ->addMessages('Route cache created', 'success')
            ->showMessagesOnSession();

        return redirect()->to(route('admin::webed-caching.index.get'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function getClearRouteCache()
    {
        \Artisan::call('route:clear');

        flash_messages()
            ->addMessages('Route cache cleared', 'success')
            ->showMessagesOnSession();

        return redirect()->to(route('admin::webed-caching.index.get'));
    }
}
