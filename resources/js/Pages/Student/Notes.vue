<template>
    
</template>

<script>
    import DashLayout from '@/Layouts/DashLayout';
    import Card from 'primevue/card';

    export default {
        name: "Notes",
        layout: DashLayout,
        components: { Card},
        props: {
            errors: Object,
            exams: Array,
            academicYear: Object,
            totalNotes: Number,
            examsCount: Object,
            $student: Object,
        },

    }
</script>

<style scoped>

</style>
