<template>
    <div>
        <pay-with-stripe :popupType="popupType" price="250000"></pay-with-stripe>
        <!--======= Usage ========-->
        <div class="billing-bg usage-graph">
            <h2>Usage</h2>
            <p>Words Generated in your Account Last 7 Days</p>
            <div class="graph" id="chartContainer">
                <apexchart ref="realtimeChart" type="line" height="350" :options="chartOptions" :series="series"></apexchart>
            </div>
            <div class="graph-content pt-4">
                <h2>Credits</h2>
                <p>Current package <strong v-if="subscriptions.length">{{subscriptions[0].meta_data.plan.transform_usage.divide_by}}</strong>, and You've generated <strong>{{info.trail_quantity_usage}}</strong> words since last month.</p>
                <h2>Bonus Credits</h2>
                <p>Available Bonus words in your account <strong>{{info.trail_bonus}}</strong>, and You've generated <strong>{{info.trail_bonus_usage}}</strong> Bonus words since last month.</p>
            </div>
        </div>
        <!--======= Subscription ========-->
        <div class="billing-bg subscription mt-5">
            <h2>Subscription</h2>
            <div v-for="subscription in subscriptions" :key="subscription.id" class="subscription-details pt-3">
                <div class="payment-details">
                    <div class="payment-options">
                        <span class="tag">{{ subscription.meta_data.status }}</span>
                        <span class="notag">{{ subscription.meta_data.plan.nickname }}</span>
                        <span class="boxtag">Change</span>
                    </div>
                    <div class="payment-mode">
                        <span class="price">{{ subscription.meta_data.plan.transform_usage.divide_by }}</span> <span class="v-top">/month</span>
                    </div>
                </div>
                <div class="plan-wrapper">
                    <div class="progress-wrapper col-8">
                        <p class="progress-title" v-if="schedule_ended_at != ''">Downgrade Subscription Scheduled at <span>{{ schedule_ended_at }}</span></p>
                        <p class="progress-title" v-else>Re-new at <span>{{ getDateConverted(subscription.meta_data.current_period_end) }}</span></p>
                        <div class="progress">
                            <div id="workcarpb" class="progress-bar" data-emergence="visible"
                                 role="progressbar" aria-valuemin="0" aria-valuemax="100"
                                 style="width: 100%;">
                                <span class="sr-only"></span>
                            </div>
                        </div>
                    </div>
                    <div class="plan col-4">
                        <a href="#" data-toggle="modal" data-target="#modal-content-new" class="btn primary-btn ts-btn r-square-btn"  @click="popupType = 'subscription'">Upgrade Plan <img src="public/ts/images/icon-arrow-white.svg" width="20" class="ml-2"></a>
                        <p>Get words for cheaper</p>
                    </div>
                </div>
            </div>
        </div>

        <!--======= Card Info and preference ========-->
        <div class="billing-card-wrapper d-flex mt-5 row">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-12 col-md-12">
                        <div class="billing-bg billing-card-info" v-if="paymentMethods.length > 0">
                            <div class="card-info" v-for="(method, key) in paymentMethods" >
                                <div class="card-icon">
                                    <img src="public/ts/images/credit-card-color.png" alt="">
                                </div>
                                <div class="card-name">
                                    <h3>{{method.brand}}</h3>
                                    <div class="card-numbers">
                                        <span class="cred-number"><img src="public/ts/images/hidden-numbber.png" alt=""></span>
                                        <span class="cred-number"><img src="public/ts/images/hidden-numbber.png" alt=""></span>
                                        <span class="cred-number"><img src="public/ts/images/hidden-numbber.png" alt=""></span>
                                        <span class="cred-number">{{method.last_four}}</span>
                                    </div>
                                    <div class="card-person">
                                        <span>Expire on: {{method.exp_month}}/{{method.exp_year}} </span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-change">
                                <a href="#" data-toggle="modal" data-target="#modal-content-new" @click="popupType = 'card'" class="btn">change</a>
                            </div>
                        </div>
                        <div v-else  class="billing-bg billing-card-info flex flex-column" >
                            <h2>Please add payment method</h2>
                            <div class="payment-details">
                                <button data-toggle="modal" data-target="#modal-content-new"  @click="popupType = 'card'" class="btn primary-btn ts-btn">Add New</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12 col-md-12">
                        <div class="billing-bg billing-card-detail">
                            <h2>Current billing cycle ends on {{ended_at}}</h2>
                            <p>If I go over my plan limit for the month:</p>
                            <div class="payment-details">
                                <div class="dropdown">
                                    <div class="btn-group">
                                        <select class="form-select btn dropdown-toggle"  @change="addPreference($event)" v-model="upgrade_preference">
                                            <option :value="null" >Select one option</option>
                                            <option value="subscription">Upgrade account to the next tier</option>
                                            <option value="10000">One Time Purchase 10000 for 10$</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-12">
                                        <div class="console"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--======= Billing Details ========-->
        <div v-if="false" class="billing-bg billing-detail-wrapper mt-5">
            <h2>Billing details</h2>
            <p>This info will be included on your invoices</p>
            <div class="billing-form">
                <div class="form-group top-form">
                    <div class="col-md-6 col-12 form-group">
                        <label>Street</label>
                        <input class="form-control" type="text"/>
                    </div>
                    <div class="col-lg-4 col-md-5 col-12 offset-md-1 offset-lg-2 form-group">
                        <label>Country</label>
                        <div class="payment-details">
                            <div class="dropdown">
                                <div class="btn-group">
                                    <select class="form-select btn dropdown-toggle btn-height" aria-label="Default select example">
                                        <option selected> united states</option>
                                        <option value="1">India</option>
                                        <option value="2">Bangladesh</option>
                                    </select>
                                </div>
                                <div class="col-xs-12">
                                    <div class="console"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group middle-form">
                    <div class="col-md-3 col-12">
                        <label>City</label>
                        <input class="form-control" type="text"/>
                    </div>
                    <div class="col-md-3 col-12">
                        <label>Zip/Postal code</label>
                        <input class="form-control" type="text"/>
                    </div>
                    <div class="col-lg-4 col-md-5 col-12 offset-md-1 offset-lg-2">
                        <label>State/Province</label>
                        <input class="form-control" type="text"/>
                    </div>
                </div>
                <div class="form-group bottom-form">
                    <div class="col-md-6 col-12 form-group">
                        <label>Tax ID/VAT</label>
                        <input class="form-control" type="text"/>
                    </div>
                    <div class="col-lg-4 col-md-5 col-12 offset-md-1 offset-lg-2 form-group">
                        <label>State/Province</label>
                        <div class="payment-details">
                            <div class="dropdown">
                                <div class="btn-group">
                                    <select class="form-select btn dropdown-toggle btn-height" aria-label="Default select example">
                                        <option selected> United States (us_ein)</option>
                                        <option value="1">India</option>
                                        <option value="2">Bangladesh</option>
                                    </select>
                                    <div class="col-xs-12">
                                        <div class="console"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group bottom-form mt-0">
                    <div class="payment-cta col-12 mt-0">
                        <a href="#" class="btn primary-btn ts-btn r-square-btn">Save</a>
                    </div>
                </div>
            </div>
        </div>
        <!--======= Payment method ========-->
        <div v-if="false" class="row" style="margin-top: 3%;">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="header-title">Payment Method</h3>
                        <p class="text-muted font-20">Set your preferred method of payment</p>
                        <br>
                        <hr v-show="paymentMethodsLoadStatus == 2 && paymentMethods.length > 0" style="color: #0000004f;">
                        <!-- If there is a payment method stored -->
                        <div v-show="paymentMethodsLoadStatus == 2 && paymentMethods.length > 0" class="row" style="cursor: pointer;" v-for="(method, key) in paymentMethods"
                             v-bind:key="'method-'+key.id"
                             v-on:click="paymentMethodSelected = method.id"
                             v-bind:class="{'mycolor text-light': paymentMethodSelected == method.id}">
                            <div class="col-md-1" style="padding-top: 22px; margin-right: inherit;">
                                <i class="fa fa-cc-visa" style='font-size:25px; color: blueviolet;'></i>
                            </div>
                            <div class="col-md-9" style="margin-left: inherit;">
                                <ul style="margin-bottom: 2rem; margin-left: inherit;">
                                    <span style="font-size: 20px;font-weight:600;">{{ method.brand.charAt(0).toUpperCase() }}{{ method.brand.slice(1) }} ending with {{ method.last_four }}</span>
                                    <p class="text-muted font-20">Expire 7/2025 . Zipcode: 19104</p>
                                </ul>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-default" style="border-radius: 10px;border-color: #d1d1d1;margin-top: 12px; font-weight: 600;width: 80px;">Edit</button>
                            </div>
                        </div>

                        <hr v-show="paymentMethodsLoadStatus == 2 && paymentMethods.length == 0" style="color: #0000004f;">
                        <!-- If there's not any payment method saved for the user -->
                        <div v-show="paymentMethodsLoadStatus == 2 && paymentMethods.length == 0" style="margin-top: 10px;" class="row">
                            <form>
                                <div class="form-group mb-3">
                                    <label style="float: left;" for="inputNameOnCard">Name on Card
                                        <span class="text-danger font-weight-bold">*</span></label>
                                    <br>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="inputNameOnCard"
                                        aria-describedby="emailHelp"
                                        v-model="card_details.name_on_card"/>
                                    <div class="invalid-feedback">Name on Card is required!</div>
                                </div>
                                <div class="form-group mb-3">
                                    <label style="float: left;" for="card-element">Credit Card</label>
                                    <div id="card-element">
                                    </div>
                                </div>
                                <!-- Used to display form errors -->
                                <div id="card-errors" role="alert"></div>
                                <div class="form-group mb-0 text-center">
                                    <!-- <button type="button" :disabled="disableSubmitButton" class='pay-with-stripe btn btn-primary mb-3' style="background-color: #FE6161" @click='submitPaymentMethod()' value="Submit">{{saving ? "Submitting..." : "Submit"}}</button> -->
                                    <button class="btn btn-default"
                                            style="border-radius: 10px; border-color: #d1d1d1; margin-top: 12px; font-weight: 600;"
                                            :disabled="disableSubmitButton"
                                            type="button"
                                            @click='submitPaymentMethod()' value="Submit"
                                    >{{saving ? "Submitting..." : "Submit"}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- row end-->
    </div>
</template>
<script>

    import { Card } from 'vue-stripe-elements-plus'
    export default {
        components: { Card },
        props: ["info"],
        data() {
            return {
                stripeAPIToken: ['local','stagging','development'].includes(process.env.APP_ENV)  ?  process.env.MIX_STRIPE_STAGGING_KEY : process.env.MIX_STRIPE_KEY,
                popupType: 'subscription',
                stripe: '',
                elements: '',
                ended_at: '',
                schedule_ended_at: '',
                card: '',
                card_details: {
                    name_on_card: "",
                    stripeToken: '',
                    price: '',
                    intentToken: '',
                },
                selectedPlan: 'monthly',
                quantity: '',
                paymentMethodSelected: {},
                paymentMethods: [],
                subscriptions: [],
                addPaymentStatus: 0,
                addPaymentStatusError: '',
                paymentMethodsLoadStatus: 0,
                subscriptionLoadStatus: 0,
                saving: false,
                paying: false,
                complete: false,
                upgrade_preference: '',
                stripeOptions: {
                    // see https://stripe.com/docs/stripe.js#element-options for details
                },
                errors: null,
                notificationSystem: {
                    options: {
                        success: {
                            position: "topRight",
                            timeout: 3000,
                            class: 'success_notification'
                        },
                        error: {
                            position: "topRight",
                            timeout: 4000,
                            class: 'error_notification'
                        },
                        completed: {
                            position: 'center',
                            timeout: 1000,
                            class: 'complete_notification'
                        },
                        info: {
                            overlay: true,
                            zindex: 999,
                            position: 'center',
                            timeout: 3000,
                            class: 'info_notification',
                        }
                    }
                },
                series: [{
                    name: 'Words',
                    data: []
                }],
                chartOptions: {
                    chart: {
                        height: 350,
                        type: 'line',
                        toolbar: {
                            show: false,
                        },
                        zoom:{
                            enabled: false,
                        }
                    },
                    stroke: {
                        width: 7,
                        curve: 'smooth'
                    },
                    xaxis: {
                        type: 'datetime',
                        categories: [],
                        labels: {
                            formatter: function(value, timestamp, opts) {
                                return opts.dateFormatter(new Date(timestamp), ' dd MMM')
                            }
                        }
                    },
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shade: 'light',
                            shadeIntensity: 1,
                            opacityFrom: 0.7,
                            opacityTo: 0.9,
                            type: 'horizontal',
                            colorStops: [
                                {
                                    offset: 0,
                                    color: "#FDD835",
                                    opacity: 1
                                },{
                                    offset: 20,
                                    color: "#FFA41B",
                                    opacity: 1
                                }, {
                                    offset: 60,
                                    color: "#ffa406",
                                    opacity: 1
                                },{
                                    offset: 100,
                                    color: "#eb6e2d",
                                    opacity: 1
                                },
                            ]
                        },
                    },
                    markers: {
                        size: 4,
                        colors: ["#FFA41B"],
                        strokeColors: "#FFA41B",
                        strokeWidth: 0,
                        hover: {
                            size: 7,
                        }
                    },
                    theme: {
                        mode: 'light',
                        palette: 'palette1',
                        monochrome: {
                            enabled: false,
                            color: '#FDD835',
                            shadeTo: 'light',
                            shadeIntensity: 0
                        },
                    },
                    yaxis: {
                        show: false,

                        title: {
                            text: 'Words',
                        },
                    },
                    grid: {
                        xaxis: {
                            lines: {
                                show: false
                            }
                        },
                        yaxis: {
                            lines: {
                                show: false
                            }
                        }
                    }
                }
            }
        },

        mounted() {
            this.upgrade_preference = this.info.user.upgrade_preference;
            this.includeStripe('js.stripe.com/v3/', function(){
                this.configureStripe();
            }.bind(this) );
            this.loadIntent();
            this.loadPaymentMethods();
            this.getSubscription();
            this.updateSeriesLine();
            this.getScheduleSubscription();
        },
        methods: {
            updateSeriesLine() {
                this.$refs.realtimeChart.updateSeries([{
                    data: this.info.chart_quantities,
                }], false, true);
                this.chartOptions = {...this.chartOptions, ...{
                        xaxis: {
                            categories: this.info.chart_dates
                        }
                    }};
                },
            /*
                Uses the intent to submit a payment method
                to Stripe. Upon success, we save the payment
                method to our system to be used.
            */
            submitPaymentMethod(){
                this.addPaymentStatus = 1;
                this.stripe.confirmCardSetup(
                    this.card_details.intentToken.client_secret, {
                        payment_method: {
                            card: this.card,
                            billing_details: {
                                name: this.card_details.name_on_card
                            }
                        }
                    }
                ).then(function(result) {
                    if (result.error) {
                        this.addPaymentStatus = 3;
                        this.addPaymentStatusError = result.error.message;
                    } else {
                        this.savePaymentMethod( result.setupIntent.payment_method );
                        this.addPaymentStatus = 2;
                        this.card.clear();
                        this.name = '';
                    }
                }.bind(this));
            },
            updateSubscription(){
                this.paying = true
                axios.post(base_url + 'user/subscription', {
                    plan: this.selectedPlan,
                    payment: this.paymentMethodSelected,
                    quantity: this.quantity
                }).then( function( response ){
                    this.showMessage(response.data);
                    this.paying = false
                    $("#pay-with-card").modal("hide");
                }.bind(this))
                    .catch(err => {
                        if (err.response) {
                            this.errors = err.response.data.errors;
                            this.showMessage(err.response.data)
                        }
                    });
            },
            submit(token) {
                this.addPaymentStatus = 1;
                axios.post(base_url + "pay-with-stripe/" + token, this.card_details)
                    .then(response => {
                        this.savePaymentMethod( this.card_details.intentToken.payment_method );
                        this.card_details = {
                            name_on_card: '',
                            stripeToken: '',
                        };
                        this.errors = null;
                        this.showMessage(response.data)
                    })
                    .catch(err => {
                        if (err.response) {
                            this.errors = err.response.data.errors;
                            this.addPaymentStatus = 3;
                            this.addPaymentStatusError = err.response.data.error;
                            this.showMessage(err.response.data)
                        }
                    });
            },
            addPreference(event) {
                axios.post(base_url + "update/update_upgrade_preference" , {'update_upgrade_preference':event.target.value})
                    .then(response => {
                        this.showMessage(response.data);
                        this.upgrade_preference = event.target.value;
                    })
                    .catch(err => {
                        if (err.response) {
                            this.showMessage(err.response.data);
                        }
                    });
            },
            getSubscription() {
                axios.get(base_url + 'user/get-subscription')
                    .then( function( response ){
                        this.subscriptions = response.data;
                        this.subscriptionLoadStatus = 2;
                    }.bind(this));
            },
            getScheduleSubscription() {
                axios.get(base_url + 'user/get-schedule-subscription')
                    .then( function( response ){
                        if(response.data !== '') {
                            this.schedule_ended_at = this.getDateConverted(response.data);
                        }
                    }.bind(this));
            },
            /*
                Saves the payment method for the user and
                re-loads the payment methods.
            */
            savePaymentMethod( method ){
                this.saving = true
                axios.post(base_url + 'user/payments', {
                    payment_method: method
                }).then( function(){
                    this.loadPaymentMethods();
                    this.saving = false
                }.bind(this));
            },
            /*
                Includes Stripe.js dynamically
            */
            includeStripe( URL, callback ){
                var documentTag = document, tag = 'script',
                    object = documentTag.createElement(tag),
                    scriptTag = documentTag.getElementsByTagName(tag)[0];
                object.src = '//' + URL;
                if (callback) { object.addEventListener('load', function (e) { callback(null, e); }, false); }
                scriptTag.parentNode.insertBefore(object, scriptTag);
            },
            /*
                Configures Stripe by setting up the elements and
                creating the card element.
            */
            configureStripe(){
                this.stripe = Stripe( this.stripeAPIToken );

                this.elements = this.stripe.elements();
                // Create an instance of the card UI component
                this.card = this.elements.create('card');
                this.card.mount('#card-element');
            },
            /*
                Loads the payment intent key for the user to pay.
            */
            loadIntent(){
                axios.get(base_url + 'user/setup-intent')
                    .then( function( response ){
                        this.card_details.intentToken = response.data;
                    }.bind(this));
            },
            /*
                Loads all of the payment methods for the
                user.
            */
            loadPaymentMethods(){
                this.paymentMethodsLoadStatus = 1;
                axios.get(base_url + 'user/payment-methods')
                    .then( function( response ){
                        this.paymentMethods = response.data;
                        this.paymentMethodsLoadStatus = 2;
                    }.bind(this));
            },
            removePaymentMethod( paymentID ){
                axios.post(base_url + 'user/remove-payment', {
                    id: paymentID
                }).then( function( response ){
                    this.loadPaymentMethods();
                }.bind(this));
            },
            showMessage(data) {
                if (data.status  == "success") {
                    this.$toast.success(data.message, 'Success Alert', this.notificationSystem.options.success );
                } else {
                    this.$toast.error(data.message, "Error Alert", this.notificationSystem.options.error);
                }
            },
            formatDate(cdate,pattern) {
                var monthNames=["January", "February", "March", "April", "May", "June",
                    "July", "August", "September", "October", "November", "December"];

                var todayDate = new Date(cdate);
                var date = todayDate.getDate().toString();
                var month = todayDate.getMonth().toString();
                var year = todayDate.getFullYear().toString();
                var formattedMonth = (todayDate.getMonth() < 10) ? "0" + month : month;
                var formattedDay = (todayDate.getDate() < 10) ? "0" + date : date;
                var result = "";

                switch (pattern) {
                    case "M/d/yyyy":
                        formattedMonth = formattedMonth.indexOf("0") == 0 ? formattedMonth.substring(1, 2) : formattedMonth;
                        formattedDay = formattedDay.indexOf("0") == 0 ? formattedDay.substring(1, 2) : formattedDay;

                        result  = formattedMonth + '/' + formattedDay + '/' + year;
                        break;

                    case "M/d/yy":
                        formattedMonth = formattedMonth.indexOf("0") == 0 ? formattedMonth.substring(1, 2) : formattedMonth;
                        formattedDay = formattedDay.indexOf("0") == 0 ? formattedDay.substring(1, 2) : formattedDay;
                        result  = formattedMonth + '/' + formattedDay + '/' + year.substr(2);
                        break;

                    case "MM/dd/yy":
                        result  = formattedMonth + '/' + formattedDay + '/' + year.substr(2);
                        break;

                    case "MM/dd/yyyy":
                        result  = formattedMonth + '/' + formattedDay + '/' + year;
                        break;

                    case "yy/MM/dd":
                        result  = year.substr(2) + '/' + formattedMonth + '/' + formattedDay;
                        break;

                    case "yyyy-MM-dd":
                        result  = year + '-' + formattedMonth + '-' + formattedDay;
                        break;

                    case "dd-MMM-yy":
                        result  = formattedDay + '-' + monthNames[todayDate.getMonth()] + '-' + year.substr(2);
                        break;
                    case "MMM-dd":
                        result  = formattedDay + ' ' + monthNames[todayDate.getMonth()];
                        break;

                    case "MMMM d, yyyy":
                        result  = todayDate.toLocaleDateString("en-us", { day: 'numeric', month: 'long', year: 'numeric' });
                        break;
                }
                return result;
            },

            getDateConverted(data) {
                this.ended_at = this.formatDate(data * 1000,'MMM-dd');
                return this.ended_at;
                var date = new Date(data * 1000);
                var week = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
                var day  = week[today.getDay()];
                var dd   = today.getDate();
                var mm   = today.getMonth()+1; //January is 0!
                var yyyy = today.getFullYear();
                var hour = today.getHours();
                var minu = today.getMinutes();

                if(dd<10)  { dd='0'+dd }
                if(mm<10)  { mm='0'+mm }
                if(minu<10){ minu='0'+minu }

                return day+' - '+dd+'/'+mm+'/'+yyyy+' '+hour+':'+minu;

                //return now.toLocaleDateString();
                var day = date.getDate();
                var month = date.getMonth() + 1;
                var year = date.getFullYear();
                if (day < 10) {
                    day = "0" + day;
                }
                if (month < 10) {
                    month = "0" + month;
                }
                var date =  month + "/" + day + "/" + year;
                return date;
            },
        },

        // end of method section
        computed: {
            disableSubmitButton() {
                return this.saving ? true: false
            },
            disablePayButton() {
                return this.paying ? true: false
            }
        },
    };
