<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>TypeSkip - Generating Great Content</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('/assets/frontend/img/favicon.ico')}}">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <script src="{{asset('/assets/admin/js/jquery.min.js')}}"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <script type="text/javascript">
        var base_url = "{{ url('/').'/' }}";
    </script>
    <link href="{{ asset('css/app-old.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{mix('/css/app.css')}}">


    <script src="{{asset('/assets/admin/libs/tagsinput/taginput.js') }}"></script>
    @yield('head')
    @csrf
</head>
<body class="v-scroll {{ (!isset($user['role'])) ? "without-user" : "" }}" >
<div id="wrapper">
@hasSection('header')
    @yield('header')
@else


<x-admin_header  :user="$user"  />
@if(isset($user['role']) && $user['role']=='isAdmin')
    <x-supeadmin_sidebar  :user="$user"  />
@else
    <x-admin_sidebar  :user="$user"  :adscounter="$adscounter" :contentTools="$contentTools" />
@endif
@endif
{{--<div class="content-page @if(strpos(Route::currentRouteName(), 'generator.') === 0) content-page-generator @endif" >--}}
    <div class="content-page " >
        <div class="content" style="margin-bottom: 2%;">
            <div class="container-fluid">
                <div class="templatediv">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>

@hasSection('footer')
@yield('footer')
@else
@endif

<div class="modal c-modal" id="request_bad_content" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form role="dialog" id="report-form" action="#" aria-modal="true" aria-labelledby="modal-headline" class="p-6 overflow-hidden transition-all transform bg-white rounded-lg shadow-xl pointer-events-auto sm:max-w-xl sm:w-full sm:p-6">
                    <div class="w-full text-left">
                        <h3 id="modal-headline" class="mt-1 text-2xl font-bold leading-6 tracking-tight text-gray-800">Flag this content</h3>
                        <p class="text-sm font-medium text-gray-500">
                            Help improve our generated content by flagging low quality outputs.
                        </p>
                        <!---->
                        <div class="orange-txt-box">
                            <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 opacity-50"><path fill-rule="evenodd" d="M3 6a3 3 0 013-3h10a1 1 0 01.8 1.6L14.25 8l2.55 3.4A1 1 0 0116 13H6a1 1 0 00-1 1v3a1 1 0 11-2 0V6z" clip-rule="evenodd"></path></svg>
                            <p class="reported_content"></p>
                        </div>
                        <div class="textbox-margin">
                            @csrf
                            <input type="hidden" id="response_id" name="response_id">
                            <label for="message" class="block font-medium leading-5 text-gray-700"> Message <span class="recomandd-txt" >(recommended)</span> <!----></label>
                            <div class="rounded-md shadow-sm">
                                <textarea id="message" name="message" rows="4" required="required" autocomplete="off" placeholder="How can we improve this content?" class="d-block w-full form-input report-input"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="textbox-margin">
                            <button type="button" id="submit-button" class="btn btn-primary submit-button">Submit</button>
                        <button type="button" id="bad-model-close" class="btn btn-secondary cancel-button" data-dismiss="modal" data-target="#request_bad_content">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    //set sidebar default open
    $(function() {
        setTimeout(function(){  $('body').attr('data-sidebar-size','default'); }, 0.001);
    });
</script>
{{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>--}}
{{--<script type="text/javascript" src="{{mix('js/paywithstripe.js') }}"></script>--}}
<script src="{{mix('/js/app.js')}}"></script>
<script src="{{asset('/assets/admin/js/vendor.min.js')}}"></script>
<script src="{{asset('/assets/admin/libs/selectize/js/standalone/selectize.min.js')}}"></script>
{{--<script src="{{asset('assets/admin')}}/js/pages/dashboard-1.init.js"></script>--}}
<script src="{{asset('/assets/admin/js/app.min.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{ asset('assets/admin/js/report-copy.js') }}"></script>
<script src="//code.tidio.co/rftuxxddgmhuhvmvv96t2rwkksspyi45.js" async></script>
{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/js/swiper.min.js'></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="https://typeskip.ai/assets/frontend/js/custom-google-animation.js"></script>
<script src="/public/ts/js/wow.min.js"></script>
<script src="{{ asset('assets') }}/custom/js/user.js"></script>
<script src="/public{{mix('js/paywithstripe.js')}}"></script>
<script src="/public{{mix('ts/js/app.js')}}"></script>--}}
</body>
</html>

