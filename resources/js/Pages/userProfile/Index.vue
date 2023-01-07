<template>
  <type-skip-layout :tools="[]">
    <section class="profile bg-light">
      <div class="container-fluid">
        <div class="templatediv">
          <!-- Form row -->
          <div class="row breadcrumbs">
            <div class="col-12">
              <Link href="/app" class="menu-iteam-ts">Dashboard</Link>
              <span class="dot-seprator">●</span> <span>Profile</span>
            </div>
          </div>
          <div class="row" style="margin-top: 3%">
            <div class="col-md-8 mx-auto">
              <div class="card ts-radius ts-form h-auto">
                <div class="card-body w-100">
                    <form @submit.prevent="uploadProfilePicture">
                        <div class="auth-logo">Profile picture</div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <myUpload field="img"
                                           @crop-success="cropSuccess"
                                           @crop-upload-success="cropUploadSuccess"
                                           @crop-upload-fail="cropUploadFail"
                                           v-model="show"
                                           url="profile/update/photo"
                                           :params="params"
                                           :headers="headers"
                                           langType="en"
                                           img-format="png"></myUpload>
                                <span v-if="errors['photo']" class="error">{{errors["photo"] }}</span>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-2">
                                <img v-if="$page.props.profile_picture" :src="`/storage/${$page.props.profile_picture}`" alt="profile"/>
                            </div>
                        </div>
                        <a class="btn btn-success btn-block ts-f-btn" @click="toggleShow">Upload Profile Picture</a>
                    </form>
                </div>
                <!-- end card-body -->
              </div>
              <!-- end card-->
            </div>
            <!-- end col -->
          </div>
          <!-- end row -->
          <div class="row" style="margin-top: 3%">
            <div class="col-md-8 mx-auto">
              <div class="card ts-radius ts-form h-auto">
                <div class="card-body w-100">
                  <form @submit.prevent="updateName">
                    <div class="auth-logo">Personal Information</div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="firstname" class="col-form-label">First Name*</label>
                        <input type="text" class="form-control" id="firstname" name="first_name" v-model="userInfo.first_name" placeholder="First Name*" />
                        <span v-if="errors['first_name']" class="error">{{errors["first_name"] }}</span>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="lastname" class="col-form-label">Last Name*</label>
                        <input type="text" class="form-control" id="lastname" name="last_name" v-model="userInfo.last_name" placeholder="Last Name*" />
                        <span v-if="errors['last_name']" class="error">{{errors["last_name"] }}</span>
                      </div>
                    </div>
                    <input type="submit" class="btn btn-success btn-block ts-f-btn" value="Update Profile" />
                  </form>
                </div>
                <!-- end card-body -->
              </div>
              <!-- end card-->
            </div>
            <!-- end col -->
          </div>
          <!-- end row -->
          <!-- Form row -->
          <div class="row" style="margin-top: 3%">
            <div class="col-md-8 mx-auto">
              <div class="card ts-radius ts-form h-auto">
                <div class="card-body w-100">
                  <form @submit.prevent="updateCompanyInfo">
                    <div class="auth-logo">Company Information</div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="company" class="col-form-label">Company*</label>
                        <input type="text" class="form-control" id="company" name="cmpName" v-model="userInfo.cmpName" placeholder="Company*" />
                        <span v-if="errors['companyName']" class="error">{{errors["companyName"] }}</span>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-12">
                        <label for="description" class="col-form-label">Description*</label>
                        <textarea class="form-control" id="description" name="cmpDescription" placeholder="Description" rows="5" v-model="userInfo.cmpDescription"></textarea>
                        <span v-if="errors['companyDescription']" class="error">{{ errors["companyDescription"] }}</span>
                      </div>
                    </div>
                    <input type="submit" class="btn btn-success btn-block ts-f-btn" value="Update" />
                  </form>
                </div>
                <!-- end card-body -->
              </div>
              <!-- end card-->
            </div>
            <!-- end col -->
          </div>
          <!-- end row -->
        </div>
      </div>
    </section>
  </type-skip-layout>
</template>
<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import TypeSkipLayout from "@/Layouts/TypeSkipLayout";
import myUpload from 'vue-image-crop-upload';
import {POSITION, useToast} from "vue-toastification";
var csrf_token = $('meta[name="csrf-token"]').attr('content');

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
  props: ["user", "errors"],
  components: {
    Head,
    Link,
    TypeSkipLayout,
      myUpload
  },
  data() {
    return {
        show: false,
        params: {
            _token: csrf_token,
            name: 'profile_image'
        },
        headers: {
            smail: '*_~'
        },
        imgDataUrl: '',
      userInfo: {
        first_name: this.user.fname,
        last_name: this.user.lname,
        cmpName: this.user.cmp_name,
        cmpDescription: this.user.cmp_description,
        profilePic: this.$page.props.profile_picture,
      },
      imageUpdateForm: this.$inertia.form({
        _method: "POST",
      }),
      previewenabled: false,
    };
  },
    mounted(){
      console.log(csrf_token);
    },
  methods: {
      toggleShow() {
          this.show = !this.show;
      },
      cropSuccess(imgDataUrl, field){
          console.log('-------- crop success --------');
          this.imgDataUrl = imgDataUrl;
      },
      cropUploadSuccess(jsonData, field){
          console.log('-------- upload success --------');
          console.log(jsonData);
          console.log('field: ' + field);
          this.toast.success("Profile Image Updated Successfully!", {
              position: POSITION.TOP_CENTER
          });
          window.location.reload();
      },
      /**
       * upload fail
       *
       * [param] status    server api return error status, like 500
       * [param] field
       */
      cropUploadFail(status, field){
          console.log('-------- upload fail --------');
          console.log(status);
          console.log('field: ' + field);
      },
    updateName() {
      let NameUpdaeForm = this.$inertia.form({
          first_name: this.userInfo.first_name,
          last_name: this.userInfo.last_name,
      });
      NameUpdaeForm.post(this.route("update_name"),{
          onSuccess: () => {
              this.toast.success("Name Updated Successfully!", {
                  position: POSITION.TOP_CENTER
              });
          }
      })
    },
    updateCompanyInfo() {
      let updateCompanyInfoForm = this.$inertia.form({
        companyName: this.userInfo.cmpName,
        companyDescription: this.userInfo.cmpDescription,
      });
      updateCompanyInfoForm.post(this.route("update_company"),{
        onSuccess: () => {
            this.toast.success("Company Updated Successfully!", {
                position: POSITION.TOP_CENTER
            });
        }
      })
    },
    uploadProfilePicture() {
      if (this.$refs.photo) {
        this.imageUpdateForm = this.$inertia.form({
          photo: this.$refs.photo.files[0],
        });
        this.imageUpdateForm.post(this.route("update_company"),{
          onSuccess: () => {
              this.toast.success("Image Updated Successfully!", {
                  position: POSITION.TOP_CENTER
              });
          }
        })
      }
    },
  },
});
</script>

<style scoped>

</style>
