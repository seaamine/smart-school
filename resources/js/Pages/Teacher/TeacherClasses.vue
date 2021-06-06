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
        <div v-for="levelclasses in classes" class="pb-6 grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-4 justify-items-center">
            <Card v-for="classe in levelclasses" class="click-card w-60">
                <template #header>
                </template>
                <template class="h-10" #title>
                    {{levelName(classe.level)}}
                </template>
                <template #content>
                    <span class="pb-2 text-2xl	">{{classe.name}}</span>
                </template>
                <template #footer>
                    <span class="badge badge-secondary">not asigned</span>
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
    .click-card:hover{
        cursor: pointer;
        border: 1px solid #7367f0!important;
        box-shadow: 0 0 10px 1px rgba(115, 103, 240, 0.7);

    }
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
>>> .p-card-content{

    text-align: center;

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
