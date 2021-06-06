<template>
    <div class="content-header mb-5">
        <h2>Affectation Enseignant 	&lt;=&gt; Class</h2>
    </div>
    <div v-if="Object.keys(errors).length" class="card card-danger p-6 mb-4 text-white">
        <ul class="list-disc">
            <li v-for="error in errors">
                {{error}}
            </li>
        </ul>
    </div>
    <div class="card p-6">
        <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-4 justify-items-center">
            <Card v-for="classe in classes" class="w-60">
                <template #header>
                </template>
                <template class="h-10" #title>
                    <span class="pb-2">{{classe.name}}</span>
                </template>
                <template #content>
                </template>
                <template #footer>
                    <button>Teatchers</button>
                    <inertia-link :href="route('subject.edit')" :data="{ id: classe.id }" method="get" as="button" type="button"
                                  class="bg-primary-500 rounded-full w-10 h-10 font-medium border border-primary-500 mr-4 focus:bg-primary-600 focus:outline-none active:bg-primary-600">
                        edit</inertia-link>

                    <button class="bg-danger-500 rounded-full w-10 h-10 font-medium p-0 inline-flex justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </template>
            </Card>
        </div>
    </div>
</template>

<script>
import DashLayout from '@/Layouts/DashLayout';
import Card from 'primevue/card';

export default {
    name: "TeacherClasses",
    layout: DashLayout,
    components: {Card},

    props: {
        errors: Object,
        classes: Array,
    },
}
</script>

<style scoped>
>>> .p-card-title{
    height: 45px;
    font-size: 1rem;
    border: 1px solid rgba(34,41,47,.125);
    border-width: 0 0 1px;
    text-align: center;
    display: flex;
    align-items: center; /* Vertical center alignment */
    justify-content: center; /* Horizontal center alignment */
}
>>> .p-card-footer{
    height: 45px;
    font-size: 1rem;
    border: 1px solid rgba(34,41,47,.125);
    border-width: 1px 0 0 0;
    text-align: center;
    display: flex;
    align-items: center; /* Vertical center alignment */
    justify-content: center; /* Horizontal center alignment */
    color: #fff;
}
</style>
