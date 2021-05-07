<template>
    <div class="content-header mb-5">
        <h2>Subjects</h2>
    </div>
    <div class="card p-6">
        <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-10">
            <Card v-for="subject in subjects">
                <template #header>
                </template>
                <template class="h-10" #title>
                    {{subject.name}}
                </template>
                <template #content>
                    <img class="object-center w-48 h-48 mx-auto " alt="user header" :src="subject.image_path">
                </template>
                <template #footer>
                    <button>Edit</button>
                    <button>Teatchers</button>
                    <button>Delete</button>
                </template>
            </Card>

        </div>
    </div>
</template>

<script>
import DashLayout from '@/Layouts/DashLayout';
import Card from 'primevue/card';
export default {
    name: "index",
    layout: DashLayout,
    props: {
        subjects: Array,
    },
    components: {Card},
}
</script>

<style scoped>

</style>
