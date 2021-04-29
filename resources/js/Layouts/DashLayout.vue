<template>
    <div class=" containter bg-white px-6 py-4 z-20 shadow-csh2">
        <nav-bar></nav-bar>
    </div>
    <div class="flex flex-row">
        <div class="bg-white flex-shrink-0 h-full min-h-screen shadow-csh1" id="sidebar">
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
    props: {
        user: Object,
    },
}
</script>

<style scoped>
#sidebar{
    width: 260px;
    max-width: 260px;
}
</style>
