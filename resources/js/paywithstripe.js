import * as $ from "jquery";
//import * as bootstrap from "bootstrap";

/*require( "../admin/libs/tagsinput/taginput" );
require( "../admin/js/vendor.min" );
require( "../admin/libs/selectize/js/standalone/selectize.min" );
require( "../admin/js/pages/dashboard-1.init" );*/

$('.contentdiv').on('click', '.pagination a', function(e) {
    e.preventDefault();
    var url = $(this).attr('data-index');
    getContents(url);
});

$('.favoritesdiv').on('click', '.pagination a', function(e) {
    e.preventDefault();
    var url = $(this).attr('data-index');
    getFavorites(url);
});

$('.trashdiv').on('click', '.pagination a', function(e) {
    e.preventDefault();
    var url = $(this).attr('data-index');
    getTrashed(url);
});
$('.copy-icon').each(function() {
    $(this).click(function() {
        var $temp = $("<input>");
        $("body").append($temp);
        var response_id = $(this).attr('data-id');
        $temp.val($('.response-content-text-'+response_id).text()).select();
        document.execCommand("copy");
        $temp.remove();

        showMessage({status:'success',title:'Copied!',message:'Text has been Copied.'})
    });
});


function getContents(url) {
    $.ajax({
        url : url
    }).done(function (data) {
        $(".contentdiv").html(data.page);
        changePaginationUrl(".contentdiv");
    }).fail(function () {
        swal({
            title: "Oops!",
            text: "Something went wrong.",
            buttons: true,
            dangerMode: true,
        });
    });
}


function getTrashed(url) {
    $.ajax({
        url : url
    }).done(function (data) {
        $(".trashdiv").html(data.page);
        changePaginationUrl(".trashdiv");
    }).fail(function () {
        swal({
            title: "Oops!",
            text: "Something went wrong.",
            buttons: true,
            dangerMode: true,
        });
    });
}

function getallContent() {
    $.ajax({
        url: "get-all-contents",
        method:"get",
        cache: false,
        success: function(result){
            if(result.status == true) {
                $(".contentdiv").html(result.page);
                changePaginationUrl('.contentdiv');
                $(".content-header").empty();
                $(".content-header").text('All Content');
            } else {
                swal({
                    title: "Oops!",
                    text: "Something went wrong.",
                    buttons: true,
                    dangerMode: true,
                });
            }
        },error:function(error) {
            swal({
                title: "Oops!",
                text: "Something went wrong.",
                buttons: true,
                dangerMode: true,
            });
        }
    });
}

function getFavorites(url) {
    $.ajax({
        url : url
    }).done(function (data) {
        $(".favoritesdiv").html(data.page);
        changePaginationUrl(".favoritesdiv");
    }).fail(function () {
        swal({
            title: "Oops!",
            text: "Something went wrong.",
            buttons: true,
            dangerMode: true,
        });
    });
}

function getFavoritesOld() {
    $.ajax({
        url: "/get-all-favorites",
        method:"get",
        cache: false,
        success: function(result){
            if(result.status == true) {
                $(".favoritesdiv").html(result.page);
                changePaginationUrl(".favoritesdiv");
                $(".content-header").empty();
                $(".content-header").text('Favorites');
            } else {
                swal({
                    title: "Oops!",
                    text: "Something went wrong.",
                    buttons: true,
                    dangerMode: true,
                });
            }
        },error:function(error) {
            swal({
                title: "Oops!",
                text: "Something went wrong.",
                buttons: true,
                dangerMode: true,
            });
        }
    });
}

$(".submit-button").click(function() {
    // Get form
    var form = $('#report-form')[0];
    var data = new FormData(form);
    if ($("#message").val() != '') {
        $(".submit-button").prop('disabled', true);
        $.ajax({
            url: "/report-content",
            method:"post",
            data: data,
            cache: false,
            processData: false,
            contentType: false,
            success: function(result){
                if(result.status == 'true') {
                    Swal.fire(
                        'Success',
                        result.message,
                        'success'
                    );
                    $("#request_bad_content").removeClass('show');
                    $("#request_bad_content").hide();
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                } else {
                    Swal.fire(
                        'Error',
                        result.message,
                        'error'
                    );
                    $("#request_bad_content").removeClass('show');
                    $("#request_bad_content").hide();
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                }
            }
        });
        $(".submit-button").prop('disabled', false);
    }
});

