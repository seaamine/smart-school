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
        <p v-for="subject in subjects">{{subject.name}}</p>
    </div>
</template>

<script>
    import DashLayout from '@/Layouts/DashLayout';
    import Card from 'primevue/card';

    export default {
        name: "TeacherClasses2",
        layout: DashLayout,
        components: {Card},

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
