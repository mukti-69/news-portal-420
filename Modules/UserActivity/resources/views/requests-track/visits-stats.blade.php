@extends('panel::layouts.master', ['title' => 'ভিজিট পরিসংখ্যান'])

@section('content')

    <x-common-breadcrumbs>
        <li><a>ভিজিট পরিসংখ্যান</a></li>
    </x-common-breadcrumbs>

    <div class="row pe-0">
        <div class="col-12 pe-0">
            <div class="portlet box shadow min-height-500">
                <div class="portlet-heading">
                    <div class="portlet-title d-flex gap-3">
                        <h3 class="title m-0">
                            <i class="icon-eye"></i>
                            ভিজিট পরিসংখ্যান
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
                    </div><!-- /.buttons-box -->
                </div><!-- /.portlet-heading -->
                <div class="portlet-body">
                    <!-- Visit counts table -->
                    <div class="visit-counts">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>সময়সীমা</th>
                                <th>ভিজিট সংখ্যা</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>গত ১ ঘণ্টা</td>
                                <td>{{ $visitCounts['hourly'] }}</td>
                            </tr>
                            <tr>
                                <td>গত ১০ ঘণ্টা</td>
                                <td>{{ $visitCounts['ten_hours'] }}</td>
                            </tr>
                            <tr>
                                <td>গত ১ দিন</td>
                                <td>{{ $visitCounts['daily'] }}</td>
                            </tr>
                            <tr>
                                <td>গত ১ সপ্তাহ</td>
                                <td>{{ $visitCounts['weekly'] }}</td>
                            </tr>
                            <tr>
                                <td>গত ১ মাস</td>
                                <td>{{ $visitCounts['monthly'] }}</td>
                            </tr>
                            <tr>
                                <td>গত ১ বছর</td>
                                <td>{{ $visitCounts['yearly'] }}</td>
                            </tr>
                            <tr>
                                <td>মোট ভিজিট</td>
                                <td>{{ $visitCounts['all'] }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div><!-- /.portlet-body -->
            </div><!-- /.portlet -->
        </div>
    </div>

@endsection
