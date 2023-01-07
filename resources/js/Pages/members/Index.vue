<template>
  <type-skip-layout>
      <section class="profile bg-light">
          <div class="container-fluid">
              <div class="templatediv">
                  <!-- Form row -->
                  <div class="row breadcrumbs">
                      <div class="col-12">
                          <Link href="/app" class="menu-iteam-ts">Dashboard</Link>
                          <span class="dot-seprator">●</span> <span>Team Members</span>
                      </div>
                  </div>
                  <div class="row" style="margin-top: 3%">
                      <div class="col-md-12">
                        <div class="card ts-radius ts-form h-auto">
                          <div class="card-body w-100">
                              <div class="auth-logo">Team Members</div>
                              <br>
                              <div class="row" v-if="userR.linked_user_role === 'user'">
                                  <div class="col-md-9">
                                      <a href="#" title="Only team owner can send member invitation." data-toggle="tooltip" data-placement="top" class="btn btn-light red-tooltip"><i class="fas fa-times"></i> Only team owner can send member invitation</a>
                                  </div>
                              </div>
                              <div class="row" v-else>
                                  <div class="col-md-6">
                                      <input type="text" id="myInput" readonly="" name="link" v-model="link" class="form-control">
                                  </div>
                                  <div class="col-md-3 align-item" v-if="refers.length>=10">
                                      <a href="#" class="btn btn-success btn-block ts-f-btn" @click="alert('You can add max 10 members!');">Share Url</a>
                                  </div>
                                  <div class="col-md-4 align-item btn-group" v-else>
                                      <a href="#" style="padding-top: 14px;" class="btn btn-success btn-block ts-f-btn" @click="share(link);"><font-awesome-icon icon="copy"/> Copy Link</a>
                                      <a href="#" style="margin-left: 10px;margin-top: 0;padding-top: 14px;" title="The existing link will be deactivated." data-toggle="tooltip" data-placement="top" class="btn btn-success btn-block ts-f-btn red-tooltip" @click="reset(userR.id)"><font-awesome-icon icon="sync-alt"/> Reset Link</a>
                                  </div>
                              </div>
                              <br>
                              <div class="table-auto">
                                  <table class="table table-bordered table-striped">
                                      <thead>
                                          <tr>
                                              <th>#</th>
                                              <th>Name</th>
                                              <th>Email</th>
                                              <th>Status</th>
                                              <th v-if="userR.linked_user_role ==='admin'">Action</th>
                                          </tr>
                                      </thead>
                                      <tbody v-if="refers.length !== 0">
                                      <template v-for="(ref, key) in refers" :key='key'>
                                          <tr>
                                              <td>{{ref.id}}</td>
                                              <td>{{ref.username}}</td>
                                              <td>{{ref.email}}</td>
                                              <td>
                                                  <span class="badge badge-success" v-if="userR.linked_user_role ==='user'">{{ref.linked_user_role}}</span>
                                                  <span class="badge badge-success" v-else>{{ref.linked_user_role}}</span>
                                              </td>
                                              <td v-if="userR.linked_user_role == 'admin'">
                                                  <a v-if="ref.linked_user_role !== 'admin'" href="#" @click="removeUser(ref.id)" class="btn"><font-awesome-icon icon="trash"/></a>
                                              </td>
                                          </tr>
                                      </template>
                                  </tbody>
                                  </table>
                              </div>
                          </div> <!-- end card-body -->
                      </div> <!-- end card-->
                      </div>
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
import Swal from "sweetalert2";

export default defineComponent({
  name: "Index",
  props: ["userR","refers"],
  components: {
    Head,
    Link,
    TypeSkipLayout
  },
  data() {
    return {
      searchTool: "",
      link:  window.location.origin +'/register/?ref='+this.userR.linkout,
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
      share(text){
          navigator.clipboard.writeText(text);
          Swal.fire(
              'Copied!',
              'Link Copied Successfully.',
              'success'
          );
      },
      reset(argument){
          Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, reset it!'
          }).then((result) => {
              if (result.isConfirmed) {
                  $.ajax({
                      url: 'update/link/'+argument,
                      type: "get",
                      dataType:'JSON',
                      contentType: false,
                      cache: false,
                      processData: false,
                      beforeSend: function(){
                      },
                      success: function (data) {
                          Swal.fire(
                              'Updated!',
                              'Link has been updated.',
                              'success'
                          );
                          location.reload();
                      },
                      error:(function(error) {
                          alert("Something went wrong");
                      })
                  });
              }
          });
      },
      removeUser(id) {
          Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, remove it!'
          }).then((result) => {
              if (result.isConfirmed) {
                  $.ajax({
                      url: 'delete/member/'+id,
                      type: "get",
                      dataType:'JSON',
                      contentType: false,
                      cache: false,
                      processData: false,
                      beforeSend: function(){
                      },
                      success: function (data) {
                          Swal.fire(
                              'Removed!',
                              'Member removed successfully!',
                              'success'
                          );
                          location.reload();
                      },
                      error:(function(error) {
                          alert("Something went wrong");
                      })
                  });
              }
          });
      }
  }
});
</script>

<style scoped>
body {
  background-color: #f5f5f5;
}
a.btn.btn-success.btn-block.ts-f-btn.red-tooltip {
    background: #f3f7f9;
    color: #5c646f!important;
    margin-top: 0;
    margin-left: 15px;
}
.ts-f-btn{
    font-weight: 600;
}
</style>
