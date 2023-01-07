<template>
    <!--********************************************************
        Market section
        /********************************************************-->
    <div class="grow-market">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="grow-content wow fadeInUp animated" data-wow-delay="1s" data-wow-duration="1s">
                        <h2>Let AI Write Copy For You #TypeSkipIt</h2>

                        <div class="grow-content-features">
                            <span><img src="/ts/images/check-white.svg" alt="check-white" />High Quality Copy in Seconds</span>
                            <span><img src="/ts/images/check-white.svg" alt="check-white" />Generate Different Angles</span>
                            <span><img src="/ts/images/check-white.svg" alt="check-white" />Eliminate Writer's Block</span>
                        </div>
                        <div class="col-md-12 text-center mt-5 mb-3">
                            <a :href="route('register')" class="sm-btn white-btn ts-btn ts-effect grow-btn">Start Free Trial</a>
                        </div>
                        <p>P.S All this copy was written by TypeSkip</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Market"
    }
</script>

<style scoped>
    .grow-content span {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .grow-content-features {
        display: flex;
        justify-content: center;
    }
</style>
