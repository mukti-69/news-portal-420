{{-- Categories --}}
@can(config('permissions_list.CATEGORY_INDEX', false))
    <div class="col-12">
        <div class="portlet box shadow min-height-500">
            <div class="portlet-heading">
                <div class="portlet-title">
                    <h3 class="title">
                        <i class="icon-grid"></i>
                        বিভাগসমূহ
                    </h3>
                </div><!-- /.portlet-title -->
                <div class="buttons-box">
                    <a class="btn btn-sm btn-default btn-round btn-fullscreen" rel="tooltip"
                       aria-label="ফুলস্ক্রিন" data-bs-original-title="ফুলস্ক্রিন">
                        <i class="icon-size-fullscreen"></i>
                        <div class="paper-ripple">
                            <div class="paper-ripple__background"></div>
                            <div class="paper-ripple__waves"></div>
                        </div>
                    </a>
                    <a class="btn btn-sm btn-default btn-round btn-close" rel="tooltip"
                       aria-label="বন্ধ করুন" data-bs-original-title="বন্ধ করুন">
                        <i class="icon-trash"></i>
                        <div class="paper-ripple">
                            <div class="paper-ripple__background"></div>
                            <div class="paper-ripple__waves"></div>
                        </div>
                    </a>
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
                            @canany([config('permissions_list.CATEGORY_UPDATE'), config('permissions_list.CATEGORY_DESTROY')])
                                <th>কার্যক্রম</th>
                            @endcanany
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $category->image->file_path) }}" alt="{{ $category->image->alt_text }}" width="100px" style="max-height: 90px">
                                </td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>{{ $category->parentCategoryTitle() }}</td>
                                <td class="ltr text-right nowrap">{{ jalalian()->forge($category->created_at)->format(config('common.datetime_format')) }}</td>
                                <td class="{{ status_class($category->status) }}">{{ status_message($category->status) }}</td>
                                @canany([
                                    config('permissions_list.CATEGORY_UPDATE'),
                                    config('permissions_list.CATEGORY_DESTROY'),
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
            </div><!-- /.portlet-body -->
        </div><!-- /.portlet -->
    </div>
@endcan
