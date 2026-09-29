@extends('panel::layouts.master', ['title' => 'ব্যবহারকারীদের বার্তার তালিকা'])

@section('content')

    <x-common-breadcrumbs>
        <li><a>যোগাযোগ</a></li>
        <li><a>ব্যবহারকারীদের বার্তার তালিকা</a></li>
    </x-common-breadcrumbs>

    <div class="row pe-0">
        <div class="col-12 pe-0">
            <div class="portlet box shadow min-height-500">
                <div class="portlet-heading">
                    <div class="portlet-title d-flex gap-3">
                        <h3 class="title m-0">
                            <i class="icon-envelope"></i>
                            ব্যবহারকারীদের বার্তার তালিকা
                        </h3>
                        <form class="d-inline-block search-form">
                            <div class="input-group">
                                <button class="btn btn-secondary d-flex align-items-center" type="submit">
                                    <i class="icon-magnifier"></i>
                                </button>
                                <input name="query" type="text" class="form-control p-2" placeholder="অনুসন্ধান..." value="{{ request()->get('query') }}">
                                @foreach(request()->except(['query', 'page']) as $key => $value)
                                    <input name="{{ $key }}" type="hidden" value="{{ $value }}">
                                @endforeach
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

                        <!-- Filter box -->
                        <div class="btn-group" rel="tooltip"
                             aria-label="মন্তব্য ফিল্টার" data-bs-original-title="মন্তব্য ফিল্টার">
                            <button type="button" class="btn btn-sm btn-default btn-round btn-info text-white dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                <i class=" fas fa-filter d-flex justify-content-center align-items-center"></i>
                                <div class="paper-ripple">
                                    <div class="paper-ripple__background"></div>
                                    <div class="paper-ripple__waves"></div>
                                </div>
                            </button>
                            <ul class="dropdown-menu">
                                @foreach($filters as $value)
                                    <li>
                                        <a class="dropdown-item"
                                           href="{{ route(
                                                            config('app.panel_prefix', 'panel') . '.contact-us.messages.index',
                                                            ['filter' => $value] + request()->all()
                                                        ) }}">
                                            {{ __($value) }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div><!-- /.buttons-box -->
                </div><!-- /.portlet-heading -->
                <div class="portlet-body">
                    <div class="table-responsive" style="overflow-x: auto !important;">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>বিষয়</th>
                                <th>নাম</th>
                                <th>ইমেইল</th>
                                <th>ফোন নম্বর</th>
                                <th>বার্তা</th>
                                <th>পড়ার অবস্থা</th>
                                <th>বার্তা পাওয়ার তারিখ</th>
                                <th>কার্যক্রম</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($userMessages as $userMessage)
                                <tr>
                                    <td>{{ $userMessage->id }}</td>
                                    <td>{{ $userMessage->subject }}</td>
                                    <td>{{ $userMessage->name }}</td>
                                    <td>{{ $userMessage->email }}</td>
                                    <td>{{ nullable_value($userMessage->phone) }}</td>
                                    <td>{{ str($userMessage->message)->limit(30) }}</td>
                                    <td class="{{ status_class($userMessage->isSeen()) }}">{{ $userMessage->getSeenStatus() }}</td>
                                    <td class="ltr text-right nowrap">{{ jalalian()->forge($userMessage->created_at)->format(config('common.datetime_format')) }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a class="btn btn-sm btn-info btn-icon round d-flex justify-content-center align-items-center"
                                               rel="tooltip" aria-label="বার্তা দেখুন" data-bs-original-title="বার্তা দেখুন"
                                               href="{{ route(config('app.panel_prefix', 'panel') . '.contact-us.messages.show', $userMessage->id) }}">
                                                <i class="icon-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Display pagination links -->
                    {{ $userMessages->links() }}

                </div><!-- /.portlet-body -->
            </div><!-- /.portlet -->
        </div>
    </div>
@endsection
