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
            <inertia-link class="flex items-center" @click="changeActiveLink('teacher-class.*')"  :class="{ 'active': activeLink == 'teacher-class.*' }" :href="route('teacher-class.index')">
                <svg class="h-8 w-8 mr-4 flex-shrink font-bold" stroke-width="15" stroke="currentColor" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M63.7,366.67a5.1,5.1,0,0,0-5.1,5.1v73.76a5.1,5.1,0,1,0,10.2,0V371.77A5.1,5.1,0,0,0,63.7,366.67Z"/><path d="M483.74,61.37H39.21a5.1,5.1,0,0,0-5.1,5.1V341.62A80.69,80.69,0,0,0,23.16,382.3v63.23a5.1,5.1,0,0,0,10.2,0V382.3a71.06,71.06,0,0,1,71-71h16.07c41.6,0,53.46,4.13,77.09,12.36L228,334.25a5.1,5.1,0,0,0,5.45-1.38L292,268.58a14.26,14.26,0,0,1,17.73-2.51,14,14,0,0,1,3.45,21.55l-70.5,78.61a17,17,0,0,1-16,5.4l-46.07-14.76a5.09,5.09,0,0,0-6.66,4.85v83.81a5.1,5.1,0,1,0,10.2,0V413.75H483.74a5.1,5.1,0,0,0,5.1-5.1V66.47A5.1,5.1,0,0,0,483.74,61.37ZM119.67,300.53a46,46,0,1,1,46-46A46,46,0,0,1,119.67,300.53Zm359,103H184.21V368.71l39.88,12.76a27.4,27.4,0,0,0,26.2-8.43l70.5-78.61A24.26,24.26,0,0,0,314.5,257a24.39,24.39,0,0,0-30,4.68l-56.34,61.81-27.28-9.47c-17.52-6.1-29.29-10.2-51.32-11.95a56.17,56.17,0,1,0-59.34.25A81.13,81.13,0,0,0,44.31,327.7V71.57H478.64Z"/><path d="M197.31,124.91H420.88a5.1,5.1,0,1,0,0-10.2H197.31a5.1,5.1,0,1,0,0,10.2Z"/><path d="M420.88,165.58H378.27a5.1,5.1,0,1,0,0,10.2h42.61a5.1,5.1,0,1,0,0-10.2Z"/><path d="M197.31,175.78H326.83a5.1,5.1,0,1,0,0-10.2H197.31a5.1,5.1,0,0,0,0,10.2Z"/><path d="M420.88,216.45H337.31a5.1,5.1,0,0,0,0,10.2h83.57a5.1,5.1,0,1,0,0-10.2Z"/><path d="M197.31,226.65h43.81a5.1,5.1,0,0,0,0-10.2H197.31a5.1,5.1,0,0,0,0,10.2Z"/></svg>
                <span>Teachers Classes Assignment</span>
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
        <li class="nav-item" @click="changeActiveLink='class.*'" >
            <inertia-link class="flex items-center" @click="changeActiveLink('exam.*')" :class="{ 'active': activeLink == 'exam.*' }" :href="route('exam.index')">
                <svg class="h-6 w-6 mr-4 flex-shrink font-bold" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     viewBox="0 0 512 512" stroke="currentColor" stroke-width="15">
                    <path d="M375.451,315.733c0-4.71-3.823-8.533-8.533-8.533h-51.2c-4.71,0-8.533,3.823-8.533,8.533s3.823,8.533,8.533,8.533h51.2
				C371.628,324.267,375.451,320.444,375.451,315.733z"/>
                    <path d="M341.317,93.867V51.2c0-4.71-3.823-8.533-8.533-8.533s-8.533,3.823-8.533,8.533v42.667
				c0,23.526,19.14,42.667,42.667,42.667h76.8v162.133c0,4.71,3.823,8.533,8.533,8.533s8.533-3.823,8.533-8.533V128
				c0-4.71-3.823-8.533-8.533-8.533h-85.333C352.803,119.467,341.317,107.981,341.317,93.867z"/>
                    <path d="M366.917,204.8h-68.267c-4.71,0-8.533,3.823-8.533,8.533c0,4.71,3.823,8.533,8.533,8.533h68.267
				c4.71,0,8.533-3.823,8.533-8.533C375.451,208.623,371.628,204.8,366.917,204.8z"/>
                    <path d="M273.051,213.333c0-4.71-3.823-8.533-8.533-8.533h-51.2c-4.71,0-8.533,3.823-8.533,8.533c0,4.71,3.823,8.533,8.533,8.533
				h51.2C269.228,221.867,273.051,218.044,273.051,213.333z"/>
                    <path d="M213.317,256c-4.71,0-8.533,3.823-8.533,8.533c0,4.71,3.823,8.533,8.533,8.533h17.067c4.71,0,8.533-3.823,8.533-8.533
				c0-4.71-3.823-8.533-8.533-8.533H213.317z"/>
                    <path d="M213.317,170.667h85.333c4.71,0,8.533-3.823,8.533-8.533c0-4.71-3.823-8.533-8.533-8.533h-85.333
				c-4.71,0-8.533,3.823-8.533,8.533C204.784,166.844,208.607,170.667,213.317,170.667z"/>
                    <path d="M264.517,273.067h85.333c4.71,0,8.533-3.823,8.533-8.533c0-4.71-3.823-8.533-8.533-8.533h-85.333
				c-4.71,0-8.533,3.823-8.533,8.533C255.984,269.244,259.807,273.067,264.517,273.067z"/>
                    <path d="M315.717,358.4c-4.71,0-8.533,3.823-8.533,8.533s3.823,8.533,8.533,8.533h17.067c4.71,0,8.533-3.823,8.533-8.533
				s-3.823-8.533-8.533-8.533H315.717z"/>
                    <path d="M281.584,307.2h-68.267c-4.71,0-8.533,3.823-8.533,8.533s3.823,8.533,8.533,8.533h68.267c4.71,0,8.533-3.823,8.533-8.533
				S286.294,307.2,281.584,307.2z"/>
                    <path d="M281.584,358.4h-68.267c-4.71,0-8.533,3.823-8.533,8.533s3.823,8.533,8.533,8.533h68.267c4.71,0,8.533-3.823,8.533-8.533
				S286.294,358.4,281.584,358.4z"/>
                    <path d="M484.754,351.497l-17.067-17.067c-13.116-13.116-33.101-13.09-46.199,0L309.684,446.234
				c-1.596,1.596-2.5,3.772-2.5,6.033v51.2c0,4.71,3.823,8.533,8.533,8.533h51.2c2.261,0,4.437-0.904,6.033-2.5l111.804-111.804
				C498.348,384.102,498.348,365.099,484.754,351.497z M410.454,369.596l13.534,13.534l-74.138,74.138l-13.534-13.534
				L410.454,369.596z M324.251,494.933v-39.134l39.134,39.134H324.251z M375.451,482.867l-13.534-13.534l74.138-74.138
				l13.534,13.534L375.451,482.867z M472.688,385.63l-11.034,11.034l-39.134-39.134l11.034-11.034
				c6.741-6.733,15.292-6.767,22.067,0l17.067,17.067C479.591,370.475,479.591,378.726,472.688,385.63z"/>
                    <path d="M281.584,494.933H59.717c-14.114,0-25.6-11.486-25.6-25.6V42.667c0-14.114,11.486-25.6,25.6-25.6h269.534L412.084,99.9
				c3.336,3.337,8.73,3.337,12.066,0c3.337-3.336,3.337-8.73,0-12.066L338.817,2.5c-1.596-1.604-3.772-2.5-6.033-2.5H59.717
				C36.191,0,17.051,19.14,17.051,42.667v426.667c0,23.526,19.14,42.667,42.667,42.667h221.867c4.71,0,8.533-3.823,8.533-8.533
				S286.294,494.933,281.584,494.933z"/>
                    <path d="M281.584,409.6h-68.267c-4.71,0-8.533,3.823-8.533,8.533s3.823,8.533,8.533,8.533h68.267c4.71,0,8.533-3.823,8.533-8.533
				S286.294,409.6,281.584,409.6z"/>
                    <path d="M170.651,162.133c0-4.71-3.823-8.533-8.533-8.533h-51.2c-4.71,0-8.533,3.823-8.533,8.533v51.2
				c0,4.71,3.823,8.533,8.533,8.533h51.2c4.71,0,8.533-3.823,8.533-8.533V162.133z M153.584,204.8h-34.133v-34.133h34.133V204.8z"/>
                    <path d="M110.917,426.667h51.2c4.71,0,8.533-3.823,8.533-8.533v-51.2c0-4.71-3.823-8.533-8.533-8.533h-51.2
				c-4.71,0-8.533,3.823-8.533,8.533v51.2C102.384,422.844,106.207,426.667,110.917,426.667z M119.451,375.467h34.133V409.6h-34.133
				V375.467z"/>
                    <path d="M121.951,321.766c1.604,1.604,3.78,2.5,6.033,2.5c0.282,0,0.555-0.008,0.845-0.043c2.543-0.247,4.838-1.63,6.255-3.755
				l34.133-51.2c2.611-3.925,1.553-9.225-2.364-11.836c-3.934-2.62-9.216-1.553-11.836,2.364l-28.356,42.539l-9.711-9.702
				c-3.336-3.337-8.73-3.337-12.066,0s-3.337,8.73,0,12.066L121.951,321.766z"/>

                </svg>

                <span>Exames</span>
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
