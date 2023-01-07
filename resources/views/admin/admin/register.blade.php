@extends('layouts/adminlogin')
@section( 'content')
<style>

.error{
    color: red
}

</style>
<div class="account-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-pattern" style="box-shadow: 5px 5px 5px 5px;">

                    <div class="card-body p-4">
                        
                        <div class="text-center w-75 m-auto">
                            <div class="auth-logo">
                                <a href="{{url('/')}}" class="logo logo-dark text-center">
                                    <span class="logo-lg">
                                        <img src="{{asset('assets')}}/frontend/img/logo.png" alt="" height="22">
                                    </span>
                                </a>
            
                                <a href="{{url('/')}}" class="logo logo-light text-center">
                                    <span class="logo-lg">
                                        <img src="{{asset('assets')}}/frontend/img/logo.png" alt="" height="22">
                                    </span>
                                </a>
                            </div>
                            <p class="text-muted mb-4 mt-3">Don't have an account? Create your account, it takes less than a minute</p>
                        </div>

                        <form action="{{url('admin/register')}}" method="POST" >
                            @csrf
                            <div class="form-group">
                                <label for="fullname">Full Name</label>
                                <input class="form-control" type="text" name="username" id="fullname" value="{{old('username')}}" placeholder="Enter your name" >
                                @error('username')
                                    <span class="error"> {{$message}}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="emailaddress">Email address</label>
                                <input class="form-control" type="email" name="email" id="emailaddress" value="{{old('email')}}"  placeholder="Enter your email">
                                @error('email')
                                   <span class="error"> {{$message}}</span>
                                @enderror
                            </div>
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
                            <div class="form-group">
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
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="checkbox" id="checkbox-signup">
                                    <label class="custom-control-label" for="checkbox-signup">I accept <a href="javascript: void(0);" class="text-dark">Terms and Conditions</a></label>
                                </div>
                                @error('checkbox')
                                  <span class="error">{{$message}}</span>
                                @enderror
                               
                            </div>
                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-success btn-block" style="background-color: #FE6161;border-color:#FE6161" type="submit"> Sign Up </button>
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