<template>
    <div class=" containter bg-white px-6 py-4 z-20 shadow-csh2">
        <nav class="flex items-stretch justify-between h-8">
            <ul>
                <li>
                    <button class="md:hidden"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg></button>
                </li>
            </ul>
            <div>
                <a>herke</a>
            </div>
        </nav>
    </div>
    <div class="flex flex-row">
            <div class="bg-white h-full min-h-screen shadow-csh1" id="sidebar">
                <side-bar></side-bar>
            </div>
            <div class="h-full min-h-screen w-full p-8">
                <p>f</p>
            </div>
    </div>
</template>

<script>
    import defaultL from '@/Layouts/default.vue';
    import SideBar from "@/Layouts/Partials/SideBar";
export default {
    name: "Home",
    components: {
        SideBar,
        defaultL
    }
}
</script>

<style scoped>
    #sidebar{
        width: 260px;
        max-width: 260px;
    }
</style>
