@extends('panel::layouts.master', ['title' => 'মেনুর তালিকা'])

@section('content')

    <x-common-breadcrumbs>
        <li><a>মেনুর তালিকা</a></li>
    </x-common-breadcrumbs>

    <div class="row pe-0">
        <div class="col-12 pe-0">
            <div class="portlet box shadow min-height-500">
                <div class="portlet-heading">
                    <div class="portlet-title d-flex gap-3">
                        <h3 class="title m-0">
                            <i class="icon-menu"></i>
                            মেনুর তালিকা
                        </h3>
                        <form class="d-inline-block search-form">
                            <div class="input-group">
                                <button class="btn btn-secondary d-flex align-items-center" type="submit">
                                    <i class="icon-magnifier"></i>
                                </button>
                                <input name="query" type="text" class="form-control p-2" placeholder="অনুসন্ধান..." value="{{ request()->get('query') }}">
                            </div>
                        </form>
                    </div><!-- /.portlet-title -->
                    <div class="buttons-box ltr">
                        <a class="btn btn-sm btn-default btn-round btn-fullscreen" rel="tooltip"
                           aria-label="ফুলস্ক্রিন" data-bs-original-title="ফুলস্ক্রিন">
                            <i class="icon-size-fullscreen d-flex justify-content-center align-items-center"></i>
                            <div class="paper-ripple">
                                <div class="paper-ripple__background"></div>
                                <div class="paper-ripple__waves"></div>
                            </div>
                        </a>
                        @can(config('permissions_list.MENU_STORE', false))
                            <div class="btn-group" rel="tooltip"
                                 aria-label="নতুন মেনু তৈরি করুন" data-bs-original-title="নতুন মেনু তৈরি করুন">
                                <button type="button" class="btn btn-sm btn-default btn-round bg-green text-white" data-bs-toggle="dropdown" aria-expanded="true">
                                    <i class="icon-plus d-flex justify-content-center align-items-center"></i>
                                    <div class="paper-ripple">
                                        <div class="paper-ripple__background"></div>
                                        <div class="paper-ripple__waves"></div>
                                    </div>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item"
                                           href="{{ route(config('app.panel_prefix', 'panel') . '.menus.create') }}">
                                            প্রধান মেনু তৈরি করুন
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item"
                                           href="{{ route(config('app.panel_prefix', 'panel') . '.menus.category-menu.create') }}">
                                            বিভাগ মেনু তৈরি করুন
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endcan
                    </div><!-- /.buttons-box -->
                </div><!-- /.portlet-heading -->
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>নাম</th>
                                <th>ঠিকানা</th>
                                <th>ক্রম</th>
                                <th>ধরন</th>
                                <th>প্যারেন্ট মেনু</th>
                                <th>বিভাগ</th>
                                <th>তৈরির তারিখ</th>
                                <th>অবস্থা</th>
                                @canany([
                                    config('permissions_list.MENU_UPDATE', false),
                                    config('permissions_list.MENU_DESTROY', false),
                                ])
                                    <th>কার্যক্রম</th>
                                @endcanany
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($menus as $menu)
                                <tr>
                                    <td>{{ $menu->id }}</td>
                                    <td>{{ $menu->getName() }}</td>
                                    <td>{{ $menu->getUrl() }}</td>
                                    <td>{{ $menu->position }}</td>
                                    <td class="nowrap">{{ __('menu-builder::types.' . $menu->type) }}</td>
                                    <td>{{ $menu->parentMenuName() }}</td>
                                    <td>{{ nullable_value($menu->category?->name) }}</td>
                                    <td class="ltr text-right nowrap">{{ jalalian()->forge($menu->created_at)->format(config('common.datetime_format')) }}</td>
                                    <td class="{{ status_class($menu->status) }}">{{ status_message($menu->status) }}</td>
                                    @canany([
                                        config('permissions_list.MENU_UPDATE', false),
                                        config('permissions_list.MENU_DESTROY', false),
                                    ])
                                        <td>
                                            <div class="d-flex gap-2">
                                                @can(config('permissions_list.MENU_UPDATE', false))
                                                    <a class="btn btn-sm btn-info btn-icon round d-flex justify-content-center align-items-center"
                                                       rel="tooltip" aria-label="সম্পাদনা" data-bs-original-title="সম্পাদনা"
                                                       @if($menu->type === get_class($menu)::MAIN_TYPE)
                                                           href="{{ route(config('app.panel_prefix', 'panel') . '.menus.edit', $menu->id) }}"
                                                       @else
                                                           href="{{ route(config('app.panel_prefix', 'panel') . '.menus.category-menu.edit', $menu->id) }}"
                                                        @endif
                                                    >
                                                        <i class="icon-pencil fa-flip-horizontal"></i>
                                                    </a>
                                                @endcan

                                                @can(config('permissions_list.MENU_DESTROY', false))
                                                    <x-common-delete-button :route="route(config('app.panel_prefix', 'panel') . '.menus.destroy', $menu->id)"/>
                                                @endcan
                                            </div>
                                        </td>
                                    @endcanany
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Display pagination links -->
                    {{ $menus->links() }}

                </div><!-- /.portlet-body -->
            </div><!-- /.portlet -->
        </div>
    </div>

@endsection
