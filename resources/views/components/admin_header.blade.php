<!-- Topbar Start -->
<div class="navbar-custom" style="background-color: white;">
    <div class="container-fluid">
       <div class="header-logo">
          <a href="{{url('/template')}}" title='Dashboard'><img src="{{ asset('assets/admin/images/template/icon.png') }}" alt="Logo"></a>
       </div>
       @if(!isset($user['username']))
            <ul class="login-signup">
                <li class="button" style="margin-right:4px">
                    <a  href="" data-toggle="modal" data-target="#login-form">Login</a>
                </li>
                <li class="button">
                    <a href="{{url('register')}}" data-toggle="modal" data-target="#register-form">Register</a>
                </li>
            </ul>
        @else
            <ul class="list-unstyled topnav-menu float-right mb-0">
                @php
                    $words = explode(" ", $user['username']);
                    $acronym = "";
                    foreach ($words as $w) {
                        $acronym .= $w[0];
                    }
                @endphp
                <li class="dropdown notification-list topbar-dropdown">
                    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                       href="#">
                        <span class="pro-user-name ml-1" style="color: #fe5c5a; text-transform: uppercase;">
                            @if (isset($user['username']))
                                {{ Str::ucfirst($acronym) }}
                            @endif
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown">
                        <div class="profile-mail">
                            <a href="#">
                                @if (isset($user['username']))
                                    <div class="circle-box">{{ Str::ucfirst($acronym) }}</div>
                                    <div class="side-profile-name">
{{--                                        @if($user['profile']->fname)--}}
{{--                                            <h5> {{ Str::ucfirst($user['profile']->fname) }} {{ Str::ucfirst($user['profile']->lname) }}</h5>--}}
{{--                                        @else--}}
{{--                                            <h5> {{ Str::ucfirst($user['username']) }}</h5>--}}
{{--                                        @endif--}}
                                        <h5> {{ Str::ucfirst($user['username']) }}</h5>

                                        <p>{{ $user['email'] }}</p>
                                    </div>
                                @endif
                            </a>
                        </div>
                        <div class="dropdown-divider"></div>
                        <!-- item-->
                        <a href="{{url('/')}}" class="dropdown-item notify-item"><i class="fas fa-home"></i><span>Home</span></a>
                        @if(isset($user['role']) && $user['role']=='user')
                            <div class="dropdown-divider"></div>
                            <a href="{{url('profile')}}" class="dropdown-item notify-item">
                                <i class="fas fa-user"></i>
                                <span>Profile</span>
                            </a>

                            <div class="dropdown-divider"></div>
                            <a href="members" class="dropdown-item notify-item">
                                <i class="fas fa-user"></i>
                                <span>Add Members</span>
                            </a>
                            @if(auth()->user()->linked_user_role == 'admin')
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('pay-with-card') }}" class="dropdown-item notify-item">
                                    <i class="fas fa-money-bill"></i>
                                    <span>Billing Details</span>
                                </a>
                            @endif

                            <!-- item-->
                            <div class="dropdown-divider"></div>
                            <a href="{{url('update-password')}}" class="dropdown-item notify-item"><i class="fa fa-key"></i><span>Change Password</span></a>
                            <div class="dropdown-divider"></div>
                            <!-- item-->
                            <a href="{{url('logout')}}" class="dropdown-item notify-item"><i class="fa fa-sign-out"></i><span>Logout</span></a>
                        @endif
                    </div>
                </li>
            </ul>
        @endif

        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile waves-effect waves-light">
                        <img src="{{ asset('assets/admin/images/new/toggle.svg') }}" class="tgl-img">
                </button>
            </li>

            <li>
                <!-- Mobile menu toggle (Horizontal Layout)-->
                <a class="navbar-toggle nav-link" data-toggle="collapse" data-target="#topnav-menu-content">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
</div>
<!-- end Topbar -->
    <!-- Modal -->
