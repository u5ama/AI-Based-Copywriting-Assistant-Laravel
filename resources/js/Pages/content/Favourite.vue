<template>
  <type-skip-layout>
    <section class="all-content-body bg-light">
      <h4 class="content-main-header mt-3 mb-3">
        <p class="content-header">Favorites</p>
      </h4>
      <div class="row cards-body c-card contentdiv" v-if="favouriteContents.length > 0">
        <div class="col-md-4" v-for="favouriteContent in favouriteContents" :key="favouriteContent.key">
            <div class="panel">
                <div data-toggle="modal"
                    v-bind:data-target="`#content-details` + favouriteContent.content.id"
                    class="panel-title"
                    :style="[favouriteContent.color ? {background: favouriteContent.color} : {background: '#2BE5CF'}] ">
                    <ads-info :adsInfo="favouriteContent.ads" :contentDate="favouriteContent.content.date" />
                </div>
                <div
                    class="panel-body panel-body-content content-description"
                    data-toggle="modal"
                    v-bind:data-target="`#content-details` + favouriteContent.content.id">
                    <p class="mt-2" v-if="favouriteContent.content.description.length < 200">
                        {{ favouriteContent.content.description }}
                    </p>
                    <p class="mt-2" v-if="favouriteContent.content.description.length >= 200">
                        {{ favouriteContent.content.description.substring(0, 200) + "..." }}
                    </p>
                </div>
                <div class="panel-footer">
                    <a href="javascript:;"
                        class="copy-response"
                        data-toggle="tooltip"
                        data-placement="bottom"
                        title="Copy"
                        @click="copyContent(favouriteContent.content.description)">
                        <svg id="fi-rr-copy"
                            xmlns="http://www.w3.org/2000/svg"
                            width="26.414"
                            height="26.414"
                            viewBox="0 0 26.414 26.414">
                            <path
                                id="fi-rr-copy-2"
                                data-name="fi-rr-copy"
                                d="M16.509,22.012H5.5a5.51,5.51,0,0,1-5.5-5.5V5.5A5.51,5.51,0,0,1,5.5,0H16.509a5.51,5.51,0,0,1,5.5,5.5V16.509A5.51,5.51,0,0,1,16.509,22.012ZM5.5,2.2A3.3,3.3,0,0,0,2.2,5.5V16.509a3.3,3.3,0,0,0,3.3,3.3H16.509a3.3,3.3,0,0,0,3.3-3.3V5.5a3.3,3.3,0,0,0-3.3-3.3Zm20.911,18.71V6.6a1.1,1.1,0,0,0-2.2,0V20.911a3.3,3.3,0,0,1-3.3,3.3H6.6a1.1,1.1,0,0,0,0,2.2H20.911A5.51,5.51,0,0,0,26.414,20.911Z">
                            </path>
                        </svg>
                    </a>
                    <a href="javascript:;"
                        class="delete-response"
                        data-toggle="tooltip"
                        data-placement="bottom"
                        title="Delete"
                        @click="deleteContent(favouriteContent.content.id)">
                        <svg id="fi-rr-trash"
                            xmlns="http://www.w3.org/2000/svg"
                            width="22.012"
                            height="26.414"
                            viewBox="0 0 22.012 26.414">
                            <path
                                id="Path_150"
                                data-name="Path 150"
                                d="M22.911,4.4H19.5A5.513,5.513,0,0,0,14.107,0h-2.2A5.513,5.513,0,0,0,6.512,4.4H3.1a1.1,1.1,0,0,0,0,2.2H4.2V20.911a5.51,5.51,0,0,0,5.5,5.5h6.6a5.51,5.51,0,0,0,5.5-5.5V6.6h1.1a1.1,1.1,0,0,0,0-2.2ZM11.905,2.2h2.2A3.308,3.308,0,0,1,17.22,4.4H8.792a3.308,3.308,0,0,1,3.114-2.2Zm7.7,18.71a3.3,3.3,0,0,1-3.3,3.3H9.7a3.3,3.3,0,0,1-3.3-3.3V6.6H19.61Z"
                                transform="translate(-2)">
                            </path>
                            <path
                                id="Path_151"
                                data-name="Path 151"
                                d="M10.1,18.8a1.1,1.1,0,0,0,1.1-1.1V11.1a1.1,1.1,0,0,0-2.2,0v6.6A1.1,1.1,0,0,0,10.1,18.8Z"
                                transform="translate(-1.296 1.006)">
                            </path>
                            <path
                                id="Path_152"
                                data-name="Path 152"
                                d="M14.1,18.8a1.1,1.1,0,0,0,1.1-1.1V11.1a1.1,1.1,0,0,0-2.2,0v6.6A1.1,1.1,0,0,0,14.1,18.8Z"
                                transform="translate(-0.893 1.006)">
                            </path>
                        </svg>
                    </a>
                    <a href="javascript:;"
                        class="active"
                        data-toggle="tooltip"
                        data-placement="bottom"
                        title="make favourite"
                        @click="removeFavourite(favouriteContent.content.id)">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="26.41"
                            height="25.568"
                            viewBox="0 0 26.41 25.568">
                            <g id="fi-rr-star" transform="translate(0 0)">
                                <path
                                    id="fi-rr-star-2"
                                    data-name="fi-rr-star"
                                    d="M26.233,9.66a3.5,3.5,0,0,0-3.376-2.45H18.049l-1.46-4.552a3.552,3.552,0,0,0-6.764,0L8.364,7.21H3.555a3.552,3.552,0,0,0-2.091,6.419L5.378,16.49,3.89,21.1a3.553,3.553,0,0,0,5.485,3.956l3.831-2.82,3.832,2.816A3.552,3.552,0,0,0,22.523,21.1L21.035,16.49l3.918-2.862A3.5,3.5,0,0,0,26.233,9.66Zm-2.579,2.191-4.561,3.334a1.1,1.1,0,0,0-.4,1.228l1.733,5.36a1.35,1.35,0,0,1-2.086,1.5l-4.485-3.3a1.1,1.1,0,0,0-1.3,0l-4.485,3.3a1.35,1.35,0,0,1-2.091-1.5l1.739-5.36a1.1,1.1,0,0,0-.4-1.228L2.758,11.851a1.35,1.35,0,0,1,.8-2.44H9.168a1.1,1.1,0,0,0,1.048-.764L11.922,3.33a1.35,1.35,0,0,1,2.571,0L16.2,8.647a1.1,1.1,0,0,0,1.048.764H22.86a1.35,1.35,0,0,1,.8,2.44Z"
                                    transform="translate(-0.008 -0.19)">
                                </path>
                            </g>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
      </div>
        <div class="row cards-body c-card contentdiv" v-else>
            <div style="
                display: flex;
                justify-content: center;
                align-items: center;
                width: 100%;
                vertical-align: middle;">
                <img style="
                  display: block;
                  margin-left: auto;
                  margin-right: auto;width: 12%;" src="/assets/admin/images/new/menu/icons-fav.svg" alt="">
            </div>
            <div style="
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            vertical-align: middle;">
                <p class="pt-3">Add To Favourite</p>
            </div>
        </div>
    </section>
  </type-skip-layout>
