@extends('panel::layouts.master', ['title' => 'বিভাগের তালিকা'])

@section('content')

    <x-common-breadcrumbs>
        <li><a>বিভাগের তালিকা</a></li>
    </x-common-breadcrumbs>

    <div class="row pe-0">
        <div class="col-12 pe-0">
            <div class="portlet box shadow min-height-500">
                <div class="portlet-heading">
                    <div class="portlet-title d-flex gap-3">
                        <h3 class="title m-0">
                            <i class="icon-people"></i>
                            বিভাগের তালিকা
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
                        @can(config('permissions_list.CATEGORY_STORE', false))
                            <a class="btn btn-sm btn-default btn-round bg-green text-white" rel="tooltip"
                               href="{{ route(config('app.panel_prefix', 'panel') . '.categories.create') }}"
                               aria-label="নতুন বিভাগ তৈরি করুন" data-bs-original-title="নতুন বিভাগ তৈরি করুন">
                                <i class="icon-plus d-flex justify-content-center align-items-center"></i>
                                <div class="paper-ripple">
                                    <div class="paper-ripple__background"></div>
                                    <div class="paper-ripple__waves"></div>
                                </div>
                            </a>
                        @endcan
                    </div><!-- /.buttons-box -->
                </div><!-- /.portlet-heading -->
                <div class="portlet-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>ফিচার্ড ছবি</th>
                                <th>নাম</th>
                                <th>slug</th>
                                <th>প্যারেন্ট বিভাগ</th>
                                <th>তৈরির তারিখ</th>
                                <th>অবস্থা</th>
                                @canany([
                                    config('permissions_list.CATEGORY_UPDATE', false),
                                    config('permissions_list.CATEGORY_DESTROY', false),
                                    config('permissions_list.SEO_MANAGEMENT', false)
                                ])
                                    <th>কার্যক্রম</th>
                                @endcanany
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>
                                        <img src="{{ $category->image->url() }}" alt="{{ $category->image->alt_text }}" width="100px" style="max-height: 90px">
                                    </td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>{{ $category->parentCategoryTitle() }}</td>
                                    <td class="ltr text-right nowrap">{{ jalalian()->forge($category->created_at)->format(config('common.datetime_format')) }}</td>
                                    <td class="{{ status_class($category->status) }}">{{ status_message($category->status) }}</td>
                                    @canany([
                                        config('permissions_list.CATEGORY_UPDATE', false),
                                        config('permissions_list.CATEGORY_DESTROY', false),
                                        config('permissions_list.SEO_MANAGEMENT', false)
                                    ])
                                        <td>
                                            <div class="d-flex gap-2">
                                                @can(config('permissions_list.CATEGORY_UPDATE', false))
                                                    <a class="btn btn-sm btn-info btn-icon round d-flex justify-content-center align-items-center"
                                                       rel="tooltip" aria-label="সম্পাদনা" data-bs-original-title="সম্পাদনা"
                                                       href="{{ route(config('app.panel_prefix', 'panel') . '.categories.edit', $category->id) }}">
                                                        <i class="icon-pencil fa-flip-horizontal"></i>
                                                    </a>
                                                @endcan

                                                @can(config('permissions_list.CATEGORY_DESTROY', false))
                                                    <x-common-delete-button :route="route(config('app.panel_prefix', 'panel') . '.categories.destroy', $category->id)"/>
                                                @endcan

                                                @can(config('permissions_list.SEO_MANAGEMENT', false))
                                                    <x-seo-manager-seo-settings-button :route="route(config('app.panel_prefix', 'panel') . '.categories.seo-settings', $category->id)"/>
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
                    {{ $categories->links() }}

                </div><!-- /.portlet-body -->
            </div><!-- /.portlet -->
        </div>
    </div>

@endsection