<div class="modal fade" id="createProject" tabindex="-1" role="dialog" aria-labelledby="loginModel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content ts-radius ts-form">
            <div class="modal-header">
            <div class="auth-logo mb-0">Create Project</div>
                <button type="menu" data-toggle="modal" data-target="#createProject" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pb-0">
                <div class="account-pages mt-1 mb-1">
                    <div class="">
                        <div class="row justify-content-center">
                            <div class="bg-pattern" style="width: 100%;">
                                <div class="card-body p-0">
                                    <div class="form-group mb-0">
                                        <label for="emailaddress">Project Name</label>
                                        <input type="hidden" name="project_id" id="project_id">
                                        <input class="form-control" type="text" id="name" name="name"  placeholder="Enter your Project Name">
                                        <span class="error" id="email_error"></span>
                                    </div>
                                </div> <!-- end card-body -->
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end container -->
                </div>
                <!-- end page -->
            </div>
            <div class="textbox-margin text-right pt-0 cr-dle">
                <button class="btn btn-success btn-block ts-f-btn" id="create-project">Submit</button>
                <button type="button" class="btn btn-secondary cancel-button" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<style>
.header-logo a img:hover {
    transform: scale(2.0);
}
.header-logo a img {
    transition: 1s ease-in-out;
}
</style>
<script type="text/javascript">




var status_delete = false;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function rename_project(el){
        var project_id = $(el).attr("data-id");
        var project_name = $(el).attr("data-name");
        $("#project_id").val(project_id);
        $("#name").val(project_name);
        $(".modal-title").text('Update Project');
    }
    function change_project(project_id){
        var current_path = window.location.pathname;
        var project_id = project_id;
        $.ajax({
            url: "{{ url('update-user-project') }}/"+project_id,
            method:"get",
            cache: false,
            success: function(result){
                location.reload();
            },error:function(error) {
                location.reload();
            }
        });
    }
    function delete_project(el){
        var project_id = $(el).attr("data-id");
        $.ajax({
            url: "{{ url('delete-project') }}/"+project_id,
            method:"get",
            cache: false,
            success: function(result){
                if(result.status == true) {
                    location.reload();
                }
            }
        });
    }
    $("#create-project").click(function() {
        var name = $("#name").val();
        var id = $("#project_id").val();
        $('#create-project').prop('disabled', true);
        if (name!= '') {
            $.ajax({
                url: "{{ url('create-project') }}",
                method:"post",
                data: {name:name, id:id, _token: "{{ csrf_token()}}"},
                cache: false,
                success: function(result){
                    $('#create-project').prop('disabled', false);
                    if(result.status == true) {
                        location.reload();
                    }
                }
            });
        }
    });
    $( document ).ready(function() {
        $('.button-menu-mobile').click(function(){
        $('.navbar-custom').toggleClass('opend');
        $('.left-side-menu').toggleClass('opend');

    });
    setTimeout(() => {
        var opendState = $('body').hasClass('sidebar-enable');
            if(opendState){
                $('.proj-dropdown').addClass('sidemenu-opend');
            }else{
                $('.proj-dropdown').removeClass('sidemenu-opend');
            }
        }, 10);

    $(document, '.sidebar-menu', '.button-menu-mobile', 'body').click(function(){
        setTimeout(() => {
        var opendState = $('body').hasClass('sidebar-enable');
            if(opendState){
                $('.proj-dropdown').addClass('sidemenu-opend');
            }else{
                $('.proj-dropdown').removeClass('sidemenu-opend');
            }
        }, 10);
    });
    //On foucs out
    $('.sc-XhUPp').on('focusout', function(event){
        var response_id = $(this).attr('data-id');
        var response = $(this).text();
        console.log(response_id);
        // $.ajax({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     },
        //     url: "{{ url('update-response') }}/"+response_id,
        //     method:"post",
        //     data:{response:response},
        //     cache: false,
        //     success: function(result){
        //         if(result.status == true) {
        //             console.log('updated');
        //         }
        //     }
        // });
    });
});
function deleteAjaxCallBack(response_id){
    $('.response-content-'+response_id).remove();
}
</script>
