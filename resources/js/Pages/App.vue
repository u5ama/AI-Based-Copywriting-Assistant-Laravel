<template>
    <type-skip-layout :tools="contentTools">
        <div class="no-side-menu">
            <div class="banner-wrapper">
                <div class="row">
                    <div class="col-md-12">
                        <div class="banner-image">
                            <h3>Welcome, {{$page.props.user.username}}</h3>
                            <p>What do you want to write today?</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between" style="margin: 21px 0px 0px 28px;">
                <h4><b>Browse</b></h4>
                <div class="form-group search-main">
                    <a href="#" data-toggle="modal" data-target="#request_template">
                        <svg style="float: left;" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 opacity-50"><path d="M11 3a1 1 0 10-2 0v1a1 1 0 102 0V3zM15.657 5.757a1 1 0 00-1.414-1.414l-.707.707a1 1 0 001.414 1.414l.707-.707zM18 10a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zM5.05 6.464A1 1 0 106.464 5.05l-.707-.707a1 1 0 00-1.414 1.414l.707.707zM5 10a1 1 0 01-1 1H3a1 1 0 110-2h1a1 1 0 011 1zM8 16v-1h4v1a2 2 0 11-4 0zM12 14c.015-.34.208-.646.477-.859a4 4 0 10-4.954 0c.27.213.462.519.476.859h4.002z"></path></svg>
                        <span style="margin-right: 15px;">Request a template</span>
                    </a>
                    <input v-model="searchKey" type="text" class="form-control" placeholder="Search">
                </div>
            </div>
            <Tools :tools="searchTools" :search="searchKey" ></Tools>
        </div>
        <div class="modal" id="request_template" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body ts-radius ts-form p-4">
                        <form @submit.prevent="submitForm">
                            <div class="w-full text-left">
                                <div class="auth-logo mb-2"> Request a new template </div>
                                <p class="text-sm font-medium text-gray-500">
                                    Would you like to see any new tools added to TypeSkip? Send us your suggestions below (Please be as detailed as possible).
                                </p>
                                <div>
                                    <label for="message-text" class="block font-medium leading-5 text-gray-700"> Message <!----></label>
                                    <div class="rounded-md shadow-sm">
                                        <textarea id="message-text" v-model="form.requestMessage" name="message" rows="4" autocomplete="off" placeholder="Please write your message" class="form-control d-block w-full form-input message-text "></textarea>
                                    </div>
                                    <span v-if="errors['requestMessage']" class="error">{{ errors["requestMessage"] }}</span>
                                </div>
                            </div>
                            <div class="textbox-margin text-right">
                                <button type="submit" class="btn ts-f-btn mr-2">Submit</button>
                                <button type="button" class="btn ts-f-btn-white" data-dismiss="modal" aria-label="Close" id="close">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </type-skip-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import Tools from "@/Pages/Partials/App/Tools";
    import TypeSkipLayout from "@/Layouts/TypeSkipLayout";
    import {POSITION, useToast} from "vue-toastification";

    export default defineComponent( {
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
        name: "App",
        props:['contentTools', 'errors'],
        components: {
            Head,
            Link,
            TypeSkipLayout,
            Tools
        },
        data() {
            return {
                searchKey: '',
                form:{
                    requestMessage: '',
                },
                contentTool: [],
                show_sidebar:false
            }
        },
        mounted() {
            this.contentTool = this.contentTools;
        },
        computed: {
            searchTools() {
                let tempTools = this.contentTool
                if (this.searchKey !== '' && this.searchKey) {
                    tempTools = tempTools.filter((item) => {
                        return item.title
                            .toUpperCase()
                            .includes(this.searchKey.toUpperCase())
                    })
                }
                return tempTools
            }
        },
        methods:{
            closeModal() {
                document.getElementById('close').click();
            },
            submitForm(){
                let requestForm = this.$inertia.form({
                    requestMessage: this.form.requestMessage,
                });
                requestForm.post(this.route("request-template"),{
                    onFinish: () => {
                        this.toast.success("Request for template Send Successfully!", {
                            position: POSITION.TOP_CENTER
                        });
                        this.closeModal();
                    }
                });
            }
        }
    })
</script>
