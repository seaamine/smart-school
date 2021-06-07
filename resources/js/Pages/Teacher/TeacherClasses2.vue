<template>
    <div class="content-header mb-5">
        <h2>Affectation des Enseignants pour Class {{classe.name}}</h2>
    </div>
    <div v-if="Object.keys(errors).length" class="card card-danger p-6 mb-4 text-white">
        <ul class="list-disc">
            <li v-for="error in errors">
                {{error}}
            </li>
        </ul>
    </div>
    <div class="card p-6">
        <p><b>Année Academeic:</b> {{academicYear.title}}</p>
        <div class="bg-white shadow-md rounded my-6">
            <table class="w-full table-fixed">
                <thead>
                <tr class="bg-primary-200 text-white uppercase text-sm leading-normal">
                    <th class="py-3 w-1/3 px-6 text-left">Matières</th>
                    <th class="py-3 px-6 w-2/3 text-left">Enseignants</th>
                </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    <tr v-for="subject in subjects" class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6">
                            {{subject.name}}
                        </td>
                        <td class="py-3 px-6">
                            <Dropdown class="w-full" v-model="selectedTeachers[subject.id]" :options="subject.teachers" optionValue="id" optionLabel="first_name" :filter="true" :filterFields="['first_name','last_name']"  placeholder="Sélectionner un Enseignant">
                                <template #option="slotProps">
                                    {{slotProps.option.last_name+' '+slotProps.option.first_name}}
                                </template>
                            </Dropdown>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    import DashLayout from '@/Layouts/DashLayout';
    import Card from 'primevue/card';
    import Dropdown from 'primevue/dropdown';

    export default {
        name: "TeacherClasses2",
        layout: DashLayout,
        components: {Card,Dropdown},
        data: function () {
            return {
                selectedTeachers: new Object(),
            }
        },
        props: {
            errors: Object,
            classe: Object,
            subjects: Array,
            academicYear: Object,
        },
        methods: {
            levelName: function(level){
                switch(level) {
                    case "1":
                        return '1 ère année';
                    case "2":
                        return '2 ème année';
                    case "3":
                        return '3 ème année';
                    case "4":
                        return '4 ème année';
                    default:
                        return '' + level +' année'
                }
            }
        }
    }
</script>

<style scoped>

</style>
