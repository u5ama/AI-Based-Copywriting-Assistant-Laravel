<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu" style="display:none;">
    @if(isset($user['role']))
        <div class="h-100" data-simplebar>
            <!-- User box -->
            <!--- Sidemenu -->
            <div id="sidebar-menu">
                <ul id="side-menu">
                    <li class="first-mdg">
                        <a href="javascript:void(0)">
                            <span class="text-center btn">
                                <img src="{{ asset('assets/admin/images/logo-white.png') }}" width="100">
                            </span>
                        </a>
                        <button class="button-menu-mobile waves-effect waves-light">
                            <img src="{{ asset('assets/admin/images/new/toggle.svg') }}" class="tgl-img">
                        </button>
                    </li>

                    <li>
                        <a href="{{url('template')}}" style="display: flex;">
                            <i class="sb-icon"><img src="{{ asset('assets/admin/images/new/menu/icons-dashboard.svg') }}"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="#sidebarBaseui" data-toggle="collapse" class="bg-gray">
                            <i class="sb-icon"><img src="{{ asset('assets/admin/images/new/menu/icons-generate.svg') }}"></i>
                            <span>
                                Generate
                                <svg class="MiniIcon SidebarCollapsibleHeader-toggle ArrowDownMiniIcon menu-open" fill="#6F7782" focusable="false" viewBox="0 0 24 24">
                                   <path d="M3.5,8.9c0-0.4,0.1-0.7,0.4-1C4.5,7.3,5.4,7.2,6,7.8l5.8,5.2l6.1-5.2C18.5,7.3,19.5,7.3,20,8c0.6,0.6,0.5,1.5-0.1,2.1 l-7.1,6.1c-0.6,0.5-1.4,0.5-2,0L4,10.1C3.6,9.8,3.5,9.4,3.5,8.9z"></path>
                                </svg>
                             </span>
                        </a>
                        <div class="collapse" id="sidebarBaseui">
                            <ul class="nav-second-level">
                                @foreach($contentTools as $contentTool)
{{--                                    <li><a href="{{ route('dynamic-templates',['uri' => $contentTool->uri]) }}"> {!!$contentTool->icon_path_inverse!!} <span>{{$contentTool->title}}</span> </a></li>--}}
                                @endforeach
                                <li><a href="{{ url('facebook-ad') }}"> <i class="fab fa-facebook" style="color: #3737AA;"></i> <span>Facebook Ad</span> </a></li>
                                <li><a href="{{ url('facebook-headline') }}"> <i class="fab fa-facebook" style="color: #3737AA;"></i> <span>Facebook video script</span> </a></li>
                                <li><a href="{{ url('google-ad') }}"><i class="fab fa-google" style="color: #FF8227;"></i><span>Google Ad</span> </a></li>
                                <li><a href="{{ url('product-description') }}"><i class="fab fa-product-hunt" style="color: #FF8227;"></i><span>Product Description</span> </a></li>
                                <li><a href="{{ url('copypaste') }}"><i class="fas fa-passport" style="color: #FE5C5A;"></i><span>Content Improver</span> </a></li>
                                <li><a href="{{ url('pas-ad') }}"><i class="fas fa-copy" style="color: #FE5C5A;"></i><span>PAS Framework</span> </a></li>
                                <li><a href="{{ url('aida-ad') }}"><i class="fas fa-ad" style="color: #FE5C5A;"></i><span>AIDA Principle</span> </a></li>
                                <li><a href="{{ url('sentence-ad') }}"><i class="fas fa-expand" style="color: #FE5C5A;"></i><span>Sentence Expander</span> </a></li>
                                <li><a href="{{ url('blog-ad') }}"><i class="fas fa-blog" style="color: #FE5C5A;"></i><span>Blog Outline</span> </a></li>
                                <li><a href="{{ url('great-ad') }}"><i class="far fa-newspaper" style="color: #FE5C5A;"></i><span>Great Headlines</span> </a></li>
                                <li><a href="{{ url('persuasive-ad') }}"><i class="fas fa-map" style="color: #FE5C5A;"></i><span>Persuasive Bullet Points</span> </a></li>
                                <li><a href="{{ url('marketing-ad') }}"><i class="fas fa-poll-h" style="color: #FE5C5A;"></i><span>Marketing Angles</span> </a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="{{url('docs')}}" style="display: flex;">
                            <i class="sb-icon"><img src="{{ asset('assets/admin/images/new/menu/icons-allc.svg') }}"></i>
                            <span>Docs</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- End Sidebar -->
            <div class="other-menu" data-simplebar>
                <a class="menu-item"  href="#contents" data-toggle="collapse"  aria-expanded="false">
                    <i class="sb-icon"><img src="{{ asset('assets/admin/images/new/menu/icons-content.svg') }}"></i>
                    <span>Content
                        <svg class="MiniIcon SidebarCollapsibleHeader-toggle ArrowDownMiniIcon menu-open" fill="#6F7782" focusable="false" viewBox="0 0 24 24">
                            <path d="M3.5,8.9c0-0.4,0.1-0.7,0.4-1C4.5,7.3,5.4,7.2,6,7.8l5.8,5.2l6.1-5.2C18.5,7.3,19.5,7.3,20,8c0.6,0.6,0.5,1.5-0.1,2.1 l-7.1,6.1c-0.6,0.5-1.4,0.5-2,0L4,10.1C3.6,9.8,3.5,9.4,3.5,8.9z"></path>
                        </svg>
                    </span>
                </a>
                <div class="collapse" id="contents">
                    <div class="btn-pref btn-group btn-group-justified btn-group-lg" role="group" aria-label="...">
                        <div class="btn-group" role="group">
                            <button type="button" id="stars_menu" onClick="get_all_content()" class="btn btn-default" data-toggle="tab">
                                <i class=""><img src="{{ asset('assets/admin/images/new/menu/icons-allc.svg') }}"></i>
                                <div class="hidden-xs">All content </div>
                            </button>
                        </div>
                        <div class="btn-group" role="group">
                            <button type="button" id="favorites_menu" onClick="get_favourite_content()" class="btn btn-default" data-toggle="tab">
                                <i class=""><img src="{{ asset('assets/admin/images/new/menu/icons-fav.svg') }}"></i>
                                <div class="hidden-xs">Favorites</div>
                            </button>
                        </div>
                        <div class="btn-group" role="group">
                            <button type="button" id="trashed_menu" onClick="get_trashed_content()" class="btn btn-default" data-toggle="tab">
                                <i class=""><img src="{{ asset('assets/admin/images/new/menu/icons-trash.svg') }}"></i>
                                <div class="hidden-xs">Trash</div>
                            </button>
                        </div>
                    </div>
                </div>
                <a class="menu-item" href="#projects" data-toggle="collapse"  aria-expanded="true">
                    <i class="sb-icon"><img src="{{ asset('assets/admin/images/new/menu/icons-team.svg') }}"></i>
                    <span> Teams
                        <svg class="MiniIcon SidebarCollapsibleHeader-toggle ArrowDownMiniIcon menu-open" fill="#6F7782" focusable="false" viewBox="0 0 24 24">
                            <path d="M3.5,8.9c0-0.4,0.1-0.7,0.4-1C4.5,7.3,5.4,7.2,6,7.8l5.8,5.2l6.1-5.2C18.5,7.3,19.5,7.3,20,8c0.6,0.6,0.5,1.5-0.1,2.1 l-7.1,6.1c-0.6,0.5-1.4,0.5-2,0L4,10.1C3.6,9.8,3.5,9.4,3.5,8.9z"></path>
                        </svg>
                    </span>
                </a>
                <div class="collapse show" id="projects">
                    <div class="box-menu" class="menu-item">
                        <div class="box-menu-item">
                            @php
                                $words = explode(" ", $user['username']);
                                $acronym = substr($words[0],0,1);
                                $acronym_team = array();
                                /*foreach ($words as $w) {
                                    $acronym .= $w[0];
                                }*/
                                $teams = \App\Models\User::where('id', '!=', $user['userID'])->where('parent_member', $user['parent_member'])->get()->take(2);
                                foreach ($teams as $key => $team) {
                                    $words1 = explode(" ", $team['username']);

                                    foreach ($words1 as $w) {
                                        $acronym_team[] = substr($w[0],0,1);
                                    }
                                }
                            @endphp
                            <ul>
                                <li class="active">
                                    <a href="#">
                                        @if (isset($user['username']))
                                            {{ Str::ucfirst($acronym) }}
                                        @endif
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        @if (isset($acronym_team[0]))
                                            {{ Str::ucfirst($acronym_team[0]) }}
                                        @endif
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        @if (isset($acronym_team[1]))
                                            {{ Str::ucfirst($acronym_team[1]) }}
                                        @endif
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('members') }}">
                                        <svg class="MiniIcon AbstractThemeableRectangularButton-leftIcon PlusMiniIcon" focusable="false" viewBox="0 0 24 24">
                                            <path d="M10,10V4c0-1.1,0.9-2,2-2s2,0.9,2,2v6h6c1.1,0,2,0.9,2,2s-0.9,2-2,2h-6v6c0,1.1-0.9,2-2,2s-2-0.9-2-2v-6H4c-1.1,0-2-0.9-2-2s0.9-2,2-2H10z"></path>
                                        </svg>
                                        Invite people
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="fixed bottom-0">
                <div class="bottem-item">
                    <a href="{{url('members')}}">
                        <img src="https://d3ki9tyy5l5ruj.cloudfront.net/obj/8a613bc1f8e95548a8ccf856b77261a748868a44/illustration_invite_teammates.svg" alt="">
                        &nbsp; Invite teammates
                    </a>
                </div>
                <div class="help-getting-started d-flex">
                    <div class="circle-box" style="color:#fff;">?</div>
                    <a target="_blank" href="https://www.notion.so/Help-Center-03eb15e1b61e4c558636622bf571eaf2">
                        <span>Help & Getting Started</span>
                    </a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <!-- Sidebar -left -->
    @endif
