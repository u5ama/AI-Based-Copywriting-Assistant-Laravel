<template>
    <!--********************************************************
   Header
   /********************************************************-->
    <header id="myHeader">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg  navbar-light header_nav ">
                <a href="#" class="navbar-brand">
                    <img src="/ts/images/logo-typeskip.svg" alt="" class="main_logo" />
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div id="navbarCollapse" class="collapse navbar-collapse justify-content-center">
                    <div class="navbar-nav ml-auto action-buttons">
                        <a href="javascript:void(0)"
                           @click="logout" class="lg-btn primary-btn ts-btn logout-btn">Logout</a>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!--********************************************************
   Banner Section
   /********************************************************-->
    <div class="pricing-banner" id="app">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="pricing-text">
                        <h1>Pricing</h1>
                        <p>Start small and scale as you need.</p>
                        <div class="price-card">
                            <span class="badge badge-pill badge-primary">Starter</span>
                            <div class="amount">
                                <span class="number">$29</span>
                                <sup class="static-month">/Mo</sup>
                            </div>
                            <p>Access to all template for generating high quality content</p>
                            <div class="services-list">
                                <ul>
                                    <li>
                                        <img src="/ts/images/pricing/right.svg" alt="check-icon">
                                        <span class="text">All Content Templates</span>
                                    </li>
                                    <li>
                                        <img src="/ts/images/pricing/right.svg" alt="check-icon">
                                        <span class="text">Upto 25,000 words Generated</span>
                                    </li>
                                    <li>
                                        <img src="/ts/images/pricing/right.svg" alt="check-icon">
                                        <span class="text">Upto 10 User Seats</span>
                                    </li>
                                    <li>
                                        <img src="/ts/images/pricing/right.svg" alt="check-icon">
                                        <span class="text">Fully Mobile Responsive</span>
                                    </li>
                                    <li>
                                        <img src="/ts/images/pricing/right.svg" alt="check-icon">
                                        <span class="text">Same Day Support</span>
                                    </li>
                                    <li>
                                        <img src="/ts/images/pricing/right.svg" alt="check-icon">
                                        <span class="text">Early Access to New Features</span>
                                    </li>
                                </ul>
                            </div>
                            <a href="#" data-toggle="modal" data-target="#modal-content-new" class="lg-btn primary-btn ts-btn r-square-btn">Start Now</a>
                            <span class="price-note">7-day 100% money back guarantee</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-content-new" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered pricing-popup" :class="popupType == 'card'?'billing-popup':''" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="mdl-close">
                            <a href="#" data-toggle="modal" data-target="#modal-content-new" > <img src="/ts/images/round-close.svg"></a>
                        </div>
                    </div>
                    <div class="modal-body">
                        <PayWithStripe popupType="subscription" :newuser="true" price="250000" :stripeKey="stripeKey"></PayWithStripe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--********************************************************
   FAQ Section
   /********************************************************-->
    <section class="blue-bg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="faq-name faq-title">Frequently asked questions</h2>
                </div>
            </div>
        </div>
    </section>
    <section class="faq-info">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="faq-qa">
                        <div class="faq-item">
                            <h3>How are word credits calculated?</h3>
                            <p>Word credits are calculated by counting each word that is generated by the TypeSkip app.</p>
                        </div>
                        <div class="faq-item">
                            <h3>How do I get more credits?</h3>
                            <p>You have the option to increase your monthly budget for word credits at any time.</p>
                        </div>
                        <div class="faq-item">
                            <h3>What if I go over my monthly plan budget for word credits?</h3>
                            <p>If your account goes over your monthly budget for word credits you will be charged for overages at $10 per 10,000 words.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import PayWithStripe from "@/components/PayWithStripe";

export default {
    props:['stripeKey'],
    components: {
        Head,
        Link,
        PayWithStripe
    },
    name: "Pricing",
    data() {
        return {
            logoutForm: this.$inertia.form({
                _method: "POST",
            }),
        }
    },
    methods: {
        logout() {
            this.logoutForm = this.$inertia.form();
            this.logoutForm.post("/logout");
        },
    }
}
</script>
