@extends('layouts/dashboard_ts')
@section('content')
    <!-- Form row -->
    <div class="row breadcrumbs">
        <div class="col-12"><a href="/template">Dashboard</a> <span class="dot-seprator">●</span> <span>Profile</span></div>
    </div>
    <div class="row" style="margin-top: 3%;">
        <div class="col-md-12 col-lg-12">
            <div class="card ts-radius ts-form h-auto" style="margin-left:25%;margin-right:25%" >
                <div class="card-body w-100">
                        <form action="{{url('update/profile')}}" method="POST">
                        @csrf
                        <div class="auth-logo">
                            Personal Information
                        </div>
                        @if(session('personalinfo'))
                         <div class="alert alert-success">{{session('personalinfo')}}</div>
                        @endif
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="firstname" class="col-form-label">First Name*</label>
                                <input type="text" class="form-control" id="firstname" name="fname" value="{{(!empty($profile['fname']) ? $profile['fname'] : '')}}" placeholder="First Name*" >
                                @error('fname')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="lastname" class="col-form-label">Last Name*</label>
                                <input type="text" class="form-control" id="lastname" name="lname" value="{{(!empty($profile['lname']) ? $profile['lname'] : '')}}"  placeholder="Last Name*" >
                                @error('lname')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        {{--<div class="form-row">
                            <!--<div class="form-group col-md-6">-->
                            <!--    <label for="inputEmail4" class="col-form-label">User Name</label>-->
                            <!--    <input type="text" class="form-control" id="inputEmail4" name="username" value="{{(!empty($profile['username']) ? $profile['username'] : '')}}" placeholder="User Name">-->
                            <!--    @error('username')-->
                            <!--      <span class="error">{{$message}}</span>-->
                            <!--    @enderror-->
                            <!--</div>-->
                            <div class="form-group col-md-6">
                                <label for="inputEmail4" class="col-form-label">Email</label>
                                <input readonly type="email" class="form-control" id="inputEmail4" name="email" value="{{(!empty($profile['email']) ? $profile['email'] : '')}}" placeholder="Email">
                            </div>
                        </div>--}}
                        <input type="submit" class="btn btn-success btn-block ts-f-btn" value="Update Profile" />
                    </form>

                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->

     <!-- Form row -->
     <div class="row" style="margin-top: 3%;">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="card ts-radius ts-form h-auto" style="margin-left:25%;margin-right:25%">
                <div class="card-body w-100">
                    <form action="{{url('update/company_info')}}" method="POST">
                    <div class="auth-logo">
                            Company Information
                    </div>
                        @if(session('companyinfo'))
                         <div class="alert alert-success">{{session('companyinfo')}}</div>
                        @endif
                        <div class="form-row">
                            @csrf
                            <div class="form-group col-md-6">
                                <label for="company" class="col-form-label">Company*</label>
                                <input type="text" class="form-control" id="company" name="cmp_name" value="{{(!empty($profile['cmp_name']) ? $profile['cmp_name'] : '')}}" placeholder="Company*">
                                @error('cmp_name')
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="description" class="col-form-label">Description*</label>
                                <textarea class="form-control" id="description"  name="cmp_description" placeholder="Description" rows="5">{{(!empty($profile['cmp_description']) ? $profile['cmp_description'] : '')}}</textarea>
                                @error('cmp_description')
                                 <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <input type="submit" class="btn btn-success btn-block ts-f-btn" value="Update" />
                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card-->
        </div> <!-- end col -->
    </div>
    <!-- end row -->
@endsection
