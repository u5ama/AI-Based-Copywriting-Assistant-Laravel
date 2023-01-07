@extends('layouts/dashboard_ts')
@section('content')
<style>
    .url{display: none;}
    .content-main-header {display: flex;}
    .content-header{margin-top: 15px;}
</style>
{{-- project dorpdown --}}
<x-projects  :projects="$projects"  :currentUser="$currentUser" />
<div class="no-side-menu">
    <div class="d-flex justify-content-between dh-title">
        <h4 class="content-main-header"><p class="content-header">All Content</p></h4>
    </div>
    <div class="row cards-body c-card contentdiv"></div>
    <div class="row cards-body c-card favoritesdiv"></div>
    <div class="row cards-body c-card trashdiv"></div>
</div>

<div class="modal c-modal" id="content-details" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form role="dialog" id="request-template-form" action="#" aria-modal="true" aria-labelledby="modal-headline" class="p-6 overflow-hidden transition-all transform bg-white rounded-lg shadow-xl pointer-events-auto sm:max-w-xl sm:w-full sm:p-6">
                    <div class="w-full text-left">
                        <div class="mdl-close">
                            <a href="#" data-dismiss="modal"> <img src="{{ asset('assets/admin/images/new/round-close.svg') }}"></a>
                        </div>
                        <div class="mdl-pos">
                            <div class="mdl-img">
                            </div>
                            <h3 class="mt-1"><span class="modal-title"></span><br><span class="mdl-small time"></span> </h3>
                        </div>
                        <div class="mdl-con">
                            <div class="text-sm font-medium text-gray-500 content-description new-content-class" id="modal-content-desc"></div>
                            <input type="text" id="url" style="opacity:0.00000000000001">
                            <input type="hidden" id="ads_response_id">
                        </div>
                        <div class="d-fl-ftr">
                            <div class="panel-footer">
                                <a href="javascript:;" class="" data-toggle="tooltip" data-placement="bottom" title="Copy" onclick="copytext('modal-content-desc')">
                                    <svg id="fi-rr-copy" xmlns="http://www.w3.org/2000/svg" width="26.414" height="26.414" viewBox="0 0 26.414 26.414">
                                        <path id="fi-rr-copy-2" data-name="fi-rr-copy" d="M16.509,22.012H5.5a5.51,5.51,0,0,1-5.5-5.5V5.5A5.51,5.51,0,0,1,5.5,0H16.509a5.51,5.51,0,0,1,5.5,5.5V16.509A5.51,5.51,0,0,1,16.509,22.012ZM5.5,2.2A3.3,3.3,0,0,0,2.2,5.5V16.509a3.3,3.3,0,0,0,3.3,3.3H16.509a3.3,3.3,0,0,0,3.3-3.3V5.5a3.3,3.3,0,0,0-3.3-3.3Zm20.911,18.71V6.6a1.1,1.1,0,0,0-2.2,0V20.911a3.3,3.3,0,0,1-3.3,3.3H6.6a1.1,1.1,0,0,0,0,2.2H20.911A5.51,5.51,0,0,0,26.414,20.911Z"/>
                                    </svg>
                                </a>
                                @if(false)
                                <a href="javascript:;"  class="share-response" data-toggle="tooltip" data-placement="bottom" title="Share" onClick="shareurl(this)">
                                    <svg id="fi-rr-share" xmlns="http://www.w3.org/2000/svg" width="26.445" height="26.416" viewBox="0 0 26.445 26.416">
                                        <path id="fi-rr-share-2" data-name="fi-rr-share" d="M21.28,16.142a5.129,5.129,0,0,0-4.225,2.228L9.892,15.135A5.034,5.034,0,0,0,9.9,11.3l7.154-3.251a5.129,5.129,0,1,0-.91-2.909A5.1,5.1,0,0,0,16.229,6L8.624,9.457a5.138,5.138,0,1,0-.017,7.514l7.625,3.443a5.213,5.213,0,0,0-.087.864,5.136,5.136,0,1,0,5.136-5.135Zm0-13.941a2.935,2.935,0,1,1-2.934,2.935A2.935,2.935,0,0,1,21.28,2.2ZM5.139,16.142a2.935,2.935,0,1,1,2.934-2.935,2.935,2.935,0,0,1-2.934,2.935ZM21.28,24.213a2.935,2.935,0,1,1,2.935-2.935,2.935,2.935,0,0,1-2.935,2.935Z" transform="translate(0.027 0.001)"/>
                                    </svg>
                                </a>
                                @endif
                                <a href="javascript:;" class="delete-response" data-toggle="tooltip" data-placement="bottom" title="Delete">
                                    <svg id="fi-rr-trash" xmlns="http://www.w3.org/2000/svg" width="22.012" height="26.414" viewBox="0 0 22.012 26.414">
                                        <path id="Path_150" data-name="Path 150" d="M22.911,4.4H19.5A5.513,5.513,0,0,0,14.107,0h-2.2A5.513,5.513,0,0,0,6.512,4.4H3.1a1.1,1.1,0,0,0,0,2.2H4.2V20.911a5.51,5.51,0,0,0,5.5,5.5h6.6a5.51,5.51,0,0,0,5.5-5.5V6.6h1.1a1.1,1.1,0,0,0,0-2.2ZM11.905,2.2h2.2A3.308,3.308,0,0,1,17.22,4.4H8.792a3.308,3.308,0,0,1,3.114-2.2Zm7.7,18.71a3.3,3.3,0,0,1-3.3,3.3H9.7a3.3,3.3,0,0,1-3.3-3.3V6.6H19.61Z" transform="translate(-2)"/>
                                        <path id="Path_151" data-name="Path 151" d="M10.1,18.8a1.1,1.1,0,0,0,1.1-1.1V11.1a1.1,1.1,0,0,0-2.2,0v6.6A1.1,1.1,0,0,0,10.1,18.8Z" transform="translate(-1.296 1.006)" />
                                        <path id="Path_152" data-name="Path 152" d="M14.1,18.8a1.1,1.1,0,0,0,1.1-1.1V11.1a1.1,1.1,0,0,0-2.2,0v6.6A1.1,1.1,0,0,0,14.1,18.8Z" transform="translate(-0.893 1.006)" />
                                    </svg>
                                </a>
                                <a href="javascript:;"  class="favourite active" data-toggle="tooltip" data-placement="bottom" title="Favourite" onClick="favourite(this)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26.41" height="25.568" viewBox="0 0 26.41 25.568">
                                        <g id="fi-rr-star" transform="translate(0 0)">
                                            <path id="fi-rr-star-2" data-name="fi-rr-star" d="M26.233,9.66a3.5,3.5,0,0,0-3.376-2.45H18.049l-1.46-4.552a3.552,3.552,0,0,0-6.764,0L8.364,7.21H3.555a3.552,3.552,0,0,0-2.091,6.419L5.378,16.49,3.89,21.1a3.553,3.553,0,0,0,5.485,3.956l3.831-2.82,3.832,2.816A3.552,3.552,0,0,0,22.523,21.1L21.035,16.49l3.918-2.862A3.5,3.5,0,0,0,26.233,9.66Zm-2.579,2.191-4.561,3.334a1.1,1.1,0,0,0-.4,1.228l1.733,5.36a1.35,1.35,0,0,1-2.086,1.5l-4.485-3.3a1.1,1.1,0,0,0-1.3,0l-4.485,3.3a1.35,1.35,0,0,1-2.091-1.5l1.739-5.36a1.1,1.1,0,0,0-.4-1.228L2.758,11.851a1.35,1.35,0,0,1,.8-2.44H9.168a1.1,1.1,0,0,0,1.048-.764L11.922,3.33a1.35,1.35,0,0,1,2.571,0L16.2,8.647a1.1,1.1,0,0,0,1.048.764H22.86a1.35,1.35,0,0,1,.8,2.44Z" transform="translate(-0.008 -0.19)" />
                                        </g>
                                    </svg>
                                </a>
                                <a href="javascript:;" class="show-input">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28.355" height="29.355" viewBox="0 0 28.355 29.355">
                                        <g id="Icon_feather-edit" data-name="Icon feather-edit" transform="translate(1.25 1.25)">
                                            <path id="Path_156" data-name="Path 156" d="M13.906,6H5.424A2.424,2.424,0,0,0,3,8.424V25.389a2.424,2.424,0,0,0,2.424,2.424H22.389a2.424,2.424,0,0,0,2.424-2.424V16.906" transform="translate(-3 -0.958)" stroke="#979797" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                            <path id="Path_157" data-name="Path 157" d="M27.058,3.709a3.042,3.042,0,0,1,4.3,4.3L17.736,21.635,12,23.069l1.434-5.736Z" transform="translate(-6.396 -2.818)" stroke="#979797" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"/>
                                        </g>
                                    </svg>
                                </a>
                                <a href="javascript:;" class="mdl-s-ipt input-url">Show input</a>
                            </div>
                            <button type="button" class="btn btn-secondary cancel-button mdl-btn " id="update-response" data-dismiss="modal">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

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
    function getallContent() {
        $.ajax({
            url: "<?php echo e(url('get-all-contents')); ?>",
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
            url: "<?php echo e(url('get-all-favorites')); ?>",
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
            url: "<?php echo e(url('get-all-trashed')); ?>",
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
    function showContent(ads_response_id) {
        $(".modal .content-description").html('');
        $(".modal-title").text('');
        $(".time").text('');
		$.ajax({
            url: "{{ url('get-content-details') }}"+"/"+ads_response_id,
            method:"get",
            cache: false,
            success: function(result){
                $(".mdl-img").html('');
                if(result.status == true) {
                    $(".modal-title").text(result.data.ads.title.charAt(0).toUpperCase() + result.data.ads.title.slice(1));
                  	$(".modal .content-description").html(result.data.content.description);
                  	$("#ads_response_id").val(result.data.content.id);
                  	$(".mdl-img").html(" <img src='"+result.data.ads.img_url+"'>");
                  	$(".url").attr("href", result.data.url);
                    $("#url").val(result.data.url);
                    $(".time").text(result.data.time);
                    $(".show-input").attr("href", result.data.input_url);
                    $(".input-url").attr("href", result.data.input_url);
                    if(result.data.favorites != null) {
                        $('.favourite').addClass("active");
                    } else {
                        $('.favourite').removeClass("active");
                    }
                } else {
                    showMessage({status:'error',title:'Oops!',message:'Something went wrong.'})
                }
            },error:function(error) {
                showMessage({status:'error',title:'Oops!',message:'Something went wrong.'})
            }
        });
	}

	$( document ).ready(function() {
        const current_url = window.location.href;
        if(current_url.includes('&favourite')) {
            setTimeout(() => {
                $("#favorites").trigger('click');
            }, 2000);
            setTimeout(() => {
                $("#favorites").addClass('active');
                getFavorites();
            }, 3000);
        } else if (current_url.includes('&trashed')) {
            setTimeout(() => {

                $("#trashed").trigger('click');
            }, 2000);
            setTimeout(() => {
                $("#trashed").addClass('active');
                getTrashedData();
            }, 3000);
        } else {
            getallContent();
        }

        $("#favorites").click(function() {
            getFavorites();
        });

        $("#trashed").click(function() {
            getTrashedData();
        });

        $('.content-description').on("click", function(){
            $(this).attr('contenteditable','true');
        });

        // Update Response
        $("#update-response").click(function(){
            var response_id = $('#ads_response_id').val();
            var response = $('#modal-content-desc').html();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('update-response') }}/"+response_id,
                method:"post",
                data:{response:response},
                cache: false,
                success: function(result){
                    if(result.status == true) {
                        if($("#stars").hasClass('active')) {
                            getallContent();
                        } else {
                            getFavorites();
                        }
                        $('#content-details').modal('hide');
                    }
                }
            });
        });
	});

    function shareurl(element) {
        var copyText = document.getElementById("url");
        copyText.type = 'text';
        copyText.select();
        document.execCommand("copy");
        copyText.type = 'hidden';
        showMessage({status:'success',title:'Copied!',message:'Link has been Copied.'})
    }

    function copytext(containerid) {
        var range = document.createRange();
        let tempInput = document.getElementById(containerid)
        tempInput.style = 'color: #000000';
        range.selectNode(document.getElementById(containerid));
        window.getSelection().removeAllRanges();
        window.getSelection().addRange(range);
        document.execCommand("copy");
        tempInput.style = 'color: #6c757d';
        window.getSelection().removeAllRanges();
        showMessage({status:'success',title:'Copied!',message:'Text has been Copied.'})
    }

</script>
@endsection
