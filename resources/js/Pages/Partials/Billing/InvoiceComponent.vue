<template>
    <div class="billing-bg invoice-wrapper mt-5">
        <h2>Invoices</h2>
        <p>View your payment history</p>
   <div class="completed-invoices" v-if="upcomingInvoice">
      <h3>Upcoming Invoices</h3>
      <div class="invoice-detail">
      <div class="invoice-card">
        <div class="invocie-left">
          <img src="/ts/images/invoice-credit-card.svg" alt="" />
        </div>
        <div class="invoice-right">
          <p class="price">$ {{ upcomingInvoice.amount_remaining /100 }} on {{ getDate(upcomingInvoice.next_payment_attempt) }}</p>
          <p class="invocie-status"> {{ upcomingInvoice.billing_reason }} </p>
        </div>
      </div>
      <div class="invocie-link"></div>
    </div>
   </div>
   <div class="completed-invoices mt-4">
     <h3>Completed Invoices</h3>
      <div class="invoice-detail" v-for="invoice in invoices" :key="invoice.key">
      <div class="invoice-card">
        <div class="invocie-left">
          <img src="/ts/images/invoice-credit-card.svg" alt="" />
        </div>
        <div class="invoice-right">
          <p class="price">$ {{ invoice.amount_paid /100 }} on {{ getDate(invoice.created) }}</p>
          <p class="invocie-status"> {{ invoice.billing_reason.split('_').join(" ") }} </p>
        </div>
      </div>
      <div class="invocie-link">
        <a :href="invoice.invoice_pdf"><img src="/ts/images/download-card.svg" alt=""
        /></a>
      </div>
    </div>
   </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import moment from 'moment';

export default defineComponent({
  name: "InvoiceComponent",
  props: ['invoices','upcomingInvoice'],
  components: {
    Head,
    Link,
  },
  data() {
    return {
      name: "",
    };
  },
  methods: {
      getDate(date) {
         return moment.unix(date).format('ll');
      }
  }
});
</script>

<style scoped>
.current-subscription-box a {
  font-weight: bold !important;
}
</style>
