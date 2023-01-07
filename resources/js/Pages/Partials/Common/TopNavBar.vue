<template>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg  navbar-light header_nav ">
            <a href="/" class="navbar-brand">
                <img src="/ts/images/logo-typeskip.svg" alt="" class="main_logo" />
            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon "></span>
            </button>
            <div id="navbarCollapse" class="collapse navbar-collapse justify-content-center">
                <div class="navbar-nav navbar-nav-l ml-auto">
                    <a href="#generate-content" class="nav-item nav-link">Use Cases</a>
                    <a href="#how-it-works" class="nav-item nav-link">How It Works</a>
                    <a href="#toollist-container" class="nav-item nav-link">Tools</a>
                    <a href="#pricing-section" class="nav-item nav-link">Pricing</a>
                </div>
                <div class="navbar-nav ml-auto action-buttons">
                    <Link v-if="!$page.props.user" :href="route('login')" class="mr-4 sm-btn white-btn ts-btn ts-effect">Login</Link>
                    <Link v-if="!$page.props.user" :href="route('register')"  class="lg-btn primary-btn ts-btn">Register</Link>
                    <Link v-if="$page.props.user" :href="route('app')"  class="lg-btn primary-btn ts-btn">Dashboard</Link>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
    import { Link } from '@inertiajs/inertia-vue3';
    export default {
        name: "TopNavBar",
        components:{Link}
    }
</script>

<style scoped>

</style>
