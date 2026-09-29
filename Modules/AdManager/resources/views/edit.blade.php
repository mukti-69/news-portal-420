@extends('panel::layouts.master', ['title' => 'বিজ্ঞাপন সম্পাদনা'])

@section('content')
    <x-common-breadcrumbs>
        <li><a href="{{ route(config('app.panel_prefix', 'panel') . '.ads.index') }}">বিজ্ঞাপনের তালিকা</a></li>
        <li><a>বিজ্ঞাপন সম্পাদনা</a></li>
    </x-common-breadcrumbs>

    <div class="row pe-0">
        <div class="col-12 pe-0">
            <div class="portlet box shadow min-height-500">
                <div class="portlet-heading">
                    <div class="portlet-title">
                        <h3 class="title">
                            <i class="fas fa-bullhorn"></i>
                            বিজ্ঞাপন সম্পাদনা
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
                    <form id="main-form" role="form" action="{{ route(config('app.panel_prefix', 'panel') . '.ads.update', $ad->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <x-common-error-messages/>

                        <fieldset class="row justify-content-center">
                            <div class="form-group col-lg-6">
                                <label for="title">শিরোনাম <small>(আবশ্যক)</small></label>
                                <input id="title" class="form-control" name="title" type="text" required value="{{ old('title', $ad->title) }}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="link">লিংক <small>(আবশ্যক)</small></label>
                                <input id="link" class="form-control" name="link" type="text" required value="{{ old('link', $ad->link) }}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="published_at">তারিখ প্রকাশ <small>(আবশ্যক)</small></label>
                                <input id="published_at" name="published_at" type="datetime-local"
                                       class="form-control" required dir="ltr"
                                       value="{{ old('published_at', \Carbon\Carbon::parse($ad->published_at)->format('Y-m-d\TH:i')) }}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="expired_at">মেয়াদ শেষের তারিখ</label>
                                <div class="input-group">
                                    <button id="clear-expiry-date" class="btn btn-danger" type="button" title="মেয়াদ তারিখ মুছুন">
                                        <i class="icon-close"></i>
                                    </button>
                                    <input id="expired_at" name="expired_at" type="datetime-local"
                                           class="form-control" dir="ltr"
                                           value="{{ old('expired_at', $ad->expired_at ? \Carbon\Carbon::parse($ad->expired_at)->format('Y-m-d\TH:i') : '') }}">
                                </div>
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="section">অবস্থান</label>
                                <select id="section" class="form-control select2" name="section">
                                    <option value="">অবস্থান নির্বাচন করুন</option>
                                    @foreach($sections as $key => $sectionName)
                                        <option value="{{ $key }}" @if((string) old('section', $ad->section) === (string) $key) selected @endif>{{ __($sectionName) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 d-flex flex-column align-items-center">
                                <div class="form-group relative col-lg-6">
                                    <label>ছবি </label>
                                    <div class="input-group round">
                                        <input type="text" class="form-control file-input" placeholder="আপলোড করতে ক্লিক করুন">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-success">
                                            <i class="icon-picture"></i>
                                            ছবি আপলোড</button>
                                    </span>
                                    </div>
                                    <input type="file" class="form-control" name="image">
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group col-12 text-center">
                                    <img class="mb-2" src="{{ asset('storage/' . $ad->image->file_path) }}" alt="{{ $ad->image->alt_text }}" style="max-width: 300px;
                                    max-height:
                                    300px">
                                    <div>
                                        {{ asset('storage/' . $ad->image->file_path) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 form-group text-center">
                                <input id="status" class="form-control" name="status" type="checkbox" @if( old('status') || (!old('title') && $ad->status) ) checked @endif>
                                <label for="status">অবস্থা</label>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6 col-sm-offset-4 mx-auto">
                                    <button class="btn btn-success btn-block">
                                        <i class="icon-check"></i>
                                        বিজ্ঞাপন সম্পাদনা
                                    </button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div><!-- /.portlet-body -->
            </div><!-- /.portlet -->
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('admin/assets/plugins/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/select2/dist/js/i18n/bn.js') }}"></script>
    <script src="{{ asset('admin/assets/js/pages/select2.js') }}"></script>

    <script>
        document.getElementById('clear-expiry-date').addEventListener('click', function () {
            document.getElementById('expired_at').value = '';
        });

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
                } else {
                    error.insertAfter(element);
                }
            }
        });
        $("#main-form").validate();
    </script>
@endpush

@push('styles')
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/select2/dist/css/select2.min.css') }}">
@endpush
