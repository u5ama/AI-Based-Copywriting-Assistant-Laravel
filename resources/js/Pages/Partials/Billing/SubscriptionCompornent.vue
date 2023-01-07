<template>
  <div class="billing-bg usage-graph mt-5 mb-3">
    <h2>Subscription</h2>
    <p v-if="!userSubscriptionsPlane">Start with starter plan and you can change later if needed</p>
      <div class="subscription-details pt-3">
          <div class="payment-details">
              <div class="payment-options">
                  <span class="tag" v-if="!userSubscriptionsPlane">{{ userSubscriptionsPlane.status }}</span>
                  <span class="notag" v-if="userSubscriptionsPlane">{{userSubscriptionsPlane.plan.nickname}}</span>
                  <span class="notag" v-else>Starter</span>
                  <span class="boxtag">Change</span>
              </div>
              <div class="payment-mode" v-if="userSubscriptionsPlane">
                  <span class="price" v-if="userSubscriptionsPlane.plan.transform_usage != null">{{userSubscriptionsPlane.plan.transform_usage.divide_by}}</span>
                  <span class="price" v-else>0</span>
                  <span class="v-top"> /month</span>
              </div>
              <div class="payment-mode" v-else>
<!--                  <span class="price" v-if="userSubscriptionsPlane.plan.transform_usage != null">{{userSubscriptionsPlane.plan.transform_usage.divide_by}}</span>-->
<!--                  <span class="price" v-else>0</span>-->
                  <span class="v-top"> /month</span>
              </div>
          </div>
          <div class="plan-wrapper">
              <div class="progress-wrapper col-8">
                  <p class="progress-title" v-if="userSubscriptionsPlane">Re-new at <span>{{ getDate(userSubscriptionsPlane.current_period_end) }}</span></p>
                  <div class="progress">
                      <div id="workcarpb" data-emergence="visible" role="progressbar" aria-valuemin="0" aria-valuemax="100" class="progress-bar" style="width: 100%;">
                          <span class="sr-only"></span>
                      </div>
                  </div>
              </div>
              <div class="plan col-4">
                  <button type="button" class="btn primary-btn ts-btn r-square-btn" @click="showUpBox">Upgrade Plan
                      <img src="ts/images/icon-arrow-white.svg" width="20" class="ml-2" style="position: relative;display: inline;">
                  </button>
                  <p>Get words for cheaper</p>
              </div>
          </div>
      </div>
    <div class="row" v-show="upBox">
      <div class="col-lg-12 col-12">
        <div class="card" style="height: auto; padding: 14px; align-items: center">
          <div class="change-subscription-plane w-100" v-if="currentSubscriptionId">
              <div class="payment-details">
                  <div class="dropdown">
                      <div class="btn-group">
                          <select
                            name="subscriptionPlaneName"
                            class="form-select btn dropdown-toggle"
                            v-model="currentSubscriptionId"
                            @change="changeSubscription">
                            <option
                              v-for="plan in allPlans.data"
                              v-bind:value="plan.id"
                              :key="plan.key">
                              {{ plan.nickname }}
                            </option>
                          </select>
                      </div>
                  </div>
              </div>

            <div class="payment-info" v-if="upgradePaymentInfoShow">
              <div style="width: 100%">
                <div class="payment-info">
                  <h4>
                    Upgraded Plan <span>{{ newPlanPrice }}$</span>
                  </h4>
                  <span>(US dollars)</span>
                </div>
                <div class="payment-info">
                  <h4>
                    Current Plan
                    <span>{{ userSubscriptionsPlane.plan.amount / 100 }} $</span>
                  </h4>
                  <span>(US dollars)</span>
                </div>
                <div class="payment-info" v-if="newPayablePrice >= 0">
                  <h4>
                    Total you pay <span> {{ newPayablePrice }} $</span>
                  </h4>
                  <span>(US dollars)</span>
                </div>
                <div class="payment-info" v-if="newPayablePrice < 0">
                  <h4>
                    Your save <span> {{ Math.abs(newPayablePrice) }} $</span>
                  </h4>
                  <span>(US dollars)</span>
                </div>
                <div class="payment-info">
                  <input
                    type="text"
                    class="form-control mb-2 mt-2"
                    placeholder="Promo code"
                    v-if="havePromo"
                    v-model="promoCode"/>
                  <a
                    href="javascript:void(0)"
                    v-if="!havePromo"
                    @click="havePromo = true"
                    class="promo"
                    >Have a promo code?</a>
                  <a
                    href="javascript:void(0)"
                    v-if="havePromo"
                    @click="havePromo = false"
                    class="promo"
                    >Don't have promo code</a>
                </div>
                <button
                  type="button"
                  @click="upgradeSubscription"
                  class="btn primary-btn ts-btn r-square-btn"
                  :disabled="upgradeBtnDisable"
                  style="min-width: 0; width: 25%">
                  Upgrade Subscription
                </button>
              </div>
            </div>
          </div>
          <h4 v-if="!currentSubscriptionId">You don't have any plan yet</h4>
            <div class="change-subscription-plane w-100" style="height: auto; padding: 14px; align-items: center"
                v-if="userSubscriptionsPlane == null || userSubscriptionsPlane.status == 'canceled' || !userSubscriptionsPlane">
                <ul class="list-group list-group-flush payment-info">
                    <li class="list-group-item">All Content Templates</li>
                    <li class="list-group-item">Upto 25,000 words Generated</li>
                    <li class="list-group-item">Upto 10 User Seats</li>
                </ul>
                <button type="button" class="btn primary-btn ts-btn r-square-btn" style="width: 35%;min-width: 0;" @click="subscribePlan">Subscribe</button>
            </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import Swal from "sweetalert2";
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
  name: "SubscriptionComponent",
  props: ["allPlans", "userSubscriptionsPlane", "oneTimePlans", 'paymentMethods'],
  components: {
    Head,
    Link,
  },
  data() {
    return {
      form_data: {},
      currentSubscriptionId: this.userSubscriptionsPlane ? this.userSubscriptionsPlane.plan.id : '',
      newSubscription: "",
      newPayablePrice: 0,
      havePromo: false,
      upBox: false,
      newPlanPrice: 0,
      promoCode: "",
      upgradeBtnDisable: true,
      upgradePaymentInfoShow: false,
      form: this.$inertia.form({
        _method: "POST",
      }),
    };
  },

  methods: {
      showUpBox(){
          this.upBox = true;
      },
      getDate(date) {
         return moment.unix(date).format('ll');
      },
    // function for subscribe a plane
    subscribePlan(payMethod) {
      Swal.fire({
        text: "Are you sure want to subscribe?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes",
        cancelButtonText: "No, cancel!",
      }).then((result) => {
        if (result.isConfirmed) {
          this.form = this.$inertia.form(payMethod);
          this.form.post(this.route("subscription-create"),{
              onSuccess: () =>  this.toast.success("Subscription Added Successfully!", {
                 position: POSITION.TOP_CENTER
             }),
              onError: errors => this.toast.error(errors.payment_method, {
                  position: POSITION.TOP_CENTER
              }),
          });
        }
      });
    },
    // function for Cancel subscription
    cancelSubscription() {
      Swal.fire({
        text: "Are you sure want to cancel the subscription?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes",
        cancelButtonText: "No, cancel!",
      }).then((result) => {
        if (result.isConfirmed) {
          this.form = this.$inertia.form();
          this.form.post(this.route("subscription-cancel"),{
              onSuccess: () => {
                  this.toast.success("Subscription Canceled Successfully!", {
                      position: POSITION.TOP_CENTER
                  })
                  this.upgradePaymentInfoShow = false;
              },
              onError: errors => this.toast.error(errors.payment_method, {
                  position: POSITION.TOP_CENTER
              }),
          });
        }
      });
    },
    changeSubscription() {
      this.allPlans.data.filter((newPlan) => {
        if (newPlan.id == this.currentSubscriptionId) {
          this.newSubscription = newPlan;

          this.calculateNewSubscription(this.newSubscription);
        }
      });
      this.upgradeBtnDisable = false;
      this.upgradePaymentInfoShow = true;
    },
    calculateNewSubscription(newSubscriptionDetails) {
      this.newPlanPrice = newSubscriptionDetails.unit_amount / 100;
      this.newPayablePrice =
      this.newPlanPrice - this.userSubscriptionsPlane.plan.amount / 100;
    },
    // function for upgrade subscription
    upgradeSubscription() {
      Swal.fire({
        text: "Are you sure want to upgrade the subscription?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes",
        cancelButtonText: "No, cancel!",
      }).then((result) => {
        if (result.isConfirmed) {
          this.form = this.$inertia.form({
            newSubscriptionId: this.currentSubscriptionId,
            promoCode: this.promoCode,
          });
          this.form.post(this.route("subscription-upgrade"), {
              onSuccess: () => {
                  this.toast.success("Subscription Upgraded Successfully!", {
                      position: POSITION.TOP_CENTER
                  })
                  this.upgradePaymentInfoShow = false;
              },
              onError: errors => this.toast.error(errors.payment_method, {
                  position: POSITION.TOP_CENTER
              }),
          });
        }
      });
    }
  }
});
</script>

<style scoped>
.current-subscription-box a {
  font-weight: bold !important;
}
.up_btn{
    height: 75px;
}
@media only screen and (max-width: 600px) {
    .up_btn{
        height: 50px;
    }
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
.change-subscription-plane .payment-info{
    text-align: center;
    border-top: 1px solid #efeff2;
    padding: 10px 20px 5px;
    display: flex;
    justify-content: space-between;
    font-weight: 600;
}
.promo {
    color: #494847;
    border-bottom: 1px solid;
    display: inline-block;
    padding-top: 15px;
    font-size: 12px;
}
</style>
