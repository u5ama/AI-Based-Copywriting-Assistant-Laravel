<template>
    <type-skip-layout>
        <section class="profile bg-light">
            <div class="container-fluid">
                <div class="templatediv">
                    <!-- Form row -->
                    <div class="row breadcrumbs">
                        <div class="col-12">
                            <Link href="/app" class="menu-iteam-ts">Dashboard</Link>
                            <span class="dot-seprator">●</span> <span>Change Password</span>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 3%">
                        <div class="col-md-8 mx-auto">
                            <div class="card ts-radius ts-form h-auto">
                                <div class="card-body w-100">
                                    <div class="text-center m-auto">
                                        <div class="auth-logo">Change Password</div>
                                    </div>
                                    <form @submit.prevent="updatePassword" >
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <div class="input-group input-group-merge">
                                                <input v-if="showPassword" type="text" id="password" class="form-control" v-model="form.password" name="password" placeholder="Enter your password">
                                                <input v-else type="password" id="password" class="form-control" v-model="form.password" name="password" placeholder="Enter your password">
                                                <div class="input-group-append" data-password="false">
                                                    <div class="input-group-text" @click="toggleShow">
                                                        <font-awesome-icon icon="eye" v-if="showPassword"/>&nbsp;
                                                        <font-awesome-icon icon="eye-slash" v-if="!showPassword"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <span v-if="errors['password']" class="error">{{errors["password"] }}</span>
                                        </div>
                                        <div class="form-group mb-1">
                                            <label for="password">Confirm Password</label>
                                            <div class="input-group input-group-merge">
                                                <input v-if="showPassword" type="text" id="password" class="form-control" v-model="form.confirm_password" name="confirm_password" placeholder="Enter your password">
                                                <input v-else type="password" id="password" class="form-control" v-model="form.confirm_password" name="confirm_password" placeholder="Enter your password">
                                                <div class="input-group-append" data-password="false">
                                                    <div class="input-group-text" @click="toggleShow">
                                                        <font-awesome-icon icon="eye" v-if="showPassword"/>&nbsp;
                                                        <font-awesome-icon icon="eye-slash" v-if="!showPassword"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <span v-if="errors['confirm_password']" class="error">{{errors["confirm_password"] }}</span>
                                        </div>

                                        <div class="form-group">
                                            <input class="input-checkbox" id="checkbox-signup-test" type="checkbox">
                                            <label class="label-checkbox" for="checkbox-signup-test">
                                            <span>
                                                <svg width="12px" height="10px" viewBox="0 0 12 10">
                                                    <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                </svg>
                                            </span>
                                                <span class="" for="checkbox-signup">I accept <a href="javascript: void(0);" class="link-text">Terms and Conditions</a></span>
                                            </label>
                                        </div>
                                        <div class="form-group mb-0 text-center">
                                            <button class="btn btn-success btn-block ts-f-btn" type="submit">Update Password</button>
                                        </div>
                                    </form>
                                </div> <!-- end card-body -->
                            </div>
                            <!-- end card -->
                            <div class="row mt-3">
                                <div class="col-12 text-center">
                                    <p class="text-white-50">Already have account?  <Link href="/login" class="text-white ml-1"><b>Sign In</b></Link></p>
                                </div> <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div> <!-- end col -->
                    </div>
                </div>
            </div>
        </section>
    </type-skip-layout>
</template>

<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import TypeSkipLayout from "@/Layouts/TypeSkipLayout";
import {POSITION, useToast} from "vue-toastification";

export default defineComponent({
    setup() {
        // Get toast interface
        const toast = useToast();
        // or with options
        toast.success("My toast content", {
            timeout: 2000,
            position: 'top'
        });
        // Make it available inside methods
        return { toast }
    },
    name: "Index",
    props: ["data","errors"],
    components: {
        Head,
        Link,
        TypeSkipLayout
    },
    data() {
        return {
            form: this.$inertia.form({
                id: this.data.user.id,
                password: '',
                confirm_password: '',
            }),
            searchTool: "",
            showPassword: false,
            show_sidebar: false,
            favouriteForm: this.$inertia.form({
                _method: "POST",
            }),
            deleteForm: this.$inertia.form({
                _method: "POST",
            }),
        };
    },
    methods: {
        toggleShow() {
            this.showPassword = !this.showPassword;
        },
        updatePassword(){
            this.form.post(this.route('update_password'), {
                onSuccess: () => {
                    this.toast.success("Password Updated Successfully!", {
                        position: POSITION.TOP_CENTER
                    });
                    this.form.reset('password', 'confirm_password')
                }
            })
        },
        share(text){
            navigator.clipboard.writeText(text);
        },
    }
});
</script>

<style scoped>
body {
    background-color: #f5f5f5;
}
</style>
