

@foreach($contents as $content)
    <div class="col-lg-4 col-md-6 response-content-{{$content->id}}"  >
        <div  @if($content->ads->ads_category == 'product-description')
             class="panel panel-description"
             @elseif($content->ads->ads_category == 'copy-paste')
             class="panel panel-copy"
             @elseif($content->ads->ads_category == 'google')
             class="panel panel-google"
             @elseif($content->ads->ads_category == 'facebook-headline')
             class="panel panel-linkedin"
             @elseif($content->ads->ads_category == 'pas-framework')
             class="panel panel-pas"
             @elseif($content->ads->ads_category == 'aida-principle')
             class="panel panel-aida"
             @elseif($content->ads->ads_category == 'sentence-expander')
             class="panel panel-aida"
             @elseif($content->ads->ads_category == 'blog-outline')
             class="panel panel-blog"
             @elseif($content->ads->ads_category == 'great-headlines')
             class="panel panel-great"
             @elseif($content->ads->ads_category == 'persuasive-bullet-points')
             class="panel panel-persuasive"
             @elseif($content->ads->ads_category == 'marketing-angles')
             class="panel panel-marketing"
             @else
             class="panel panel-linkedin"
             @endif>
            <div data-toggle="modal" data-target="#content-details" onClick="showContent({{ $content->id }})"  class="panel-title"
                 @if($content->ads->ContentTool)
                    style="background-color: {{$content->ads->ContentTool->color_code}} !important;"
                @endif
                >
                @if($content->ads->ads_category == 'product-description')
                    <img src="{{ asset('assets/admin/images/newTemplate/product-description.png') }}">
                @elseif($content->ads->ads_category == 'copy-paste')
                    <img src="{{ asset('assets/admin/images/newTemplate/file.png') }}">
                @elseif($content->ads->ads_category == 'google')
                    <img src="{{ asset('assets/admin/images/newTemplate/google-symbol.svg') }}">
                @elseif($content->ads->ads_category == 'pas-framework')
                    <img src="{{ asset('assets/admin/images/newTemplate/pas-framework.png') }}">
                @elseif($content->ads->ads_category == 'aida-principle')
                    <img src="{{ asset('assets/admin/images/newTemplate/aida-principal.png') }}">
                @elseif($content->ads->ads_category == 'sentence-expander')
                    <img src="{{ asset('assets/admin/images/newTemplate/sentence-expander.svg') }}">
                @elseif($content->ads->ads_category == 'blog-outline')
                    <img src="{{ asset('assets/admin/images/newTemplate/blog-outline.svg') }}">
                @elseif($content->ads->ads_category == 'great-headlines')
                    <img src="{{ asset('assets/admin/images/newTemplate/headline-generator.svg') }}">
                @elseif($content->ads->ads_category == 'persuasive-bullet-points')
                    <img src="{{ asset('assets/admin/images/newTemplate/persuasive-bullet-point.png') }}">
                @elseif($content->ads->ads_category == 'marketing-angles')
                    <img src="{{ asset('assets/admin/images/newTemplate/marketing-angles.png') }}">
                @else
                    @if($content->ads->ContentTool)
                        <img src="{{ $content->ads->ContentTool->icon_path}}">
                    @else
                        <img src="{{ asset('assets/admin/images/newTemplate/facebook.svg') }}">
                    @endif
                @endif
                <div class="ccp-title-head">
                    @if($content->ads->ads_category == 'copy-paste')
                        <span class="ccp-title">Content Improver</span>
                    @elseif($content->ads->ads_category == 'facebook-headline')
                        <span class="ccp-title">Facebook video script</span>
                    @else
                        @if($content->ads->ContentTool)
                            <span class="ccp-title">{{ $content->ads->ContentTool->title}}</span>
                        @else
                            <span class="ccp-title">{{ str_replace("-", " ",ucfirst($content->ads->ads_category)) }}</span>
                        @endif

                    @endif
                    <span class="ccp-time">{{ $content->created_at->diffForHumans() }}</span>
                        @if($content->ads->ads_category == 'facebook')
                            <input type="text" class="url" value="{{ url('facebook-ad/'.$content->ads->company_name.'/'.encrypt($content->ads->id).'/'.encrypt($content->id)) }}">
                         @elseif ($content->ads->ads_category == 'google')
                            <input type="text" class="url" value="{{ url('google-ad/'.$content->ads->company_name.'/'.encrypt($content->ads->id).'/'.encrypt($content->id)) }}">
                        @elseif ($content->ads->ads_category == 'product-description')
                            <input type="text" class="url" value="{{ url('product-description/'.$content->ads->company_name.'/'.encrypt($content->ads->id).'/'.encrypt($content->id)) }}">
                        @elseif ($content->ads->ads_category == 'facebook-headline')
                            <input type="text" class="url" value="{{ url('facebook-headline/'.$content->ads->company_name.'/'.encrypt($content->ads->id).'/'.encrypt($content->id)) }}">
                        @elseif ($content->ads->ads_category == 'copy-paste')
                            <input type="text" class="url" value="{{ url('copypaste/'.$content->ads->company_name.'/'.encrypt($content->ads->id).'/'.encrypt($content->id)) }}">
                        @elseif ($content->ads->ads_category == 'pas-framework')
                            <input type="text" class="url" value="{{ url('pas-ad/'.$content->ads->company_name.'/'.encrypt($content->ads->id).'/'.encrypt($content->id)) }}">
                        @elseif ($content->ads->ads_category == 'aida-principle')
                            <input type="text" class="url" value="{{ url('aida-ad/'.$content->ads->company_name.'/'.encrypt($content->ads->id).'/'.encrypt($content->id)) }}">
                        @elseif ($content->ads->ads_category == 'sentence-expander')
                            <input type="text" class="url" value="{{ url('sentence-ad/'.$content->ads->company_name.'/'.encrypt($content->ads->id).'/'.encrypt($content->id)) }}">
                        @elseif ($content->ads->ads_category == 'blog-outline')
                            <input type="text" class="url" value="{{ url('blog-ad/'.$content->ads->company_name.'/'.encrypt($content->ads->id).'/'.encrypt($content->id)) }}">
                        @elseif ($content->ads->ads_category == 'great-headlines')
                            <input type="text" class="url" value="{{ url('great-ad/'.$content->ads->company_name.'/'.encrypt($content->ads->id).'/'.encrypt($content->id)) }}">
                        @elseif ($content->ads->ads_category == 'persuasive-bullet-points')
                            <input type="text" class="url" value="{{ url('persuasive-ad/'.$content->ads->company_name.'/'.encrypt($content->ads->id).'/'.encrypt($content->id)) }}">
                        @elseif ($content->ads->ads_category == 'marketing-angles')
                            <input type="text" class="url" value="{{ url('marketing-ad/'.$content->ads->company_name.'/'.encrypt($content->ads->id).'/'.encrypt($content->id)) }}">
                        @endif
                </div>
            </div>
            <div class="panel-body panel-body-content content-description" data-toggle="modal" data-target="#content-details" onClick="showContent({{ $content->id }})" >
                {{$content->description}}
            </div>
            <div class="panel-footer">
                <a href="javascript:;"  class="copy-response" data-toggle="tooltip" data-placement="bottom" title="Copy">
                    <svg id="fi-rr-copy" xmlns="http://www.w3.org/2000/svg" width="26.414" height="26.414" viewBox="0 0 26.414 26.414">
                        <path id="fi-rr-copy-2" data-name="fi-rr-copy" d="M16.509,22.012H5.5a5.51,5.51,0,0,1-5.5-5.5V5.5A5.51,5.51,0,0,1,5.5,0H16.509a5.51,5.51,0,0,1,5.5,5.5V16.509A5.51,5.51,0,0,1,16.509,22.012ZM5.5,2.2A3.3,3.3,0,0,0,2.2,5.5V16.509a3.3,3.3,0,0,0,3.3,3.3H16.509a3.3,3.3,0,0,0,3.3-3.3V5.5a3.3,3.3,0,0,0-3.3-3.3Zm20.911,18.71V6.6a1.1,1.1,0,0,0-2.2,0V20.911a3.3,3.3,0,0,1-3.3,3.3H6.6a1.1,1.1,0,0,0,0,2.2H20.911A5.51,5.51,0,0,0,26.414,20.911Z"/>
                    </svg>
                </a>
                @if(false)
                <a href="javascript:;" onclick="share(this)" data-id="{{$content->id}}" data-toggle="tooltip" data-placement="bottom" title="Delete">
                    <svg id="fi-rr-share" xmlns="http://www.w3.org/2000/svg" width="26.445" height="26.416" viewBox="0 0 26.445 26.416">
                        <path id="fi-rr-share-2" data-name="fi-rr-share" d="M21.28,16.142a5.129,5.129,0,0,0-4.225,2.228L9.892,15.135A5.034,5.034,0,0,0,9.9,11.3l7.154-3.251a5.129,5.129,0,1,0-.91-2.909A5.1,5.1,0,0,0,16.229,6L8.624,9.457a5.138,5.138,0,1,0-.017,7.514l7.625,3.443a5.213,5.213,0,0,0-.087.864,5.136,5.136,0,1,0,5.136-5.135Zm0-13.941a2.935,2.935,0,1,1-2.934,2.935A2.935,2.935,0,0,1,21.28,2.2ZM5.139,16.142a2.935,2.935,0,1,1,2.934-2.935,2.935,2.935,0,0,1-2.934,2.935ZM21.28,24.213a2.935,2.935,0,1,1,2.935-2.935,2.935,2.935,0,0,1-2.935,2.935Z" transform="translate(0.027 0.001)"/>
                    </svg>
                </a>
                @endif
                <a href="javascript:;" class="delete-response" data-toggle="tooltip" data-placement="bottom" title="Delete" data-id="{{$content->id}}">
                    <svg id="fi-rr-trash" xmlns="http://www.w3.org/2000/svg" width="22.012" height="26.414" viewBox="0 0 22.012 26.414">
                        <path id="Path_150" data-name="Path 150" d="M22.911,4.4H19.5A5.513,5.513,0,0,0,14.107,0h-2.2A5.513,5.513,0,0,0,6.512,4.4H3.1a1.1,1.1,0,0,0,0,2.2H4.2V20.911a5.51,5.51,0,0,0,5.5,5.5h6.6a5.51,5.51,0,0,0,5.5-5.5V6.6h1.1a1.1,1.1,0,0,0,0-2.2ZM11.905,2.2h2.2A3.308,3.308,0,0,1,17.22,4.4H8.792a3.308,3.308,0,0,1,3.114-2.2Zm7.7,18.71a3.3,3.3,0,0,1-3.3,3.3H9.7a3.3,3.3,0,0,1-3.3-3.3V6.6H19.61Z" transform="translate(-2)"/>
                        <path id="Path_151" data-name="Path 151" d="M10.1,18.8a1.1,1.1,0,0,0,1.1-1.1V11.1a1.1,1.1,0,0,0-2.2,0v6.6A1.1,1.1,0,0,0,10.1,18.8Z" transform="translate(-1.296 1.006)" />
                        <path id="Path_152" data-name="Path 152" d="M14.1,18.8a1.1,1.1,0,0,0,1.1-1.1V11.1a1.1,1.1,0,0,0-2.2,0v6.6A1.1,1.1,0,0,0,14.1,18.8Z" transform="translate(-0.893 1.006)" />
                    </svg>
                </a>
                @if(isset($deleted))
                    <a href="javascript:;" onclick="restore(this)" data-id="{{$content->id}}" data-toggle="tooltip" data-placement="bottom" title="Restore">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26.41" height="25.568" viewBox="0 0 26.41 25.568">
                            <g id="fi-rr-star" transform="translate(0 0)">
                                <path id="fi-rr-star-2" data-name="fi-rr-star" d="M26.233,9.66a3.5,3.5,0,0,0-3.376-2.45H18.049l-1.46-4.552a3.552,3.552,0,0,0-6.764,0L8.364,7.21H3.555a3.552,3.552,0,0,0-2.091,6.419L5.378,16.49,3.89,21.1a3.553,3.553,0,0,0,5.485,3.956l3.831-2.82,3.832,2.816A3.552,3.552,0,0,0,22.523,21.1L21.035,16.49l3.918-2.862A3.5,3.5,0,0,0,26.233,9.66Zm-2.579,2.191-4.561,3.334a1.1,1.1,0,0,0-.4,1.228l1.733,5.36a1.35,1.35,0,0,1-2.086,1.5l-4.485-3.3a1.1,1.1,0,0,0-1.3,0l-4.485,3.3a1.35,1.35,0,0,1-2.091-1.5l1.739-5.36a1.1,1.1,0,0,0-.4-1.228L2.758,11.851a1.35,1.35,0,0,1,.8-2.44H9.168a1.1,1.1,0,0,0,1.048-.764L11.922,3.33a1.35,1.35,0,0,1,2.571,0L16.2,8.647a1.1,1.1,0,0,0,1.048.764H22.86a1.35,1.35,0,0,1,.8,2.44Z" transform="translate(-0.008 -0.19)" />
                            </g>
                        </svg>
                    </a>
                @else
                    <a href="javascript:;" onclick="favourite(this)" data-id="{{$content->id}}" class="{{isset($content->UserFavourite->id)?'active':''}}" data-toggle="tooltip" data-placement="bottom" title="Delete">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26.41" height="25.568" viewBox="0 0 26.41 25.568">
                            <g id="fi-rr-star" transform="translate(0 0)">
                                <path id="fi-rr-star-2" data-name="fi-rr-star" d="M26.233,9.66a3.5,3.5,0,0,0-3.376-2.45H18.049l-1.46-4.552a3.552,3.552,0,0,0-6.764,0L8.364,7.21H3.555a3.552,3.552,0,0,0-2.091,6.419L5.378,16.49,3.89,21.1a3.553,3.553,0,0,0,5.485,3.956l3.831-2.82,3.832,2.816A3.552,3.552,0,0,0,22.523,21.1L21.035,16.49l3.918-2.862A3.5,3.5,0,0,0,26.233,9.66Zm-2.579,2.191-4.561,3.334a1.1,1.1,0,0,0-.4,1.228l1.733,5.36a1.35,1.35,0,0,1-2.086,1.5l-4.485-3.3a1.1,1.1,0,0,0-1.3,0l-4.485,3.3a1.35,1.35,0,0,1-2.091-1.5l1.739-5.36a1.1,1.1,0,0,0-.4-1.228L2.758,11.851a1.35,1.35,0,0,1,.8-2.44H9.168a1.1,1.1,0,0,0,1.048-.764L11.922,3.33a1.35,1.35,0,0,1,2.571,0L16.2,8.647a1.1,1.1,0,0,0,1.048.764H22.86a1.35,1.35,0,0,1,.8,2.44Z" transform="translate(-0.008 -0.19)" />
                            </g>
                        </svg>
                    </a>
                @endif

            </div>
        </div>
    </div>
@endforeach
<div class="col-lg-12 pagination justify-content-center mt-5" >
    {{ $contents->render() }}
</div>
