<template>
    <div class="content-header mb-5">
        <h2>Subjects</h2>
    </div>
    <div class="card p-6">
        <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <Card v-for="subject in subjects">
                <template #header>
                    <img alt="user header" src="demo/images/usercard.png">
                </template>
                <template #title>
                    {{subject.name}}
                </template>
                <template #content>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore sed consequuntur error repudiandae numquam deserunt
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
