<template>
    <div class="blank-page blank-page bg-white">
        <div class="umc-Login-root umc-Login-root--v4">
            <div class="umc-rall umc-rall--login umc-rall--wide box-root umc-flex umc-fd-column">
                <div class="umc-rlb umc-rlb--default umc-rlb--desktopUltraWide">
                    <div class="umc-rl-bg">
                        <div class="umc-graybg"></div>
                        <div class="umc-mc umc-rv-first"></div>
                        <div class="umc-mc umc-rv-second"></div>
                        <div class="umc-mc umc-rv-third"></div>
                        <div class="umc-mc umc-rv-fourth"></div>
                        <div class="umc-mc umc-rv-fifth"></div>
                        <div class="umc-fleft"></div>
                        <div class="umc-sleft"></div>
                        <div class="umc-fs-left"></div>
                        <div class="umc-frights"></div>
                    </div>
                </div>
                <div class="umc-rall-cw box-root w-100-sm">
                    <div class="box-shadow-2 p-0 mt-4 login-width">
                        <div class="card border-grey border-grey-shadowcls  border-lighten-3 mt-5 pl-4 pr-4 login-sm-h">
                            <div class="card-header2 border-0 pt-4 pb-4 w-full">
                                <div class="card-title text-center p-3">
                                    <img src="/assets/frontend/img/logo-typeskip.svg" alt="branding logo" class="login_logo" style="display:inline">
                                </div>
                            </div>

                            <div class="card-content">
                                <div class="card-body pt-0  text-center">
                                    <a :href="route('login.google')"
                                       class="btn btn-social mb-1 mr-1 btn-outline-google width100">
                                        <img src="/assets/frontend/img/google.svg" style="width:18px" >
                                        <span class="px-1">Register with Google</span>
                                    </a>
                                </div>
                                <div class="card-body p-0 pl-3 pr-3  text-center">
                                    <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2">
                                        <span>OR </span>
                                    </p>
                                </div>
                                <div class="card-body pt-0">
                                    <div id="msg" style="display:none" class="alert alert-success"></div>
                                    <div class="alert alert-danger" style="display:none" id="error"></div>
                                    <form class="form-horizontal" @submit.prevent="submit">
                                        <fieldset class="form-group floating-label-form-group">
                                            <label class="form_label_cls" for="fullname">Full Name</label>
                                            <input v-model="form.name" class="form-control" type="text" name="username" id="fullname" placeholder="Enter your name">
                                            <span v-if="form.errors.name" class="error" id="email_error">{{form.errors.name}}</span>
                                        </fieldset>
                                        <fieldset class="form-group floating-label-form-group">
                                            <label class="form_label_cls" for="emailAddress">Email Address</label>
                                            <input v-model="form.email" :class="['form-control', form.errors.email ? 'is-invalid':'']" type="email" id="emailAddress" name="email"
                                                   placeholder="Enter your email" >
                                            <span v-if="form.errors.email" class="error" id="email_error">{{form.errors.email}}</span>
                                        </fieldset>
                                        <fieldset class="form-group floating-label-form-group mb-1">
                                            <label class="form_label_cls" for="password">Password</label>
                                            <input v-model="form.password" type="password" id="password" class="form-control" name="password" placeholder="Enter your password">
                                            <span v-if="form.errors.password" class="error" id="password_error">{{form.errors.password}}</span>
                                        </fieldset>
                                        <div class="form-group row">
                                            <div class="col-md-12 col-12 text-center text-sm-left">
                                                <span class="font-size-12">
                                                By signing up, I accept the TypeSkip <a href="/privacy" target="_blank">Terms of Service</a> and acknowledge the
                                                <a href="/privacy" target="_blank">Privacy Policy</a>.
                                                </span>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-outline-info btn-block inlineblock btn_one mt-3" id="register-button"><i class="ft-unlock"></i> Sign up</button>
                                        <h5 v-if="form.processing" class="please_wait">
                                            <img src="/public/ts/images/loading.gif" alt="">
                                        </h5>
                                    </form>
                                </div>
                                <p class="card-subtitle  text-muted text-center font-small-3 mb-4 font14">
                                    <span>Already have an account? <Link href="/login">Sign In</Link></span>
                                </p>
                                <p class="card-subtitle  text-muted text-center font-small-3 mb-4 font12">
                                    <span>
                                        <a target="_blank" href="/privacy">Privacy Policy </a>and
                                        <a  target="_blank" href="/terms">Terms of Service</a> apply.
                                    </span>
                                </p>
                            </div>
                            <!-- <div class="card-footer">
                              <div class="">
                                <p class="float-sm-left text-center m-0"><a href="recover-password.html" class="card-link">Recover password</a></p>
                                <p class="float-sm-right text-center m-0">New to Modern Admin? <a href="register-simple.html" class="card-link">Sign Up</a></p>
                              </div>
                            </div> -->
                        </div>
                        <div class="mt-4 mb-4 pb-4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { defineComponent } from 'vue'
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue'
    import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue'
    import JetButton from '@/Jetstream/Button.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetCheckbox from '@/Jetstream/Checkbox.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Head,
            JetAuthenticationCard,
            JetAuthenticationCardLogo,
            JetButton,
            JetInput,
            JetCheckbox,
            JetLabel,
            JetValidationErrors,
            Link,
        },

        data() {
            return {
                form: this.$inertia.form({
                    name: '',
                    email: '',
                    password: '',
                    processing: false,
                    ref:null,
                    pa:null,
                })
            }
        },

        created() {
            let uri = window.location.href.split('?');
            if(uri.length === 2) {
                let vars = uri[1].split('&');
                let getVars = {};
                let tmp = '';
                vars.forEach(function(v) {
                    tmp = v.split('=');
                    if(tmp.length === 2)
                        getVars[tmp[0]] = tmp[1];
                });
                this.form.ref = getVars.ref;
            }
        },
        methods: {
            submit() {
                this.form.processing = true;
                this.form.post(this.route('register'), {
                    onFinish: () => {
                        this.form.reset('password', 'password_confirmation');
                        this.form.processing = false
                    }
                })
            }
        }
    })
