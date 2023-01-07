<template>
    <!--********************************************************
            Discover Conversion Section
            /********************************************************-->
    <section class="discover_Section padding-top-80 padding-bottom-80 wow fadeInUp animated" data-wow-delay="1s" data-wow-duration="1s">
        <div class="container">
            <div class="col-lg-12 text-center">

                <div class="width1000 discovered_text_Setcion p-5">
                    <div class="center-side">
                        <h4 class="discover-heading colorfff text-center pl-4 pr-4">See How AI Copywriting changes the game for you and your business</h4>
                        <p class="text colorC8C8C8 mt-4"> Design and build the perfect collaborative workspace with Attio’s</p>
                        <div class="text-center pl-4 pr-4 mt-4" >
                            <a :href="route('register')" class="lg-btn primary-btn ts-btn discover-btn">Get Started</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="line-shape">
        <img class="lineshape4" src="/ts/images/line_shape2.png" alt="shape image">
    </div>
</template>

<script>
    export default {
        name: "DiscoverConversion"
    }
</script>

<style scoped>
.discover_Section {
    background-color: #fff;
}
    .discover_Section::before {
        background-image: url('../../../../../public/ts/images/discover.webp');
    }
</style>
