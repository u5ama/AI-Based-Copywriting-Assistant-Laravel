@extends('layouts/layout_ts')
@section('header')
    <link rel='stylesheet' href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/css/swiper.min.css">
    <!--********************************************************
    Header
    /********************************************************-->
    <header id="myHeader">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg  navbar-light header_nav ">
                <a href="{{route('landing')}}" class="navbar-brand">
                    <img src="{{asset('/ts/images/logo-typeskip.svg')}}" alt="" class="main_logo" />
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div id="navbarCollapse" class="collapse navbar-collapse justify-content-center">
                    <div class="navbar-nav navbar-nav-l ml-auto">
                        <a href="#generate-content" class="nav-item nav-link">Use Cases</a>
                        <a href="#how-it-works" class="nav-item nav-link">How It Works</a>
                        <a href="#toollist-container" class="nav-item nav-link">Tools</a>
                        <a href="#pricing-section" class="nav-item nav-link">Pricing</a>
                    </div>
                    <div class="navbar-nav ml-auto action-buttons">
                        @if (!request()->session()->has("user"))
                            <a href="{{route('login_v1')}}" class="mr-4 sm-btn white-btn ts-btn ts-effect">Login</a>
                            <a href="{{route('register')}}"  class="lg-btn primary-btn ts-btn">Register</a>
                        @else
                            <a href="{{route('template')}}"  class="lg-btn primary-btn ts-btn">Dashboard</a>
                        @endif
                    </div>
                </div>
            </nav>
        </div>
    </header>
@endsection
@section('content')

    <!--********************************************************
        Banner Section
    /********************************************************-->
    <section class="banner_section colorfff">
        <div class="banner_overlay_Section" >
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="layer1text pl-md-3 pr-md-0">
                            <div class="hdrh2cls_typ">Let our AI</div>
                            <div class="hdrh2cls" id="typed-text">Write Product Descriptions, Facebook ads, & more for you</div>
                            <p class="mt-4 banner-para">Turn keywords and one-liners into persuasive, high converting ads, product descriptions, and blogs etc.</p>
                            <div class="wow fadeInLeft text-left text-nd-left" data-wow-delay="1s" data-wow-duration="3s">
                                <a href="{{route('register')}}" class="lg-btn primary-btn ts-btn mt-4 banner-btn">Get Started - Free!</a>
                                <small class="banner-small text-left text-nd-left">7-Day Free Trial</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="header_card_box">
                            <div class="header_card_box_bg1 leftRight"></div>
                            <div class="header_card_box_bg2 topBottom"></div>
                            <div class="card-box">

                                <!-- card header -->
                                <div class="card-header">
                                    <div class="three-dots">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>

                                    <button id="reset"><img src="https://typeskip.ai/assets/frontend/landing-images/reset.svg" alt="reset">Reset</button>
                                </div>
                                <!-- card header end -->

                                <!-- card top -->
                                <div class="card-top">
                                    <a href="#"><img src="https://typeskip.ai/assets/frontend/landing-images/typeskip.png" alt="logo"></a>

                                </div>
                                <!-- card top end -->

                                <!-- card main -->
                                <div class="main-wrap">
                                    <!-- form -->
                                    <form class="rightform">
                                        <input id="name" placeholder="Company Name" readonly dataValue="SwolePatrol" width="500" type="text">
                                        <input id="title" placeholder="Tone of Voice" readonly dataValue="Witty" type="text">
                                        <textarea id="textarea" placeholder="Description" readonly dataValue="High quality honey cinnamon peanut butter whey protein" rows="3"></textarea>
                                        <div class="keywords">
                                            <span class="placeholder">Keywords</span>
                                            <span class="keyword-item">26G Protein<button class="tag-remove"></button></span>
                                            <span class="keyword-item">Get Results<button class="tag-remove"></button></span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <div class="outputs">
                                                <input id="nValue" value="5" type="number" name="nValue" min="1" max="15" aria-describedby="ideas" autocomplete="off" class="pr-20 form-input">
                                                <!--                        <span>Outputs</span>-->
                                            </div>
                                            <button class="generate" type="button">
                                                <span class="btn-load" ></span>
                                                <span class="btn-txt">Generate</span>
                                            </button>
                                        </div>
                                        <button class="playDemo">Step 1: Play Demo</button>
                                        <button type="button" class="hit-generate">Step 2: Hit Generate!</button>
                                    </form>
                                    <!-- form end -->

                                    <!-- content box -->
                                    <div class="content-box">
                                        <div class="box-empty">
                                            <img src="https://typeskip.ai/assets//frontend/landing-images/demo.png" alt="" class="plane">
                                            <p>Answer the prompts and click generate to watch the AI magic happen ✨.</p>
                                        </div>
                                        <ul>
                                            <li>
                                                <div class="card-item">
                                                    <p><b>Ad</b> • www.swolepatrol.com/ ▾</p>
                                                    <h3>Get Buff Fast | Build Muscle Fast | Boost Your Workout</h3>
                                                    <p>Finally, protein made the way it should be. With 26g of protein per serving and a mouth watering honey cinnamon peanut butter flavor, gains have never tasted this good.</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="card-item">
                                                    <p><b>Ad</b> • www.swolepatrol.com/ ▾</p>
                                                    <h3>Best Whey Protein | Whey Protein Powder | Whey Protein</h3>
                                                    <p>Swole Patrol – The Professional's Choice in Gaining Mass, Building Strength, and Wanting to Look Good Naked. And it just so happens to be packed with 26g of protein per serving, and only 2g of sugar.<br>
                                                        We know what you’re thinking: “How can this possibly taste good?” Well, we have a secret ingredient that makes all the difference…
                                                    </p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="card-item">
                                                    <p><b>Ad</b> • www.swolepatrol.com/ ▾</p>
                                                    <h3>Get the gains you deserve</h3>
                                                    <p>You’ve been working hard in the gym, but your protein is holding you back from getting the results you want. SwolePatrol has 26G of protein per serving and tastes delicious so that you can get the gains you deserve without sacrificing taste or quality. Click here to try it for free: www.swolepatrol.com/freetrial</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="card-item">
                                                    <p><b>Ad</b> • www.swolepatrol.com/ ▾</p>
                                                    <h3>Tired of protein powders that taste like chalk?</h3>
                                                    <p>Swole Patrol is a new type of protein powder made for the hard-gaining athlete. It’s loaded with 26G of muscle building protein and has a delicious Honey Cinnamon Peanut Butter flavor. But what really sets Swole Patrol apart from other proteins is how it’s made. We use an advanced process to make our whey isolate, which means you get more pure protein per serving than any other brand on the market!</p>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="card-item">
                                                    <p><b>Ad</b> • www.swolepatrol.com/ ▾</p>
                                                    <h3>Looking for a healthy protein shake?</h3>
                                                    <p>Swole Patrol is the first and only brand to deliver 26g of protein per serving in a delicious honey cinnamon peanut butter flavor. It’s perfect for pre-workout, post-workout, or just as a snack. And it’s made without any artificial sweeteners or flavors.</p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- content box end -->
                                </div>
                                <!-- card main end -->
                            </div>
                            <div class="header_card_box_bg3 leftRight"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--********************************************************
    Testimonials Scetion
    /********************************************************-->
    <section class="section dark extra-dark padding-top-0 padding-bottom-80 margin-bottom-0 mb-5 first-section bg03192E">
        <div class="title-section white wow fadeInUp animated" data-wow-delay="1s" data-wow-duration="1s">
            <h2 class="h2 our-word text-white pt-lg-5 animate__fadeInUp">Don't take our word for it.</h2>
        </div>
        <div class="wol-container w-dyn-list list-word wow fadeInUp animated" data-wow-delay="1s" data-wow-duration="1s" style="height:29rem">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div role="list" class="masonry w-dyn-items" style="position: relative;">
                            <div role="listitem" class="masonry-item w-dyn-item">
                                <div class="card-wol">
                                    <div class="wol-tweet wow fadeInUp animated" data-wow-delay="0.3s" data-wow-duration="0.5s">
                                        <div class="wol-title-wrapper">
                                            <a href="#" class="wol-image photo w-inline-block">
                                                <img loading="lazy" src="{{asset('/ts/images/profile1.svg')}}" alt="profile1" /></a>
                                            <div class="wol-title-content">
                                                <span href="#" class="wol-tweet-name">Nadeem P.</span
                                                ><a href="#" class="p3 wol-handle"
                                                >@NattyK</a
                                                >
                                            </div>
                                        </div>
                                        <div class="rich-text wol w-richtext">
                                            <p>
                                                I am a copywriter with several years of experience in the industry,
                                                but I still struggle with creating headlines and compelling content.
                                                I was so excited when TypeSkip released its AI copywriting tool because it promised to help me write high quality headlines and content very quickly.
                                                The tool has been such an amazing time saver!
                                                I'm able to generate better copy than ever before as well as save tons of time by being able to craft multiple messages at once without any
                                                extra effort on my end; all while learning more about what works for my audience too.
                                            </p>
                                        </div>
                                        <span
                                            class="link-basic-style p4 n600"
                                        >March 17, 2021</span>
                                    </div>
                                    <div class="wol-article w-condition-invisible">
                                        <div class="wol-title-wrapper">
                                            <a
                                                href="#"
                                                target="_blank"
                                                class="w-inline-block"
                                            ><img
                                                    loading="lazy"
                                                    src="{{asset('/ts/images/profile3.svg')}}"
                                                    alt=""
                                                    class="wol-image"
                                                /></a>
                                            <div class="wol-title-content">
                                                <span class="wol-tweet-name w-dyn-bind-empty"></span>
                                                <a href="#" class="p3 wol-handle w-dyn-bind-empty"></a>
                                            </div>
                                        </div>
                                        <div class="p3 n100 w-richtext">
                                            <p>
                                                If you are the type of person who wants to be able to produce a high-quality, near-perfect copywriting without having the skills or time for it, TypeSkip is your solution. This AI-driven software will help you generate high quality content quickly and with little effort on your part. It is also designed for both those newbie and expert marketers out there so it's great for anyone who needs help writing copy and content.
                                            </p>
                                        </div>
                                        <a href="#" target="_blank" class="link-basic-style p3-bold">Produkthelt</a
                                        >
                                        <div class="p3 top-margin n600">March 19, 2021</div>
                                    </div>
                                    <div class="wol-quote w-condition-invisible wow fadeInUp animated" data-wow-delay="0.7s" data-wow-duration="0.5s">
                                        <div class="wol-title-wrapper">
                                            <img
                                                loading="lazy"
                                                src="{{asset('/ts/images/profile5.svg')}}"
                                                alt="profile5"
                                                class="wol-image photo"
                                            />
                                            <div class="wol-title-content">
                                                <div class="p3">Rabz S.</div>
                                                <div class="p3 n600">@Rabz.S</div>
                                            </div>
                                        </div>
                                        <div class="p3 white w-richtext">
                                            <p>
                                                TypeSkip is a copywriting AI tool that simplifies high converting customer messages. I love how easy it has made my work as a copywriter, especially because the quality of the content is excellent and highly effective for conversions.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div
                                role="listitem"
                                class="masonry-item w-dyn-item"
                            >
                                <div class="card-wol">
                                    <div class="wol-tweet">
                                        <div class="wol-title-wrapper">
                                            <a
                                                href="#"
                                                class="wol-image photo w-inline-block"
                                            ><img
                                                    loading="lazy"
                                                    src="{{asset('/ts/images/profile2.svg')}}"
                                                    alt="profile2"
                                                /></a>
                                            <div class="wol-title-content">
                                                <span href="#" class="wol-tweet-name"> Jordyn A.</span>
                                            </div>
                                        </div>
                                        <div class="rich-text wol w-richtext">
                                            <p>
                                                TypeSkip is an AI copywriting tool that makes it easy to suck less at writing copy and content. With just a few clicks, it creates high-quality text for ads, emails, websites landing pages, blogs etc. It's great for anyone who needs help writing good copy or content quickly - but doesn't have the time or skills to do so themselves.
                                            </p>
                                        </div>
                                        <span class="link-basic-style p4 n600" >April 22, 2021</span>
                                    </div>
                                    <div class="wol-article w-condition-invisible">
                                        <div class="wol-title-wrapper">
                                            <a
                                                href="#"
                                                target="_blank"
                                                class="w-inline-block"
                                            ><img
                                                    loading="lazy"
                                                    src="{{asset('/ts/images/profile3.svg')}}"
                                                    alt=""
                                                    class="wol-image"
                                                /></a>
                                            <div class="wol-title-content">
                                                <span href="#" class="wol-tweet-name w-dyn-bind-empty"></span>
                                                <a href="#" class="p3 wol-handle w-dyn-bind-empty"></a>
                                            </div>
                                        </div>
                                        <div class="p3 n100 w-richtext">
                                            <p>
                                                In my full-time gig as a copywriter, I can't say I've ever had the luxury of too much time to write. In fact, in most cases, 30 minutes is more than enough for me to crank out high-quality copy that converts at an impressive rate. For anyone who's been through the hellish process of sitting down and just not really knowing where (or how) to start writing, TypeSkip.ai has your back. It helps you generate top converting ads or blogs with just a few clicks of your mouse – it's actually very easy!
                                            </p>
                                        </div>
                                        <a href="#" target="_blank" class="link-basic-style p3-bold">BlueReceipt</a
                                        >
                                        <div class="p3 top-margin n600">March 22, 2021</div>
                                    </div>
                                    <div class="wol-quote w-condition-invisible">
                                        <div class="wol-title-wrapper">
                                            <img
                                                loading="lazy"
                                                src="{{asset('/ts/images/profile4.svg')}}"
                                                alt="BlueReceipt"
                                                class="wol-image photo"
                                            />
                                            <div class="wol-title-content">
                                                <div class="p3">BlueReceipt</div>
                                            </div>
                                        </div>
                                        <div class="p3 white w-richtext">
                                            <p>
                                                What I love most about typeskip.ai is how easy it is to use and the amazing quality of copy it generates for me. In a day, this AI copywriting tool has helped me write more than I could have in a month! I usually don't even know what to say when writing content or ads but now that this AI is taking over, everything looks so professional with little effort on my end!
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="listitem" class="masonry-item w-dyn-item">
                                <div class="card-wol">
                                    <div class="wol-tweet">
                                        <div class="wol-title-wrapper">
                                            <a href="#" class="wol-image photo w-inline-block"><img loading="lazy" src="{{asset('/ts/images/profile2.svg')}}" alt="profile2" /></a>
                                            <div class="wol-title-content">
                                                <span href="#" class="wol-tweet-name">Natty K</span
                                                ><a href="#" class="p3 wol-handle"
                                                >@Natty</a
                                                >
                                            </div>
                                        </div>
                                        <div class="rich-text wol w-richtext">
                                            <p>
                                                If you are the type of person who wants to be able to produce a high-quality, near-perfect copywriting without having the skills or time for it, TypeSkip is your solution. This AI-driven software will help you generate high quality content quickly and with little effort on your part. It is also designed for both those newbie and expert marketers out there so it's great for anyone who needs help writing copy and content.
                                            </p>
                                        </div>
                                        <span class="link-basic-style p4 n600">April 27, 2021</span
                                        >
                                    </div>


                                </div>
                            </div>
                            <div role="listitem" class="masonry-item w-dyn-item">
                                <div class="card-wol">
                                    <div class="wol-tweet">
                                        <div class="wol-title-wrapper">
                                            <a href="#" class="wol-image photo w-inline-block"><img loading="lazy" src="{{asset('/ts/images/profile4.svg')}}" alt="profile4
                                 Whitcroft" /></a>
                                            <div class="wol-title-content">
                                                <span class="wol-tweet-name">Jamie W.</span>
                                            </div>
                                        </div>
                                        <div class="rich-text wol w-richtext">
                                            <p>
                                                In my full-time gig as a copywriter, I can't say I've ever had the luxury of too much time to write. In fact, in most cases, 30 minutes is more than enough for me to crank out high-quality copy that converts at an impressive rate. For anyone who's been through the hellish process of sitting down and just not really knowing where (or how) to start writing, TypeSkip.ai has your back. It helps you generate top converting ads or blogs with just a few clicks of your mouse – it's actually very easy!
                                            </p>
                                        </div>
                                        <span class="link-basic-style p4 n600">March 16, 2021</span>
                                    </div>
                                </div>
                            </div>

                            <div
                                role="listitem"
                                class="masonry-item w-dyn-item"
                            >
                                <div class="card-wol">
                                    <div class="wol-tweet">
                                        <div class="wol-title-wrapper">
                                            <a
                                                href="#"
                                                class="wol-image photo w-inline-block"
                                            ><img
                                                    loading="lazy"
                                                    src="{{asset('/ts/images/profile5.svg')}}"
                                                    alt="Ugo Martin"
                                                /></a>
                                            <div class="wol-title-content">
                                                <span href="#" class="wol-tweet-name">Rabz S</span
                                                ><a href="#" class="p3 wol-handle"
                                                >@RabzS</a
                                                >
                                            </div>
                                        </div>
                                        <div class="rich-text wol w-richtext">
                                            <p>
                                                TypeSkip is a copywriting AI tool that simplifies high converting customer messages. I love how easy it has made my work as a copywriter, especially because the quality of the content is excellent and highly effective for conversions.
                                            </p>
                                        </div>
                                        <span
                                            class="link-basic-style p4 n600"
                                        >March 17, 2021</span
                                        >
                                    </div>
                                </div>
                            </div>
                            <div
                                role="listitem"
                                class="masonry-item w-dyn-item"
                            >
                                <div class="card-wol">
                                    <div class="wol-tweet w-condition-invisible">
                                        <div class="wol-title-wrapper">
                                            <a href="#" class="wol-image photo w-inline-block"
                                            ><img
                                                    loading="lazy"
                                                    src="{{asset('/ts/images/profile4.svg')}}"
                                                    alt="profile4"
                                                /></a>
                                            <div class="wol-title-content">
                                                <span href="#" class="wol-tweet-name">Software From the Future: The In...</span
                                                ><a href="#" class="p3 wol-handle w-dyn-bind-empty"></a>
                                            </div>
                                        </div>
                                        <div class="rich-text wol w-richtext">
                                            <p>What I love most about TypeSkip.ai is how easy it is to use and the amazing quality of copy it generates for me. In a day, this AI copywriting tool has helped me write more than I could have in a month! I usually don't even know what to say when writing content or ads but now that this AI is taking over, everything looks so professional with little effort on my end!</p>
                                        </div>
                                        <span class="link-basic-style p4 n600">February 2020</span
                                        >
                                    </div>
                                    <div class="wol-article">
                                        <div class="wol-title-wrapper">
                                            <a
                                                href="#"
                                                target="_blank"
                                                class="wol-image photo w-inline-block"
                                            ><img
                                                    loading="lazy"
                                                    src="{{asset('/ts/images/profile2.svg')}}"
                                                    alt="Capiche"
                                                    class="wol-image"
                                                /></a>
                                            <div class="wol-title-content">
                                                <span href="#" class="wol-tweet-name">Walter U.</span>
                                            </div>
                                        </div>
                                        <div class="rich-text wol w-richtext">
                                            <p>What I love most about typeskip.ai is how easy it is to use and the amazing quality of copy it generates for me. In a day, this AI copywriting tool has helped me write more than I could have in a month! I usually don't even know what to say when writing content or ads but now that this AI is taking over, everything looks so professional with little effort on my end!</p>
                                        </div>
                                        <span class="link-basic-style p4 n600">March 06, 2021</span
                                        >
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="container" style="position: relative;">
            <div class="wol-gradient">
                <div data-w-id="12a151e4-3697-cf71-bace-ce8b92feece8" class="wol-show-more lg-btn primary-btn ts-btn">Show more</div>
            </div>
        </div>
    </section>
    <div class="section-shape">
        <img src="{{asset('/ts/images/shape1.webp')}}" alt="shape image">
    </div>

    <!--********************************************************
    Generate Scetion
    /********************************************************-->
    <div class="generate-content" id="generate-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 wow fadeInUp animated" data-wow-delay="1s" data-wow-duration="1s">
                    <h2 class="top-heading">generate</h2>
                    <div class="left_gred_section1"></div>
                    <div class="left_gred_section1 rightgred1"></div>
                    <div class="navigation">
                        <div class="border-bottom">
                            <div class="tabs">
                                <div class="tab1 one active" >
                                    <img src="{{asset('/ts/images/new-icons/facebook.png')}}" />  Facebook Ad
                                </div>
                                <div class="tab2 two">
                                    <img src="{{asset('/ts/images/new-icons/google-symbol.png')}}" /> Google ads
                                </div>
                                <div class="tab3 three">
                                    <img src="{{asset('/ts/images/new-icons/product-description.png')}}" /> Product Description
                                </div>
                                <div class="tab4 four">
                                    <img src="{{asset('/ts/images/new-icons/sentenceimprover.png')}}" /> Content Improverr
                                </div>
                                <div class="tab5 five">
                                    <img src="{{asset('/ts/images/new-icons/pas-framework.png')}}" /> PAS Framework
                                </div>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tabCont1" style="display:block;">
                                <div class="two-side-section">
                                    <div class="left-side">
                                        <div class="video-box">
                                            <div class="video_left position-relative">
                                                <a href="#" class="video_popup_btn"  data-toggle="modal" data-target="#home_video_play">
                                                    <img src="{{asset('/ts/images/video-img.png')}}"/>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="right-side">
                                        <h1 class="heading">COLLABORATE. SYNC. BUILD.</h1>
                                        <p class="text right-gap">DESIGN AND BUILD THE PERFECT COLLABORATIVE</p>
                                        <p class="text"> WORKSPACE WITH ATTIO’S CUTTING-EDGE FEATURES.</p>
                                        <button class="lg-btn primary-btn ts-btn">Get Started</button>
                                    </div>
                                </div>
                            </div>
                            <div class="tabCont2">
                                <div class="two-side-section">
                                    <div class="left-side">
                                        <div class="video-box">
                                            <div class="video_left position-relative">
                                                <a href="#" class="video_popup_btn"  data-toggle="modal" data-target="#home_video_play">
                                                    <img src="{{asset('/ts/images/video-img.png')}}">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="right-side">
                                        <h1 class="heading">SYNC. BUILD. COLLABORATE.</h1>
                                        <p class="text right-gap">DESIGN AND BUILD THE PERFECT COLLABORATIVE</p>
                                        <p class="text"> WORKSPACE WITH ATTIO’S CUTTING-EDGE FEATURES.</p>
                                        <button class="lg-btn primary-btn ts-btn">Get Started</button>
                                    </div>
                                </div>
                            </div>
                            <div class="tabCont3">
                                <div class="two-side-section">
                                    <div class="left-side">
                                        <div class="video-box">
                                            <div class="video_left position-relative">
                                                <a href="#" class="video_popup_btn"  data-toggle="modal" data-target="#home_video_play">
                                                    <img src="{{asset('/ts/images/video-img.png')}}">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="right-side">
                                        <h1 class="heading">COLLABORATE. SYNC. BUILD.</h1>
                                        <p class="text right-gap">DESIGN AND BUILD THE PERFECT COLLABORATIVE</p>
                                        <p class="text"> WORKSPACE WITH ATTIO’S CUTTING-EDGE FEATURES.</p>
                                        <button class="lg-btn primary-btn ts-btn">Get Started</button>
                                    </div>
                                </div>
                            </div>
                            <div class="tabCont4">
                                <div class="two-side-section">
                                    <div class="left-side">
                                        <div class="video-box">
                                            <div class="video_left position-relative">
                                                <a href="#" class="video_popup_btn"  data-toggle="modal" data-target="#home_video_play">
                                                    <img src="{{asset('/ts/images/video-img.png')}}">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="right-side">
                                        <h1 class="heading">BUILD. SYNC. COLLABORATE.</h1>
                                        <p class="text right-gap">DESIGN AND BUILD THE PERFECT COLLABORATIVE</p>
                                        <p class="text"> WORKSPACE WITH ATTIO’S CUTTING-EDGE FEATURES.</p>
                                        <button class="lg-btn primary-btn ts-btn">Get Started</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section-shape">
        <img class="shape2" src="{{asset('/ts/images/shape2.webp')}}" alt="shape image">
    </div>

    <!--********************************************************
    Generate Facebook Ads Scetion
    /********************************************************-->
    <div class="generate-fb-ads padding-bottom-100 padding-bottom-200 padding-top-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 wow fadeInUp animated" data-wow-delay="1s" data-wow-duration="1s">
                    <h1 class="css-vlw4g1 e16g2qa72">
                        <span class="colorfff">Made for</span>
                        <span class="is-loading css-78hkvy e16g2qa71" style="width: auto; color: #FB8231;">
            <b class="is-bold is-showing">Entrepreneurs</b>
            <b class="is-bold is-hidng">Dropshippers</b>
            <b class="is-bold is-hidng">Marketers</b>
            <b class="is-bold is-hidng">Agencies </b>
            </span>

                    </h1>
                    <div class="three-section-row">
                        <div class="column">
                            <div class="combined-img">
                                <img src="{{asset('/ts/images/profile1.svg')}}" alt="profile-img" />
                                <img src="{{asset('/ts/images/icon-img.svg')}}" alt="icon-img" class="icon-image" />
                            </div>
                            <div class="rightSide-text">
                                <h4 class="heading colorfff">Jared B.</h4>
                                <h5 class="gray-text">Agency Owner</h5>
                                <p class="p-text">Easy to use—turns newbies into pro writers in minutes! The generated copy has top notch quality that I can't get from any of my current tools
                                </p>
                            </div>
                        </div>

                        <div class="column">
                            <div class="combined-img">
                                <img src="{{asset('/ts/images/profile1.svg')}}" alt="profile-img" />
                                <img src="{{asset('/ts/images/icon-img.svg')}}" alt="icon-img" class="icon-image" />
                            </div>
                            <div class="rightSide-text">
                                <h4 class="heading colorfff">Dustin S.</h4>
                                <h5 class="gray-text">Marketer</h5>
                                <p class="p-text">TypeSkip  has been one of the best tools I've come across - it is super easy and quick to use, and gives my business a much needed boost in conversions!
                                </p>
                            </div>
                        </div>
                        <div class="column">
                            <div class="combined-img">
                                <img src="{{asset('/ts/images/profile1.svg')}}" alt="profile-img" />
                                <img src="{{asset('/ts/images/icon-img.svg')}}" alt="icon-img" class="icon-image" />
                            </div>
                            <div class="rightSide-text">
                                <h4 class="heading colorfff">Lucy S.</h4>
                                <h5 class="gray-text">Dropshipper</h5>
                                <p class="p-text">I don’t have to recycle my content anymore! I can just generate new content anytime. </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section-shape">
        <img class="shape3" src="{{asset('/ts/images/shape1.webp')}}" alt="shape image">
    </div>

    <!--********************************************************
    how it works Scetion
    /********************************************************-->
    <div class="section-howitworks dark extra-dark padding-bottom-100 wow fadeInUp animated" data-wow-delay="1s" data-wow-duration="1s" id="how-it-works">
        <div class="container-fluid text-central">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-section">
                        <div class="kicker white">How it works</div>
                        <h2 class="h2">Choose AI Tool. Input Keywords. Generate</h2>
                        <p class="p3 subpara">Write Highly Persuasive, Converting Copy using Cutting Edge AI</p>
                    </div>
                    <div class="left_gred_section3"></div>
                    <div class="left_gred_section3 rightgred3"></div>
                    <div class="w-layout-grid cards-steps">
                        <a href="#sync" class="no-link-style w-inline-block wow fadeInLeft animated" data-wow-delay="1s" data-wow-duration="1s">
                            <div class="card steps">
                                <div class="p1-bold crossed-zero color000">01</div>
                                <div class="flex-vertical align-left">
                                    <img src="{{asset('/ts/images/new-icons/tools.svg')}}" loading="lazy" alt="card01" class="topBottom">
                                    <h3 class="heading color000">Choose AI tool</h3>
                                    <p>Select one of the many AI Tools that are trained by copywriting experts to mimic the best copy examples in the world.
                                    </p>
                                    <!-- <div class="link-card" style="color: rgb(169, 169, 169);">
                                        <div class="link-text">↓</div>
                                        <div class="link-text hidden" style="display: none; opacity: 0;">Learn more</div>
                                    </div> -->
                                </div>
                            </div>
                        </a>
                        <a href="#build" class="no-link-style w-inline-block wow fadeInUp animated" data-wow-delay="1s" data-wow-duration="1s">
                            <div class="card steps">
                                <div class="p1-bold crossed-zero color000">02</div>
                                <div class="flex-vertical align-left justify-center">
                                    <img src="{{asset('/ts/images/new-icons/description.svg')}}" loading="lazy" alt="card02" class="topBottom">
                                    <h3 class="heading color000">Describe Your Product</h3>
                                    <p>Enter a short description or describe your product using Keywords
                                    </p>
                                    <!-- <div class="link-card" style="color: rgb(169, 169, 169);">
                                        <div class="link-text">↓</div>
                                        <div class="link-text hidden" style="display: none; opacity: 0;">Learn more</div>
                                    </div> -->
                                </div>
                            </div>
                        </a>
                        <a href="#collaborate" class="no-link-style w-inline-block wow fadeInRight animated" data-wow-delay="1s" data-wow-duration="1s">
                            <div class="card steps">
                                <div class="p1-bold crossed-zero color000">03</div>
                                <div class="flex-vertical align-left justify-center">
                                    <img src="{{asset('/ts/images/new-icons/administration.svg')}}" loading="lazy" alt="card03" class="topBottom">
                                    <h3 class="heading color000">Generate AI Output</h3>
                                    <p>Press Generate To Get high quality content that sells, generated in seconds.</p>
                                    <!-- <div class="link-card" style="color: rgb(169, 169, 169);">
                                        <div class="link-text">↓</div>
                                        <div class="link-text hidden" style="display: none; opacity: 0;">Learn more</div>
                                    </div> -->
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="bg-steps"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="section-shape">
        <img class="shape4" src="{{asset('/ts/images/shape2.webp')}}" alt="shape image">
    </div>

    <!--********************************************************
    Build Collaborate Scetion
    /********************************************************-->
    <div class="build-collaborate">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="collaborate-two-side">
                        <div class="left-side">
                            <h2 class="colorfff collaborate-title">Sync. Build. Collaborate.</h2>
                            <p>Design and build the perfect collaborative </p>
                            <p>workspace with Attio’s cutting-edge features.</p>
                            <div class="center text-center">
                                <button class="lg-btn primary-btn ts-btn">get started</button>
                            </div>
                        </div>
                        <div class="right-side">
                            <div class="country-flags">
                                <div class="country-item">
                                    <img src="{{asset('/ts/images/flag/india.svg')}}">
                                    <span class="c-name">India</span>
                                </div>
                                <div class="country-item">
                                    <img src="{{asset('/ts/images/flag/united-kingdom.svg')}}">
                                    <span class="c-name">United Kingdom</span>
                                </div>
                                <div class="country-item">
                                    <img src="{{asset('/ts/images/flag/spain.svg')}}">
                                    <span class="c-name">Spain</span>
                                </div>
                                <div class="country-item">
                                    <img src="{{asset('/ts/images/flag/france.svg')}}">
                                    <span class="c-name">France</span>
                                </div>
                                <div class="country-item">
                                    <img src="{{asset('/ts/images/flag/russia.svg')}}">
                                    <span class="c-name">Russia</span>
                                </div>
                                <div class="country-item">
                                    <img src="{{asset('/ts/images/flag/brazil.svg')}}">
                                    <span class="c-name">Brazil</span>
                                </div>
                                <div class="country-item">
                                    <img src="{{asset('/ts/images/flag/chile.svg')}}">
                                    <span class="c-name">Chile</span>
                                </div>
                                <div class="country-item">
                                    <img src="{{asset('/ts/images/flag/pakistan.svg')}}">
                                    <span class="c-name">Pakistan</span>
                                </div>
                                <div class="country-item">
                                    <img src="{{asset('/ts/images/flag/mexico.svg')}}">
                                    <span class="c-name">mexico</span>
                                </div>
                                <div class="country-item">
                                    <img src="{{asset('/ts/images/flag/turkey.svg')}}">
                                    <span class="c-name">Turkey</span>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="width100 w-inline-block mt-5">
                        <div class="container p-0">

                            <div class="col-lg-10 offset-lg-2">
                                <div class="blog-slider">
                                    <img src="{{asset('/ts/images/quotation.svg')}}" class="quotation-img">
                                    <div class="blog-slider__wrp swiper-wrapper">

                                        <div class="blog-slider__item swiper-slide">
                                            <div class="blog-slider__img">
                                                <img src="https://res.cloudinary.com/muhammederdem/image/upload/v1535759871/alessandro-capuzzi-799180-unsplash.jpg" alt="">
                                            </div>
                                            <div class="blog-slider__content">
                                                <div class="blog-slider__text">"I just wrote a full ebook in an hour. It's unbelievable how good this is."</div>
                                                <span class="blog-slider__code">
                                    <strong>Jesse S.</strong><br/>Marketer
                                    </span>
                                            </div>
                                        </div>
                                        <div class="blog-slider__item swiper-slide">
                                            <div class="blog-slider__img">
                                                <img src="https://res.cloudinary.com/muhammederdem/image/upload/v1535759871/jason-leung-798979-unsplash.jpg" alt="">
                                            </div>
                                            <div class="blog-slider__content">
                                                <div class="blog-slider__text">"Currently using it in my dropshipping business to upload and list products. I’m recommending it to everyone I know."</div>
                                                <span class="blog-slider__code">
                                    <strong>Manny A.</strong><br/>Dropshipper
                                    </span>
                                            </div>
                                        </div>

                                        <div class="blog-slider__item swiper-slide">
                                            <div class="blog-slider__img">
                                                <img src="https://res.cloudinary.com/muhammederdem/image/upload/v1535759871/alessandro-capuzzi-799180-unsplash.jpg" alt="">
                                            </div>
                                            <div class="blog-slider__content">
                                                <div class="blog-slider__text">"Easily the best tool of 2021. It is a gamechanger!"</div>
                                                <span class="blog-slider__code">
                                    <strong>Jenny P.</strong><br/>Agency
                                    </span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="blog-slider__pagination"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section-shape">
        <img class="shape5" src="{{asset('/ts/images/shape1.webp')}}" alt="shape image">
    </div>
    <div class="line-shape">
        <img class="lineshape1" src="{{asset('/ts/images/line_shape1.png')}}" alt="shape image">
    </div>

    <!--********************************************************
    Tool list Scetion
    /********************************************************-->
    <div class="toollist-container" id="toollist-container">
        <h1 class="toolist-heading">Tools List:</h1>
        <div class="lit">
            <div class="cards-row">
                <div class="tool-card">
                    <img src="{{asset('/ts/images/new-icons/facebook.png')}}" alt="top-icon" />
                    <h3>Facebook ads</h3>
                    <p>A limitless supply of orignal Facebook Ad Copy </p>
                </div>
                <div class="tool-card">
                    <img src="{{asset('/ts/images/new-icons/google-symbol.png')}}" alt="top-icon" />
                    <h3>Google ads</h3>
                    <p>Create Google Ad with exact requirement and layouts </p>
                </div>
                <div class="tool-card">
                    <img src="{{asset('/ts/images/new-icons/product-description.png')}}" alt="top-icon" />
                    <h3>Product Description</h3>
                    <p>Launching a new product? Let's couple it with a catchy product description </p>
                </div>
                <div class="tool-card">
                    <img src="{{asset('/ts/images/new-icons/facebook.png')}}" alt="top-icon" />
                    <h3>Facebook video script</h3>
                    <p>Create product descriptions that sell</p>
                </div>
                <div class="tool-card">
                    <img src="{{asset('/ts/images/new-icons/sentenceimprover.png')}}" alt="top-icon" />
                    <h3>Content Improver</h3>
                    <p>Rewrite your content and express yourself clearly.</p>
                </div>
                <div class="tool-card">
                    <img src="{{asset('/ts/images/new-icons/pas-framework.png')}}" alt="top-icon" />
                    <h3>PAS Framework</h3>
                    <p>Generate Problem - Agitate - Solution using product Description.</p>
                </div>
                <div class="tool-card">
                    <img src="{{asset('/ts/images/new-icons/pas-framework.png')}}" alt="top-icon" />
                    <h3>AIDA Framework</h3>
                    <p>Write Attention, Interest, Desire, Action using product description.</p>
                </div>
            </div>
        </div>
        <div class="lit right">
            <div class="cards-row">
                <div class="tool-card">
                    <img src="{{asset('/ts/images/new-icons/sentenceimprover.png')}}" alt="top-icon" />
                    <h3>Sentence Improver</h3>
                    <p>Expand the given paragraphs into longer paragraphs.</p>
                </div>
                <div class="tool-card">
                    <img src="{{asset('/ts/images/new-icons/sentence-expander.png')}}" alt="top-icon" />
                    <h3>Sentence Expander</h3>
                    <p>Create Google Ad with exact requirement and layouts </p>
                </div>
                <div class="tool-card">
                    <img src="{{asset('/ts/images/new-icons/product-description.png')}}" alt="top-icon" />
                    <h3>Product Description</h3>
                    <p>Launching a new product? Let's couple it with a catchy product description </p>
                </div>
                <div class="tool-card">
                    <img src="{{asset('/ts/images/new-icons/persuasive-bullet-point.png')}}" alt="top-icon" />
                    <h3>Persuasive Bullet Point</h3>
                    <p>Write persuasive bullet points using product description. </p>
                </div>
                <div class="tool-card">
                    <img src="{{asset('/ts/images/new-icons/marketing-angles.png')}}" alt="top-icon" />
                    <h3>Marketing Angles</h3>
                    <p>Write different marketing angles using Product Description.</p>
                </div>
                <div class="tool-card">
                    <img src="{{asset('/ts/images/new-icons/headline-generator.png')}}" alt="top-icon" />
                    <h3>Headline Generator</h3>
                    <p>Create high quality headlines in seconds </p>
                </div>
                <div class="tool-card">
                    <img src="{{asset('/ts/images/new-icons/blog-outline.png')}}" alt="top-icon" />
                    <h3>Blog Outline</h3>
                    <p>Write an outline for a blog post using the title. </p>
                </div>
            </div>
        </div>
    </div>
    <div class="line-shape">
        <img class="lineshape2" src="{{asset('/ts/images/line_shape2.png')}}" alt="shape image">
    </div>

    <!--********************************************************
    Discover Conversion Scetion
    /********************************************************-->
    <section class="discover_Section padding-top-80 padding-bottom-80 wow fadeInUp animated" data-wow-delay="1s" data-wow-duration="1s">
        <div class="container">
            <div class="col-lg-12 text-center">

                <div class="width1000 discovered_text_Setcion p-5">
                    <div class="center-side">
                        <h4 class="discover-heading colorfff text-center pl-4 pr-4">See How AI Copywriting changes the game for you and your business</h4>

                        <p class="text colorC8C8C8 mt-4"> Design and build the perfect collaborative workspace with Attio’s</p>
                        <div class="text-center pl-4 pr-4 mt-4" >
                            <a href="{{route('register')}}" class="lg-btn primary-btn ts-btn discover-btn">Get Started</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="line-shape">
        <img class="lineshape4" src="{{asset('/ts/images/line_shape2.png')}}" alt="shape image">
    </div>

    <!--********************************************************
    Pricing section
    /********************************************************-->
    <div class="pricing-section" id="pricing-section">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="left-side">
                        <h2 class="price-heading">Our Pricing</h2>
                        <div class="border"></div>
                        <p class="text"> Start small and scale as you grow.</p>
                    </div>
                    <div class="right-side">
                        <div class="pricing-cards">
                            <div class="price-card small topBottom">
                                <div class="d-fl">
                                    <img class="icon-top" src="{{asset('/ts/images/balloon.svg')}}" alt="pricing-top-icon" />
                                    <label>Free Trial</label>
                                </div>
                                <div class="amount">
                                    <span class="doller">$</span>
                                    <span class="number">0</span>
                                    <span class="slash">/</span>
                                    <span class="static-month">7 Days</span>
                                </div>
                                <div class="services-list">
                                    <ul>
                                        <li>
                                            <img src="{{asset('/ts/images/check-icon.svg')}}" alt="check-icon" />
                                            <span class="text">All Content Templates</span>
                                        </li>
                                        <li>
                                            <img src="{{asset('/ts/images/check-icon.svg')}}" alt="check-icon" />
                                            <span class="text">Upto 25,000 words Generated</span>
                                        </li>
                                        <li>
                                            <img src="{{asset('/ts/images/check-icon.svg')}}" alt="check-icon" />
                                            <span class="text">Upto 10 User Seats</span>
                                        </li>
                                        <li>
                                            <img src="{{asset('/ts/images/check-icon.svg')}}" alt="check-icon" />
                                            <span class="text">Fully Mobile Responsive</span>
                                        </li>
                                        <li>
                                            <img src="{{asset('/ts/images/check-icon.svg')}}" alt="check-icon" />
                                            <span class="text">Same Day Support</span>
                                        </li>
                                        <li>
                                            <img src="{{asset('/ts/images/check-icon.svg')}}" alt="check-icon" />
                                            <span class="text">Early Access to New Features</span>
                                        </li>
                                    </ul>
                                </div>
                                <a href="{{route('register')}}" class="lg-btn primary-btn ts-btn price-btn">Get Started</a>
                            </div>
                            <div class="price-card big topBottom">
                                <div class="d-fl">
                                    <img class="icon-top" src="{{asset('/ts/images/rocket.svg')}}" alt="pricing-top-icon" />
                                    <label>Starter</label>
                                </div>
                                <div class="amount">
                                    <span class="doller">$</span>
                                    <span class="number">29</span>
                                    <span class="slash">/</span>
                                    <span class="static-month">Month</span>
                                </div>
                                <div class="services-list">
                                    <ul>
                                        <li>
                                            <img src="{{asset('/ts/images/check-icon.svg')}}" alt="check-icon" />
                                            <span class="text">All Content Templates</span>
                                        </li>
                                        <li>
                                            <img src="{{asset('/ts/images/check-icon.svg')}}" alt="check-icon" />
                                            <span class="text">Upto 25,000 words Generated</span>
                                        </li>
                                        <li>
                                            <img src="{{asset('/ts/images/check-icon.svg')}}" alt="check-icon" />
                                            <span class="text">Upto 10 User Seats</span>
                                        </li>
                                        <li>
                                            <img src="{{asset('/ts/images/check-icon.svg')}}" alt="check-icon" />
                                            <span class="text">Fully Mobile Responsive</span>
                                        </li>
                                        <li>
                                            <img src="{{asset('/ts/images/check-icon.svg')}}" alt="check-icon" />
                                            <span class="text">Same Day Support</span>
                                        </li>
                                        <li>
                                            <img src="{{asset('/ts/images/check-icon.svg')}}" alt="check-icon" />
                                            <span class="text">Early Access to New Features</span>
                                        </li>
                                    </ul>
                                </div>
                                <a href="{{route('register')}}" class="lg-btn primary-btn ts-btn price-btn">Get Started</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="line-shape">
        <img class="lineshape4" src="{{asset('/ts/images/line_shape7.png')}}" alt="shape image">
    </div>

    <!--********************************************************
    Pricing section Don't Take Our Word For It.
    /********************************************************-->
    <div id="Features" class="section features-cards-section">
        <div class="top-heading wow fadeInUp animated" data-wow-delay="1s" data-wow-duration="1s">
            <h1 class="colorfff">Don't Take Our Word For It.</h1>
        </div>
        <div class="left_gred_section4"></div>
        <div class="container features">
            <div class="w-dyn-list card-columns">
                <div role="list" class="feature-side-cards-2 w-dyn-items">
                    <div role="listitem" class="w-dyn-item">
                        <div class="skilll white-card">
                            <div class="top-part">
                                <img src="{{asset('/ts/images/profile1.svg')}}" alt="profile" />
                                <div class="name">
                                    <h4>Alan J.</h4>
                                </div>
                            </div>
                            <div class="mid-part">
                                I am a copywriter with several years of experience in the industry, but I still struggle with creating headlines and compelling content. I was so excited when TypeSkip released its AI copywriting tool because it promised to help me write high quality headlines and content very quickly. The tool has been such an amazing time saver! I'm able to generate better copy than ever before as well as save tons of time by being able to craft multiple messages at once without any extra effort on my end; all while learning more about what works for my audience too.
                            </div>
                            <div class="bottom-part">

                                <span class="date">April 17, 2021</span>
                            </div>
                        </div>
                    </div>
                    <div role="listitem" class="w-dyn-item">
                        <div class="skilll white-card">
                            <div class="top-part">
                                <img src="{{asset('/ts/images/profile1.svg')}}" alt="profile" />
                                <div class="name">
                                    <h4>Matt S.</h4>
                                </div>
                            </div>
                            <div class="mid-part">
                                If you are the type of person who wants to be able to produce a high-quality, near-perfect copywriting without having the skills or time for it, TypeSkip is your solution. This AI-driven software will help you generate high quality content quickly and with little effort on your part. It is also designed for both those newbie and expert marketers out there so it's great for anyone who needs help writing copy and content.
                            </div>
                            <div class="bottom-part">

                                <span class="date">April 22, 2021</span>
                            </div>
                        </div>
                    </div>
                    <div role="listitem" class="w-dyn-item">
                        <div class="skilll white-card">
                            <div class="top-part">
                                <img src="{{asset('/ts/images/profile1.svg')}}" alt="profile" />
                                <div class="name">
                                    <h4> Karl Y.</h4>
                                </div>
                            </div>
                            <div class="mid-part">
                                TypeSkip is a copywriting AI tool that simplifies high converting customer messages. I love how easy it has made my work as a copywriter, especially because the quality of the content is excellent and highly effective for conversions.
                            </div>
                            <div class="bottom-part">
                                <span class="date">May 1, 2021</span>
                            </div>
                        </div>
                    </div>
                    <div role="listitem" class="w-dyn-item">
                        <div class="skilll white-card">
                            <div class="top-part">
                                <img src="{{asset('/ts/images/profile1.svg')}}" alt="profile" />
                                <div class="name">
                                    <h4>Lucy</h4>
                                </div>
                            </div>
                            <div class="mid-part">
                                TypeSkip is an AI copywriting tool that makes it easy to suck less at writing copy and content. With just a few clicks, it creates high-quality text for ads, emails, websites landing pages, blogs etc. It's great for anyone who needs help writing good copy or content quickly - but doesn't have the time or skills to do so themselves.

                            </div>
                            <div class="bottom-part">
                                <span class="date">May 29, 2021</span>
                            </div>
                        </div>
                    </div>
                    <div role="listitem" class="w-dyn-item">
                        <div class="skilll white-card">
                            <div class="top-part">
                                <img src="{{asset('/ts/images/profile1.svg')}}" alt="profile" />
                                <div class="name">
                                    <h4>Carla J.</h4>
                                </div>
                            </div>
                            <div class="mid-part">
                                In my full-time gig as a copywriter, I can't say I've ever had the luxury of too much time to write. In fact, in most cases, 30 minutes is more than enough for me to crank out high-quality copy that converts at an impressive rate. For anyone who's been through the hellish process of sitting down and just not really knowing where (or how) to start writing, TypeSkip.ai has your back. It helps you generate top converting ads or blogs with just a few clicks of your mouse – it's actually very easy!

                            </div>
                            <div class="bottom-part">
                                <span class="date">April 7, 2021</span>
                            </div>
                        </div>
                    </div>
                    <div role="listitem" class="w-dyn-item">
                        <div class="skilll white-card">
                            <div class="top-part">
                                <img src="{{asset('/ts/images/profile1.svg')}}" alt="profile" />
                                <div class="name">
                                    <h4>Dustin</h4>
                                </div>
                            </div>
                            <div class="mid-part">
                                What I love most about TypeSkip.ai is how easy it is to use and the amazing quality of copy it generates for me. In a day, this AI copywriting tool has helped me write more than I could have in a month! I usually don't even know what to say when writing content or ads but now that this AI is taking over, everything looks so professional with little effort on my end!

                            </div>
                            <div class="bottom-part">
                                <span class="date">May 15, 2021</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="div-block-3">
                <div class="anchor-sticky-info">
                    <h2 class="gradient-rainbow colorfff">Write More Content</h2>
                    <p>TypeSkip lets you write more content in a couple </p>
                    <p>of hours than you could previously in a whole month. </p>
                    <div class="center text-center">
                        <a href="{{route('register')}}" class="lg-btn primary-btn ts-btn sync-btn">get started</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--********************************************************
    Market section
    /********************************************************-->
    <div class="grow-market">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="grow-content wow fadeInUp animated" data-wow-delay="1s" data-wow-duration="1s">
                        <h2>Let AI Write Copy For You #TypeSkipIt</h2>

                        <span><img src="{{asset('/ts/images/check-white.svg')}}" alt="check-white" />High Quality Copy in Seconds</span>
                        <span><img src="{{asset('/ts/images/check-white.svg')}}" alt="check-white" />Generate Different Angles</span>
                        <span><img src="{{asset('/ts/images/check-white.svg')}}" alt="check-white" />Eliminate Writer's Block</span>
                        <div class="col-md-12 text-center mt-5 mb-3">
                            <a href="{{route('register')}}" class="sm-btn white-btn ts-btn ts-effect grow-btn">Start Free Trial</a>
                        </div>
                        <p>P.S All this copy was written by TypeSkip</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Home Video Play -->
    <div class="modal fade" id="home_video_play" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centerd modal-lg ph-modal" role="document">
            <div class="modal-content">
                <img src="{{asset('/ts/images/close-white.svg')}}" class="close-modal close" data-dismiss="modal" aria-label="Close">
                <div class="modal-body p-0">
                    <iframe id="sampleVideo" src="https://www.youtube.com/embed/LXb3EKWsInQ" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection



