<template>
  <type-skip-layout>
    <div class="row">
      <div class="col-12">
        <div class="d-flex justify-content-between dh-title df">
          <div class="fm-title">
            <div class="fm-title-d-u bg-white">
              <img :src="tool.icon_path.replace('public', '')" />
              <h3 class="fm-text-u">{{ tool.title }}
                <br/>
                <span class="fm-title-desc">{{ tool.short_description }}</span>
              </h3>
            </div>
          </div>
          <div class="tools-color" style="width: 240px">
            <form @submit.prevent="saveColor">
              <div class="form-group">
                <label><b>Set color for this tool</b></label>
                <div class="row">
                  <div class="col-md-7 m-0 p-0">
                    <input type="color" class="w-100" style="height: 35px; margin-top: -3px" v-model="color"/>
                  </div>
                  <div class="col-md-5 m-0 p-0">
                    <button type="submit" class="btn btn-primary btn-sm rounded-0">Set color</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- end page title -->
    <div class="row cards-body c-card">
      <div class="form-area">
        <div class="form-left">
          <form @submit.prevent="generateContext" id="add_form">
            <div v-for="(item, index) in requiredItems" :key="item.key" class="form-group">
              <span class="btm-char-count">
                  <span class="brand-remaining-count" :id="'lb'+item.key" v-if="item.slug === 'brand-name'">{{totalCharacter}}</span>
                  <span class="brand-remaining-count" :id="'lb'+item.key" v-if="item.slug === 'outputs' && item.input_type !== 'multi-select'">{{totalCharacterOut}}</span>
                  <span class="brand-remaining-count" :id="'lb'+item.key" v-if="item.slug === 'company-or-product-description'">{{totalCharacterTextArea}}</span>
                  <span :id="'lm'+item.key" v-if="item.input_type !== 'multi-select'" >/{{ item.input_limit }}</span>
                  <span :id="'lm'+item.key" v-else >Limit: {{ item.input_limit }}</span>
              </span>
              <label :for="'input' + item.key" :id="item.key">{{ item.input_title }}</label>
              <input v-if="item.input_type === 'input'"
                     type="text" v-model="form_data[item.key]"
                     v-on:keyup="charactersLeft(form_data[item.key], item.slug)"
                     :maxlength="item.input_limit"
                     :placeholder="item.input_info_placeholder"
                     class="ctext form-control brand-remaining"/>
                <span v-if="item.input_type === 'input' && errors[item.key]" class="error" :id="'input-error' + item.key">{{ errors[item.key] }}</span>
              <textarea
                v-if="item.input_type === 'textarea'"
                type="text"
                v-model="form_data[item.key]"
                :maxlength="item.input_limit"
                :placeholder="item.input_info_placeholder"
                v-on:keyup="charactersLeft(form_data[item.key], item.slug)"
                class="ctext form-control brand-remaining">
              </textarea>
                <span v-if="item.input_type === 'textarea' && errors[item.key]" class="error" :id="'input-error' + item.key">{{ errors[item.key] }}</span>
              <tag-chooser
                v-if="item.input_type === 'multi-select'"
                v-model="form_data[item.key]"
                :value="form_data[item.key]"
                placeholder="Press enter to add item"
                :limit="10"
                :key="'ip-' + index"
                :ref="'TagInput' + item.key"
                :add-tag-on-keys="[13, 188, 9]">
              </tag-chooser>
              <span v-if="item.input_type === 'multi-select' && errors[item.key]" class="error" :id="'input-error' + item.key">{{ errors[item.key] }}</span>
