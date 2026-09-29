@extends('panel::layouts.master', ['title' => 'রোলের তালিকা'])

@section('content')

    <x-common-breadcrumbs>
        <li><a>রোলের তালিকা</a></li>
    </x-common-breadcrumbs>

    <div class="row pe-0">
        <div class="col-12 pe-0">
            <div class="portlet box shadow min-height-500">
                <div class="portlet-heading">
                    <div class="portlet-title">
                        <h3 class="title">
                            <i class="icon-people"></i>
                            রোলের তালিকা
                        </h3>
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
                        @can(config('permissions_list.ROLE_STORE', false))
                            <a class="btn btn-sm btn-default btn-round bg-green text-white" rel="tooltip"
                               href="{{ route(config('app.panel_prefix', 'panel') . '.roles.create') }}"
                               aria-label="নতুন রোল তৈরি করুন" data-bs-original-title="নতুন রোল তৈরি করুন">
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
                                <th>নাম</th>
                                <th>প্রদর্শনের নাম</th>
                                <th>রোলের অনুমতি</th>
                                <th>তৈরির তারিখ</th>
                                @canany([config('permissions_list.ROLE_UPDATE'), config('permissions_list.ROLE_DESTROY')])
                                    <th>কার্যক্রম</th>
                                @endcanany
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->local_name }}</td>
                                    <td class="nowrap" title="{{ $role->getPermissionLocalNames()->implode(', ') }}">
                                        {{ str($role->getPermissionLocalNames()->implode(', '))->limit() }}
                                    </td>
                                    <td class="ltr text-right nowrap">{{ jalalian()->forge($role->created_at)->format(config('common.datetime_format')) }}</td>
                                    @canany([config('permissions_list.ROLE_UPDATE'), config('permissions_list.ROLE_DESTROY')])
                                        <td>
                                            <div class="d-flex gap-2">
                                                @can(config('permissions_list.ROLE_UPDATE', false))
                                                    <a class="btn btn-sm btn-info btn-icon round d-flex justify-content-center align-items-center"
                                                       rel="tooltip" aria-label="সম্পাদনা" data-bs-original-title="সম্পাদনা"
                                                       href="{{ route(config('app.panel_prefix', 'panel') . '.roles.edit', $role->id) }}">
                                                        <i class="icon-pencil fa-flip-horizontal"></i>
                                                    </a>
                                                @endcan

                                                @can(config('permissions_list.ROLE_DESTROY', false))
                                                    <x-common-delete-button :route="route(config('app.panel_prefix', 'panel') . '.roles.destroy', $role->id)"/>
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
                    {{ $roles->links() }}

                </div><!-- /.portlet-body -->
            </div><!-- /.portlet -->
        </div>
    </div>

@endsection
