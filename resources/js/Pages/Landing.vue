<template>
    <link rel='stylesheet' href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/css/swiper.min.css">
    <header id="myHeader">
        <TopNavBar></TopNavBar>

        <section class="banner_section colorfff">
            <Banner></Banner>
        </section>

        <Testimonials></Testimonials>

        <GenerateSection></GenerateSection>

        <MadeFor></MadeFor>

        <HowItWorks></HowItWorks>

       <BuildCollaborate></BuildCollaborate>

        <ToolList></ToolList>

        <DiscoverConversion></DiscoverConversion>

        <Pricing></Pricing>

        <DontTakeOurWordForIt></DontTakeOurWordForIt>

        <Market></Market>
        <!-- Home Video Play -->
        <div class="modal fade" id="home_video_play" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centerd modal-lg ph-modal" role="document">
                <div class="modal-content">
                    <img src="/ts/images/close-white.svg" class="close-modal close" data-dismiss="modal" aria-label="Close">
                    <div class="modal-body p-0">
                        <iframe id="sampleVideo" src="https://www.youtube.com/embed/LXb3EKWsInQ" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
        <Footer></Footer>
    </header>
</template>

<script>
    import Testimonials from "@/Pages/Partials/Landing/Testimonials";
    import GenerateSection from "@/Pages/Partials/Landing/GenerateSection";
    import MadeFor from "@/Pages/Partials/Landing/MadeFor";
    import HowItWorks from "@/Pages/Partials/Landing/HowItWorks";
    import BuildCollaborate from "@/Pages/Partials/Landing/BuildCollaborate";
    import ToolList from "@/Pages/Partials/Landing/ToolList";
    import DiscoverConversion from "@/Pages/Partials/Landing/DiscoverConversion";
    import Pricing from "@/Pages/Partials/Landing/Pricing";
    import DontTakeOurWordForIt from "@/Pages/Partials/Landing/DontTakeOurWordForIt";
    import Market from "@/Pages/Partials/Landing/Market";
    import Banner from "@/Pages/Partials/Landing/Banner";
    import Footer from "@/Pages/Partials/Common/Footer";
    import TopNavBar from "@/Pages/Partials/Common/TopNavBar";
    export default {
        name: "Landing",
        components: {
            TopNavBar,
            Footer,
            Banner,
            Market,
            DontTakeOurWordForIt,
            Pricing,
            DiscoverConversion, ToolList, BuildCollaborate, HowItWorks, GenerateSection, Testimonials, MadeFor}
    }
</script>
<style scoped>
    .banner_section {
        background-image: url('../../../public/ts/images/banner/Path1734.png');
    }
</style>
