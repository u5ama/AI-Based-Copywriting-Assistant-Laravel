<template>
  <div class="row">
      <div class="col-md-12">
          <subscription-compornent :allPlans="allPlans" :oneTimePlans="oneTimePlans" :userSubscriptionsPlane="userSubscriptionsPlane"  ></subscription-compornent>
      </div>
  </div>
    <div class="row" id="pay">
      <div class="col-md-6">
          <!--======= Payment methods ========-->
          <div class="billing-bg usage-graph">
            <h2>Payment methods</h2>
            <p v-if="paymentMethods.length > 0">Your payment methods and active card</p>
            <p style="color: red;" v-if="paymentMethods.length === 0">No Payment Method Added</p>
            <div class="payment-info" v-if="paymentMethods.length > 0">
              <div class="row">
                <div class="col-md-10">
                  <div class="payment-info-single mb-3"
                    v-for="paymentMethod in paymentMethods"
                    :key="paymentMethod.key">
                    <div class="card-info-dettail">
                      <h1>**** **** **** {{ paymentMethod.card.last4 }}</h1>
                      <p>{{ paymentMethod.card.brand }}</p>
                    </div>
                    <div class="make-default-btn">
                      <input
                        type="radio"
                        name="defaultcard"
                        v-on:change="UpdatedefaultMethode(paymentMethod)"
                        :checked="$page.props.user.card_last_four == paymentMethod.card.last4"/>
                      <button class="btn ml-1 payMethode-delete-btn" @click="deletePayMethode(paymentMethod)">
                         <svg
                          id="fi-rr-trash"
                          xmlns="http://www.w3.org/2000/svg"
                          width="22.012"
                          height="26.414"
                          viewBox="0 0 22.012 26.414">
                          <path
                            id="Path_150"
                            data-name="Path 150"
                            d="M22.911,4.4H19.5A5.513,5.513,0,0,0,14.107,0h-2.2A5.513,5.513,0,0,0,6.512,4.4H3.1a1.1,1.1,0,0,0,0,2.2H4.2V20.911a5.51,5.51,0,0,0,5.5,5.5h6.6a5.51,5.51,0,0,0,5.5-5.5V6.6h1.1a1.1,1.1,0,0,0,0-2.2ZM11.905,2.2h2.2A3.308,3.308,0,0,1,17.22,4.4H8.792a3.308,3.308,0,0,1,3.114-2.2Zm7.7,18.71a3.3,3.3,0,0,1-3.3,3.3H9.7a3.3,3.3,0,0,1-3.3-3.3V6.6H19.61Z"
                            transform="translate(-2)"></path>
                          <path
                            id="Path_151"
                            data-name="Path 151"
                            d="M10.1,18.8a1.1,1.1,0,0,0,1.1-1.1V11.1a1.1,1.1,0,0,0-2.2,0v6.6A1.1,1.1,0,0,0,10.1,18.8Z"
                            transform="translate(-1.296 1.006)"></path>
                          <path
                            id="Path_152"
                            data-name="Path 152"
                            d="M14.1,18.8a1.1,1.1,0,0,0,1.1-1.1V11.1a1.1,1.1,0,0,0-2.2,0v6.6A1.1,1.1,0,0,0,14.1,18.8Z"
                            transform="translate(-0.893 1.006)"></path>
                        </svg>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="graph-content">
              <div class="payment-details">
                <button data-toggle="modal" data-target="#modal-content-new" class="btn primary-btn ts-btn">Add New</button>
                <div class="modal fade" id="modal-content-new" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-lg modal-dialog-centered">
                      <div class="modal-body">
                          <div class="mdl-close">
                              <a href="#" data-toggle="modal" data-target="#modal-content-new">
                                  <img src="ts/images/round-close.svg">
                              </a>
                          </div>
                      </div>
                    <div class="modal-content">
                      <div class="payment-wrapper">
                        <div class="payment-method col-md-12 col-12">
                          <div class="payment-details-wrapper bg-white mt-lg-2">
                            <!-- <div class="payment-details"> -->
                            <div>
                                <div class="payment-details">
                                    <div class="payment-options">
                                        <span>Credit or Debit Card</span>
                                    </div>
                                    <div class="payment-mode">
                                        <ul>
                                            <li>
                                                <a>
                                                    <img src="ts/images/pricing/visa.svg" alt="">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="ts/images/pricing/mastercard.svg" alt="">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="ts/images/pricing/discover.svg" alt="">
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img src="ts/images/pricing/american-express.svg" alt="">
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                              <div class="payment-options">
                                <div id="card-element"></div>
                                <div class="payment-cta">
                                  <button class="btn primary-btn ts-btn r-square-btn mt-2" @click="processPayment" :disabled="paymentProcessing" v-text="paymentProcessing ? 'Processing' : 'Add Card'"></button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
        <div class="col-md-6">
            <div class="billing-bg usage-graph">
                <div class="change-subscription-plane">
                    <h2>Current billing cycle ends on {{ getDate(userSubscriptionsPlane.current_period_end) }}</h2>
                    <p>If I go over my plan limit for the month:</p>
                    <div class="payment-details">
                        <div class="dropdown">
                            <div class="btn-group">
                                <select name="upgrade_preference" class="form-select btn dropdown-toggle" v-model="upgradePreferance" @change="updateupgradePref">
                                    <option value="">Select one option</option>
                                    <option value="subscription">Upgrade account to the next tier</option>
                                    <option value="10000">One Time Purchase 10000 for 10$</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import { loadStripe } from "@stripe/stripe-js";
