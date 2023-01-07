@extends('layouts/dashboard_ts')
@section('content')
    <!-- Start Page Content here -->
    <!-- ============================================================== -->
    <link href="{{ asset('assets/admin') }}/libs/tagsinput/taginput.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />
    <script src="{{ asset('assets/admin') }}/libs/tagsinput/taginput.js"></script>
    @if(isset($user['userID']))
        {{-- project dorpdown --}}
        <x-projects  :projects="$projects"  :currentUser="$currentUser" />
        {{-- End Project --}}
    @endif
    <!-- start page title -->
    <style>
        @media screen and (min-width: 766px) {
            /*.content-page{margin-left:0}*/
            .left-side-menu{position:absolute}
            body[data-sidebar-size=condensed] .content-page{margin-left:0!important;padding:0 15px 65px}
            /*body[data-sidebar-size=default] .content-page{padding:0 15px 65px;margin-left:0!important}*/
            /*.form-area{position:fixed}*/
            .form-area .form-left{margin-bottom:-999px;padding-bottom:999px;padding-top:20px;height:100%}
            /*.form-area .form-right{position:fixed;right:0;overflow:auto;padding:20px;height:87%}*/
            .dh-title.df{margin:20px 0 0;padding-bottom: 10px;}
            textarea.form-control{height: 100px;}
            .action-area{margin-top: 30px;padding: 15px 15px 20px 0;}}
        @media screen and (max-width: 765px) {
            .fr-area{padding:10px 15px 10px 10px}
            .action-area{position:fixed;bottom:0;width:100%;background:#f5f7fb;display:flex;justify-content:center;padding-right:0;align-items:center}}
        
        .delete-icon {
            margin-left: 0 !important;
        }
        .kiNLFp {
            padding: 20px;
            background-color: white;
            border: 1px solid rgb(132, 141, 211);
            width: 100%;
            border-radius: 10px;
            margin-bottom: 15px;
        }
        .fNjRST {
            display: flex;
            -moz-box-pack: center;
            justify-content: center;
            -moz-box-align: center;
            align-items: center;
            width: calc(100% + 40px);
            margin-top: 10px;
            margin-left: -20px;
            height: 260px;
            border-top: 1px solid rgb(220, 220, 220);
            border-bottom: 1px solid rgb(220, 220, 220);
        }
        .jOcitS {
            margin-bottom: 6px;
            left: 3rem;
            bottom: 2.25rem;
            font-family: Helvetica, Open Sans;
            line-height: 1.195rem;
        }
        .kxdBff {
            position: relative;
            width: calc(100% + 40px);
            margin-left: -20px;
            padding-left: 18px;
            padding-top: 8px;
            height: 78px;
            border-bottom: 1px solid rgb(220, 220, 220);
            background-color: rgb(240, 242, 245);
            font-family: Helvetica, Open Sans;
            font-size: 1rem;
            color: rgb(101, 103, 107);
        }
        .absolute-btn {
            position: absolute;
            right: 21%;
        }
    </style>
    <div class="d-flex justify-content-between dh-title df">
        <div class="fm-title">
            <div class="fm-title-d bg-white"><img src="{{ asset('assets/admin/images/newTemplate/marketing-angles.png') }}"></div>
            <h3>Market Angles<br><span class="fm-title-desc">Write different marketing angles using Product Description.</span></h3>
        </div>
    </div>
    <!-- end page title -->
    <div class="row cards-body c-card">
        <div class="form-area">
            <div class="form-left">
                <form action="google-ad" id="add_form" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <span class="btm-char-count"><span class="brand-remaining-count">0</span><span>/80</span></span>
                        <label for="ctext">Name:</label>
                        <input type="hidden" name="category" value="{{ encrypt($category) }}">
                        <input type="text"
                               id="brand-remaining"
                               maxlength="80"
                               name="Company"
                               placeholder="e.g. TypeSkip"
                               class="ctext form-control brand-remaining"
                               value="{{ old('Company') ? old('Company') : $contents[0]['ads']->company_name ?? ''}}">
                        <span class="error" id="Company_error"></span>
                    </div>

                    <div class="form-group">
                        <span class="btm-char-count"><span class="description-remaining-count">0</span><span>/400</span></span>
                        <label for="company">Product description:</label>
                        <textarea type="text"
                                  name="CompanyDescription"
                                  maxlength="400"
                                  placeholder="Write high quality content, product descriptions, and more using just a few keywords or one-liners"
                                  id="company" rows="3"
                                  class="form-control description-remaining">{{ old('CompanyDescription') ? old('CompanyDescription') : ($contents[0]['ads']->description ?? '') }}</textarea>
                        <span class="error" id="CompanyDescription_error"></span>
                    </div>

                    <div class="form-group MuiCollapse-container MuiCollapse-hidden" style="min-height: 0px;">
                        <div class="MuiCollapse-wrapper">
                            <div class="MuiCollapse-wrapperInner">
                                <div class="MuiPaper-root MuiAlert-root MuiAlert-standardError MuiPaper-elevation0" role="alert">
                                    <div class="MuiAlert-message">Please fill in all required elements and press 'Generate'. </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="action-area">
                        <div class="outputs">
                            <input id="nValue" value="5" type="number" name="number_of_outputs" min="1" max="15" aria-describedby="ideas" autocomplete="off" class="pr-20 form-input">
                            <span>Outputs</span>
                        </div>
                        <h5 class="plz_wait" style="display: inline-block;width: 164px;position: relative;height: auto;">
                            <img style="width: 255px;height: auto;position: absolute;top: -120px;left: -55px;" src="{{asset('assets/admin/loader/please_wait_new.gif')}}">
                        </h5>
                        @if(auth()->check() && ($adscounter >0 || auth()->user()->subscribed('Typeskip.ai')))
                            <button type="button" id="submit_btn" class="btn btn-secondary cancel-button mdl-btn" data-dismiss="modal">Generate</button>
                        @else
                            <h5 class="text-danger">Please purchase offer to generate Ads</h5>
                        @endif
                        <h5 class="text-danger error_msg"></h5>
                    </div>
                </form>
            </div> <!-- end card-box -->
            <div class="form-right">
                <div class="sc-bXDlPE sc-ctaXAZ jFuWAH edemjN">
                    @if(count($contents)>0)
                        @foreach($contents as $key => $value)
                            <div style="display: none" class="note-item response-content-{{ $value->id }}">
                                <p class="sc-XhUPp response-content-text-{{ $value->id }}" contenteditable="true">{{ $value->description }}
                                </p>
                                <div class="note-action">
                                    <div class="panel-footer">
                                        <a href="#" class="copy-icon-add pr-2" data-toggle="tooltip" data-placement="bottom" title="Copy" data-id="{{ $value->id }}">
                                            <svg id="fi-rr-copy" xmlns="http://www.w3.org/2000/svg" width="26.414" height="26.414" viewBox="0 0 26.414 26.414">
                                                <path id="fi-rr-copy-2" data-name="fi-rr-copy" d="M16.509,22.012H5.5a5.51,5.51,0,0,1-5.5-5.5V5.5A5.51,5.51,0,0,1,5.5,0H16.509a5.51,5.51,0,0,1,5.5,5.5V16.509A5.51,5.51,0,0,1,16.509,22.012ZM5.5,2.2A3.3,3.3,0,0,0,2.2,5.5V16.509a3.3,3.3,0,0,0,3.3,3.3H16.509a3.3,3.3,0,0,0,3.3-3.3V5.5a3.3,3.3,0,0,0-3.3-3.3Zm20.911,18.71V6.6a1.1,1.1,0,0,0-2.2,0V20.911a3.3,3.3,0,0,1-3.3,3.3H6.6a1.1,1.1,0,0,0,0,2.2H20.911A5.51,5.51,0,0,0,26.414,20.911Z"></path>
                                            </svg>
                                        </a>
                                        <a href="#" class="delete-icon delete-response-add pr-2" data-toggle="tooltip" data-placement="bottom" title="Delete" data-id="{{ $value->id }}">
                                            <svg id="fi-rr-trash" xmlns="http://www.w3.org/2000/svg" width="22.012" height="26.414" viewBox="0 0 22.012 26.414">
                                                <path id="Path_150" data-name="Path 150" d="M22.911,4.4H19.5A5.513,5.513,0,0,0,14.107,0h-2.2A5.513,5.513,0,0,0,6.512,4.4H3.1a1.1,1.1,0,0,0,0,2.2H4.2V20.911a5.51,5.51,0,0,0,5.5,5.5h6.6a5.51,5.51,0,0,0,5.5-5.5V6.6h1.1a1.1,1.1,0,0,0,0-2.2ZM11.905,2.2h2.2A3.308,3.308,0,0,1,17.22,4.4H8.792a3.308,3.308,0,0,1,3.114-2.2Zm7.7,18.71a3.3,3.3,0,0,1-3.3,3.3H9.7a3.3,3.3,0,0,1-3.3-3.3V6.6H19.61Z" transform="translate(-2)"></path>
                                                <path id="Path_151" data-name="Path 151" d="M10.1,18.8a1.1,1.1,0,0,0,1.1-1.1V11.1a1.1,1.1,0,0,0-2.2,0v6.6A1.1,1.1,0,0,0,10.1,18.8Z" transform="translate(-1.296 1.006)"></path>
                                                <path id="Path_152" data-name="Path 152" d="M14.1,18.8a1.1,1.1,0,0,0,1.1-1.1V11.1a1.1,1.1,0,0,0-2.2,0v6.6A1.1,1.1,0,0,0,14.1,18.8Z" transform="translate(-0.893 1.006)"></path>
                                            </svg>
                                        </a>
                                        <a href="#"
                                           class="pr-2 @if( $value->is_favorite) active @endif"
                                           onclick="favourite(this)"
                                           data-id="{{ $value->id }}"
                                           data-toggle="tooltip"
                                           data-placement="bottom"
                                           title="Favourite">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="26.41" height="25.568" viewBox="0 0 26.41 25.568">
                                                <g id="fi-rr-star" transform="translate(0 0)">
                                                    <path id="fi-rr-star-2" data-name="fi-rr-star" d="M26.233,9.66a3.5,3.5,0,0,0-3.376-2.45H18.049l-1.46-4.552a3.552,3.552,0,0,0-6.764,0L8.364,7.21H3.555a3.552,3.552,0,0,0-2.091,6.419L5.378,16.49,3.89,21.1a3.553,3.553,0,0,0,5.485,3.956l3.831-2.82,3.832,2.816A3.552,3.552,0,0,0,22.523,21.1L21.035,16.49l3.918-2.862A3.5,3.5,0,0,0,26.233,9.66Zm-2.579,2.191-4.561,3.334a1.1,1.1,0,0,0-.4,1.228l1.733,5.36a1.35,1.35,0,0,1-2.086,1.5l-4.485-3.3a1.1,1.1,0,0,0-1.3,0l-4.485,3.3a1.35,1.35,0,0,1-2.091-1.5l1.739-5.36a1.1,1.1,0,0,0-.4-1.228L2.758,11.851a1.35,1.35,0,0,1,.8-2.44H9.168a1.1,1.1,0,0,0,1.048-.764L11.922,3.33a1.35,1.35,0,0,1,2.571,0L16.2,8.647a1.1,1.1,0,0,0,1.048.764H22.86a1.35,1.35,0,0,1,.8,2.44Z" transform="translate(-0.008 -0.19)"></path>
                                                </g>
                                            </svg>
                                        </a>
                                        <span class="top-icons mr-2 report-icon pr-2" data-id="{{ $value->id }}"><i class="fas fa-flag"></i></span>
                                        <label class="fm-lbl">{{$value->date_for_humman}}</label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="card-box content-box remove-after-appends">
                            <div class="sc-dFJsGO liTBVH">
                                <div style="display: flex; flex-direction: row; align-items: center; justify-content: space-between;">
                                </div>
                                <div class="box-empty">
                                    <img src="{{asset('assets')}}/frontend/landing-images/demo.png" alt="" class="plane">
                                    <p>Answer the prompts and click generate to watch the AI magic happen ✨.</p>
                                </div>
                            </div>
                        </div> <!-- end card-box -->
                    @endif
                </div>
                @if(count($contents)>5)
                    <div style="height: 120px">
                        <div class="d-flex justify-content-center absolute-btn">
                            <button class=" btn btn-primary m-1" onclick="showCards()">
                                <i class="fas fa-angle-double-right"></i> More
                            </button>
                            <button class=" btn btn-secondary m-1" onclick="showCards(true)">
                                <i class="far fa-caret-square-down"></i> All
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->
    <script>
        let cart = document.getElementsByClassName('note-item');
        let countForShowCart = 0;
        function showCards(all = false){
            countForShowCart  = countForShowCart  + 5;
            for(let i = 0; i <cart.length; i++){
                if(all || i < countForShowCart ){
                    cart[i].style.display = 'block';
                }
            }
            return true;
        }
        showCards();
        $('.plz_wait').hide();
        $('#avoid_keyword').tagsInput({
            'unique': true,
        });
        $(document).on('click', '.delete-response-add', function(){
            $('[data-toggle="tooltip"]').tooltip('hide');
            event.preventDefault();
            var response_id = $(this).attr("data-id");
            console.log(response_id);
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
                            console.log(el);
                            $(el).addClass("active");
                            showMessage({status:'success',title:'Mark Favourite',message:'Marked as favourite.'})
                        } else {
                            showMessage({status:'success',title:'Un-Favourite',message:'Marked as un-favourite.'})
                            $(el).removeClass("active");
                        }
                    } else {
                        showMessage({status:'error',title:'Oops!',message:'Something went wrong.'})
                    }
                },error:function(error) {
                    showMessage({status:'error',title:'Oops!',message:'Something went wrong.'})

                }
            });
        }
        $(document).on('click', '#submit_btn', function(e) {
            $('.error').empty();
            $("#submit_btn").hide();
            $('.plz_wait').fadeIn();
            $url = "{{ url('marketing-ad') }}";
            $.ajax({
                url: $url,
                type: "POST",
                dataType: 'json',
                data: $('#add_form').serializeArray(),
                success: function(data) {
                    $('.plz_wait').hide();
                    $("#submit_btn").fadeIn();
                    $('.plz_wait').hide();
                    $("#submit_btn").show();
                    if (data.response == true) {
                        $('.trail-quantity').text($('.trail-quantity').text()-data.totalNumberOfWords);
                        const removeElements = (elms) => elms.forEach(el => el.remove());
                        removeElements( document.querySelectorAll(".remove-after-appends") )
                        $('.edemjN').prepend(data.ads);
                    } else {
                        $('.plz_wait').hide();
                        $('.error_msg').html(data.msg);
                        $("#submit_btn").fadeIn();
                        $('#Company_error').html(data.Company_error);
                        $('#CompanyDescription_error').html(data.CompanyDescription_error);
                        $('#addkeywords_error').html(data.addkeywords_error);
                        $('#numberofoutputs_error').html(data.numberofoutputs_error);
                    }
                }
            });
        });
    </script>
@endsection
