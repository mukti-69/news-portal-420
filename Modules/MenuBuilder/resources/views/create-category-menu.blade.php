@extends('panel::layouts.master', ['title' => 'নতুন মেনু তৈরি করুন'])

@section('content')
    <x-common-breadcrumbs>
        <li><a href="{{ route(config('app.panel_prefix', 'panel') . '.menus.index') }}">মেনুর তালিকা</a></li>
        <li><a>নতুন মেনু তৈরি করুন</a></li>
    </x-common-breadcrumbs>

    <div class="row pe-0">
        <div class="col-12 pe-0">
            <div class="portlet box shadow min-height-500">
                <div class="portlet-heading">
                    <div class="portlet-title">
                        <h3 class="title">
                            <i class="icon-menu"></i>
                            নতুন মেনু তৈরি করুন
                        </h3>
                    </div><!-- /.portlet-title -->
                    <div class="buttons-box">
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
                    <form id="main-form" role="form"
                          action="{{ route(config('app.panel_prefix', 'panel') . '.menus.category-menu.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <x-common-error-messages/>

                        <fieldset class="row justify-content-center">
                            <div class="form-group col-lg-6">
                                <label for="type">ধরন <small>(আবশ্যক)</small></label>
                                <select id="type" class="form-control" name="type" required>
                                    @foreach($types as $type)
                                        <option value="{{ $type }}" @if(old('type') === $type) selected @endif>{{ __('menu-builder::types.' . $type) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="category_id">বিভাগ <small>(আবশ্যক)</small></label>
                                <select id="category_id" class="form-control select2" name="category_id" required>
                                    <option value="">বিভাগ নির্বাচন করুন</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" @if((int) old('category_id') === $category->id) selected @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="position">ক্রম <small>(আবশ্যক)</small></label>
                                <input id="position" class="form-control" name="position" type="number" required value="{{ old('position') }}">
                                <p class="small">{{ 'সর্বোচ্চ নিবন্ধিত ক্রম: ' . $latestPosition}}</p>
                            </div>
                            <div class="form-group text-center col-lg-12">
                                <input id="status" class="form-control" name="status" type="checkbox" @if(old('status')) checked @endif>
                                <label for="status">অবস্থা</label>
                            </div>
                            <div class="form-group col-lg-6">
                                <button class="btn btn-success btn-block">
                                    <i class="icon-check"></i>
                                    নতুন মেনু তৈরি করুন
                                </button>
                            </div>
                        </fieldset>
                    </form>
                </div><!-- /.portlet-body -->
            </div><!-- /.portlet -->
        </div>
    </div>
@endsection

@push('scripts')
    <!-- BEGIN PAGE JAVASCRIPT -->
    <script src="{{ asset('admin/assets/plugins/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/select2/dist/js/i18n/bn.js') }}"></script>
    <script src="{{ asset('admin/assets/js/pages/select2.js') }}"></script>
    <!-- END PAGE JAVASCRIPT -->

    <script>
        $.validator.setDefaults({
            highlight: function (element) {
                $(element).closest('.form-group').addClass('has-error').removeClass("has-success");
            },
            unhighlight: function (element) {
                $(element).closest('.form-group').removeClass('has-error').addClass("has-success");
            },
            errorElement: 'span',
            errorClass: 'help-block',
            errorPlacement: function (error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else if (element.hasClass('select2-hidden-accessible')) {
                    error.insertAfter(element.next('span.select2'));
                } else {
                    error.insertAfter(element);
                }
            }
        });
        $("#main-form").validate();

        $(".select2").select2({
            language: "bn"
        });
    </script>
@endpush

@push('styles')
    <!-- BEGIN PAGE CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/select2/dist/css/select2.min.css') }}">
    <!-- END PAGE CSS -->
@endpush
