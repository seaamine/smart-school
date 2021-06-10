<template>
    <div class="flex flex-col h-screen max-h-screen" >
        <div class="flex-initial flex-grow-0 containter bg-white px-6 py-2 z-20 shadow-csh2">
            <nav-bar @toggle-sidebar="toggleSb = !toggleSb"></nav-bar>
        </div>
        <div class="flex-1 flex flex-row" style="max-height: 94%;">
            <div :class="{'hidden': !toggleSb}" class="z-20 lg:block absolute h-full lg:relative bg-white flex-shrink-0 shadow-csh1" id="sidebar">
                <side-bar v-if=" $page.props.user.role === 'admin'"></side-bar>
                <side-bar-teacher v-if=" $page.props.user.role === 'teacher'"></side-bar-teacher>
                <div v-else>
                    Not A/B/C
                </div>
            </div>
            <div class="flex flex-col flex-grow max-h-full w-full p-8 overflow-y-auto">
                <Toast />

                <!-- Page Content -->
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script>
import SideBar from "@/Layouts/Partials/SideBar";
import NavBar from "@/Layouts/Partials/NavBar";
import Toast from 'primevue/toast';
import SideBarTeacher from "@/Layouts/Partials/SideBarTeacher";

export default {
    name: "DashLayout",
    components: {
        SideBarTeacher,
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
