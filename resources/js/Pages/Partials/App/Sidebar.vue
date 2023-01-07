<template>
  <!-- ========== Left Sidebar Start ========== -->
  <div class="left-side-menu" style="
      transform: translateX(0%) !important;
      display: block;
      width: 255px !important;
      overflow-y: scroll;
      transition: left .8s ease;
    ">
    <div class="h-100" data-simplebar>
      <!-- User box -->
      <!--- Sidemenu -->
      <div id="sidebar-menu">
        <ul id="side-menu">
          <li class="sidebar-logo-tag mt-2">
            <a :href="'/app'">
              <img src="/assets/admin/images/logo-white.png" width="100" />
            </a>
            <button @click="closeSidebar" class="button-menu-mobile waves-effect waves-light">
              <img src="/assets/admin/images/new/toggle.svg" class="tgl-img" />
            </button>
          </li>
          <li style="margin-top: 15px;">
            <Link href="/app" class="menu-iteam-ts">
              <i class="sb-icon">
                <img src="/assets/admin/images/new/menu/icons-dashboard.svg" />
              </i>
              <span>Dashboard</span>
            </Link>
          </li>

          <li class="">
            <a class="menu-item bg-gray" href="#generate" data-toggle="collapse" :aria-expanded="{true: chekIfGeneratorPage() }">
              <i class="sb-icon">
                <img src="/assets/admin/images/new/menu/icons-generate.svg" />
              </i>
              <span>
                Generate
                <svg class="MiniIcon SidebarCollapsibleHeader-toggle ArrowDownMiniIcon menu-open" fill="#6F7782" focusable="false" viewBox="0 0 24 24">
                  <path d="M3.5,8.9c0-0.4,0.1-0.7,0.4-1C4.5,7.3,5.4,7.2,6,7.8l5.8,5.2l6.1-5.2C18.5,7.3,19.5,7.3,20,8c0.6,0.6,0.5,1.5-0.1,2.1 l-7.1,6.1c-0.6,0.5-1.4,0.5-2,0L4,10.1C3.6,9.8,3.5,9.4,3.5,8.9z"></path>
                </svg>
              </span>
            </a>
            <div class="collapse" :class="{ show: chekIfGeneratorPage() }" id="generate">
              <ul class="nav-second-level">
                <li v-for="contentTool in $page.props.tools" :key="contentTool.key">
                  <Link :href="`/app/${contentTool.uri}`">
                    <span v-html="contentTool.icon_path_inverse" style="font-size: 14px;"></span>
                    <span> {{ contentTool.title }} </span>
                  </Link>
                </li>
              </ul>
            </div>
          </li>
          <li class="">
            <a class="menu-item" href="#content" data-toggle="collapse" :aria-expanded="{true: chekIfContentPage() }">
              <i class="sb-icon">
                <img src="/assets/admin/images/new/menu/icons-content.svg" />
              </i>
              <span>
                Content
                <svg class="MiniIcon SidebarCollapsibleHeader-toggle ArrowDownMiniIcon menu-open" fill="#6F7782" focusable="false" viewBox="0 0 24 24">
                  <path d="M3.5,8.9c0-0.4,0.1-0.7,0.4-1C4.5,7.3,5.4,7.2,6,7.8l5.8,5.2l6.1-5.2C18.5,7.3,19.5,7.3,20,8c0.6,0.6,0.5,1.5-0.1,2.1 l-7.1,6.1c-0.6,0.5-1.4,0.5-2,0L4,10.1C3.6,9.8,3.5,9.4,3.5,8.9z"
                  ></path>
                </svg>
              </span>
            </a>
            <div class="collapse" :class="{show : chekIfContentPage()}" id="content">
              <ul class="nav-second-level">
                <li>
                  <Link :href="`/all/content`">
                    <i class="sb-icon">
                      <img src="/assets/admin/images/new/menu/icons-allc.svg" />
                    </i>
                    <span> All content </span>
                  </Link>
                </li>
                <li>
                  <Link :href="`/favourite/content`">
                    <i class="sb-icon">
                      <img src="/assets/admin/images/new/menu/icons-fav.svg" />
                    </i>
                    <span> Favorites </span>
                  </Link>
                </li>
                <li>
                  <Link :href="`/trashed/content`">
                    <i class="sb-icon">
                      <img src="/assets/admin/images/new/menu/icons-trash.svg"/>
                    </i>
                    <span> Trash </span>
                  </Link>
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </div>
      <!-- End Sidebar -->
      <div class="other-menu" data-simplebar>
        <a class="menu-item"
          href="#projects"
          data-toggle="collapse"
          aria-expanded="true">
          <i class="sb-icon">
            <img src="/assets/admin/images/new/menu/icons-team.svg" />
          </i>
          <span>Teams
            <svg class="MiniIcon SidebarCollapsibleHeader-toggle ArrowDownMiniIcon menu-open" fill="#6F7782" focusable="false" viewBox="0 0 24 24">
              <path d="M3.5,8.9c0-0.4,0.1-0.7,0.4-1C4.5,7.3,5.4,7.2,6,7.8l5.8,5.2l6.1-5.2C18.5,7.3,19.5,7.3,20,8c0.6,0.6,0.5,1.5-0.1,2.1 l-7.1,6.1c-0.6,0.5-1.4,0.5-2,0L4,10.1C3.6,9.8,3.5,9.4,3.5,8.9z"></path>
            </svg>
          </span>
        </a>
        <div class="collapse show" id="projects">
          <div class="menu-item box-menu">
            <div class="box-menu-item">
              <ul>
                <li
                  v-for="teamMember in teamMembers"
                  :key="teamMember.key"
                  :class="{ active: teamMember.id == $page.props.user.id }">
                  <a href="#"> {{ teamMember.username.charAt(0) }} </a>
                </li>
                <li>
                  <Link :href="`/members`" style="text-align: end;" class="invite_link">
                    <svg class="svgSpace MiniIcon AbstractThemeableRectangularButton-leftIcon PlusMiniIcon" focusable="false" viewBox="0 0 24 24">
                      <path d="M10,10V4c0-1.1,0.9-2,2-2s2,0.9,2,2v6h6c1.1,0,2,0.9,2,2s-0.9,2-2,2h-6v6c0,1.1-0.9,2-2,2s-2-0.9-2-2v-6H4c-1.1,0-2-0.9-2-2s0.9-2,2-2H10z"></path>
                    </svg>
                    Invite people
                  </Link>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="relative bottom-0">
        <div class="bottem-item">
          <Link :href="`/members`">
            <img style="position: relative;display: inline;" src="https://d3ki9tyy5l5ruj.cloudfront.net/obj/8a613bc1f8e95548a8ccf856b77261a748868a44/illustration_invite_teammates.svg" alt=""/>
            &nbsp; Invite teammates
          </Link>
        </div>
        <div class="help-getting-started d-flex">
          <div class="circle-box" style="color: #fff">?</div>
          <a target="_blank" href="https://www.notion.so/Help-Center-03eb15e1b61e4c558636622bf571eaf2">
            <span>Help & Getting Started</span>
          </a>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>
  <!-- Left Sidebar End -->
