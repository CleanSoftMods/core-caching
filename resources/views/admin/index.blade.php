@extends('webed-core::admin._master')

@section('css')

@endsection

@section('js')

@endsection

@section('js-init')

@endsection

@section('content')
    <div class="layout-1columns">
        <div class="column main">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        <i class="icon-layers font-dark"></i>
                        {{ trans('webed-caching::base.cache_commands') }}
                    </h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <a href="{{ route('admin::webed-caching.clear-cms-cache.get') }}"
                           data-toggle="confirmation"
                           data-placement="right"
                           title="{{ trans('webed-core::messages.are_you_sure') }}"
                           class="btn btn-danger">
                            {{ trans('webed-caching::base.commands.clear_cms_cache') }}
                        </a>
                        <a href="{{ route('admin::webed-caching.refresh-compiled-views.get') }}"
                           data-toggle="confirmation"
                           data-placement="right"
                           title="{{ trans('webed-core::messages.are_you_sure') }}"
                           class="btn btn-warning">
                            {{ trans('webed-caching::base.commands.refresh_compiled_views') }}
                        </a>
                    </div>
                    <div class="form-group">
                        <a href="{{ route('admin::webed-caching.create-config-cache.get') }}"
                           data-toggle="confirmation"
                           data-placement="right"
                           title="{{ trans('webed-core::messages.are_you_sure') }}"
                           class="btn green">
                            {{ trans('webed-caching::base.commands.create_config_cache') }}
                        </a>
                        <a href="{{ route('admin::webed-caching.clear-config-cache.get') }}"
                           data-toggle="confirmation"
                           data-placement="right"
                           title="{{ trans('webed-core::messages.are_you_sure') }}"
                           class="btn green-meadow">
                            {{ trans('webed-caching::base.commands.clear_config_cache') }}
                        </a>
                    </div>
                    <div class="form-group">
                        <a href="{{ route('admin::webed-caching.optimize-class.get') }}"
                           data-toggle="confirmation"
                           data-placement="right"
                           title="{{ trans('webed-core::messages.are_you_sure') }}"
                           class="btn purple">
                            {{ trans('webed-caching::base.commands.optimize_class_loader') }}
                        </a>
                        <a href="{{ route('admin::webed-caching.clear-compiled-class.get') }}"
                           data-toggle="confirmation"
                           data-placement="right"
                           title="{{ trans('webed-core::messages.are_you_sure') }}"
                           class="btn red-haze">
                            {{ trans('webed-caching::base.commands.clear_optimized_class_loader') }}
                        </a>
                    </div>
                    <div class="form-group hidden">
                        <a href="{{ route('admin::webed-caching.create-route-cache.get') }}"
                           data-toggle="confirmation"
                           data-placement="right"
                           title="{{ trans('webed-core::messages.are_you_sure') }}"
                           class="btn yellow-crusta">
                            {{ trans('webed-caching::base.commands.create_route_cache') }}
                        </a>
                        <a href="{{ route('admin::webed-caching.clear-route-cache.get') }}"
                           data-toggle="confirmation"
                           data-placement="right"
                           title="{{ trans('webed-core::messages.are_you_sure') }}"
                           class="btn purple">
                            {{ trans('webed-caching::base.commands.clear_route_cache') }}
                        </a>
                    </div>
                </div>
            </div>
            @php do_action(BASE_ACTION_META_BOXES, 'main', WEBED_CACHING . '.index', null) @endphp
        </div>
    </div>
@endsection