</div>
<!-- Left Sidebar End -->
<script src="https://unpkg.com/izitoast/dist/js/iziToast.min.js"></script>

<script type="text/javascript">

        iziToast.settings({
            options: {
                success: {
                    position: "topRight",
                    timeout: 3000,
                    class: 'success_notification'
                },
                error: {
                    position: "topRight",
                    timeout: 4000,
                    class: 'error_notification'
                },
                completed: {
                    position: 'center',
                    timeout: 1000,
                    class: 'complete_notification'
                },
                info: {
                    overlay: true,
                    zindex: 999,
                    position: 'center',
                    timeout: 3000,
                    class: 'info_notification',
                }
            }
        });
    function showMessage(data) {
        if (data.status  == "success") {
            iziToast.success({position: "topCenter", title: data.title, message: data.message});
        } else {
            iziToast.error({position: "topCenter", title: data.title, message: data.message});
        }
    }
    function pageload(page){
        $url = "{{url('/template')}}";
        token = $('input[name="_token"]').val();
        window.history.pushState("template", "Title", "{{url('template')}}");
        $.ajax({
            url: $url,
            type: "POST",
            dataType: 'json',
            data: {_token: token,template:page},
            success: function (data) {
                if(data.response){
                    $('.list').find( 'li.active' ).removeClass( 'active' );
                    $('#'+data.pagename+'').addClass( 'active' );
                    $('.templatediv').html(data.page);
                } else {
                    alert('Something Went Wrong');
                }
            }
        });
    };

    function get_favourite_content() {
        var current_url = window.location.href;
        if(!current_url.includes('content')) {
            window.location.href = '{{ env("APP_URL") }}content?'+Math.random().toString(36).substr(2, 500)+'&favourite';
        } else {
            $(".contentdiv").empty();
            $(".trashdiv").empty();
            getFavorites();
        }
    }

    function get_trashed_content() {
        var current_url = window.location.href;
        if(!current_url.includes('content')) {
            window.location.href = '{{ env("APP_URL") }}content?'+Math.random().toString(36).substr(2, 500)+'&trashed';
        } else {
            $(".contentdiv").empty();
            $(".favoritesdiv").empty();
            getTrashedData();
        }
    }

    function get_all_content() {
        var current_url = window.location.href;
        if(!current_url.includes('content')) {
            window.location.href = '{{ env("APP_URL") }}content?'+Math.random().toString(36).substr(2, 500)+'&all';
        } else {
            $(".favoritesdiv").empty();
            $(".trashdiv").empty();
            getallContent();
        }
    }

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
    //Copy response
    $(document).on('click', '.copy-response', function(){

        var $temp = $("<div style='white-space: pre-line;color:#000000;background-color:#fff;background:#fff'>");
        $(this).append($temp);
        if($(this).parent().parent().find('.content-description').html() != undefined) {
            $temp.attr("contenteditable", true)
                .html($(this).parent().parent().find('.content-description').html()).select()
                .on("focus", function() { document.execCommand('selectAll',false,null); })
                .focus();
        } else {
            $temp.attr("contenteditable", true)
                .html($(this).parent().parent().parent().find('.content-description').html()).select()
                .on("focus", function() { document.execCommand('selectAll',false,null); })
                .focus();
        }
        document.execCommand("copy");
        $temp.remove();

        showMessage({status:'success',title:'Copied!',message:'Text has been Copied.'})
    });
    // Delete content functionality
    $(document).on('click', '.delete-response', function(){
        $('[data-toggle="tooltip"]').tooltip('hide');
        event.preventDefault();
        var response_id = $(this).attr("data-id");
        if(response_id == undefined) {
            response_id = $("#ads_response_id").val();
        }

        $.ajax({
            url: "{{ url('delete-response') }}/"+response_id,
            method:"get",
            cache: false,
            success: function(result){
                if ($('.response-content-'+response_id)[0]){
                    // Do something if class exists
                    $('.response-content-'+response_id).remove();
                    showMessage({status:'success',title:'Deleted!',message:'Deleted Successfully'})
                } else {
                    // Do something if class does not exist\
                    showMessage({status:'success',title:'Deleted!',message:'Deleted Successfully.'})
                    location.reload();
                }

            }
        });
    });

    // Favourite content functionality
    function favourite(el) {
        var ads_response_id = $(el).attr("data-id");
        if(ads_response_id == undefined) {
            ads_response_id = $("#ads_response_id").val();
        }
		$.ajax({
            url: "{{ url('favourite') }}"+"/"+ads_response_id,
            method:"get",
            cache: false,
            success: function(result){
                if(result.status == true) {
                    if(result.action == "add") {
                        $(el).addClass("active");
                        showMessage({status:'success',title:'Mark Favourite',message:'Marked as favourite.'})
                    } else {
                        showMessage({status:'success',title:'Un-Favourite',message:'Marked as un-favourite.'})
                        $(el).removeClass("active");
                    }
                } else {
                    showMessage({status:'error',title:'Oops!',message:'Something went wrong.'})
                    /*swal({
                        title: "Oops!",
                        text: "Something went wrong.",
                        buttons: true,
                        dangerMode: true,
                    });*/
                }
            },error:function(error) {
                showMessage({status:'error',title:'Oops!',message:'Something went wrong.'})
                /*swal({
                    title: "Oops!",
                    text: "Something went wrong.",
                    buttons: true,
                    dangerMode: true,
                });*/
            }
        });
	}

    function restore(el) {
        var ads_response_id = $(el).attr("data-id");
        if(ads_response_id == undefined) {
            ads_response_id = $("#ads_response_id").val();
        }
		$.ajax({
            url: "{{ url('restore') }}"+"/"+ads_response_id,
            method:"get",
            cache: false,
            success: function(result){
                if(result.status == true) {
                    get_trashed_content();
                        showMessage({status:'success',title:'Restored',message:'Marked as favourite.'})
                } else {
                    showMessage({status:'error',title:'Oops!',message:'Something went wrong.'})
                    /*swal({
                        title: "Oops!",
                        text: "Something went wrong.",
                        buttons: true,
                        dangerMode: true,
                    });*/
                }
            },error:function(error) {
                showMessage({status:'error',title:'Oops!',message:'Something went wrong.'})
                /*swal({
                    title: "Oops!",
                    text: "Something went wrong.",
                    buttons: true,
                    dangerMode: true,
                });*/
            }
        });
	}

    function share(element) {
        var $temp2 = $("<input>");
        $("body").append($temp2);
        $temp2.val($(element).parent().parent().find('.url').val()).select();
        console.log($(element).parent().parent().find('.url').val())
        document.execCommand("copy");
        $temp2.remove();
        showMessage({status:'success',title:'Copied!',message:'Link has been Copied.'})
        /*Swal.fire(
            'Copied!',
            'Link has been Copied.',
            'success'
        );*/
    }

    $(document).ready(function(){
        $(".button-menu-mobile").click(function(){
            $url = "{{url('/save-user-sidebar-choice')}}";
            token = $('input[name="_token"]').val();

            $.ajax({
                    url: $url,
                    type: "POST",
                    dataType: 'json',
                    data: {_token: token},
                        success: function (data) {
                            $('.left-side-menu').show();
                            localStorage.setItem("sidebarStatus", data.data);
                        }
            });
        });

        var sidebarStatus = localStorage.getItem("sidebarStatus");
        if(sidebarStatus == null){
            $.ajax({
                    url: "{{url('/get-user-sidebar-choice')}}",
                    type: "get",
                    dataType: 'json',
                        success: function (data) {
                            localStorage.setItem("sidebarStatus", data.data);
                            if(data.data === false){
                                $('.navbar-custom').removeClass('opend');
                                $('.left-side-menu').removeClass('opend');
                                $('body').attr('data-sidebar-size', 'condensed');
                                $('.left-side-menu').hide();

                            } else {
                                $('.left-side-menu').show();
                                //alert('Something Went Wrong');
                            }
                        }
            });
        }else{
            if(sidebarStatus == 'false'){
                setTimeout(function(){
                $('.navbar-custom').removeClass('opend');
                $('.left-side-menu').removeClass('opend');
                $('body').attr('data-sidebar-size', 'condensed');
                 }, 3);

            }else{
                $('.left-side-menu').show();
            }
        }

    });

</script>