</script>

<style scoped>
    body{background: #f6f8f9}
    .blank-page .content-wrapper .flexbox-container {
        /*display: flex;*/
        align-items: center;
        height: 100vh;
    }
    .width100{width:100%}
    .login_logo{width:150px;}
    .btn-outline-google {
        border: 1px solid #dadada !important;
        color: #000;padding: 10px 0px;position:relative;
    }
    .btn-outline-google img {
        position: absolute;
        left: 32px;
        top: 12px;
    }
    .border-grey-shadowcls{border: none;
        box-shadow: 0 5px 20px 0 rgb(21 27 38 / 8%)}
    .line-on-side {
        border-bottom: 1px solid #dadada;
        line-height: 0.1em;
        margin: 10px 0 20px;
        margin-right: 0px;
        margin-left: 0px;
    }
    .line-on-side span {
        background: #fff;
        padding: 0 10px;
    }
    label.form_label_cls {
        font-size: 12px;
        color: #6f7782;
    }
    .forgot_link {
        color: #6f7782;
        font-size: 12px;
        text-decoration: underline;
    }
    .inlineblock{display:inline-block;}
    .btn_one {
        background: #03192e;
        color: #fff;
        border-color: #03192e;
        -webkit-transition: all 1.6s ease;
        transition: all 1.6s ease;
    }
    .btn_one:hover {
        background: #03192e;
        color: #fff;
        opacity: 0.8;
        border-color: #03192e;
        -webkit-transition: all 1.6s ease;
        transition: all 1.6s ease;
    }
    .colorf96f67{color:#f96f67; }
    .font14{font-size:14px;}
    .font12{font-size:12px;}

    .LoginFooter-navRow {
        margin: 0;
        padding: 0;
        width: 100%;
        display: inline-block;
        text-align: center;
    }
    .LoginFooter-navRowItem {
        font-size: 14px;
        display: inline-block;
        margin-right: 3%;
    }
    .HiddenLink.HiddenLink--darkGray1 {
        cursor: pointer;
        color: #6f7782;
        fill: #6f7782;
    }
    .Typography--m.Typography {font-size: 12px;}
    .LoginFooter-navRowItem i {
        font-size: 7px;
        position: relative;
        top: -2px;
    }


    /* Login Background */
    .umc-rall{background-color:#fff;min-height:100%;height:100%;}
    .umc-rall-logo{padding-bottom:40px;padding-left:20px;}
    .umc-rall-cw{margin:0 16px;z-index:0;position:relative;display:flex;flex-direction:row;height:100%;}
    .umc-rall--wide .umc-rall-cw{padding-top:0;justify-content:space-between;}
    .umc-rall--login.umc-rall--wide .umc-rall-cw{justify-content:center;}
    .umc-rall--wide .umc-rall-cw{margin:0 auto;width:1080px;}
    .umc-rall-formContainer{display:flex;flex-direction:column;width:540px;}
    .umc-rall--wide .umc-rall-formContainer{width:540px;min-width:540px;}
    .umc-rall-formPadding{padding:32px 0;}
    .umc-rall--wide .umc-rall-formPadding{padding:56px 48px;}
    .umc-rall-card{border-radius:12px;flex-shrink:0;}
    .umc-rall-formContainer-spacer{flex-grow:1;flex-shrink:1;}
    .umc-rall-footer{position:relative;padding-top:24px;padding-bottom:24px;padding-left:20px;}
    .umc-rl-bg{position:fixed;left:0;right:0;top:-250px;bottom:0;z-index:0;transform:skewY(-12deg);}
    .umc-fs-left,.umc-fleft,.umc-frights,.umc-sleft{position:absolute;}
    .umc-fleft{top:668px;left:calc(50% - 700px);right:calc(50% + 540px);height:40px;background-color:#efba97;}
    .umc-sleft{top:698px;left:-10px;right:calc(50% + 405px);height:40px;background-color:#fb8231;}
    .umc-fs-left{top:698px;left:calc(50% - 700px);right:calc(50% + 540px);height:10px;background-color:#dc5a02;}
    .umc-frights{top:658px;right:-10px;left:calc(50% + 430px);height:40px;background-color:#fb8231;}
    .umc-graybg{position:absolute;top:-1000px;left:0;right:0;transform-origin:0 50%;height:1698px;background-color:#f7fafc;}
    .umc-mc{position:absolute;top:-100vh;bottom:-100vh;right:auto;width:1px;background-size:1px 8px;background-image:linear-gradient(180deg,#eceef4 49%,rgba(236,238,244,0) 50%);}
    .umc-rv-fifth,.umc-rv-first{background:#eceef4;background-image:none;}
    .umc-rv-first{left:calc(50% - 540px);}
    .umc-rv-second{left:calc(50% - 270px);}
    .umc-rv-third{left:50%;}
    .umc-rv-fourth{left:calc(50% + 269px);}
    .umc-rv-fifth{left:calc(50% + 540px);}
    .umc-Login-root{background:#fff;}
    .umc-Login-root--v4{background:#fff;height:100vh;}
    .umc-Login-root--v4 a,.umc-Login-root--v4 a div>span{color:#ffae38;}
    .umc-flex{display:-ms-flexbox;display:flex;}
    .umc-fd-column{-ms-flex-direction:column;flex-direction:column;}
    .box-root{box-sizing:border-box;}
    .login-width {width:90%;max-width: 540px;}
    .login-sm-h{height: auto !important}
    @media (max-width:787px) {
        .umc-rall--wide .umc-rall-cw{padding-top:0}
        .login-width{max-width:90%}
        .umc-rl-bg{top:0}
        .umc-rall--wide .umc-rall-cw{width:auto}
        .umc-rall-cw.box-root.w-100-sm{width: 100%;}
        .umc-graybg{height:1298px}
        .umc-sleft{top:180px;left:0;background-color:#fb8231;width:72px;height:40px}
        .umc-fs-left{top:80px;left:calc(50% + 103px);height:10px;width:126px;background-color:#fb8231;right:0}
        .umc-frights{height:40px;top:80px;left:calc(50% + 67px);width:800px;background-color:#fb8231}
        .umc-fleft{height:40px;top:50px;left:calc(50% + 103px);background-color:#efba97;width:126px}}
    .card.border-grey.border-grey-shadowcls.border-lighten-3.mt-5.pl-4.pr-4 {padding: 0 !important;}
    .font-size-12{font-size: 12px;}
    .please_wait{display:flex;justify-content:center;position:absolute;background:#fff;width:100%;bottom:0;left:0;right:0;align-items:center;margin:0 auto;top:0}
    .error{color:red;}
    .card{height: auto;}

</style>