function getTrashedData() {
    $.ajax({
        url: "/get-all-trashed",
        method:"get",
        cache: false,
        success: function(result){
            if(result.status == true) {
                $(".trashdiv").html(result.page);
                changePaginationUrl('.trashdiv');
                $(".content-header").empty();
                $(".content-header").text('Trashed');
            } else {
                swal({
                    title: "Oops!",
                    text: "Something went wrong.",
                    buttons: true,
                    dangerMode: true,
                });
            }
        },error:function(error) {
            swal({
                title: "Oops!",
                text: "Something went wrong.",
                buttons: true,
                dangerMode: true,
            });
        }
    });
}

function changePaginationUrl(div) {
    $(div+" .pagination a").each(function() {
        var url =  $(this).attr('href');
        $(this).attr('data-index',url);
        $(this).attr('href', '');
    });
}

var status_delete = false;
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function rename_project(el){
    var project_id = $(el).attr("data-id");
    var project_name = $(el).attr("data-name");
    $("#project_id").val(project_id);
    $("#name").val(project_name);
    $(".modal-title").text('Update Project');
}

function change_project(project_id){
    var current_path = window.location.pathname;
    var project_id = project_id;
    $.ajax({
        url: "/update-user-project/"+project_id,
        method:"get",
        cache: false,
        success: function(result){
            location.reload();
        },error:function(error) {
            location.reload();
        }
    });
}

function delete_project(el){
    var project_id = $(el).attr("data-id");
    $.ajax({
        url: "/delete-project/"+project_id,
        method:"get",
        cache: false,
        success: function(result){
            if(result.status == true) {
                location.reload();
            }
        }
    });
}

$( document ).ready(function() {
    $('.button-menu-mobile').click(function(){
        $('.navbar-custom').toggleClass('opend');
        $('.left-side-menu').toggleClass('opend');
    });
    setTimeout(() => {
        var opendState = $('body').hasClass('sidebar-enable');
        if(opendState){
            $('.proj-dropdown').addClass('sidemenu-opend');
        }else{
            $('.proj-dropdown').removeClass('sidemenu-opend');
        }
    }, 10);

    $(document, '.sidebar-menu', '.button-menu-mobile', 'body').click(function(){
        setTimeout(() => {
            var opendState = $('body').hasClass('sidebar-enable');
            if(opendState){
                $('.proj-dropdown').addClass('sidemenu-opend');
            }else{
                $('.proj-dropdown').removeClass('sidemenu-opend');
            }
        }, 10);
    });
});

function deleteAjaxCallBack(response_id){
    $('.response-content-'+response_id).remove();
}

$( document ).ready(function() {
    if(window.location.href.substring(window.location.href.lastIndexOf('/') + 1) !== 'template'){
        $('.navbar-custom').removeClass('opend');
        $('.left-side-menu').removeClass('opend');
        $('body').attr('data-sidebar-size', 'condensed');
    }

    $(".template-request").click(function() {
        // Get form
        var form = $('#request-template-form')[0];
        var data = new FormData(form);

        if ($(".message-text").val() != '') {
            $(".template-request").prop('disabled', true);
            $.ajax({
                url: '/request-template',
                method:"post",
                data: data,
                cache: false,
                processData: false,
                contentType: false,
                success: function(result){
                    $(".template-request").prop('disabled', false);
                    if(result.status == 'true') {
                        Swal.fire(
                            'Success',
                            result.message,
                            'success'
                        );
                        $("#request_template").modal('hide');
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                    } else {
                        Swal.fire(
                            'Error',
                            result.message,
                            'error'
                        );
                        $("#request_template").modal('hide');
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                    }
                }
            });
        }else{
            alert('Please add message.')
        }
    });
});

require('./vue-asset');
import VueIziToast from 'vue-izitoast';
import 'izitoast/dist/css/iziToast.min.css';
import Vue from 'vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

window.Vue = require('vue');
Vue.use(VueIziToast);
Vue.use(BootstrapVue);
Vue.use(IconsPlugin);
Vue.config.productionTip = false;

