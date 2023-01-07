<template>
    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-pattern">
                        <div class="card-body p-4">
                            <div class="text-center w-75 m-auto">
                                <div class="auth-logo">
                                    <Link href="/login" class="logo logo-dark text-center">
                                    <span class="logo-lg">
                                        <img src="/assets/frontend/img/logo-typeskip.svg" alt="" height="22">
                                    </span>
                                    </Link>
                                    <Link href="/login" class="logo logo-light text-center">
                                    <span class="logo-lg">
                                        <img src="/assets/frontend/img/logo-typeskip.svg" alt="" height="22">
                                    </span>
                                    </Link>
                                </div>
                                <p class="text-muted mb-4 mt-3">Enter your email address and we'll send you an email with instructions to reset your password.</p>
                            </div>
                            <form @submit.prevent="sendEmail">
                                <div class="form-group mb-3">
                                    <label for="emailaddress">Email address</label>
                                    <input class="form-control" type="email" id="emailaddress" name="email" placeholder="Enter your email" v-model="form.email">
                                    <span id="emailerror" style="color: red;"></span>
                                </div>

<!--                              <div class="form-group mb-3 mt-2">-->
<!--                                    @if(config('services.recaptcha.key'))-->
<!--                                    <div class="g-recaptcha"-->
<!--                                         data-sitekey="{{config('services.recaptcha.key')}}">-->
<!--                                    </div>-->
<!--                                    @endif-->
<!--                                    <span id="g_recaptcha_response" style="color: red;"></span>-->
<!--                                </div>-->
                                <button type="submit" class="btn btn-outline-info btn-block inlineblock btn_one mt-3">
                                    <i class="ft-unlock"></i>
                                    Reset Password
                                </button>
                                <h5 v-if="form.processing" class="please_wait">
                                    <img src="/ts/images/loading.gif" alt="">
                                </h5>
                            </form>

                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->
                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <p class="text-white-50">Back to <Link href="/login" class="text-white ml-1"><b>Log in</b></Link></p>
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->
</template>

<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
    name: "Index",
    props: ["data", "errors"],
    components: {
        Head,
        Link
    },
    data() {
        return {
            form: this.$inertia.form({
                email: '',
                processing: false
            })
        }
    },
    methods: {
        sendEmail () {
            this.form.processing = true;
            this.form.post(this.route('password-recover'), {
                onFinish: () => {
                    this.form.reset('email');
                    this.form.processing = false
                }
            })
        }
    }
})
</script>

<style>
.please_wait{display:flex;justify-content:center;position:absolute;background:#fff;width:100%;bottom:0;left:0;right:0;align-items:center;margin:0 auto;top:0}
</style>
