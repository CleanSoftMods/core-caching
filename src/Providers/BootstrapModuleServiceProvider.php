<?php namespace WebEd\Base\Caching\Providers;

use Illuminate\Support\ServiceProvider;

class BootstrapModuleServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        app()->booted(function () {
            $this->booted();
        });
    }

    protected function booted()
    {
        \DashboardMenu::registerItem([
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
    }
}
