@extends('panel::layouts.master', ['title' => 'ব্যবহারকারী প্যানেল'])

@section('content')
    <x-common-breadcrumbs :noprefix="true">
        <li><a>ড্যাশবোর্ড</a></li>
    </x-common-breadcrumbs>

    {{-- Header Stats --}}
    @include('panel::content-sections/header-stats')

    <div class="row m-0 p-0">
        {{-- Site Visitors --}}
        @include('panel::content-sections.site-visitors')

        {{-- Articles Visits --}}
        @include('panel::content-sections.articles-visits')

        {{-- Articles --}}
        @include('panel::content-sections/articles')

        {{-- Categories --}}
        @include('panel::content-sections/categories')

        {{-- Tags --}}
        @include('panel::content-sections/tags')

        {{-- Images --}}
        @include('panel::content-sections/images')

        {{-- Comments --}}
        @include('panel::content-sections/comments')
    </div>

@endsection

@push('scripts')
    <script src="{{ asset('admin/assets/plugins/jquery-incremental-counter/jquery.incremental-counter.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/morris.js/morris.min.js') }}"></script>
    <script>
        $(".counter-down").incrementalCounter({digits: 'auto'});
    </script>
    <script>
        Morris.Donut({
            element: 'site-visits-yearly',
            data: [
                {value: {{ $visitsCount['yearly'] }}, label: 'বছর', formatted: '{{ $visitsCount['yearly'] }} জন'},
                {value: {{ $visitsCount['monthly'] }}, label: 'মাস', formatted: '{{ $visitsCount['monthly'] }} জন'},
                {value: {{ $visitsCount['weekly'] }}, label: 'সপ্তাহ', formatted: '{{ $visitsCount['weekly'] }} জন'},
            ],
            colors: [
                '#1e4572',
                '#597bbd',
                '#6da1f1',
            ],
            formatter: function (x, data) {
                return data.formatted;
            },
            resize: true
        });

        Morris.Donut({
            element: 'site-visits-daily',
            data: [
                {value: {{ $visitsCount['daily'] }}, label: 'দিন', formatted: '{{ $visitsCount['daily'] }} জন'},
                {value: {{ $visitsCount['ten_hours'] }}, label: '১০ ঘণ্টা', formatted: '{{ $visitsCount['ten_hours'] }} জন'},
                {value: {{ $visitsCount['hourly'] }}, label: '১ ঘণ্টা', formatted: '{{ $visitsCount['hourly'] }} জন'},
            ],
            colors: [
                '#ffc107',
                '#e36100',
                '#d50000',
            ],
            formatter: function (x, data) {
                return data.formatted;
            },
            resize: true
        });
    </script>
    <script>
        Morris.Donut({
            element: 'articles-visits-yearly',
            data: [
                {value: {{ $articlesVisitsCount['year'] }}, label: 'বছর', formatted: '{{ $articlesVisitsCount['year'] }} জন'},
                {value: {{ $articlesVisitsCount['month'] }}, label: 'মাস', formatted: '{{ $articlesVisitsCount['month'] }} জন'},
                {value: {{ $articlesVisitsCount['week'] }}, label: 'সপ্তাহ', formatted: '{{ $articlesVisitsCount['week'] }} জন'},
            ],
            colors: [
                '#1e4572',
                '#597bbd',
                '#6da1f1',
            ],
            formatter: function (x, data) {
                return data.formatted;
            },
            resize: true
        });

        Morris.Donut({
            element: 'articles-visits-daily',
            data: [
                {value: {{ $articlesVisitsCount['day'] }}, label: 'দিন', formatted: '{{ $articlesVisitsCount['day'] }} জন'},
                {value: {{ $articlesVisitsCount['10hours'] }}, label: '১০ ঘণ্টা', formatted: '{{ $articlesVisitsCount['10hours'] }} জন'},
                {value: {{ $articlesVisitsCount['hour'] }}, label: '১ ঘণ্টা', formatted: '{{ $articlesVisitsCount['hour'] }} জন'},
            ],
            colors: [
                '#ffc107',
                '#e36100',
                '#d50000',
            ],
            formatter: function (x, data) {
                return data.formatted;
            },
            resize: true
        });
    </script>
@endpush

