<template>
    <div id="wrapper">
        <AppHeader @open_sidebar="show_sidebar=true"></AppHeader>
        <Sidebar v-if="show_sidebar" @close_sidebar="show_sidebar=false" v-bind:show_sidebar="show_sidebar" :tools="contentTools"></Sidebar>
        <div class="content-page" :class="{'content-page-after': show_sidebar, 'generator-action': show_sidebar}">
            <div class="content" style="margin-bottom: 2%;">
                <div class="container-fluid">
                    <div class="templatediv">
                        <slot></slot>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import { SidebarMenu } from 'vue-sidebar-menu'
    import Sidebar from "@/Pages/Partials/App/Sidebar";
    import AppHeader from "@/Pages/Partials/App/AppHeader";
    export default {
        name: "type-skip-layout",
        props:['tools'],
        components: {
            Head,
            Link,
            Sidebar,
            AppHeader,
            SidebarMenu
        },
        data() {
            return {
                searchTool: '',
                show_sidebar:false,
                menu: [
                    {
                        header: 'Main Navigation',
                        hiddenOnCollapse: true
                    },
                    {
                        href: '/',
                        title: 'Dashboard',
                        icon: 'fa fa-user'
                    },
                    {
                        href: '/charts',
                        title: 'Charts',
                        icon: 'fa fa-chart-area',
                        child: [
                            {
                                href: '/charts/sublink',
                                title: 'Sub Link'
                            }
                        ]
                    }
                ]
            }
        },
        created() {
            // sidebar open with set localStorage value
            if(localStorage.getItem("isSidebarOpen")) {
                this.show_sidebar =true;
            }
        }
    }
</script>

<style scoped>
.content-page-after {
    margin-left: 0px;
}
</style>
