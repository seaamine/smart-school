<template>
    <div class=" containter bg-white px-6 py-4 z-20 shadow-csh2">
        <nav-bar @toggle-sidebar="toggleSb = !toggleSb"></nav-bar>
    </div>
    <div class="flex flex-row">
        <div :class="{'hidden': !toggleSb}" class="z-20 lg:block absolute lg:relative bg-white flex-shrink-0 h-full min-h-screen shadow-csh1" id="sidebar">
            <side-bar></side-bar>
        </div>
        <div class="h-full min-h-screen w-full p-8">
            <!-- Page Content -->
            <slot></slot>
        </div>
    </div>
</template>

<script>
import SideBar from "@/Layouts/Partials/SideBar";
import NavBar from "@/Layouts/Partials/NavBar";
export default {
    name: "DashLayout",
    components: {
        NavBar,
        SideBar,
    },
    data () {
        return {
            toggleSb: false,
        }
    },
    props: {
        user: Object,
    },
    methods:{

    }
}
</script>

<style scoped>
#sidebar{
    width: 260px;
    max-width: 260px;
}
</style>
