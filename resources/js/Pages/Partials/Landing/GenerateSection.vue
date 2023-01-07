<template>
    <!--********************************************************
            Generate Section
    //********************************************************-->
    <div class="generate-content" id="generate-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 wow fadeInUp animated" data-wow-delay="1s" data-wow-duration="1s">
                    <h2 class="top-heading">generate</h2>
                    <div class="left_gred_section1"></div>
                    <div class="left_gred_section1 rightgred1"></div>
                    <div class="navigation">
                        <div class="border-bottom">
                            <div class="tabs" :style="transform ?'transform: translateX(-'+transform+'%);':''">
                                <div @click="active = 'facebook'" :class="['tab1 one', active == 'facebook'? 'active':'']" >
                                    <img src="/ts/images/new-icons/facebook.png" />  Facebook Ad
                                </div>
                                <div @click="active = 'google', transform = 20" :class="['tab2 two', active == 'google'? 'active':'']">
                                    <img src="/ts/images/new-icons/google-symbol.png" /> Google ads
                                </div>
                                <div @click="active = 'product', transform = 40" :class="['tab3 three', active == 'product'? 'active':'']">
                                    <img src="/ts/images/new-icons/product-description.png" /> Product Description
                                </div>
                                <div @click="active = 'sentenceimprover', transform = 60" :class="['tab4 four', active == 'sentenceimprover'? 'active':'']">
                                    <img src="/ts/images/new-icons/sentenceimprover.png" /> Content Improverr
                                </div>
                                <div @click="active = 'framework', transform = 80" :class="['tab5 five', active == 'framework'? 'active':'']">
                                    <img src="/ts/images/new-icons/pas-framework.png" /> PAS Framework
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
                                                    <img src="/ts/images/video-img.png"/>
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
                                                    <img src="/ts/images/video-img.png">
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
                                                    <img src="/ts/images/video-img.png">
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
                                                    <img src="/ts/images/video-img.png">
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
        <img  class="shape2" src="/ts/images/shape2.webp" alt="shape image">
    </div>
</template>

<script>
    export default {
        name: "GenerateSection",
        data(){
            return{
                active:'facebook',
                transform:0,
            }
        }
    }
</script>

<style scoped>

</style>
