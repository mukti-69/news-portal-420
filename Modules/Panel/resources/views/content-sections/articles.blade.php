{{-- Articles --}}
@can(config('permissions_list.ARTICLE_INDEX', false))
    <div class="col-12">
        <div class="portlet box shadow min-height-500">
            <div class="portlet-heading">
                <div class="portlet-title">
                    <h3 class="title">
                        <i class="icon-globe"></i>
                        সংবাদ
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
                <div class="table-responsive overflow-x-auto">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>ফিচার্ড ছবি</th>
                            <th>শিরোনাম</th>
                            <th>slug</th>
                            <th>ব্যবহারকারী</th>
                            <th>বিভাগ</th>
                            <th>ট্যাগ</th>
                            <th>লাইক সংখ্যা</th>
                            <th>প্রকাশের তারিখ</th>
                            <th>তৈরির তারিখ</th>
                            <th>সম্পাদকের পছন্দ</th>
                            <th>ব্রেকিং নিউজ</th>
                            <th>অবস্থা</th>
                            @canany([config('permissions_list.ARTICLE_UPDATE'), config('permissions_list.ARTICLE_DESTROY')])
                                <th>কার্যক্রম</th>
                            @endcanany
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($articles as $article)
                            <tr>
                                <td>{{ $article->id }}</td>
                                <td>
                                    <img src="{{ $article->image->url() }}" alt="{{ $article->image->alt_text }}" width="100px" style="max-height: 90px">
                                </td>
                                <td>{{ $article->title }}</td>
                                <td>{{ $article->slug }}</td>
                                <td>{{ $article->user->full_name }}</td>
                                <td>{{ $article->category->name }}</td>
                                <td class="nowrap">{{ str(nullable_value($article->tagNames()))->limit(50) }}</td>
                                <td>{{ $article->likeCount }}</td>
                                <td class="ltr text-right nowrap">{{ jalalian()->forge($article->published_at)->format(config('common.datetime_format')) }}</td>
                                <td class="ltr text-right nowrap">{{ jalalian()->forge($article->created_at)->format(config('common.datetime_format')) }}</td>
                                <td class="{{ status_class($article->editor_choice) }}">{{ status_message($article->editor_choice) }}</td>
                                <td class="{{ status_class($article->isHot()) }}">{{ status_message($article->isHot()) }}</td>
                                <td class="{{ status_class($article->status) }}">{{ status_message($article->status) }}</td>
                                @canany([
                                    config('permissions_list.ARTICLE_UPDATE'),
                                    config('permissions_list.ARTICLE_DESTROY'),
                                    config('permissions_list.SEO_MANAGEMENT', false)
                                ])
                                    <td>
                                        <div class="d-flex gap-2">
                                            @can(config('permissions_list.ARTICLE_UPDATE', false))
                                                <a class="btn btn-sm btn-info btn-icon round d-flex justify-content-center align-items-center"
                                                   rel="tooltip" aria-label="সম্পাদনা" data-bs-original-title="সম্পাদনা"
                                                   href="{{ route(config('app.panel_prefix', 'panel') . '.articles.edit', $article->id) }}">
                                                    <i class="icon-pencil fa-flip-horizontal"></i>
                                                </a>
                                            @endcan

                                            @can(config('permissions_list.ARTICLE_DESTROY', false))
                                                <x-common-delete-button :route="route(config('app.panel_prefix', 'panel') . '.articles.destroy', $article->id)"/>
                                            @endcan

                                            @can(config('permissions_list.SEO_MANAGEMENT', false))
                                                <x-seo-manager-seo-settings-button :route="route(config('app.panel_prefix', 'panel') . '.articles.seo-settings', $article->id)"/>
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
