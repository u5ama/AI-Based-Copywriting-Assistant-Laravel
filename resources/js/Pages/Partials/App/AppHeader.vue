<template>
  <!-- Topbar Start -->
  <div class="navbar-custom" style="background-color: white">
    <div class="container-fluid">
      <div class="header-logo">
        <Link :href="route('app')" title="Dashboard"><img src="/assets/admin/images/template/icon.png" alt="Logo"/></Link>
      </div>
        <ul class="list-unstyled topnav-menu topnav-menu-left m-0 ml-5">
            <li>
                <div class="templatediv">
                <div class="proj-dropdown dropdown">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <a href="#" v-for="(p, index) in $page.props.projects" :key="index" class="d-h-flex">
                            <span v-if="$page.props.user.current_project === p.projects.id"><b class="sort-nname">{{p.projects.name.substring(0,2)}}</b>
                            <img src="https://www.typeskip.ai/assets/admin/images/new/mp-img.svg" class="mp-img">
                            </span>
                            <span v-if="$page.props.user.current_project === p.projects.id">{{p.projects.name}}</span>
                            <span v-if="$page.props.user.current_project === p.projects.id"><img src="https://www.typeskip.ai/assets/admin/images/new/arrowup.svg" class="mp-img-drp"></span>
                        </a>
                    </button>
                    <ul class="dropdown-menu ts-dropdown" aria-labelledby="dropdownMenu">
                        <div class="project-wrap">
                            <h5>Create New Project <a href="#" data-toggle="modal" data-target="#createProject"><font-awesome-icon icon="plus" /></a></h5>
                            <div class="drp-user" v-for="p in $page.props.projects">
                                <span class="name-ltr pointer" @click="change_project(p.projects.id)">{{p.projects.name.substring(0,2)}}</span>
                                <span class="name-full pointer" @click="change_project(p.projects.id)" :data-id="p.projects.id">{{p.projects.name}}<abbr> </abbr></span>
                                <span v-if="$page.props.user.current_project === p.projects.id" class="name-tick pointer" @click="change_project(p.projects.id)">
                                    <img src="https://www.typeskip.ai/assets/admin/images/new/green-check.svg">
                                </span>
                                <div class="dropdown dot-drop">
                                    <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="three-dot">...</span>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dLabel">
                                        <li><a href="#" data-toggle="modal" :data-id="p.projects.id" data-name="My Project" data-target="#createProject" @click="rename_project(p.projects.id, p.projects.name)"><font-awesome-icon icon="edit"/>&nbsp; Rename</a></li>
                                        <li><a href="#" :data-id="p.projects.id" @click="delete_project(p.projects.id)"><font-awesome-icon icon="trash"/>&nbsp; Delete</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
        </li>
    </ul>
      <ul class="list-unstyled topnav-menu float-right mb-0">
        <li class="dropdown notification-list topbar-dropdown">
          <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="#">
            <span class="pro-user-name ml-1" style="color: #fe5c5a; text-transform: uppercase">
              <img :src="`/storage/${$page.props.profile_picture}`" alt="" v-if="$page.props.profile_picture"/>
              <span v-else>{{$page.props.user.username.substring(0, 2) }}</span>
            </span>
          </a>
          <div class="dropdown-menu dropdown-menu-right profile-dropdown">
            <div class="profile-mail">
              <a href="#">
                <div class="circle-box">
                  <img :src="`/storage/${$page.props.profile_picture}`" alt="" v-if="$page.props.profile_picture"/>
                  <span v-if="!$page.props.profile_picture">{{$page.props.user.username.substring(0, 2)}}</span>
                </div>
                <div class="side-profile-name">
                  <h5>{{ $page.props.user.username }}</h5>
                  <p>{{ $page.props.user.email }}</p>
                </div>
              </a>
            </div>
            <div class="dropdown-divider"></div>
            <Link href="/" class="dropdown-item notify-item">
                <font-awesome-icon icon="home"/>&nbsp;<span>Home</span>
            </Link>
            <div class="dropdown-divider"></div>
            <Link href="/profile" class="dropdown-item notify-item">
                <font-awesome-icon icon="user"/>&nbsp;
              <span>Profile</span>
            </Link>
            <div class="dropdown-divider"></div>
              <Link href="/members" class="dropdown-item notify-item">
                <font-awesome-icon icon="user"/>&nbsp;
              <span>Add Members</span>
            </Link>
            <div class="dropdown-divider" v-if="$page.props.user.linked_user_role == 'admin'"></div>
            <Link href="/billing" class="dropdown-item notify-item" v-if="$page.props.user.linked_user_role == 'admin'">
                <font-awesome-icon icon="money-bill"/>&nbsp;
              <span>Billing Details</span>
            </Link>
            <div class="dropdown-divider"></div>
            <Link href="/change_password"
              class="dropdown-item notify-item"
              ><font-awesome-icon icon="key"/>&nbsp;<span>Change Password</span></Link>
            <div class="dropdown-divider"></div>
            <a href="javascript:void(0)"
              @click="logout"
              class="dropdown-item notify-item">
                <font-awesome-icon :icon="['fas', 'sign-out']" />&nbsp;<span>Logout</span>
            </a>
          </div>
        </li>
      </ul>

      <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
        <li>
          <button @click="open_toggle()" class="button-menu-mobile waves-effect waves-light">
            <img src="/assets/admin/images/new/toggle.svg" class="tgl-img" />
          </button>
        </li>
        <li>
          <!-- Mobile menu toggle (Horizontal Layout)-->
          <a class="navbar-toggle nav-link" data-toggle="collapse" data-target="#topnav-menu-content">
            <div class="lines">
              <span></span>
              <span></span>
              <span></span>
            </div>
          </a>
          <!-- End mobile menu toggle-->
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
  </div>
  <!-- end Topbar -->
  <!-- Modal -->
      <div class="modal fade" id="createProject" tabindex="-1" role="dialog" aria-labelledby="loginModel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content ts-radius ts-form">
                  <div class="modal-header">
                      <div class="auth-logo mb-0" id="modal-title">Create Project</div>
                      <button type="menu" data-toggle="modal" data-target="#createProject" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <form @submit.prevent="submitProject">
                  <div class="modal-body pb-0">
                      <div class="account-pages mt-1 mb-1">
                          <div class="">
                              <div class="row justify-content-center">
                                  <div class="bg-pattern" style="width: 100%;">
                                      <div class="card-body p-0">
                                          <div class="form-group mb-0">
                                              <label for="emailaddress">Project Name</label>
                                              <input type="hidden" name="project_id" id="project_id" v-model="form.project_id">
                                              <input class="form-control" type="text" id="name" name="name" v-model="form.name" placeholder="Enter your Project Name">
                                              <span v-if="form.errors.name" class="error" id="email_error">{{form.errors.name}}</span>
                                          </div>
                                      </div> <!-- end card-body -->
                                  </div>
                                  <!-- end row -->
                              </div>
                              <!-- end row -->
                          </div>
                          <!-- end container -->
                      </div>
                      <!-- end page -->
                  </div>
                      <div class="textbox-margin text-right pt-0 cr-dle">
                          <button type="submit" class="btn btn-success btn-block ts-f-btn" id="create-project">Submit</button>
                          <button type="button" class="btn btn-secondary cancel-button" id="close" data-dismiss="modal">Close</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
