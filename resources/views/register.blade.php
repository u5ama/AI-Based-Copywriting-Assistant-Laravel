@extends('layouts/layout_ts')
@section('title','TypeSkip | Register')
@section('head')
    <link rel="stylesheet" href="{{asset('/assets/frontend/style_new.css')}}"/>
    <script src='https://www.google.com/recaptcha/api.js'></script>
@endsection

@section('header')
@endsection
@section('content')
    <div class="blank-page blank-page bg-white">
        <div class="umc-Login-root umc-Login-root--v4">
            <div class="umc-rall umc-rall--login umc-rall--wide box-root umc-flex umc-fd-column">
                <div class="umc-rlb umc-rlb--default umc-rlb--desktopUltraWide">
                    <div class="umc-rl-bg">
                        <div class="umc-graybg"></div>
                        <div class="umc-mc umc-rv-first"></div>
                        <div class="umc-mc umc-rv-second"></div>
                        <div class="umc-mc umc-rv-third"></div>
                        <div class="umc-mc umc-rv-fourth"></div>
                        <div class="umc-mc umc-rv-fifth"></div>
                        <div class="umc-fleft"></div>
                        <div class="umc-sleft"></div>
                        <div class="umc-fs-left"></div>
                        <div class="umc-frights"></div>
                    </div>
                </div>
                <div class="umc-rall-cw box-root w-100-sm">
                    <div class="box-shadow-2 p-0 mt-4 login-width">
                        <div class="card border-grey border-grey-shadowcls  border-lighten-3 mt-5 pl-4 pr-4 login-sm-h">
                            <div class="card-header2 border-0 pt-4 pb-4 w-full">
                                <div class="card-title text-center p-3">
                                    <img src="{{asset('assets/frontend/img/logo-typeskip.svg')}}" alt="branding logo"
                                         class="login_logo">
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="card-body pt-0  text-center">
                                    <a href="{{route('login.google')}}"
                                       class="btn btn-social mb-1 mr-1 btn-outline-google width100">
                                        <!--                                        <span class="fa fa-google-plus font-medium-4 colorf96f67"></span>-->
                                        <img src="{{asset('assets/frontend/img/google.svg')}}" style="width:18px" >
                                        <span class="px-1">Register with Google</span>
                                    </a>
                                </div>
                                <div class="card-body p-0 pl-3 pr-3  text-center">
                                    <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2">
                                        <span>OR </span>
                                    </p>
                                </div>
                                <div class="card-body pt-0">
                                    @if (session('changepassword'))
                                        <div class="alert alert-danger">{{ session('changepassword') }} </div>
                                    @endif
                                    @if (session('message'))
                                        <div
                                            class="alert alert-{{ session('message') == 'You Are Not Allowed To Perform This Action!' ? 'danger' : 'success' }}">
                                            {{ session('message') }}</div>
                                    @endif
                                    <div id="msg" style="display:none"
                                         class="alert alert-success"></div>
                                    <div class="alert alert-danger" style="display:none" id="error"></div>
                                    <form class="form-horizontal" action="{{ route('register') }}"
                                          enctype="multipart/form-data" id="register_form" method="POST">
                                        @csrf
                                        <input type="hidden" name="ref" value="{{ Request::get('ref') }}">
                                        <input type="hidden" name="pa" value="{{ Request::get('pa') }}">
                                        <fieldset class="form-group floating-label-form-group">
                                            <label class="form_label_cls" for="user-name">Full Name</label>
                                            <input class="form-control" type="text" name="username" id="fullname" value="{{ old('username') }}" placeholder="Enter your name">
                                            <span class="error" id="username_error"></span>
                                        </fieldset>
                                        <fieldset class="form-group floating-label-form-group">
                                            <label class="form_label_cls" for="user-name">Email Address</label>
                                            <input class="form-control" type="email" id="emailaddress" name="email"
                                                   placeholder="Enter your email" value="{{ old('email') }}">
                                            <span class="error" id="emailaddress_error"> </span>
                                        </fieldset>
                                        <fieldset class="form-group floating-label-form-group mb-1">
                                            <label class="form_label_cls" for="user-password">Password</label>
                                            <input type="password" id="password" class="form-control" name="password"
                                                   placeholder="Enter your password">
                                            <span class="error" id="register_password"></span>
                                        </fieldset>
                                        <fieldset class="form-group floating-label-form-group mb-1 mt-2">
                                            @if(config('services.recaptcha.key'))
                                                <div class="g-recaptcha"
                                                     data-sitekey="{{config('services.recaptcha.key')}}">
                                                </div>
                                            @endif
                                            <span class="error" id="g_recaptcha_response"></span>
                                        </fieldset>
                                        <div class="form-group row">
                                            <div class="col-md-12 col-12 text-center text-sm-left">
                                                <span class="font-size-12">
                                                By signing up, I accept the TypeSkip <a href="{{route('privacy')}}" target="_blank">Terms of Service</a> and acknowledge the
                                                <a href="{{route('privacy')}}" target="_blank">Privacy Policy</a>.
                                                </span>
                                            </div>
                                        </div>
                                        <button type="button"
                                                class="btn btn-outline-info btn-block inlineblock btn_one mt-3"
                                                id="register-button"><i class="ft-unlock"></i> Sign up
                                        </button>
                                        <h5 class="please_wait">
                                            <img src="public/ts/images/loading.gif" alt="">
                                        </h5>
                                    </form>
                                </div>
                                <p class="card-subtitle  text-muted text-center font-small-3 mb-4 font14">
                                    <span>Already have an account? <a href="{{route("login_v1")}}">Sign In</a></span>
                                </p>
                                <p class="card-subtitle  text-muted text-center font-small-3 mb-4 font12">
                                    <span><a target="_blank" href="{{route('privacy')}}">Privacy Policy </a>and <a  target="_blank" href="{{route('privacy')}}">Terms of Service</a> apply.</span>
                                </p>
                            </div>
                        </div>
                        <div class="mt-4 mb-4 pb-4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('footer')
    <div></div>
@endsection