Vue.component('billing-details', require('./components/BillingDetails.vue').default);
Vue.component("stripe-card-element", require("./components/StripeCardElement.vue").default);
Vue.component('pay-with-stripe', require('./components/PayWithStripe.vue').default);
Vue.component('content-tools', require('./components/ContentTools.vue').default);
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('Tiptap', require('./components/DocTiptap.vue').default);
Vue.component('docview', require('./components/DocumentView.vue').default);
Vue.component('doclisting', require('./components/DocList').default);
Vue.component('editor', require('./components/Editor.vue').default);

import VueApexCharts from 'vue-apexcharts'
Vue.use(VueApexCharts)
window.Vue = require('vue').default;
window.VueResource = require('vue-resource');
window.Vue.use(window.VueResource);

Vue.component('pagination', require('laravel-vue-pagination'));

Vue.component('apexchart', VueApexCharts)
var app = new Vue({
    el: '#app',
    data() {
        return {
            searchTool: '',
            tools:[
                {
                    name:'New Facebook Ad',
                    description:'A limitless supply of original Facebook Ad Copy',
                    url:'facebook',
                    image:'public/ts/images/new-icons/facebook.png'
                },
                {
                    name:'New Google Ad',
                    description:'Create Google Ad with exact requirement and layouts',
                    url:'google',
                    image:'public/ts/images/new-icons/google-symbol.png'
                },
                {
                    name:'Product Description',
                    description:'Launching a new product? Let\'s couple it with a catchy product description',
                    url:'product-description',
                    image:'public/ts/images/new-icons/product-description.png'
                },
                {
                    name:'Facebook video script',
                    description:'Create product descriptions that sell',
                    url:'facebook-headline',
                    image:'public/ts/images/new-icons/facebook.png'
                },
                {
                    name:'Content Improver',
                    description:'Create compelling product descriptions to be used websites emails and social media.',
                    url:'copy-paste',
                    image:'public/ts/images/new-icons/sentenceimprover.png'
                },
                {
                    name:'PAS Framework',
                    description:'Generate Problem - Agitate - Solution using product Description.',
                    url:'pas-framework',
                    image:'public/ts/images/new-icons/pas-framework.png'
                },
                {
                    name:'AIDA Principle',
                    description:'Write Attention, Interest, Desire, Action using product description.',
                    url:'aida-principle',
                    image:'assets/admin/images/newTemplate/aida-principal.png'
                },
                {
                    name:'Sentence Expander',
                    description:'Expand the given paragraphs into longer paragraphs.',
                    url:'sentence-expander',
                    image:'assets/admin/images/newTemplate/sentence-expander.svg'
                },
                {
                    name:'Blog Outline',
                    description:'Write an outline for a blog post using the title.',
                    url:'blog-outline',
                    image:'assets/admin/images/newTemplate/blog-outline.svg'
                },
                {
                    name:'Great Headlines',
                    description:'Create high quality headlines in seconds.',
                    url:'great-headlines',
                    image:'assets/admin/images/newTemplate/headline-generator.svg'
                },
                {
                    name:'Persuasive Bullet Points',
                    description:'Write differentPersuasive Bullet Points using Product Description.',
                    url:'persuasive-bullet-points',
                    image:'assets/admin/images/newTemplate/persuasive-bullet-point.png'
                },
                {
                    name:'Marketing Angles',
                    description:'Write different marketing angles using Product Description.',
                    url:'marketing-angles',
                    image:'assets/admin/images/newTemplate/marketing-angles.png'
                },
            ]
        }
    },
    methods: {
        searchTools: function(tools) {
            if(this.searchTool){
                return tools.filter(tool => {
                    return tool.name.toLowerCase().includes(this.searchTool.toLowerCase());
                });
            }else{
                return tools;
            }
        }
    }
});

$('.brand-remaining').keyup(function () {
    var max = 80;
    var len = $(this).val().length;
    if (len >= max) {
        $('.brand-remaining-count').text(len);
    } else {
        var char = max - len;
        $('.brand-remaining-count').text(len);
    }
});

$('.description-remaining').keyup(function () {
    var max = 400;
    var len = $(this).val().length;
    if (len >= max) {
        $('.description-remaining-count').text(len);
    } else {
        $('.description-remaining-count').text(len);
    }
});