import Swal from "sweetalert2";
import SubscriptionCompornent from "./SubscriptionCompornent.vue";
import moment from 'moment';
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
  name: "MyPaymentMethods",
  props: ["stripeKey", "paymentMethods",'allPlans','oneTimePlans','userSubscriptionsPlane','userPreference'],
  components: {
    Head,
    Link,
    SubscriptionCompornent,
  },
  data() {
    return {
      form_data: {},
      stripe: {},
      cardElement: {},
      upgradePreferance: this.userPreference ? this.userPreference : '',
      form: this.$inertia.form({
        _method: "POST",
      }),
      paymentProcessing: false,
    };
  },
    created() {
        this.upgradePaymentInfoShow = false;
    },
  async mounted() {
    this.stripe = await loadStripe(this.stripeKey);
    const elements = this.stripe.elements();
    this.cardElement = elements.create("card", {
      classes: {
        base: "bg-white-100 rounded border border-gray-300 focus:border-indigo-500 text-base outline-none text-gray-700 p-3 leading-8 transition-colors duration-200 ease-in-out mt-2",
      },
    });
    this.cardElement.mount("#card-element");
  },
  methods: {
      getDate(date) {
          return moment.unix(date).format('ll');
      },
      updateupgradePref() {
           this.form = this.$inertia.form({
                upgradePreference: this.upgradePreferance,
          });
          this.form.post(this.route("subscription-upgrade-pref"), {
              onFinish: () =>this.toast.success("Preference updated Successfully!", {
                  position: POSITION.TOP_CENTER
              })
          });
      },
    // function for add payment methode
    async processPayment() {
      this.paymentProcessing = true;
      const { paymentMethod, error } = await this.stripe.createPaymentMethod(
        "card",
        this.cardElement
      );
      if (error) {
        this.paymentProcessing = false;
        console.error(error.message);
      } else {
        // TODO: if everything success from payment form
        // console.log(paymentMethod);

        this.form_data = paymentMethod;
        this.form = this.$inertia.form(this.form_data);
        const tt = this;
        this.form.post(this.route("add-card"), {
            onFinish: () =>this.toast.success("Payment Method Added Successfully!", {
                position: POSITION.TOP_CENTER
            })
        });
        $('#modal-content-new').modal('hide');
      }
    },
    // function for update payment methode
    UpdatedefaultMethode(payMethod) {
      Swal.fire({
        text: "Are you sure want to make this card as default payment method?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, make it!",
        cancelButtonText: "No, cancel!",
      }).then((result) => {
        if (result.isConfirmed) {
          this.form = this.$inertia.form(payMethod);
          this.form.post(this.route("update-default-card"), {
              onFinish: () =>this.toast.success("Payment Method Updated Successfully!", {
                  position: POSITION.TOP_CENTER
              })
          });
        }
      });
    },
    // function for delete payment methode
    deletePayMethode(payMethod) {
      Swal.fire({
        text: "Are you sure want to delete this payment method?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
      }).then((result) => {
        if (result.isConfirmed) {
          this.form = this.$inertia.form(payMethod);
          this.form.post(this.route("delete-card"),{
              onFinish: () =>this.toast.success("Payment Method Deleted Successfully!", {
                  position: POSITION.TOP_CENTER
              })
          });
        }
      });
    },
  },
});
</script>

<style scoped>
.payment-info-single {
  display: flex;
  justify-content: space-between;
  align-items: center;
  border: 1px solid #ff940d;
  padding: 7px 17px;
  border-radius: 8px;
  background: #fbf7f7;
}
.card-info-dettail h1 {
  margin: 0;
  padding: 0;
  font-size: 21px;
}
.card-info-dettail p {
  margin: 0;
  padding: 0;
  font-size: 17px;
}
.payMethode-delete-btn {
  font-weight: bold;
  font-size: 20px;
  color: red;
}
.payment-details {
    display: flex;
    justify-content: space-between;
    align-content: baseline;
}
.payment-options>span {
    font-size: 22px;
    color: #03192e;
    font-weight: 600;
}
.payment-mode ul li {
    list-style: none;
    display: inline-block;
}
.payment-mode ul li:not(:last-child) {
    margin-right: 12px;
}
.modal-content {
    border-radius: 20px;
    background: #f2f3f4;
}
.payment-wrapper {
    border-radius: 20px;
    background: #f2f3f4;
    padding: 20px 20px 30px 20px;
}
.payment-details .dropdown {
    width: 100%;
}
.payment-details .dropdown .btn{
    padding-top: 6px;
    width: 100%;
    height: 40px;
    font-weight: 600;
    padding-right: 30px;
    font-size: 17px;
    padding-left: 20px;
}
.change-subscription-plane .payment-details .dropdown .btn-group {
    flex: 100%;
}
</style>
