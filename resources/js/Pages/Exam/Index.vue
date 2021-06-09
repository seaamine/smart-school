<template>
    <div class="content-header mb-5">
        <h2>Examens</h2>
    </div>
    <div v-if="Object.keys(errors).length" class="card card-danger p-6 mb-4 text-white">
        <ul class="list-disc">
            <li v-for="error in errors">
                {{error}}
            </li>
        </ul>
    </div>
</template>

<script>
    import DashLayout from '@/Layouts/DashLayout';

    export default {
        name: "Index",
        layout: DashLayout,
        props: {
            errors: Object,
        },
    }
</script>

<style scoped>

</style>
