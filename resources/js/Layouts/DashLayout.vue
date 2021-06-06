<template>
    <div class=" containter bg-white px-6 py-2 z-20 shadow-csh2">
        <nav-bar @toggle-sidebar="toggleSb = !toggleSb"></nav-bar>
    </div>
    <div class="flex flex-row">
        <div :class="{'hidden': !toggleSb}" class="z-20 lg:block absolute lg:relative bg-white flex-shrink-0 h-full min-h-screen shadow-csh1" id="sidebar">
            <side-bar></side-bar>
        </div>
        <div class="h-full min-h-screen w-full p-8">
            <Toast />

            <!-- Page Content -->
            <slot></slot>
        </div>
    </div>
</template>

<script>
import SideBar from "@/Layouts/Partials/SideBar";
import NavBar from "@/Layouts/Partials/NavBar";
import Toast from 'primevue/toast';

export default {
    name: "DashLayout",
    components: {
        NavBar,
        SideBar,
        Toast,
    },
    data () {
        return {
            toggleSb: false,

        }
    },
    methods:{

    },
    computed: {
        pageToast () {
            return this.$page.props.toast;
        },
    },
    watch: {
        pageToast: function(newVal, oldVal) { // watch it
            console.log(newVal);console.log(oldVal);
            if(Object.keys(newVal).length){
                this.$toast.add({severity:newVal.type, summary: newVal.message, detail:newVal.detail, life: 3000});
            }
        }
    }
}
</script>

<style scoped>
#sidebar{
    width: 260px;
    max-width: 260px;
}
</style>
