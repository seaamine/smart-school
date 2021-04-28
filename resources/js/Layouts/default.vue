<template>
    <div class="flex min-h-screen bg-primary-50">
        <sidebar />
        <nuxt class="flex-auto h-screen overflow-y-auto p-6" />
    </div>
</template>

<script>
    import Sidebar from '@/Layouts/Partials/SideBar.vue'

    export default {
        name: "default",
        components: {
            Sidebar
        }
    }
</script>

<style scoped>

</style>
