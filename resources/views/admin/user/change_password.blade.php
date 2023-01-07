@extends('layouts/dashboard_ts')
@section('content')
<div class="row breadcrumbs">
        <div class="col-12"><a href="/template">Dashboard</a> <span class="dot-seprator">●</span> <span>Change Password</span></div>
    </div>
<div class="account-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <!--col-lg-6 col-xl-5-->
            <div class="col-md-8 ">
                <div class="card bg-pattern ts-radius ts-form">

                    <div class="card-body w-100 pt-2 px-3">

                        <div class="text-center m-auto">
                            <div class="auth-logo">
                                Change Password
                            <!--    <a href="{{url('/')}}" class="logo logo-dark text-center">-->
                            <!--        <span class="logo-lg">-->
                            <!--            <img src="{{asset('assets')}}/frontend/img/logo.png" alt="" height="22">-->
                            <!--        </span>-->
                            <!--    </a>-->

                            <!--    <a href="{{url('/')}}" class="logo logo-light text-center">-->
                            <!--        <span class="logo-lg">-->
                            <!--            <img src="{{asset('assets')}}/frontend/img/logo.png" alt="" height="22">-->
                            <!--        </span>-->
                            <!--    </a>-->
                            </div>

                        </div>

                        <form action="{{url('update-password')}}" method="POST" >
                            @csrf
                            <div class="form-group">
                                <label for="password">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password" value="{{old('password')}}" placeholder="Enter your password">
                                    <div class="input-group-append" data-password="false">
                                        <div class="input-group-text">
                                            <span class="fa fa-eye font-12"></span>
                                        </div>
                                    </div>
                                </div>
                                @error('password')
                                    <span class="error"> {{$message}}</span>
                               @enderror
                            </div>
                            <div class="form-group mb-1">
                                <label for="password">Confirm Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="confirm_password" value="{{old('confirm_password')}}" placeholder="Enter your password">
                                    <div class="input-group-append" data-password="false">
                                        <div class="input-group-text">
                                            <span class="fa fa-eye font-12"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             <!-- <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="checkbox" id="checkbox-signup">
                                    <label class="custom-control-label" for="checkbox-signup">I accept <a href="javascript: void(0);" class="link-text">Terms and Conditions</a></label>
                                </div>
                                @error('checkbox')
                                  <span class="error">{{$message}}</span>
                                @enderror

                            </div>  -->

                            <div class="form-group">
                                <input class="input-checkbox" id="checkbox-signup-test" type="checkbox">
                                <label class="label-checkbox" for="checkbox-signup-test">
                                <span>
                                    <svg width="12px" height="10px" viewBox="0 0 12 10">
                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                    </svg>
                                </span>

                                <span class="" for="checkbox-signup">I accept <a href="javascript: void(0);" class="link-text">Terms and Conditions</a></span>
                                </label>
                                @error('checkbox')
                                  <span class="error">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-success btn-block ts-f-btn" type="submit">Update Password</button>
                            </div>

                        </form>

                        {{-- <div class="text-center">
                            <h5 class="mt-3 text-muted">Sign up using</h5>
                            <ul class="social-list list-inline mt-3 mb-0">
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i class="mdi mdi-google"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="social-list-item border-info text-info"><i class="mdi mdi-twitter"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i class="mdi mdi-github"></i></a>
                                </li>
                            </ul>
                        </div> --}}

                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->

                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p class="text-white-50">Already have account?  <a href="{{url('login')}}" class="text-white ml-1"><b>Sign In</b></a></p>
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->
@endsection
