@extends('layouts/dashboard_ts')
@section('content')

    @if(isset($user['userID']))
        {{-- project dorpdown --}}
        <x-projects  :projects="$projects"  :currentUser="$currentUser" />
        {{-- End Project --}}
    @endif
<style>
.error{color:red}
.fkyVgZ{background-color:#FC6501;padding:10px 40px;border:medium none;border-radius:34px;box-shadow:rgba(83,92,165,0.2) 0 1px 2px 2px;color:white;font-size:20px;margin-top:30px}
.jFuWAH{width:100%;}
.edemjN{background-color:rgb(242,242,242)}
.liTBVH{width:100%;overflow:auto;height:calc(100% - 130px);text-align:center}
/* .jFuWAH{overflow-y:auto!important} */
.delete-icon{margin-left:0!important}
.kiNLFp{padding:20px;background-color:white;border:1px solid rgb(132,141,211);width:100%;border-radius:10px;margin-bottom:15px}
.fNjRST{display:flex;-moz-box-pack:center;justify-content:center;-moz-box-align:center;align-items:center;width:calc(100% + 40px);margin-top:10px;margin-left:-20px;height:260px;border-top:1px solid rgb(220,220,220);border-bottom:1px solid rgb(220,220,220)}
.jOcitS{margin-bottom:6px;left:3rem;bottom:2.25rem;font-family:Helvetica,Open Sans;line-height:1.195rem}
.kxdBff{position:relative;width:calc(100% + 40px);margin-left:-20px;padding-left:18px;padding-top:8px;height:78px;border-bottom:1px solid rgb(220,220,220);background-color:rgb(240,242,245);font-family:Helvetica,Open Sans;font-size:1rem;color:rgb(101,103,107)}
</style>

    <!-- Start Page Content here -->
    <!-- ============================================================== -->
    <link href="{{asset('assets/admin') }}/libs/tagsinput/taginput.css" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />
    <script src="{{asset('assets/admin') }}/libs/tagsinput/taginput.js"></script>
    @if(isset($user['userID']))
        {{-- project dorpdown --}}
        <x-projects  :projects="$projects"  :currentUser="$currentUser" />
        {{-- End Project --}}
    @endif
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between dh-title df">
                <div class="fm-title">
                    <div

                        @if($ad_info['ads_category'] == 'facebook')
                        class="fm-title-d bg-fb"
                        @else
                        class="fm-title-d bg-google"
                        @endif >
                        @if($ad_info['ads_category'] == 'facebook')
                            <img src="{{ asset('assets/admin/images/new/social/facebook.svg') }}">
                        @else
                            <img src="{{ asset('assets/admin/images/new/social/google.svg') }}">
                        @endif </div>
                    <h3>{{$ad_info['ads_category'] == 'facebook'?'Facebook':'Google'}} Ad<br>
                        @if($ad_info['ads_category'] == 'facebook')
                            <span class="fm-title-desc">A limitless supply of orignal Facebook Ad Copy</span>
                        @else
                            <span class="fm-title-desc">Create Google Ad with exact requirement and layouts</span>
                        @endif

                    </h3>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->


    <!-------->

    <div class="row cards-body c-card">
        <div class="form-area">
            <div class="form-left">
                <form action="google-ad" id="add_form" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <span class="btm-char-count"><span class="brand-remaining-count">{{strlen($ad_info['company_name'])}}</span><span>/80</span></span>
                    <label for="ctext">Brand Name:</label>
                        <input type="hidden" name="ad_id" value="{{ encrypt($ad_info['id']) }}">
                        <input type="hidden" name="category" value="{{ encrypt($ad_info['ads_category']) }}">
                        <input type="text" name="Company" maxlength="80" placeholder="e.g. TypeSkip" class="ctext form-control brand-remaining" value="{{ $ad_info['company_name'] }}">
                        <span class="error" id="Company_error"></span>
                    </div>

                    <div class="form-group">
                        <span class="btm-char-count"><span class="description-remaining-count">{{strlen($ad_info['description'])}}</span><span>/400</span></span>
                        <label for="company">Company or Product Description:</label>
                        <textarea type="text" name="CompanyDescription" maxlength="400" placeholder="Write high quality content, product descriptions, and more using just a few keywords or one-liners" id="company" rows="3" class="form-control description-remaining">{{ $ad_info['description'] }}</textarea>
                        <span class="error" id="CompanyDescription_error"></span>
                    </div>

                    <div class="form-group addKeyword-field" id="addKeyword-field-1">
                        <span class="btm-char-count">0<span>/80</span></span>
                        <label for="ctext">Add Keywords:</label>
                        <input type="text" id="AddKeywordstags" name="add_keywords" value="{{ $ad_info['add_keywords'] }}" class="form-control ctext" multiple="multiple" aria-describedby="ctext">
                        <span class="error" id="addkeywords_error"></span>
                    </div>

                    <div class="form-group addKeyword-field" id="addKeyword-field-1">
                        <span class="btm-char-count">0<span>/80</span></span>
                        <label for="ctext">Keywords to avoid:</label>
                        <input type="text" id="avoid_keyword" name="avoid_keyword" value="{{ $ad_info['avoid_keyword'] }}" class="form-control ctext" multiple="multiple" aria-describedby="ctext">
                        <span class="error" id="avoidkeywords_error"></span>
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
                            <input id="nValue" value="{{ $ad_info['number_of_outputs'] }}" type="number" name="number_of_outputs" min="1" max="15" aria-describedby="ideas" autocomplete="off" class="pr-20 form-input">
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
                    <?php
                    $values_set['choices'] = $ads;
                    echo (string) View::make('components.ads', ['ads' => $values_set]);
                    ?>
                </div> <!-- end col -->
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->
    <script>
        $('.plz_wait').hide();

        $('#AddKeywordstags').tagsInput({
            'unique': true,
        });
        $('#avoid_keyword').tagsInput({
            'unique': true,
        });


        $(document).on('click','#submit_btn',function(e){
            $('.error').empty();
            $("#submit_btn").hide();
            $('.plz_wait').fadeIn();
            $url = "{{request()->is('facebook-ad')?url('facebook-ad'):url('google-ad')}}";
            $.ajax({
                url: $url,
                type: "POST",
                dataType: 'json',
                data: $('#add_form').serializeArray(),
                success: function (data) {
                    $('.plz_wait').hide();
                    $("#submit_btn").fadeIn();
                    $('.plz_wait').hide();
                    $("#submit_btn").show();
                    if(data.response==true) {
                        $('.trail-quantity').text($('.trail-quantity').text()-data.totalNumberOfWords);
                        $('.edemjN').html(data.ads);
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
