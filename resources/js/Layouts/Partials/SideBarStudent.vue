<template>
    <ul>
        <li class="nav-item lg:hidden">
            <inertia-link class="flex items-center"   :href="route('home')">
                <img class="mr-2" style="width: 45px; height: 45px;" width="45" height="45" :src="$page.props.appUrl+'/images/logo.png'">
                <span style=" margin: auto 0px auto 0;" class="text-primary-500 align-middle font-semibold text-xl">Smart School</span>
            </inertia-link>

        </li>
        <li class="nav-item">
            <inertia-link class="flex items-center" @click="changeActiveLink('dashboard')"  :class="{ 'active': activeLink == 'dashboard' }" :href="route('dashboard')">

                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-4 flex-shrink" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span>Tableau de bord</span>
            </inertia-link>

        </li>
        <li class="nav-item">
            <inertia-link class="flex items-center" @click="changeActiveLink('student.exams-notes')" :class="{ 'active': activeLink == 'student.exams-notes' }" :href="route('student.exams-notes')">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-4 flex-shrink" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                </svg>
                <span>Notes d'examens</span>
            </inertia-link>
        </li>
        <li class="nav-item">
            <inertia-link class="flex items-center" @click="changeActiveLink('school-certificate.*')" :class="{ 'active': activeLink == 'school-certificate.*' }" :href="route('school-certificate.request')">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-4 flex-shrink" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                <span>certificat de scolarité</span>
            </inertia-link>
        </li>
    </ul>
</template>

<script>
    export default {
        name: "SideBarStudent",
        methods:{
            changeActiveLink: function(routeName) {
                this.activeLink = routeName;
            },
        },
        data() {
            let routeGroups = ['dashboard', 'school-certificate.*','student.exams-notes'];
            return {
                activeLink: routeGroups.find(rt => route().current(rt)),
            }
        },
    }
</script>

<style scoped>

</style>
