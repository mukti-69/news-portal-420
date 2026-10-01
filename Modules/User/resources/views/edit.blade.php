@extends('panel::layouts.master', ['title' => "ব্যবহারকারী সম্পাদনা"])

@section('content')
    <x-common-breadcrumbs>
        <li><a href="{{ route(config('app.panel_prefix', 'panel') . '.users.index') }}">ব্যবহারকারীর তালিকা</a></li>
        <li><a>ব্যবহারকারী সম্পাদনা</a></li>
    </x-common-breadcrumbs>

    <div class="row pe-0">
        <div class="col-12 pe-0">
            <div class="portlet box shadow min-height-500">
                <div class="portlet-heading">
                    <div class="portlet-title">
                        <h3 class="title">
                            <i class="icon-user-follow"></i>
                            ব্যবহারকারী সম্পাদনা {{ $user->full_name }}
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
                    <form id="main-form" role="form" action="{{ route(config('app.panel_prefix', 'panel') . '.users.update', $user->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <x-common-error-messages/>

                        <fieldset class="row justify-content-center">
                            <div class="form-group col-lg-6">
                                <label for="full_name">পুরো নাম <small>(আবশ্যক)</small></label>
                                <input id="full_name" class="form-control" name="full_name" type="text" required value="{{ old('full_name', $user->full_name) }}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="username">ইউজারনেম <small>(আবশ্যক)</small></label>
                                <input id="username" class="form-control" name="username" type="text" required value="{{ old('username', $user->username) }}">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="email">ইমেইল <small>(আবশ্যক)</small> </label>
                                <input id="email" class="form-control" name="email" type="email" required value="{{ old('email', $user->email) }}">
                            </div>
                            <div class="form-group col-12 row justify-content-center">
                                <div class="col-md-6">
                                    <label for="bio">ব্যবহারকারী সম্পর্কে সংক্ষিপ্ত বিবরণ</label>
                                    <textarea class="form-control" name="bio" id="bio">{{ old('bio', $user->bio) }}</textarea>
                                </div>
                            </div>
                            <div class="accordion mb-3" id="accordionEditPassword">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button collapsed h4 p-2 mt-0 mb-1" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEditPassword"
                                                aria-expanded="true"
                                                aria-controls="collapseOne">
                                            পাসওয়ার্ড সম্পাদনা
                                        </button>
                                    </h2>
                                    <div id="collapseEditPassword" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body row">
                                            <div class="form-group col-lg-6">
                                                <label for="password">পাসওয়ার্ড <small>(আবশ্যক, কমপক্ষে ৮ অক্ষর)</small></label>
                                                <input id="password" class="form-control" name="password" minlength="8" type="password">
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label for="password_confirmation">পাসওয়ার্ড আবার লিখুন <small>(আবশ্যক, কমপক্ষে ৮ অক্ষর)</small></label>
                                                <input id="password_confirmation" class="form-control" name="password_confirmation" minlength="8" type="password">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-flex flex-column align-items-center">
                                <div class="form-group relative col-lg-6">
                                    <label>ব্যবহারকারীর ছবি <small>(আবশ্যক)</small></label>
                                    <div class="input-group round">
                                        <input type="text" class="form-control file-input" placeholder="আপলোড করতে ক্লিক করুন">
                                        <span class="input-group-btn">
                                        <button type="button" class="btn btn-success">
                                            <i class="icon-picture"></i>
                                            ছবি আপলোড</button>
                                    </span>
                                    </div>
                                    <input type="file" class="form-control" name="picture">
                                    <div class="help-block"></div>
                                </div>
                                <div class="form-group col-12 text-center">
                                    <img class="mb-2" src="{{ $user->image->url() }}" alt="{{ $user->image->alt_text }}" style="max-width: 300px; max-height:
                                    300px">
                                    <div>
                                        {{ $user->image->url() }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-12 row justify-content-center">
                                <div class="row justify-content-center col-6 row">
                                    <div class="text-center col-6">
                                        <input id="email_verification" class="form-control" name="email_verification" type="checkbox"
                                               @if(old('email_verification') || (!old('name') && $user->email_verified_at)) checked @endif>
                                        <label for="email_verification">ইমেইল যাচাই</label>
                                    </div>
                                    <div class="text-center col-6">
                                        <input id="status" class="form-control" name="status" type="checkbox"
                                               @if(old('status') || (!old('name') && $user->status)) checked @endif>
                                        <label for="status">অবস্থা</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-6 col-sm-offset-4 mx-auto">
                                    <button class="btn btn-success btn-block">
                                        <i class="icon-check"></i>
                                        ব্যবহারকারী সম্পাদনা
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
                } else {
                    error.insertAfter(element);
                }
            }
        });
        $("#main-form").validate({
            rules: {
                password_confirmation: {
                    equalTo: "#password"
                }
            },
            messages: {
                password_confirmation: {
                    equalTo: "পাসওয়ার্ড দুটি মেলেনি"
                }
            }
        });
    </script>
@endpush
