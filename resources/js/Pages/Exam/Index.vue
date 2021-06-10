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
    <div class="card p-6 flex flex-row">
        <Card class="w-52">
            <template #header>
            </template>
            <template class="h-10" #title>
                1 ere Simastre
            </template>
            <template #content>
                <img src="images/exam.png">
            </template>
            <template #footer>
                <button :disabled="semestersStatus.semester1.started" @click="startSemester(1)" class="rounded-full text-success-500 font-medium mr-4 hover:text-primary-200  focus:text-primary-800 p-0 inline-flex justify-center items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </button>
                <button :disabled="!semestersStatus.semester1.stoped" @click="stopSemester(1)" class="rounded-full text-danger-500 font-medium mr-4 hover:text-danger-200  focus:text-danger-800 p-0 inline-flex justify-center items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 10a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z" />
                    </svg>
                </button>
                <button :disabled="!semestersStatus.semester1.published" @click="publishSemester(1)" class="rounded-full text-info-500 font-medium mr-4 hover:text-info-800  focus:text-info-800 p-0 inline-flex justify-center items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
                </button>
            </template>
        </Card>
    </div>
</template>

<script>
    import DashLayout from '@/Layouts/DashLayout';
    import Card from 'primevue/card';
    import Button from "@/Jetstream/Button";

    export default {
        name: "Index",
        components: {Button, Card},
        layout: DashLayout,
        props: {
            errors: Object,
            exams: Array,
        },
        methods:{
            startSemester: function(sem){

            },
            stopSemester: function(sem){

            },
            publishSemester: function(sem){

            }
        },
        data(){
            return{
                semestersStatus:{
                    'semester1':{'id':null,'started':false,'stoped':false,'published':false},
                    'semester2':{'id':null,'started':false,'stoped':false,'published':false},
                    'semester3':{'id':null,'started':false,'stoped':false,'published':false},
                }
            };
        },
        created() {
            exams.forEach(exam => {
                this.semestersStatus['semester'+exam.semester][id]=exam.id;
                this.semestersStatus['semester'+exam.semester]['started']=exam.id;
            })
        }
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
