@extends('layouts/layout_ts')
@section('title','TypeSkip | Log In')
@section('head')
    <link rel="stylesheet" href="{{asset('assets')}}/frontend/style_new.css"/>
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
                        <div class="card border-grey border-grey-shadowcls border-lighten-3 mt-5 pl-4 pr-4 login-sm-h">
                            <div class="card-header2 w-full border-0 pt-4 pb-4">
                                <div class="card-title text-center p-3">
                                        <img src="{{asset('assets/frontend/img/logo-typeskip.svg')}}" alt="branding logo" class="login_logo">
                                </div>
                            </div>

                            <div class="card-content  w-full">
                                <div class="card-body pt-0  text-center">

                                    <a href="{{route('login.google')}}"
                                       class="btn btn-social mb-1 mr-1 btn-outline-google width100">
                                        <img src="{{asset('assets/frontend/img/google.svg')}}" style="width:18px" >
                                        <span class="px-1">Log in with Google</span>
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
                                    @if (session('error-email'))
                                        <div class="alert alert-danger">{{ session('error-email') }} </div>
                                    @endif

                                    @if (session('message'))
                                        <div
                                            class="alert alert-{{ session('message') == 'You Are Not Allowed To Perform This Action!' ? 'danger' : 'success' }}">
                                            {{ session('message') }}</div>
                                    @endif

                                    <div class="alert alert-danger" style="display:none" id="error"></div>
                                    <form class="form-horizontal" action="{{ url('/login') }}"
                                          enctype="multipart/form-data" id="login_form" method="POST">
                                        <fieldset class="form-group floating-label-form-group">
                                            <label class="form_label_cls" for="user-name">Email Address</label>
                                            <input class="form-control" type="email" id="emailaddress" name="email"
                                                   placeholder="Enter your email">
                                            <span class="error" id="email_error"></span>
                                        </fieldset>
                                        <fieldset class="form-group floating-label-form-group mb-1">
                                            <label class="form_label_cls" for="user-password">Password</label>
                                            <input type="password" id="password" class="form-control" name="password"
                                                   placeholder="Enter your password">
                                            <span class="error" id="password_error"></span>
                                        </fieldset>
                                        <div class="form-group row">
                                            <div class="col-md-6 col-12 text-center text-sm-left">
                                                {{--<a href="javascript:void(0)" onclick="openmodel('forgotpassword-form','login-form')" class="card-link forgot_link">Forgot
                                                    Password?</a>--}}
                                                <a href="{{ url('/password-recover') }}" class="card-link forgot_link">Forgot Password?</a>
                                            </div>
                                        </div>
                                        <button type="button"
                                                class="btn btn-outline-info btn-block inlineblock btn_one mt-3"
                                                id="submit-button"><i class="ft-unlock"></i> Login
                                        </button>
                                        <h5 class="please_wait">
                                            <img src="/ts/images/loading.gif" alt="">
                                        </h5>
                                        @csrf
                                    </form>
                                </div>
                                <p class="card-subtitle  text-muted text-center font-small-3 mb-4 font14">
                                    <span>Don't have an account? <a href="{{route('register')}}">Sign Up</a></span>
                                </p>

                                <p class="card-subtitle  text-muted text-center font-small-3 mb-4 font12">
                                    <span> <a href="{{route('privacy')}}">Privacy Policy </a>and <a href="{{route('privacy')}}">Terms of Service</a> apply.</span>
                                </p>
                            </div>
                        </div>
                        <div class="mt-4 mb-4 pb-4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  Forgot password Model start   -->
        <div class="modal fade" id="forgotpassword-form" tabindex="-1" role="dialog" aria-labelledby="forgotModel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="forgotModel">
                            <div class="auth-logo">
                                <a href="{{ url('/') }}" class="logo logo-dark text-center">
                            <span class="logo-lg">
                                <img src="{{ asset('/assets/frontend/img/logo-typeskip.svg') }}" alt="" height="22">
                            </span>
                                </a>
                            </div>
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="account-pages mt-1 mb-1">
                                <div class="row justify-content-center">
                                    <div class="bg-pattern w-full">
                                        <div class="card-body p-4">
                                            <div class="text-center w-full m-auto">
                                                <p class="text-muted mb-4 mt-3">
                                                    Enter your email address and we'll send you an email with instructions to reset your password.
                                                </p>
                                            </div>

                                            <form action="{{ url('/password-recover') }}" id="recoverForm">
                                                @csrf
                                                <div class="form-group mb-3">
                                                    <label for="emailaddress">Email address</label>
                                                    <input class="form-control" type="email" id="emailaddress" name="email"
                                                           placeholder="Enter your email">
                                                    <span id="emailerror" style="color: red;"></span>
                                                </div>

                                                <div class="form-group mb-0 text-center">
                                                    <button class="btn btn-primary btn-block" style="background-color: #03192e" id="submit" type="button">
                                                        Reset Password
                                                    </button>
                                                    <h5 class="plz_wait" style="display:none">
                                                        <img src="/ts/images/loading.gif" alt="">
                                                    </h5>
                                                </div>
                                            </form>
                                        </div> <!-- end card-body -->
                                    </div>
                                    <!-- end card -->
                                    <div class="col-12 text-center">
                                        <p class="text-white-50">Back to <a onclick="openmodel('login-form','forgotpassword-form')" class="text-white ml-1"><b>Log in</b></a></p>
                                    </div> <!-- end col -->
                                    <!-- end row -->
                                </div>
                                <!-- end row -->
                        </div>
                        <!-- end page -->
                    </div>
                </div>
            </div>
        </div>
        <!-- forgot password model end -->
    </div>
@endsection
@section('footer')
    <div></div>
@endsection



