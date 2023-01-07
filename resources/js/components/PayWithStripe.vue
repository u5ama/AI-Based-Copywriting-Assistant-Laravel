<template>
    <div>
        <!----subscription popup ---->
            <form role="dialog" id="request-template-form-1" action="#" aria-modal="true" aria-labelledby="modal-headline" class="p-6 overflow-hidden transition-all transform bg-white rounded-lg shadow-xl pointer-events-auto sm:w-full sm:p-6">
                <div class="w-full text-center">
                    <div class="top" v-if="newuser">
                        <h2>Start your 7-day free trial now!</h2>
                        <p>We don't charge you today. Your card will be charged on {{dateAfter7days()}} after your 7 day free trial ends.</p>
                    </div>

                    <div class="payment-wrapper">
                        <div class="payment-method" :class="popupType == 'card'?'col-md-12 col-12':'col-md-6 col-12'">
                            <span>Payment Method</span>
                            <div class="payment-details-wrapper bg-white">
                                <div class="payment-details">
                                    <div class="payment-options">
                                        <span>Credit or Debit Card</span>
                                    </div>
                                    <div class="payment-mode">
                                        <ul>
                                            <li><a href="#"><img src="/ts/images/pricing/visa.svg" alt=""></a></li>
                                            <li><a href="#"><img src="/ts/images/pricing/mastercard.svg" alt=""></a></li>
                                            <li><a href="#"><img src="/ts/images/pricing/discover.svg" alt=""></a></li>
                                            <li><a href="#"><img src="/ts/images/pricing/american-express.svg" alt=""></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div v-if="!paymentMethods.length">
                                    <div class="payment-info">
                                        <h3>Credit Card Info</h3>
                                        <p>Set your preferred method of payment</p>
                                    </div>
                                    <div id="card-element" class="card-class">
                                    </div>
                                    <!-- Used to display Element errors. -->
                                    <div id="card-errors" role="alert"></div>
                                    <div class="payment-cta">
                                        <button type="button" class='btn primary-btn ts-btn r-square-btn' @click='submitPaymentMethod()' value="Submit">{{saving ? "Submitting..." : "Submit"}}</button>
                                    </div>
                                </div>
                                <div v-if="paymentMethods.length">
                                    <div class="payment-info">
                                        <h3>Credit Card Info</h3>
                                        <p>Your preferred method of payment</p>
                                    </div>
                                    <div>
                                        <div class="d-flex flex-column rounded text-light text-left px-2 payment-card payment-card-m r-square-btn">
                                            <a href="#" @click="removePaymentMethod( paymentMethods[0].id )" class="remove-card-btn" > <img src="/ts/images/round-close.svg"></a>
                                            <p class="business">
                                                {{ paymentMethods[0].brand.charAt(0).toUpperCase() }}{{ paymentMethods[0].brand.slice(1) }}
                                              <br>  XXXX XXXX XXXX {{ paymentMethods[0].last_four }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="payment-cta" v-if="false">
                                        <button type="button" :disabled="disableSubmitButton" class='btn primary-btn ts-btn r-square-btn' @click='submitPaymentMethod()' value="Submit">{{saving ? "Submitting..." : "Add New Card"}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div v-if="popupType == 'subscription'" class="payment-method summary col-md-6 col-12">
                            <span>Summary</span>
                            <div class="payment-details-wrapper">
                                <div v-if="newuser">
                                    <div class="payment-details" v-if="defaultPackage">
                                        <div class="payment-options">
                                            <span class="tag">Starter</span>
                                        </div>
                                        <div class="payment-mode">
                                            <span class="price">25,000</span> <span>/mo</span>
                                        </div>
                                    </div>
                                    <div class="payment-details" v-else>
                                        <div class="dropdown" >
                                            <div class="btn-group" v-if="subscriptions.length">
                                                <select class="form-select btn dropdown-toggle" @change="selectPlan($event)">
                                                    <option v-for="pack in packages" :value="pack.wordCount" >{{pack.name}}</option>
                                                </select>
                                            </div>
                                            <div class="btn-group" v-else>
                                                <select class="form-select btn dropdown-toggle" @change="selectPlan($event)">
                                                    <option v-for="pack in packages" :value="pack.wordCount" >{{pack.name}}</option>
                                                </select>
                                            </div>
                                            <div class="col-xs-12">
                                                <div class="console"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div v-else >
                                    <div  v-if="defaultPackage">
                                        <div class="payment-details" v-if="subscriptions.length">
                                            <div class="payment-options">
                                                <span class="tag">{{ subscriptions[0].meta_data.plan.nickname }} ({{ subscriptions[0].meta_data.status }})</span>
                                            </div>
                                            <div class="payment-mode">
                                                <span class="price">{{subscriptions[0].meta_data.plan.transform_usage.divide_by}}</span> <span>/mo</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div v-else>
                                        <div v-if="subscriptions.length">
                                            <div class="payment-options mb-1" style="text-align: left;padding: 0 20px;">
                                                <span class="tag">{{ subscriptions[0].meta_data.plan.nickname }} ({{ subscriptions[0].meta_data.status }})</span>
                                            </div>
                                        </div>
                                        <div class="payment-details" >
                                            <div class="dropdown" >
                                                <div class="btn-group" v-if="subscriptions.length">
                                                    <select class="form-select btn dropdown-toggle" @change="selectPlan($event)">
                                                        <option v-for="pack in packages" :value="pack.wordCount" >{{pack.name}}</option>
                                                    </select>
                                                </div>
                                                <div class="btn-group" v-else>
                                                    <select class="form-select btn dropdown-toggle" @change="selectPlan($event)">
                                                        <option v-for="pack in packages" :value="pack.wordCount" >{{pack.name}}</option>
                                                    </select>
                                                </div>
                                                <div class="col-xs-12">
                                                    <div class="console"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="payment-details" v-else>
                                    <div class="dropdown" >
                                        <div class="btn-group" v-if="subscriptions.length">
                                            <select class="form-select btn dropdown-toggle" @change="selectPlan($event)">
                                                <option v-for="pack in packages" :value="pack.wordCount" >{{pack.name}}</option>
                                            </select>
                                        </div>
                                        <div class="btn-group" v-else>
                                            <select class="form-select btn dropdown-toggle" @change="selectPlan($event)">
                                                <option v-for="pack in packages" :value="pack.wordCount" >{{pack.name}}</option>
                                            </select>
                                        </div>
                                        <div class="col-xs-12">
                                            <div class="console"></div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#" v-if="!defaultPackage" class="payment-text" v-on:click="defaultPackage = true ,can_show_have_promo_code = false , can_show_today_price = false, can_show_submit = false">
                                    <span>Goto Cheaper plan</span>
                                </a>
                                <div class="payment-info" v-if="subscriptions.length && can_show_today_price" >
                                    <div  v-if="newuser" class="payment-info">
                                        <h3>Today you pay (US  dollars)</h3>
                                        <span>$0</span>
                                    </div>
                                    <div v-else style="width: 100%;">
                                        <div class="payment-info">
                                            <h3>Upgraded Plan (US  dollars)</h3>
                                            <span class="upgraded_plan_price">{{upgraded_plan_price + '$'}}</span>
                                        </div>
                                        <div class="payment-info">
                                            <h3>Current Plan (US  dollars)</h3>
                                            <span class="current_plan_price">{{parseFloat(subscriptions[0].meta_data.plan.amount)/100 + '$'}}</span>
                                        </div>
                                        <div class="payment-info">
                                            <h3>Today you pay (US  dollars)</h3>
                                            <span class="today_plan_price">{{today_plan_price + '$'}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div  v-if="newuser" class="payment-time">
                                    <p v-if="!defaultPackage">After 7 days: {{selectedPackageObj.price}}</p>
                                    <p v-else>After 7 days: 29$</p>
                                </div>
                                <div v-if="havePromoCode" class="mx-3 text-left mt-2">
                                    <input class="form-control" placeholder="Promo Code" type="text" v-model="promoCode">
                                </div>
                                <a href="#" v-if="!havePromoCode && can_show_have_promo_code" v-on:click="havePromoCode = !havePromoCode" class="promo">Have a promo code?</a>
                                <a href="#" v-if="!havePromoCode && newuser" v-on:click="havePromoCode = !havePromoCode" class="promo">Have a promo code?</a>
                                <a href="#" v-if="havePromoCode" v-on:click="havePromoCode = !havePromoCode" class="promo">Don't have promo code?</a>
                                <div class="payment-cta" v-if="newuser">
                                    <a href="#" class="btn primary-btn ts-btn r-square-btn" :disabled="disablePayButton" value="Submit" @click='updateSubscriptionNew()'>{{paying ? "Submitting..." : "Try it free for 7 days"}}</a>
                                </div>
                                <div v-if="can_show_submit">
                                    <div class="payment-cta" >
                                        <a href="#" class="btn primary-btn ts-btn r-square-btn" :disabled="disablePayButton" value="Submit" @click='updateSubscriptionNew()'>{{paying ? "Submitting..." : "Submit"}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
</template>
<script>

import { defineComponent } from "vue";
// import { EventBus } from "../vue-asset";
import { loadStripe } from "@stripe/stripe-js";
import { Card, createToken } from 'vue-stripe-elements-plus'
import { useToast, POSITION } from "vue-toastification";

export default defineComponent({
    setup() {
        // Get toast interface
        const toast = useToast();
        // or with options
        toast.success("My toast content", {
            timeout: 2000,
            position: 'top'
        });
        // These options will override the options defined in the "app.use" plugin registration for this specific toast
        // Make it available inside methods
        return { toast }
    },
    props: {
        'price':{
            type: String,
            default: '250000',
        },newuser:{
            type: Boolean,
            default: false,
        },popupType:{
            type: String,
            default: 'subscription',
        }
    },
    components: { Card },

    data() {
        return {
            subscriptions:[],
            packages:[],
            havePromoCode:false,
            promoCode:'',
            selectedPackage:'25000',
            selectedPackageObj:{},
            defaultPackage: true,
            stripeAPIToken:  ['local','stagging','development'].includes(process.env.APP_ENV)  ?  process.env.MIX_STRIPE_STAGGING_KEY : process.env.MIX_STRIPE_KEY,
            stripe: '',
            elements: '',
            card: '',
            card_details: {
                name_on_card: "default",
                stripeToken: '',
                price: '',
                intentToken: '',
            },
            form: this.$inertia.form({
                _method: "POST",
            }),
            paymentProcessing: false,
            selectedPlan: 'monthly',
            plan_id: '',
            quantity: '',
            paymentMethodSelected: {},
            paymentMethods: [],
            addPaymentStatus: 0,
            upgraded_plan_price: 0,
            today_plan_price: 0,
            current_plan_price: 0,
            addPaymentStatusError: '',
            paymentMethodsLoadStatus: 0,
            saving: false,
            paying: false,
            complete: false,
            stripeOptions: {
                // see https://stripe.com/docs/stripe.js#element-options for details
            },
            can_show_today_price: false,
            can_show_submit: false,
            can_show_have_promo_code: false,
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
        }
    },
     mounted() {
        this.includeStripe('js.stripe.com/v3/', function(){
            this.configureStripe();
        }.bind(this) );
        this.loadIntent();
        this.loadPaymentMethods();
        this.getSubscription();
        this.getPlan();
    },
    // end of method section

    created() {
        this.card_details.price = this.price
    },
  methods: {
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
            var displayError = document.getElementById('card-errors');
            if (result.error) {
                displayError.textContent = result.error.message;
                this.addPaymentStatus = 3;
                this.addPaymentStatusError = result.error.message;
            } else {
                displayError.textContent = '';
                this.savePaymentMethod( result.setupIntent.payment_method );
                this.addPaymentStatus = 2;
                this.card.clear();
                this.name = '';
            }
        }.bind(this));
    },
/*        updateSubscription(){
            this.paying = true
            axios.post(base_url + 'user/subscription', {
                plan: this.selectedPlan,
                payment: this.paymentMethodSelected,
                quantity: this.quantity
            }).then( function( response ){
                this.showMessage(response.data);
                this.paying = false
                $("#pay-with-card").modal("hide");
                window.setTimeout(function(){window.location.href = base_url + 'template';},3000)
            }.bind(this))
            .catch(err => {
                if (err.response) {
                    this.errors = err.response.data.errors;
                    this.showMessage(err.response.data)
                }
            });
        },*/

        updateSubscriptionNew(){
            if(!this.paymentMethods.length){
                this.showMessage({status:'fail',message:'Please add payment method first.'})
                return false
            }
            // if(this.havePromoCode && this.promoCode == ''){
            //     this.showMessage({status:'failed',message:'Please add add promo code'})
            //     return false
            // }
            this.paying = true
            axios.post(base_url + 'subscription/create', {
                plan: this.selectedPlan,
                plan_id: this.plan_id,
                payment: this.paymentMethods[0].id,
                quantity: this.selectedPackage,
                promocode: this.promoCode
            }).then( function( response ){
                // this.showMessage(response.data);
                this.paying = false
                $("#pay-with-card").modal("hide");
                if (this.newuser)
                    window.setTimeout(function(){window.location.href = base_url + 'app';},3000)
                else
                    window.setTimeout(function(){location.reload();},3000)
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
                 //window.location.href = base_url + 'template';
                })
                .catch(err => {
                if (err.response) {
                    this.errors = err.response.data.errors;
                    this.addPaymentStatus = 3;
                    this.addPaymentStatusError = err.response.data.error;
                    this.showMessage(err.response.data)
                    //this.$toast.error('Something Went Wrong', 'Error', { timeout: 3000 } );
                }
            });
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

            // Handle real-time validation errors from the card Element.
            this.card.addEventListener('change', function(event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });
        },

        /*
            Loads the payment intent key for the user to pay.
        */
        loadIntent(){
            axios.get(base_url + 'user/setup-intent')
                .then( function( response ){
                    console.log(response);
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
                this.toast.success("Card Removed Successfully!", {
                    position: POSITION.TOP_CENTER
                })
                window.setTimeout(function(){location.reload();},3000)

            }.bind(this));
        },

        showMessage(data) {
            if (data.status  == "success") {
                this.$toast.success(data.message, 'Success Alert', this.notificationSystem.options.success );
            } else {
                this.$toast.error(data.message, "Error Alert", this.notificationSystem.options.error);
            }
        },
        selectPlan(event) {

            this.selectedPackage =  event.target.value;
            let selectedPackageObj = this.packages.filter(i => i.wordCount === parseInt(this.selectedPackage));
            this.selectedPackageObj = selectedPackageObj[0];
            this.current_plan_price = (this.subscriptions[0].meta_data.plan.amount) /100;
            this.plan_id = selectedPackageObj[0]['id'];
            this.upgraded_plan_price = selectedPackageObj[0]['price'].split("$")[0];

            if(this.upgraded_plan_price > this.current_plan_price) {
                this.today_plan_price = parseFloat(this.upgraded_plan_price) - parseFloat(this.current_plan_price);
                this.can_show_today_price = true;
            } else {
                this.can_show_today_price = false;
            }

            if(this.upgraded_plan_price != this.current_plan_price) {
                this.can_show_submit = true;
                this.can_show_have_promo_code = true;
            } else {
                this.can_show_submit = false;
                this.can_show_have_promo_code = false;
            }
        },
        dateAfter7days() {
            var date = new Date();
            date.setDate(date.getDate() + 7);
            const month = date.toLocaleString('default', { month: 'long' });
            return month+' '+date.getDate()+','+date.getFullYear();
        },
        getSubscription() {
              axios.get(base_url + 'user/get-subscription')
                  .then( function( response ){
                      this.subscriptions = response.data;
                  }.bind(this));
        },
        getPlan() {
              axios.get(base_url + 'user/get-plans')
                  .then( function( response ){
                      this.packages = response.data;
                      let packages = response.data;
                      packages.sort((a, b) => a.wordCount - b.wordCount);
                      this.selectedPackageObj = packages[1];
                      this.plan_id = packages[1].id;
                  }.bind(this));
        },
  },
  computed: {

    disableSubmitButton() {
      return this.saving ? true: false
    },

    disablePayButton() {
      return this.paying ? true: false
    }

  },
});
</script>

<style scoped>
    .card-p {
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
        background: #fe5858;
    }

    .mycolor span {
        color: white;
    }
    .remove-card-btn img{
        width: 20px;
        height: 20px;
        position: absolute;
        right: 15px;
        top: 15px;
    }
    .card-class{
        border: 1px solid #FC5503;border-radius: 5px;padding:10px
    }
</style>