<!--              <select
                class="ctext form-control brand-remaining"
                v-if="item.input_type == 'select'"
              >
                <option selected disabled>
                  {{ item.input_info_placeholder }}
                </option>
                <option v-for="(n, i) in 10" :key="i" :value="n">
                  {{ n }}
                </option>
              </select>
              <span
                v-if="errors[item.key]"
                class="error"
                :id="'input-error' + item.key"
                >{{ errors[item.key] }}</span
              >-->
            </div>
              <div class="form-group MuiCollapse-container MuiCollapse-hidden" style="min-height: 0px;">
                  <div class="MuiCollapse-wrapper">
                      <div class="MuiCollapse-wrapperInner">
                          <div class="MuiPaper-root MuiAlert-root MuiAlert-standardError MuiPaper-elevation0" role="alert">
                              <div class="MuiAlert-message">Please fill in all required elements and press 'Generate'. </div>
                          </div>
                      </div>
                  </div>
              </div>
            <div class="action-area">
              <div class="outputs">
                <input
                  id="nValue"
                  placeholder="Number of output"
                  type="number"
                  name="number_of_outputs"
                  v-model="noOfoutput"
                  min="1"
                  max="15"
                  aria-describedby="ideas"
                  autocomplete="off"
                  class="pr-20 form-input"/>
                <span>Outputs</span>
              </div>
              <img
                v-if="form.processing"
                style="
                  width: 180px;
                  height: auto;
                  position: absolute;
                  z-index: 99;
                "
                src="/assets/admin/loader/please_wait_new.gif"/>
              <button type="submit" id="submit_btn" class="btn btn-secondary cancel-button mdl-btn" :class="{ locadingActive: form.processing }" :disabled="form.processing">Generate</button>
            </div>
          </form>
        </div>

        <div class="form-right">
          <div v-if="adsResponse.length > 0">
            <div style="display: none" class="note-item response-content-value-id" v-for="(context, index) in adsResponse" :key="'con-' + index">
              <div>
                <p class="sc-XhUPp response-content-text-value-id"
                  data-id="value-id"
                  contenteditable="true">
                  {{ context.description }}
                </p>
                <div class="note-action">
                  <div class="panel-footer">
                    <a href="#"
                      class="copy-icon pr-2"
                      data-toggle="tooltip"
                      data-placement="bottom"
                      title="Copy"
                      data-id="value-id"
                      @click="copyContent(context.description)">
                      <copy-icon />
                    </a>
                    <a href="#"
                      class="delete-icon delete-response pr-2"
                      data-toggle="tooltip"
                      data-placement="bottom"
                      title="Delete"
                      @click="deleteContent(context.id)">
                      <delete-icon />
                    </a>
                    <a href="#"
                      class="pr-2"
                      @click="makeFavourite(context.id)"
                      data-id="value-id"
                      data-toggle="tooltip"
                      data-placement="bottom"
                      title="Favourite"
                      :class="{ active: context.isFavourite }">
                      <favourite-icon />
                    </a>
                    <span class="top-icons mr-2 report-icon pr-2 pt-1" data-id="value-id" @click="makeFlag(context.id, context.description)">
                        <font-awesome-icon style="font-size: 18px;" icon="flag"/>
                    </span>
                    <label class="fm-lbl">{{ context.date }}</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <div class="sc-bXDlPE sc-ctaXAZ jFuWAH edemjN" v-else>
            <div class="card-box content-box remove-after-appends" style="margin-top: 0;">
                <div class="sc-dFJsGO liTBVH">
                    <div style="display: flex; flex-direction: row; align-items: center; justify-content: space-between;">
                    </div>
                    <div class="box-empty">
                        <img src="https://www.typeskip.ai/assets/frontend/landing-images/demo.png" alt="" class="plane">
                        <p>Answer the prompts and click generate to watch the AI magic happen ✨.</p>
                    </div>
                </div>
            </div> <!-- end card-box -->
        </div>
            <div v-if="adsResponse.length > 5">
                <div class="d-flex justify-content-center">
                    <button class="btn btn-primary m-1" @click="showCards()">
                        <i class="fas fa-angle-double-right"></i> More
                    </button>
                    <button class="btn btn-secondary m-1" @click="showCards(true)">
                        <i class="far fa-caret-square-down"></i> All
                    </button>
                </div>
            </div>
            <div class="modal c-modal" id="request_bad_content" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <form @submit.prevent="reportContentSubmit" role="dialog" id="report-form" aria-modal="true" aria-labelledby="modal-headline" class="p-2 overflow-hidden transition-all transform rounded-lg pointer-events-auto">
                                <div class="w-full text-left">
                                    <h3 id="modal-headline" class="mt-1 text-2xl font-bold leading-6 tracking-tight text-gray-800">Flag this content</h3>
                                    <p class="text-sm font-medium text-gray-500">
                                        Help improve our generated content by flagging low quality outputs.
                                    </p>
                                    <!---->
                                    <div class="orange-txt-box">
                                        <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 opacity-50"><path fill-rule="evenodd" d="M3 6a3 3 0 013-3h10a1 1 0 01.8 1.6L14.25 8l2.55 3.4A1 1 0 0116 13H6a1 1 0 00-1 1v3a1 1 0 11-2 0V6z" clip-rule="evenodd"></path></svg>
                                        <p class="reported_content">{{reportContent}}</p>
                                    </div>
                                    <div class="textbox-margin">
                                        <input type="hidden" id="response_id" name="response_id">
                                        <label for="message" class="block font-medium leading-5 text-gray-700"> Message <span class="recomandd-txt" >(recommended)</span> <!----></label>
                                        <div class="rounded-md shadow-sm">
                                            <textarea id="message" name="message" rows="4" autocomplete="off" placeholder="How can we improve this content?" class="d-block w-full form-input report-input" v-model="improveContent"></textarea>
                                            <span v-if="errors['message']" class="error">{{errors["message"] }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="textbox-margin">
                                    <button type="submit" id="submit-button" class="btn btn-primary submit-button">Submit</button>
                                    <button type="button" id="bad-model-close" class="btn btn-secondary cancel-button" data-dismiss="modal" data-target="#request_bad_content">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </type-skip-layout>
</template>
<script>
import TypeSkipLayout from "@/Layouts/TypeSkipLayout";
import TagChooser from "@/Pages/Partials/App/TagChooser";
import DeleteIcon from "@/misc/DeleteIcon";
import FavouriteIcon from "@/misc/FavouriteIcon";
import CopyIcon from "@//misc/CopyIcon";
import Swal from "sweetalert2";
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
  name: "App",
  props: [
    "tool",
    "requiredItems",
    "errors",
    "ads",
    "output",
    "adsResponse",
    "lastAdd",
    "toolColor",
  ],
  components: {
    TypeSkipLayout,
    TagChooser,
    DeleteIcon,
    FavouriteIcon,
    CopyIcon,
  },
  data() {
    return {
      color: this.toolColor,
      tags: [],
      form_data: {},
      noOfoutput: 5,
      totalCharacter: 0,
      totalCharacterTextArea: 0,
      totalCharacterOut: 0,
      totalCharacterKeyword: 0,
      countForShowCart: 0,
      generatedContents: {},
      favourite: false,
      response_id: 0,
      reportContent: '',
      improveContent: '',
      tag: "",
      form: this.$inertia.form({
        _method: "PUT",
      }),
      favouriteForm: this.$inertia.form({
        _method: "POST",
      }),
      deleteForm: this.$inertia.form({
        _method: "POST",
      }),
      storeColor: this.$inertia.form({
        _method: "POST",
      }),
      isProcessing: false,
    };
  },
  mounted() {
    for (let i = 0; i < this.requiredItems.length; i++) {
      this.form_data[this.requiredItems[i].key] = this.requiredItems[i].value;
    }
      if (this.lastAdd.company_name){
          this.totalCharacter = this.lastAdd.company_name.length;
      }
      if (this.lastAdd.add_keywords){
          this.totalCharacterOut = this.lastAdd.add_keywords.length;
      }
      if (this.lastAdd.description){
          this.totalCharacterTextArea = this.lastAdd.description.length;
      }
    this.showCards();
  },
  methods: {
      makeFlag(id, content){
          $('#request_bad_content').modal('show');
          this.reportContent = content;
          this.response_id = id;
      },
      reportContentSubmit(){
          this.form = this.$inertia.form({
              message: this.improveContent,
              response_id: this.response_id,
          });
          this.form.post(this.route("report-content"), {
              onSuccess: () => {
                  this.toast.success("Content Reported Successfully!", {
                      position: POSITION.TOP_CENTER
                  });
                  $('#request_bad_content').modal('hide');
                  this.reportContent = '';
                  this.response_id = '';
              }
          });
      },
      charactersLeft(value, type) {
          if (type === 'brand-name'){
              this.totalCharacter = value.length;
          }
          if (type === 'outputs'){
              this.totalCharacterOut = value.length;
          }
          if (type === 'company-or-product-description'){
              this.totalCharacterTextArea = value.length;
          }
      },
      showCards(all = false){
          let cart = document.getElementsByClassName('note-item')
          this.countForShowCart  = this.countForShowCart  + 5;
          for(let i = 0; i < cart.length; i++){
              if(all || i < this.countForShowCart ){
                  cart[i].style.display = 'block';
              }
          }
          return true;
      },
      charCount: function(text){
          // console.log(text);
      },
      generateContext() {
      for (let i = 0; i < this.requiredItems.length; i++) {
        if (this.requiredItems[i].input_type === "multi-select") {
          this.form_data[this.requiredItems[i].key] =
            this.$refs["TagInput" + this.requiredItems[i].key].innerTags;
        }
      }
      this.form_data["tool_id"] = this.tool.id;
      this.form_data["number_of_outputs"] = this.noOfoutput;
      this.form_data["outputs"] = this.noOfoutput;
      this.form_data["_method"] = "POST";
      this.form = this.$inertia.form(this.form_data);
        this.form.post(this.route("generate_content"),{
            onSuccess: () =>{
                this.toast.success("Content Generated Successfully!", {
                    position: POSITION.TOP_CENTER
                });
                let cart = document.getElementsByClassName('note-item');
                for(let i = 0; i < cart.length; i++){
                    cart[i].style.display = 'block';
                }
            }
        });
    },
    copyContent(text) {
      navigator.clipboard.writeText(text);
    },
    makeFavourite(responseId) {
        this.favouriteForm = this.$inertia.form({ responseId: responseId });
        this.favouriteForm.post(this.route("add_fav"),{
            onSuccess: () =>this.toast.success("Added to Favourite Successfully!", {
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
                onSuccess: () =>this.toast.success("Content Removed Successfully!", {
                    position: POSITION.TOP_CENTER
                })
            });
        }
      });
    },
  saveColor() {
     this.storeColor = this.$inertia.form({ toolid: this.tool.id , color: this.color});
     this.storeColor.post(this.route("add_color"),{
         onSuccess: () =>this.toast.success("Content Color Added Successfully!", {
              position: POSITION.TOP_CENTER
          })
     });
    }
  }
};
</script>

