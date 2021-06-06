<template>
    <ul>
        <li class="nav-item">
            <inertia-link class="flex items-center" @click="changeActiveLink('dashboard')"  :class="{ 'active': activeLink == 'dashboard' }" :href="route('dashboard')">

                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-4 flex-shrink" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span>Tableau de bord</span>
            </inertia-link>

        </li>
        <li class="nav-item">
            <inertia-link class="flex items-center" @click="changeActiveLink('student.*')"  :class="{ 'active': activeLink == 'student.*' }" :href="route('student.index')">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-4 flex-shrink" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <span>Student</span>
            </inertia-link>

        </li>
        <li class="nav-item">
            <inertia-link class="flex items-center" @click="changeActiveLink('teacher.*')"  :class="{ 'active': activeLink == 'teacher.*' }" :href="route('teacher.index')">
                <svg class="h-6 w-6 mr-4 flex-shrink font-bold" stroke-width="15" stroke="currentColor" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M63.7,366.67a5.1,5.1,0,0,0-5.1,5.1v73.76a5.1,5.1,0,1,0,10.2,0V371.77A5.1,5.1,0,0,0,63.7,366.67Z"/><path d="M483.74,61.37H39.21a5.1,5.1,0,0,0-5.1,5.1V341.62A80.69,80.69,0,0,0,23.16,382.3v63.23a5.1,5.1,0,0,0,10.2,0V382.3a71.06,71.06,0,0,1,71-71h16.07c41.6,0,53.46,4.13,77.09,12.36L228,334.25a5.1,5.1,0,0,0,5.45-1.38L292,268.58a14.26,14.26,0,0,1,17.73-2.51,14,14,0,0,1,3.45,21.55l-70.5,78.61a17,17,0,0,1-16,5.4l-46.07-14.76a5.09,5.09,0,0,0-6.66,4.85v83.81a5.1,5.1,0,1,0,10.2,0V413.75H483.74a5.1,5.1,0,0,0,5.1-5.1V66.47A5.1,5.1,0,0,0,483.74,61.37ZM119.67,300.53a46,46,0,1,1,46-46A46,46,0,0,1,119.67,300.53Zm359,103H184.21V368.71l39.88,12.76a27.4,27.4,0,0,0,26.2-8.43l70.5-78.61A24.26,24.26,0,0,0,314.5,257a24.39,24.39,0,0,0-30,4.68l-56.34,61.81-27.28-9.47c-17.52-6.1-29.29-10.2-51.32-11.95a56.17,56.17,0,1,0-59.34.25A81.13,81.13,0,0,0,44.31,327.7V71.57H478.64Z"/><path d="M197.31,124.91H420.88a5.1,5.1,0,1,0,0-10.2H197.31a5.1,5.1,0,1,0,0,10.2Z"/><path d="M420.88,165.58H378.27a5.1,5.1,0,1,0,0,10.2h42.61a5.1,5.1,0,1,0,0-10.2Z"/><path d="M197.31,175.78H326.83a5.1,5.1,0,1,0,0-10.2H197.31a5.1,5.1,0,0,0,0,10.2Z"/><path d="M420.88,216.45H337.31a5.1,5.1,0,0,0,0,10.2h83.57a5.1,5.1,0,1,0,0-10.2Z"/><path d="M197.31,226.65h43.81a5.1,5.1,0,0,0,0-10.2H197.31a5.1,5.1,0,0,0,0,10.2Z"/></svg>
                <span>Teachers</span>
            </inertia-link>

        </li>
        <li class="nav-item">
            <inertia-link class="flex items-center" @click="changeActiveLink('subject.*')"  :class="{ 'active': activeLink == 'subject.*' }" :href="route('subject.index')">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-4 flex-shrink" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path d="M12 14l9-5-9-5-9 5 9 5z" />
                    <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                </svg>
                <span>Matieres</span>
            </inertia-link>
        </li>
        <li class="nav-item" >
            <inertia-link class="flex items-center" @click="changeActiveLink('academicYear.*')" :class="{ 'active': activeLink == 'academicYear.*' }" :href="route('academicYear.index')">

                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-4 flex-shrink" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span>Années Académiques</span>
            </inertia-link>
        </li>
        <li class="nav-item" @click="changeActiveLink='class.*'" >
            <inertia-link class="flex items-center" @click="changeActiveLink('class.*')" :class="{ 'active': activeLink == 'class.*' }" :href="route('class.index')">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-4 flex-shrink" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                <span>Classes</span>
            </inertia-link>
        </li>
    </ul>
</template>

<script>
    import { ref } from 'vue'
    export default {
        name: "SideBar",
    setup(){
    },
        methods:{
            changeActiveLink: function(routeName) {
                console.log(routeName);
                this.activeLink = routeName;
            },
        },
        data() {
            let routeGroups = ['dashboard', 'teacher.*', 'student.*','subject.*','academicYear.*','class.*'];
            return {
                activeLink: routeGroups.find(rt => route().current(rt)),
            }
        },
}

</script>

<style scoped>


</style>