</script>

<style scoped>
    .card {
        border: none;
        border-radius: 8px;
        box-shadow: 5px 6px 6px 2px #e9ecef
    }

    .heading {
        font-size: 23px;
        font-weight: 00
    }

    .text {
        font-size: 16px;
        font-weight: 500;
        color: #b1b6bd
    }

    .pricing {
        border: 2px solid #304FFE;
        background-color: #f2f5ff
    }

    .business {
        font-size: 20px;
        font-weight: 500
    }

    .plan {
        color: #aba4a4
    }

    .dollar {
        font-size: 16px;
        color: #6b6b6f
    }

    .amount {
        font-size: 50px;
        font-weight: 500
    }

    .year {
        font-size: 20px;
        color: #6b6b6f;
        margin-top: 19px
    }

    .detail {
        font-size: 22px;
        font-weight: 500
    }

    .cvv {
        height: 44px;
        width: 73px;
        border: 2px solid #eee
    }

    .cvv:focus {
        box-shadow: none;
        border: 2px solid #304FFE
    }

    .email-text {
        height: 55px;
        border: 2px solid #eee
    }

    .email-text:focus {
        box-shadow: none;
        border: 2px solid #304FFE
    }

    .payment-button {
        height: 70px;
        font-size: 20px
    }

    .mycolor {
        background: #aaf0d1 !important;
        color: darkgreen !important;
    }

    .mycolor span {
        color: darkgreen !important;
    }
</style>


