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
    <link rel="shortcut icon" href="{{asset('assets')}}/frontend/img/favicon.ico">

    <!-- Plugins css -->
    <link href="{{asset('assets/admin')}}/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin')}}/libs/selectize/css/selectize.bootstrap3.css" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{asset('assets/admin')}}/css/bootstrap-modern.min.css" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
    <link href="{{asset('assets/admin')}}/css/app-modern.min.css" rel="stylesheet" type="text/css" id="app-default-stylesheet" />

    <link href="{{asset('assets/admin')}}/css/bootstrap-modern-dark.min.css" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
    <link href="{{asset('assets/admin')}}/css/app-modern-dark.min.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />

    <link rel="stylesheet" href="{{asset('assets/admin')}}/css/style.css">

    <!-- icons -->
    <link href="{{asset('assets/admin')}}/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
    <script src="{{asset('assets')}}/admin/js/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <script type="text/javascript">
        var base_url = "{{ url('/').'/' }}";
    </script>
    {{--<link rel="stylesheet" href="public{{mix('ts/css/app.css')}}">--}}
    <link rel="stylesheet" href="public{{mix('css/app.css')}}">
    <style>
        html {
            scroll-behavior: smooth;
        }
    </style>
    @yield('header')
</head>

<body class="v-scroll loading {{ (!isset($user['role'])) ? "without-user" : "" }}" >
     @csrf
    <!-- Begin page -->
    <div id="wrapper">
        <x-admin_header  :user="$user"  />
        @if(isset($user['role']) && $user['role']=='isAdmin')
            <x-supeadmin_sidebar  :user="$user"  />
        @else
            <x-admin_sidebar  :user="$user"  :adscounter="$adscounter" />
        @endif
        <div class="content-page  @if(strpos(Route::currentRouteName(), 'generator.') === 0) content-page-generator @endif" >
            <div class="content" style="margin-bottom: 2%;">
                <div class="container-fluid">
                    <div class="templatediv">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
     <script src="//code.tidio.co/rftuxxddgmhuhvmvv96t2rwkksspyi45.js" async></script>
     <script type="text/javascript" src="{{ url('public/js/paywithstripe.js') }}"></script>
 {{-- <x-admin_rightbar  /> --}}


<!-- Right bar overlay-->

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/3.4.1/select2.min.js" integrity="sha512-nyIg3+A3n8Ja7rAIC/wFROz+g0JD46CG5PCHdZ/j0dSZ8yBgsMUXM4cjeI2Lgd5htIPaZgRfFs4y+LBUG9BSKA==" crossorigin="anonymous"></script> --}}

<!-- Vendor js -->
<script src="{{asset('assets/admin')}}/js/vendor.min.js"></script>

<!-- Plugins js-->
{{-- <script src="{{asset('assets/admin')}}/libs/flatpickr/flatpickr.min.js"></script> --}}
{{-- <script src="{{asset('assets/admin')}}/libs/apexcharts/apexcharts.min.js"></script> --}}

<script src="{{asset('assets/admin')}}/libs/selectize/js/standalone/selectize.min.js"></script>

<!-- Dashboar 1 init js-->
<script src="{{asset('assets/admin')}}/js/pages/dashboard-1.init.js"></script>

<!-- App js-->
<script src="{{asset('assets/admin')}}/js/app.min.js"></script>
<script src="public/{{mix('ts/js/app.js')}}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script type="text/javascript">


    $('.contentdiv').on('click', '.pagination a', function(e) {
        e.preventDefault();
        var url = $(this).attr('data-index');
        getContents(url);
    });

    $('.favoritesdiv').on('click', '.pagination a', function(e) {
        e.preventDefault();
        var url = $(this).attr('data-index');
        getFavorites(url);
    });

    $('.trashdiv').on('click', '.pagination a', function(e) {
        e.preventDefault();
        var url = $(this).attr('data-index');
        getTrashed(url);
    });

    function getContents(url) {
        $.ajax({
            url : url
        }).done(function (data) {
            $(".contentdiv").html(data.page);
            changePaginationUrl(".contentdiv");
        }).fail(function () {
            swal({
                title: "Oops!",
                text: "Something went wrong.",
                buttons: true,
                dangerMode: true,
            });
        });
    }

    function getFavorites(url) {
        $.ajax({
            url : url
        }).done(function (data) {
            $(".favoritesdiv").html(data.page);
            changePaginationUrl(".favoritesdiv");
        }).fail(function () {
            swal({
                title: "Oops!",
                text: "Something went wrong.",
                buttons: true,
                dangerMode: true,
            });
        });
    }

    function getTrashed(url) {
        $.ajax({
            url : url
        }).done(function (data) {
            $(".trashdiv").html(data.page);
            changePaginationUrl(".trashdiv");
        }).fail(function () {
            swal({
                title: "Oops!",
                text: "Something went wrong.",
                buttons: true,
                dangerMode: true,
            });
        });
    }

    function getallContent() {
        $.ajax({
            url: "{{ url('get-all-contents') }}",
            method:"get",
            cache: false,
            success: function(result){
                if(result.status == true) {
                    $(".contentdiv").html(result.page);
                    changePaginationUrl('.contentdiv');
                    $(".content-header").empty();
                    $(".content-header").text('All Content');
                } else {
                    swal({
                        title: "Oops!",
                        text: "Something went wrong.",
                        buttons: true,
                        dangerMode: true,
                    });
                }
            },error:function(error) {
                swal({
                    title: "Oops!",
                    text: "Something went wrong.",
                    buttons: true,
                    dangerMode: true,
                });
            }
        });
    }

    function getFavorites() {
        $.ajax({
            url: "{{ url('get-all-favorites') }}",
            method:"get",
            cache: false,
            success: function(result){
                if(result.status == true) {
                    $(".favoritesdiv").html(result.page);
                    changePaginationUrl(".favoritesdiv");
                    $(".content-header").empty();
                    $(".content-header").text('Favorites');
                } else {
                    swal({
                        title: "Oops!",
                        text: "Something went wrong.",
                        buttons: true,
                        dangerMode: true,
                    });
                }
            },error:function(error) {
                swal({
                    title: "Oops!",
                    text: "Something went wrong.",
                    buttons: true,
                    dangerMode: true,
                });
            }
        });
    }

    function getTrashedData() {
        $.ajax({
            url: "{{ url('get-all-trashed') }}",
            method:"get",
            cache: false,
            success: function(result){
                if(result.status == true) {
                    $(".trashdiv").html(result.page);
                    changePaginationUrl('.trashdiv');
                    $(".content-header").empty();
                    $(".content-header").text('Trashed');
                } else {
                    swal({
                        title: "Oops!",
                        text: "Something went wrong.",
                        buttons: true,
                        dangerMode: true,
                    });
                }
            },error:function(error) {
                swal({
                    title: "Oops!",
                    text: "Something went wrong.",
                    buttons: true,
                    dangerMode: true,
                });
            }
        });
    }

    function changePaginationUrl(div) {
        $(div+" .pagination a").each(function() {
            var url =  $(this).attr('href');
            $(this).attr('data-index',url);
            $(this).attr('href', '');
        });
    }
</script>
</body>
</html>