<style scoped>
.fm-title-d-u {
  background: 0 0 !important;
  border-radius: 50%;
  height: 60px;
  justify-content: center;
  display: flex;
  align-content: center;
  gap: 15px;
}
.fm-text-u {
  display: flex;
  flex-direction: column;
  justify-content: center;
}
@media screen and (min-width: 766px) {
  .left-side-menu {
    position: absolute;
  }
  body[data-sidebar-size="condensed"] .content-page {
    margin-left: 0 !important;
    padding: 0 15px 65px;
  }
  .form-area .form-left {
    margin-bottom: -999px;
    padding-bottom: 999px;
    padding-top: 20px;
    height: 100%;
  }
  .dh-title.df {
    margin: 20px 0 0;
    padding-bottom: 10px;
  }
  textarea.form-control {
    height: 100px;
  }
  .action-area {
    margin-top: 30px;
    padding: 15px 15px 20px 0;
  }
}
@media screen and (max-width: 765px) {
  .fr-area {
    padding: 10px 15px 10px 10px;
  }
  .action-area {
    position: fixed;
    bottom: 0;
    width: 100%;
    background: #f5f7fb;
    display: flex;
    justify-content: center;
    padding-right: 0;
    align-items: center;
  }
}

.delete-icon {
  margin-left: 0 !important;
}
.kiNLFp {
  padding: 20px;
  background-color: white;
  border: 1px solid rgb(132, 141, 211);
  width: 100%;
  border-radius: 10px;
  margin-bottom: 15px;
}
.fNjRST {
  display: flex;
  -moz-box-pack: center;
  justify-content: center;
  -moz-box-align: center;
  align-items: center;
  width: calc(100% + 40px);
  margin-top: 10px;
  margin-left: -20px;
  height: 260px;
  border-top: 1px solid rgb(220, 220, 220);
  border-bottom: 1px solid rgb(220, 220, 220);
}
.jOcitS {
  margin-bottom: 6px;
  left: 3rem;
  bottom: 2.25rem;
  font-family: Helvetica, Open Sans;
  line-height: 1.195rem;
}
.kxdBff {
  position: relative;
  width: calc(100% + 40px);
  margin-left: -20px;
  padding-left: 18px;
  padding-top: 8px;
  height: 78px;
  border-bottom: 1px solid rgb(220, 220, 220);
  background-color: rgb(240, 242, 245);
  font-family: Helvetica, Open Sans;
  font-size: 1rem;
  color: rgb(101, 103, 107);
}
.absolute-btn {
  position: absolute;
  right: 21%;
}
.delete-icon {
  margin-left: 0 !important;
}
.kiNLFp {
  padding: 20px;
  background-color: white;
  border: 1px solid rgb(132, 141, 211);
  width: 100%;
  border-radius: 10px;
  margin-bottom: 15px;
}
.fNjRST {
  display: flex;
  -moz-box-pack: center;
  justify-content: center;
  -moz-box-align: center;
  align-items: center;
  width: calc(100% + 40px);
  margin-top: 10px;
  margin-left: -20px;
  height: 260px;
  border-top: 1px solid rgb(220, 220, 220);
  border-bottom: 1px solid rgb(220, 220, 220);
}
.jOcitS {
  margin-bottom: 6px;
  left: 3rem;
  bottom: 2.25rem;
  font-family: Helvetica, Open Sans;
  line-height: 1.195rem;
}
.kxdBff {
  position: relative;
  width: calc(100% + 40px);
  margin-left: -20px;
  padding-left: 18px;
  padding-top: 8px;
  height: 78px;
  border-bottom: 1px solid rgb(220, 220, 220);
  background-color: rgb(240, 242, 245);
  font-family: Helvetica, Open Sans;
  font-size: 1rem;
  color: rgb(101, 103, 107);
}
.locadingActive {
  opacity: 0;
}
label#outputs {
    display: none;
}
span#lboutputs {
    display: none;
}
span#lboutputs {
    display: none;
}

.report-icon:hover{
    color:blue;
}
</style>
