@extends('layouts/mainAdmin')
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
    <div class="d-flex justify-content-between dh-title df">
        <div class="fm-title">
            <div class="fm-title-d bg-white"><img src="{{ asset('assets/admin/images/newTemplate/headline-generator.svg') }}"></div>
            <h3>Great Headlines<br><span class="fm-title-desc">Create high quality headlines in seconds.</span></h3>
        </div>
    </div>
    <!-- end page title -->
    <div class="row cards-body c-card">
        <div class="form-area">
            <div class="form-left">
                <form action="google-ad" id="add_form" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <span class="btm-char-count"><span class="brand-remaining-count">{{strlen($ad_info['company_name'])}}</span><span>/80</span></span>
                        <label for="ctext">Name:</label>
                        <input type="hidden" name="ad_id" value="{{encrypt($ad_info['id'])}}">
                        <input type="hidden" name="category" value="{{encrypt($ad_info['ads_category'])}}">
                        <input type="text" name="Company" maxlength="80" placeholder="e.g. TypeSkip" class="ctext form-control brand-remaining" value="{{ $ad_info['company_name'] }}">
                        <span class="error" id="Company_error"></span>
                    </div>

                    <div class="form-group">
                        <span class="btm-char-count"><span class="description-remaining-count">{{strlen($ad_info['description'])}}</span><span>/400</span></span>
                        <label for="company">Product description:</label>
                        <textarea type="text"
                                  name="CompanyDescription"
                                  maxlength="400"
                                  placeholder="Write high quality content, product descriptions, and more using just a few keywords or one-liners"
                                  id="company"
                                  rows="3"
                                  class="form-control description-remaining">{{$ad_info['description']}}</textarea>
                        <span class="error" id="CompanyDescription_error"></span>
                    </div>

                    <div class="form-group addKeyword-field" id="addKeyword-field-1">
                        <label for="ctext">Who is it for: </label>
                        <input type="text"
                               id="AddKeywordstags"
                               name="add_keywords"
                               value="{{$ad_info['add_keywords']}}"
                               class="form-control ctext"
                               aria-describedby="ctext">
                        <span class="error" id="addkeywords_error"></span>
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
                            <input id="nValue" value="{{ $ad_info['number_of_outputs'] }}" type="number" name="number_of_outputs"  min="1" max="15" aria-describedby="ideas" autocomplete="off" class="pr-20 form-input">
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
        $('#avoid_keyword').tagsInput({
            'unique': true,
        });
        $(document).on('click', '#submit_btn', function(e) {
            $('.error').empty();
            $("#submit_btn").hide();
            $('.plz_wait').fadeIn();
            $url = "{{ url('great-ad') }}";
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
