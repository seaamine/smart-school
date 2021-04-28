<template>
    <div class="bg-white py-4 px-3 md:py-6 md:px-8">
        <SchoolLogo class="w-10 h-10 md:w-12 md:h-12" />
        <nav>
            <ul class="py-4">
                <li class="py-2">
                    <a to="/styleguide" class="nav-link"></a>
                </li>
                <li class="py-2">
                    <a to="/styleguide" class="nav-link"></a>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
    import SchoolLogo from '@/Components/SchoolLogo.vue';
    export default {
        name: "SideBar",
        components: {
            SchoolLogo
        }
    }
</script>

<style scoped>
    .page-enter-active {
        animation: acrossIn 0.4s ease-out both;
    }
    .page-leave-active {
        animation: acrossOut 0.6s ease-in both;
    }
    @keyframes acrossIn {
        0% {
            transform: translate3d(-0.35%, 0, 0);
            opacity: 0;
        }
        100% {
            transform: translate3d(0, 0, 0);
            opacity: 1;
        }
    }
    @keyframes acrossOut {
        0% {
            transform: translate3d(0%, 0, 0);
            opacity: 1;
        }
        100% {
            transform: translate3d(20%, 0, 0);
            opacity: 0;
        }
    }
</style>
