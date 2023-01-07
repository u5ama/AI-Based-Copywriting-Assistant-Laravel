<template>
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
                                    <img class="icon-top" src="/ts/images/balloon.svg" alt="pricing-top-icon" />
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
                                            <img src="/ts/images/check-icon.svg" alt="check-icon" />
                                            <span class="text">All Content Templates</span>
                                        </li>
                                        <li>
                                            <img src="/ts/images/check-icon.svg" alt="check-icon" />
                                            <span class="text">Upto 25,000 words Generated</span>
                                        </li>
                                        <li>
                                            <img src="/ts/images/check-icon.svg" alt="check-icon" />
                                            <span class="text">Upto 10 User Seats</span>
                                        </li>
                                        <li>
                                            <img src="/ts/images/check-icon.svg" alt="check-icon" />
                                            <span class="text">Fully Mobile Responsive</span>
                                        </li>
                                        <li>
                                            <img src="/ts/images/check-icon.svg" alt="check-icon" />
                                            <span class="text">Same Day Support</span>
                                        </li>
                                        <li>
                                            <img src="/ts/images/check-icon.svg" alt="check-icon" />
                                            <span class="text">Early Access to New Features</span>
                                        </li>
                                    </ul>
                                </div>
                                <a :href="route('register')" class="lg-btn primary-btn ts-btn price-btn">Get Started</a>
                            </div>
                            <div class="price-card big topBottom">
                                <div class="d-fl">
                                    <img class="icon-top" src="/ts/images/rocket.svg" alt="pricing-top-icon" />
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
                                            <img src="/ts/images/check-icon.svg" alt="check-icon" />
                                            <span class="text">All Content Templates</span>
                                        </li>
                                        <li>
                                            <img src="/ts/images/check-icon.svg" alt="check-icon" />
                                            <span class="text">Upto 25,000 words Generated</span>
                                        </li>
                                        <li>
                                            <img src="/ts/images/check-icon.svg" alt="check-icon" />
                                            <span class="text">Upto 10 User Seats</span>
                                        </li>
                                        <li>
                                            <img src="/ts/images/check-icon.svg" alt="check-icon" />
                                            <span class="text">Fully Mobile Responsive</span>
                                        </li>
                                        <li>
                                            <img src="/ts/images/check-icon.svg" alt="check-icon" />
                                            <span class="text">Same Day Support</span>
                                        </li>
                                        <li>
                                            <img src="/ts/images/check-icon.svg" alt="check-icon" />
                                            <span class="text">Early Access to New Features</span>
                                        </li>
                                    </ul>
                                </div>
                                <a :href="route('register')" class="lg-btn primary-btn ts-btn price-btn">Get Started</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="line-shape">
        <img class="lineshape4" src="/ts/images/line_shape7.png" alt="shape image">
    </div>
</template>

<script>
    export default {
        name: "Pricing"
    }
</script>

<style scoped>

</style>
