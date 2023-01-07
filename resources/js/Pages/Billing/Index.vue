<template>
    <type-skip-layout :tools="[]">
        <section class="billing-banner bg-light">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 mt-2">
                        <div class="alert alert-primary alert-dismissible fade show" role="alert" v-if="$page.props.flash.message">
                            {{ $page.props.flash.message }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    <!-- New User Message-->
                    <div class="modal" id="request_template" tabindex="-1" role="dialog" v-if="!userSubscriptionsPlane">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-body ts-radius ts-form p-4 w-full">
                                        <div class="w-full text-left">
                                            <div class="auth-logo mb-2"> Welcome to Typeskip </div>
                                            <p class="text-sm font-medium text-gray-500">
                                                Access to all template for generating high quality content
                                            </p>
                                                <ul style="display: inline;">
                                                    <li>
                                                        <img src="/ts/images/pricing/right.svg" alt="check-icon" class="img-check">
                                                        <span class="text">All Content Templates</span>
                                                    </li>
                                                    <li>
                                                        <img src="/ts/images/pricing/right.svg" alt="check-icon" class="img-check">
                                                        <span class="text">Upto 25,000 words Generated</span>
                                                    </li>
                                                    <li>
                                                        <img src="/ts/images/pricing/right.svg" alt="check-icon" class="img-check">
                                                        <span class="text">Upto 10 User Seats</span>
                                                    </li>
                                                    <li>
                                                        <img src="/ts/images/pricing/right.svg" alt="check-icon" class="img-check">
                                                        <span class="text">Fully Mobile Responsive</span>
                                                    </li>
                                                    <li>
                                                        <img src="/ts/images/pricing/right.svg" alt="check-icon" class="img-check">
                                                        <span class="text">Same Day Support</span>
                                                    </li>
                                                    <li>
                                                        <img src="/ts/images/pricing/right.svg" alt="check-icon" class="img-check">
                                                        <span class="text">Early Access to New Features</span>
                                                    </li>
                                                </ul>
                                            <div class="auth-logo mt-2 mb-0"> To Avail this Offer; Add a payment method & Create Subscription! </div>
                                        </div>
                                        <div class="textbox-margin text-right w-full">
                                            <button type="button" class="btn ts-f-btn-white" data-dismiss="modal" aria-label="Close" id="close">Okay!</button>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- New User Message-->
                    <div class="col-12">
                        <h1>Billing and Plans</h1>
                    </div>
                    <div class="billing-tabs col-12 p-0">
                        <ul class="nav nav-tabs" id="myTab">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#UsageandBilling">Usage & Billing</a>
                            </li>
                        </ul>
                        <div class="tab-content col-12 pt-3" id="myTabContent">
                            <div class="tab-pane fade active show usage-billing-wrapper" id="UsageandBilling">
                                <!-- User uses statistic -->
                                <usage-stats :statsDates="statsDates" :statsWordCounts="statsWordCounts" :userSubscriptionsPlane="userSubscriptionsPlane" :paymentMethods="paymentMethods" :trail_quantity_usage="trail_quantity_usage"></usage-stats>
                                <!-- User payment methods -->
                                <my-payment-methods :stripeKey="stripeKey" :paymentMethods="paymentMethods" :allPlans="allPlans" :oneTimePlans="oneTimePlans" :userSubscriptionsPlane="userSubscriptionsPlane" :userPreference="userPreference"></my-payment-methods>
                                <!-- User invoices methods -->
                                <invoice-component :invoices="invoices" :upcomingInvoice="upcomingInvoice"></invoice-component>
                                <div class="billing-bg cancle-account mt-5 mb-5">
                                    <h2>Cancel account</h2>
                                    <p>We are working on adding self cancellation and it should be ready by early next week. In the mean time if you would like to close your account and delete all content + remaining Credits please send us an email at <a href="mailto:basil@typeskip.ai">basil@typeskip.ai</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </type-skip-layout>
</template>
<script>
import { defineComponent } from 'vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import TypeSkipLayout from "@/Layouts/TypeSkipLayout";
import UsageStats from "@/Pages/Partials/Billing/UsageStats";
import MyPaymentMethods from "@/Pages/Partials/Billing/MyPaymentMethods";
import InvoiceComponent from "@/Pages/Partials/Billing/InvoiceComponent";
import PricingComponent from "@/Pages/Billing/Pricing";

export default defineComponent( {
    name: "App",
    props:['contentTools', 'statsDates', 'statsWordCounts', 'stripeKey', 'paymentMethods','allPlans','oneTimePlans','userSubscriptionsPlane','invoices',"upcomingInvoice",'userPreference','trail_quantity_usage'],
    components: {
        Head,
        Link,
        TypeSkipLayout,
        UsageStats,
        MyPaymentMethods,
        InvoiceComponent,
        PricingComponent,
    },
    data() {
        return {
            searchTool: '',
            show_sidebar:false,
            showPriceComponent:false,
        }
    },
    mounted() {
        this.openModal();
    },
    methods:{
        openModal () {
            if(!this.userSubscriptionsPlane){
                // $('#request_template').modal('show')
            }
        },
    }
})
</script>

<style scoped>
body{
    background-color:#f5f5f5;
}
.card{
    margin-left: 15%;
    margin-right: 15%;
}
.card-body{
    padding: 28px;
}
hr.line{
    color: #0000004f;
    margin-top: -25px;
    margin-left: 30px;
    margin-right: 30px;
}
.row1 {
    border-style: solid 2px;
    border-color: #d1d1d1;
    padding-left: 36px;
    padding-top: 12px;
}
.active1{
    width: 65px;
    padding: 7px;
    font-size: medium;
    background-color: #aaf0d1 !important;
    color: darkgreen !important;
}
.number{
    color: #0000004f;
    margin-top: -2px;
    width: 18%;
}
.img-check{
    display: inline;
    margin-right: 10px;
    margin-bottom: 10px;
}
</style>