</template>

<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import TypeSkipLayout from "@/Layouts/TypeSkipLayout";
import AdsInfo from "@/components/partials/AdsInfo";
import ContentModal from "@/components/partials/ContentModal";
import Swal from "sweetalert2";
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
  name: "Favourite",
  props: ["favouriteContents"],
  components: {
    Head,
    Link,
    AdsInfo,
      ContentModal,
    TypeSkipLayout,
  },
  data() {
    return {
      searchTool: "",
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
    copyContent(text) {
      navigator.clipboard.writeText(text);
    },
    removeFavourite(responseId) {
      this.favouriteForm = this.$inertia.form({ responseId: responseId });
        this.favouriteForm.post(this.route("remove_fav"),{
            onFinish: () =>this.toast.success("Removed From Favourite Successfully!", {
                position: POSITION.TOP_CENTER
            })
        });
    },
    deleteContent(responseId) {
      Swal.fire({
        text: "Are you sure want to delete this content?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
      }).then((result) => {
        if (result.isConfirmed) {
          this.deleteForm = this.$inertia.form({ responseId: responseId });
            this.deleteForm.post(this.route("content_delete"),{
                onFinish: () =>this.toast.success("Content Removed Successfully!", {
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
body {
  background-color: #f5f5f5;
}
</style>
