<template>
  <div class="modal c-modal"
    v-bind:id="`content-details` + content.id"
    tabindex="-1"
    role="dialog"
    aria-modal="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content" >
          <form @submit.prevent="updateContentSubmit">
            <div class="modal-body">
              <div class="w-full text-left">
                <div class="mdl-close">
                  <a href="#" data-dismiss="modal">
                    <img src="/assets/admin/images/new/round-close.svg"/>
                  </a>
                </div>
                <div class="mdl-pos">
                  <div class="mdl-img">
                      <img v-if="content.ads.ads_category == 'google'" src="/assets/admin/images/newTemplate/google-symbol.svg" />
                      <img v-if="content.ads.ads_category == 'product-description'" src="/assets/admin/images/newTemplate/product-description.png" />
                      <img v-if="content.ads.ads_category == 'facebook-headline'" src="/assets/admin/images/newTemplate/facebook.svg" />
                      <img v-if="content.ads.ads_category == 'facebook'" src="/assets/admin/images/newTemplate/facebook.svg" />
                      <img v-if="content.ads.ads_category == 'pas-framework'" src="/assets/admin/images/newTemplate/pas-framework.png" />
                      <img v-if="content.ads.ads_category == 'copy-paste'" src="/assets/admin/images/newTemplate/sentenceimprover.png" />

                      <img v-if="content.ads.ads_category == 'aida-principle'" src="/assets/admin/images/newTemplate/aida-principal.png" />
                      <img v-if="content.ads.ads_category == 'sentence-expander'" src="/assets/admin/images/newTemplate/sentence-expander.png" />
                      <img v-if="content.ads.ads_category == 'blog-outline'" src="/assets/admin/images/newTemplate/blog-outline.png" />
                      <img v-if="content.ads.ads_category == 'great-headlines'" src="/assets/admin/images/newTemplate/headline-generator.png" />
                      <img v-if="content.ads.ads_category == 'persuasive-bullet-points'" src="/assets/admin/images/newTemplate/persuasive-bullet-point.png" />
                      <img v-if="content.ads.ads_category == 'marketing-angles'" src="/assets/admin/images/newTemplate/marketing-angles.png" />

                      <img v-if="content.ads.ads_category == ''" src="/assets/admin/images/newTemplate/google-symbol.svg" />
                  </div>
                  <h3 class="mt-1">
                    <span class="modal-title">{{  content.ads.ads_category? content.ads.ads_category.split("-").join(" ") : 'Example' }}</span><br /><span
                      class="mdl-small time">
                      {{ content.date }}
                    </span>
                  </h3>
                </div>
                <div class="mdl-con">
                    <textarea autocomplete="off" style="border: none;height: 250px;" class="
                      d-block w-full form-input
                      text-sm
                      font-medium
                      text-gray-500
                      content-description
                      new-content-class"
                    id="modal-content-desc"
                    contenteditable="true" v-model=" content.description ">
                    </textarea>
                </div>
                <div class="d-fl-ftr">
                  <div class="panel-footer">
                    <a href="javascript:;"
                      class=""
                      data-toggle="tooltip"
                      data-placement="bottom"
                      title=""
                      data-original-title="Copy"
                      @click="copyContent(content.description)">
                     <copy-icon />
                    </a>
                    <a href="javascript:void(0)"
                      class="delete-response"
                      data-toggle="tooltip"
                      data-placement="bottom"
                      title=""
                      data-original-title="Delete"
                      @click="deleteContent(content.id)">
                     <delete-icon />
                    </a>
                    <a href="javascript:;"
                      :class="{ active: content.isFavourite }"
                      data-toggle="tooltip"
                      data-placement="bottom"
                      title=""
                      @click="makeFavourite(content.id)"
                      data-original-title="Favourite">
                      <favourite-icon />
                    </a>
                    <Link
                      class="show-input"><pen-icon />
                    </Link>
                    <button class="mdl-s-ipt input-url" @click="goToPage">Show input</button>
                  </div>
                  <button
                    type="submit"
                    class="btn btn-secondary cancel-button mdl-btn"
                    id="update-response">
                    Submit
                  </button>
                </div>
              </div>
            </div>
          </form>
      </div>
    </div>
  </div>
</template>

<script>
import DeleteIcon from "@/misc/DeleteIcon";
import FavouriteIcon from "@/misc/FavouriteIcon";
import CopyIcon from '@//misc/CopyIcon';
import PenIcon from '@//misc/PenIcon';
import Swal from "sweetalert2";
import { Link } from "@inertiajs/inertia-vue3";
import {POSITION, useToast} from "vue-toastification";

export default {
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
  name: "ContentModal",
  props: ["content"],
  components: {
    DeleteIcon,
    FavouriteIcon,
    CopyIcon,
      Link,
    PenIcon
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
            content_id: '',
            content_description: '',
            url: '',
        };
    },
    mounted(){
        this.content_id = this.content.id;
        this.content_description = this.content.description;
    },
    methods: {
        goToPage(){
            window.location.href = '/app/'+this.content.ads.ads_category;
        },
        copyContent(text) {
            navigator.clipboard.writeText(text);
            console.log("Text copied");
        },
        makeFavourite(responseId) {
            this.favouriteForm = this.$inertia.form({ responseId: responseId });
            this.favouriteForm.post("/content/favourite");
        },
        updateContentSubmit(){
            this.form = this.$inertia.form({
                // message: $('#modal-content-desc').html(),
                message: this.content.description,
                response_id: this.content_id,
            });
            this.form.post(this.route("update-response"), {
                onSuccess: () => {
                    this.toast.success("Content Updated Successfully!", {
                        position: POSITION.TOP_CENTER
                    });
                    this.content_description = '';
                    this.content_id = '';
                }
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
                    this.deleteForm.post("/content/delete");
                }
            });
        },
    },
};
</script>

<style scoped>

#modal-content-desc::-webkit-scrollbar {
    display: none;
}
</style>
