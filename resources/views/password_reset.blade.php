<!DOCTYPE html>
<html lang="en">
<head>
    <title>Password Reset</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('assets')}}/frontend/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('assets')}}/frontend/style_new.css"/>
    <script src="{{asset('assets')}}/frontend/js/jquery-1.12.4.min.js"></script>
    <script src="{{asset('assets')}}/frontend/js/bootstrap.min.js"></script>
    <style>
        .error {
            color: red
        }
    </style>
</head>
<body class=" blank-page blank-page">

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>

        <div class="content-body">
            <section class="flexbox-container">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="col-md-4 col-10 box-shadow-2 p-0 mt-4">
                        <div class="card border-grey border-grey-shadowcls  border-lighten-3 mt-5 pl-4 pr-4">
                            <div class="card-header2 border-0 pt-4 pb-4">
                                <div class="card-title text-center">
                                    <div class="p-3">
                                        <img src="{{asset('assets')}}/frontend/img/logo2.png" alt="branding logo"
                                             class="login_logo">
                                    </div>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="card-body pt-0  text-center">
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
                                    <form class="form-horizontal"
                                          enctype="multipart/form-data" id="reset_Form" method="POST">
                                        <input type="hidden" name="id" value="{{!empty($id)?$id:''}}">
                                        <fieldset class="form-group floating-label-form-group mb-1">
                                            <label class="form_label_cls" for="user-password">Password</label>
                                            <input type="password" id="password" class="form-control" name="password"
                                                   placeholder="Enter your password">
                                            <span class="error" id="password_error"></span>
                                        </fieldset>
                                        <button type="button"
                                                class="btn btn-outline-info btn-block inlineblock btn_one mt-3"
                                                id="submit"><i class="ft-unlock"></i> Update Password
                                        </button>
                                        <h5 class="plz_wait" style="display: none">Please Wait</h5>
                                        @csrf
                                    </form>
                                </div>
                                <p class="card-subtitle  text-muted text-center font-small-3 mb-4 font12">
                                    <span>This site is protected by reCAPTCHA and the Google <a href="/">Privacy Policy </a>and <a href="/">Terms of Service</a> apply.</span>
                                </p>
                            </div>
                        </div>
                        <div class="mt-4 mb-4">
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<script type="text/javascript">

    $(document).on('click','#submit',function(e){
        $url = "{{url('update_password')}}";
        $.ajax({
            url: $url,
            type: "POST",
            dataType: 'json',
            data: $('#reset_Form').serializeArray(),
            success: function (data) {
                if(data.response){
                    var redirect = "{{url('/login_v1')}}";
                    window.location.replace(redirect);
                }
                else{
                    $('#password_error').html(data.password_error);
                }
            }
        });
    });
</script>
</body>
</html>
