@extends('panel::layouts.master', ['title' => 'বিজ্ঞাপনের তালিকা'])

@section('content')
    <x-common-breadcrumbs>
        <li><a>বিজ্ঞাপনের তালিকা</a></li>
    </x-common-breadcrumbs>

    <div class="row pe-0">
        <div class="col-12 pe-0">
            <div class="portlet box shadow min-height-500">
                <div class="portlet-heading">
                    <div class="portlet-title d-flex gap-3">
                        <h3 class="title m-0">
                            <i class="fas fa-bullhorn"></i>
                            বিজ্ঞাপনের তালিকা
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
                        @can(config('permissions_list.ADS_STORE', false))
                            <a class="btn btn-sm btn-default btn-round bg-green text-white" rel="tooltip"
                               href="{{ route(config('app.panel_prefix', 'panel') . '.ads.create') }}"
                               aria-label="নতুন বিজ্ঞাপন তৈরি করুন" data-bs-original-title="নতুন বিজ্ঞাপন তৈরি করুন">
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
                    <div class="table-responsive overflow-x-auto">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>ছবি</th>
                                <th>শিরোনাম</th>
                                <th>লিংক</th>
                                <th>অবস্থান</th>
                                <th>প্রকাশের তারিখ</th>
                                <th>মেয়াদ শেষের তারিখ</th>
                                <th>তৈরির তারিখ</th>
                                <th>অবস্থা</th>
                                @canany([config('permissions_list.ADS_UPDATE'), config('permissions_list.ADS_DESTROY')])
                                    <th>কার্যক্রম</th>
                                @endcanany
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($ads as $ad)
                                <tr>
                                    <td>{{ $ad->id }}</td>
                                    <td>
                                        <img src="{{ $ad->image->url() }}" alt="{{ $ad->image->alt_text }}" width="100px" style="max-height: 90px">
                                    </td>
                                    <td>{{ $ad->title }}</td>
                                    <td>{{ $ad->link }}</td>
                                    <td>{{ nullable_value( __($ad->getSection()) ) }}</td>
                                    <td class="ltr text-right nowrap">{{ jalalian()->forge($ad->published_at)->format(config('common.datetime_format')) }}</td>
                                    <td class="ltr text-right nowrap">
                                        @if($ad->expired_at)
                                            {{ jalalian()->forge($ad->expired_at)->format(config('common.datetime_format')) }}
                                        @else
                                            {{ nullable_value($ad->expired_at) }}
                                        @endif
                                    </td>
                                    <td class="ltr text-right nowrap">{{ jalalian()->forge($ad->created_at)->format(config('common.datetime_format')) }}</td>
                                    <td class="{{ status_class($ad->status) }}">{{ status_message($ad->status) }}</td>
                                    @canany([config('permissions_list.ADS_UPDATE'), config('permissions_list.ADS_DESTROY')])
                                        <td>
                                            <div class="d-flex gap-2">
                                                @can(config('permissions_list.ADS_UPDATE', false))
                                                    <a class="btn btn-sm btn-info btn-icon round d-flex justify-content-center align-items-center"
                                                       rel="tooltip" aria-label="সম্পাদনা" data-bs-original-title="সম্পাদনা"
                                                       href="{{ route(config('app.panel_prefix', 'panel') . '.ads.edit', $ad->id) }}">
                                                        <i class="icon-pencil fa-flip-horizontal"></i>
                                                    </a>
                                                @endcan

                                                @can(config('permissions_list.ADS_DESTROY', false))
                                                    <x-common-delete-button :route="route(config('app.panel_prefix', 'panel') . '.ads.destroy', $ad->id)"/>
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
                    {{ $ads->links() }}

                </div><!-- /.portlet-body -->
            </div><!-- /.portlet -->
        </div>
    </div>

@endsection