</template>

<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import Swal from "sweetalert2";
export default {
  components: {
    Head,
    Link,
  },
  name: "AppHeader",
  data() {
    return {
      sidebar: false,
        notificationSystem: {
            options: {
                success: {
                    position: "topRight",
                    timeout: 3000,
                    class: 'success_notification'
                },
                error: {
                    position: "topRight",
                    timeout: 4000,
                    class: 'error_notification'
                },
                completed: {
                    position: 'center',
                    timeout: 1000,
                    class: 'complete_notification'
                },
                info: {
                    overlay: true,
                    zindex: 999,
                    position: 'center',
                    timeout: 3000,
                    class: 'info_notification',
                }
            }
        },
        form: this.$inertia.form({
            name: '',
            project_id: '',
        }),
        pro: this.$inertia.form({
            project_id: '',
        }),
      logoutForm: this.$inertia.form({
        _method: "POST",
      }),
    };
  },
  methods: {
    open_toggle() {
      localStorage.setItem("isSidebarOpen", true);
      this.$emit("open_sidebar");
    },
    logout() {
      this.logoutForm = this.$inertia.form();
      this.logoutForm.post("/logout");
    },
    submitProject(){
          this.form.post(this.route('create-project'), {
              onSuccess: () => {
                  this.form.reset('name');
                  this.closeModal();
              },
              onError: errors => {
                  console.log(errors);
              },
          })
      },
      change_project(project_id){
          this.pro.project_id = project_id;
          this.pro.post(this.route('update-user-project'), {
              onFinish: () => this.pro.reset('project_id')
          })
      },
      rename_project(id, name){
          this.form.name = name;
          this.form.project_id = id;

          $("#modal-title").text('Update Project');
      },
      delete_project(id){
          Swal.fire({
              text: "Are you sure want to delete the project?",
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Yes",
              cancelButtonText: "No, cancel!",
          }).then((result) => {
              if (result.isConfirmed) {
                  this.pro.project_id = id;
                  this.pro.post(this.route('delete-project'), {
                      onFinish: () => this.pro.reset('project_id')
                  })
              }
          });
      },
      closeModal() {
          document.getElementById('close').click();
      }
  },
};
</script>

<style scoped>
.header-logo a img:hover {
  transform: scale(2);
}
.header-logo a img {
  transition: 1s ease-in-out;
}
.circle-box img {
  border-radius: 50%;
  height: 36px;
  width: 36px;
}
body[data-sidebar-size=condensed] .proj-dropdown {
    left: 96px;
}
body[data-sidebar-size=default] .proj-dropdown {
    left: 260px;
}
</style>