</template>

<script>
import { Link } from "@inertiajs/inertia-vue3";
import axios from "axios";
import { defineComponent } from "vue";

export default defineComponent({
  props: ["show_sidebar", "tools"],
  components: {
    defineComponent,
    Link,
  },
  name: "Sidebar",
  data() {
    return {
      teamMembers : [],
    };
  },
  methods: {
    // sidebar close with localStorage clear
    closeSidebar() {
      this.$emit('close_sidebar')
      localStorage.removeItem("isSidebarOpen");
    },
    getTeamMembers() {
        var url = window.location.origin +"/api/get/team-members";
      axios.post(url, {authUserId : this.$page.props.user.id})
      .then(response => {
        if(response.status == '200') {
          this.teamMembers = response.data;
        }
      }).catch(err => {
        console.log("api/get/team-members err", err);
      })
    },
    chekIfGeneratorPage() {
      let page = this.$page.url;
      if(page == '/app/product-description' || page == '/app/copy-paste' || page == '/app/facebook' || page == '/app/facebook-headline' || page == '/app/aida-principle' || page == '/app/google' || page == '/app/instagram-post' || page == '/app/pas-framework' || page == '/app/tweetstorm'|| page == '/app/sentence-expander'|| page == '/app/blog-outline'|| page == '/app/great-headlines'|| page == '/app/persuasive-bullet-points'|| page == '/app/marketing-angles'){
        return true;
      }else {
        return false;
      }
    },
    chekIfContentPage() {
        let page = this.$page.url;
         if(page == '/all/content' || page == '/favourite/content' || page == '/trashed/content'){
        return true;
      }else {
        return false;
      }
    }
  },
  mounted() {
    this.getTeamMembers();
    this.chekIfGeneratorPage();
    this.chekIfContentPage();
  },
});
</script>

<style scoped>
.sidebar-logo-tag {
  display: flex;
  justify-content: space-around;
  align-items: center;
}
.left-side-menu .button-menu-mobile {
  position: relative;
  border: none;
  background: none;
  height: 25px;
  z-index: 10;
}
.menu-iteam-ts:hover {
  text-decoration: none !important;
}
.sidebar-submenu {
  height: 0;
  opacity: 0;
}
.sidebar-submenu-active {
  height: auto;
  opacity: 1;
  transition: 0.5s;
}
.left-side-menu::-webkit-scrollbar{
    width: 0px;
    background: transparent;
}
.svgSpace{
    position: relative;
    right: -8px;
    display: inline;
}
.invite_link:hover {
    background: none !important;
    opacity: 0.7 !important;
}
</style>
