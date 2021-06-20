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
    <div class="card p-6">
        <p class="mb-4"><b>Année Academic: </b>{{academicYear.title}}</p>
        <div class="flex flex-row gap-6">
            <transition name="mode-fade" mode="out-in">
                <div v-if="step === 'trimester'" class=" flex flex-grow flex-row gap-6 flex-wrap items-center justify-center">
                    <div class="relative">
                        <Card class="w-52 relative">
                            <template #header>
                            </template>
                            <template class="h-10" #title>
                                1 ere Trimestre
                            </template>
                            <template #content>
                                <img :src="$page.props.appUrl+'/images/exam.png'">
                                <div  class="relative pt-1">
                                    <div class="flex mb-2 items-center justify-between">
                                        <div>
                              <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-white bg-primary-200">
                                {{triStatus(trimestersStatus.trimester1)}}
                              </span>
                                        </div>
                                    </div>
                                </div>
                            </template>
                            <template #footer>
                                <div class="flex items-center justify-center">
                                    <button  :disabled="!trimestersStatus.trimester1.published" @click="selectTrimester(1)" class="bg-success-500 text-white rounded-md font-medium py-2 px-4 hover:bg-primary-800 hover:ring hover:ring-primary-200 inline-flex justify-center items-center">
                                        Voir
                                    </button>
                                </div>
                            </template>
                        </Card>
                        <div v-show="!trimestersStatus.trimester1.started" class="bg-white opacity-75 absolute top-0 left-0 w-full h-full flex items-center justify-center">
                            <p class="p-2 text-danger-800 font-semibold text-3xl">inactif</p>
                        </div>
                    </div>
                    <div><p class="font-bold"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                    </svg></p></div>
                    <div class="relative">
                        <Card class="w-52 relative">
                            <template #header>
                            </template>
                            <template class="h-10" #title>
                                2 éme Trimestre
                            </template>
                            <template #content>
                                <img :src="$page.props.appUrl+'/images/exam.png'">
                                <div  class="relative pt-1">
                                    <div class="flex mb-2 items-center justify-between">
                                        <div>
                              <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-white bg-primary-200">
                                {{triStatus(trimestersStatus.trimester2)}}
                              </span>
                                        </div>
                                    </div>
                                </div>
                            </template>
                            <template #footer>
                                <div class="flex items-center justify-center">
                                    <button  :disabled="!trimestersStatus.trimester2.published" @click="selectTrimester(2)" class="bg-success-500 text-white rounded-md font-medium py-2 px-4 hover:bg-primary-800 hover:ring hover:ring-primary-200 inline-flex justify-center items-center">
                                        Voir
                                    </button>
                                </div>
                            </template>
                        </Card>
                        <div v-show="!trimestersStatus.trimester2.started" class="bg-white opacity-75 absolute top-0 left-0 w-full h-full flex items-center justify-center">
                            <p class="p-2 text-danger-800 font-semibold text-3xl">inactif</p>
                        </div>
                    </div>

                    <div><p class="font-bold"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                    </svg></p></div>
                    <div class="relative">
                        <Card class="w-52 relative">
                            <template #header>
                            </template>
                            <template class="h-10" #title>
                                3 éme Trimestre
                            </template>
                            <template #content>
                                <img :src="$page.props.appUrl+'/images/exam.png'">
                                <div  class="relative pt-1">
                                    <div class="flex mb-2 items-center justify-between">
                                        <div>
                              <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-white bg-primary-200">
                                {{triStatus(trimestersStatus.trimester3)}}
                              </span>
                                        </div>
                                    </div>
                                </div>
                            </template>
                            <template #footer>
                                <div class="flex items-center justify-center">
                                    <button  :disabled="!trimestersStatus.trimester3.published" @click="selectTrimester(3)" class="bg-success-500 text-white rounded-md font-medium py-2 px-4 hover:bg-primary-800 hover:ring hover:ring-primary-200 inline-flex justify-center items-center">
                                        Voir
                                    </button>
                                </div>
                            </template>
                        </Card>
                        <div v-show="!trimestersStatus.trimester3.started" class="bg-white opacity-75 absolute top-0 left-0 w-full h-full flex items-center justify-center">
                            <p class="p-2 text-danger-800 font-semibold text-3xl">inactif</p>
                        </div>
                    </div>

                </div>
                <div class="w-full" v-else-if="step === 'notes'">
                    <div>
                        <p>Nom: {{student.last_name+' '+student.first_name}}</p>
                        <p>Classe: {{classe.name}}</p>
                        <p class="mb-4">Trimistre: {{selectedTrimester}}</p>
                        <DataTable responsiveLayout="stack" breakpoint="768px" :value="subjects" dataKey="id" class="p-datatable-sm">
                            <Column :style="{width:'150px'}" field="name" header="Matière"></Column>
                            <Column :style="{width:'150px'}" header="Evaluation">
                                <template #body="slotProps">
                                        {{studentNotes[selectedTrimester][slotProps.data.id].note_eval}}
                                </template>
                            </Column>
                            <Column :style="{width:'150px'}" header="Devoir">
                                <template #body="slotProps">
                                    {{studentNotes[selectedTrimester][slotProps.data.id].note_devoir}}
                                </template>
                            </Column>
                            <Column :style="{width:'150px'}" header="Examen">
                                <template #body="slotProps">
                                    {{studentNotes[selectedTrimester][slotProps.data.id].note_exam}}
                                </template>
                            </Column>
                            <Column :style="{width:'150px'}" header="Remarque">
                                <template #body="slotProps">
                                    {{studentNotes[selectedTrimester][slotProps.data.id].remarque}}
                                </template>
                            </Column>
                        </DataTable>
                    </div>
                    <div class="flex justify-evenly mt-4">
                        <button @click="step='trimester';selectedTrimester=null;" class="text-white py-4 w-1/3 rounded-md font-medium bg-warning-500 py-2 px-4 hover:bg-primary-800 hover:ring hover:ring-primary-200 inline-flex justify-center items-center">
                            Annuler
                        </button>
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
    import DashLayout from '@/Layouts/DashLayout';
    import Card from 'primevue/card';
    import DataTable from 'primevue/datatable';
    import Column from 'primevue/column';

    export default {
        name: "Notes",
        layout: DashLayout,
        components: { Card,DataTable, Column},
        props: {
            errors: Object,
            exams: Array,
            academicYear: Object,
            student: Object,
            subjects: Array,
            classe: Object,
            studentNotes: Object,
        },
        methods:{
            selectTrimester(tri){
                this.selectedTrimester = tri;
                this.step = 'notes';
            },
            initTrimester(tri,exam){
                let i = this.exams.findIndex(e => e.id === exam.id);
                this.exams[i]=exam;
                this.trimestersStatus['trimester'+tri]['id']=exam.id;
                this.trimestersStatus['trimester'+tri]['numNotes']=exam.num_notes ?? 0;
                this.trimestersStatus['trimester'+tri]['started']=exam.started_at ? true : false;
                this.trimestersStatus['trimester'+tri]['stopped']=exam.stopped_at ? true : false;
                this.trimestersStatus['trimester'+tri]['published']=exam.published_at ? true : false;
            },
            triStatus(tri){
                if(!tri.started){
                    return "Pas commencé";
                }
                if(!tri.stopped){
                    return "En cours";
                }else{
                    if(tri.published){
                        return "publié";
                    }else{
                        return "En cours";

                    }
                }

            },
        },
        data(){
            return{
                trimestersStatus:{
                    'trimester1':{'id':null,'started':false,'stopped':false,'published':false,'numNotes':0},
                    'trimester2':{'id':null,'started':false,'stopped':false,'published':false,'numNotes':0},
                    'trimester3':{'id':null,'started':false,'stopped':false,'published':false,'numNotes':0},
                },
                step: 'trimester',
                selectedTrimester: null,

            }
        },
        created() {
            this.exams.forEach(exam => {
                this.trimestersStatus['trimester'+exam.trimester]['id']=exam.id;
                this.trimestersStatus['trimester'+exam.trimester]['started']=exam.started_at ? true : false;
                this.trimestersStatus['trimester'+exam.trimester]['stopped']=exam.stopped_at ? true : false;
                this.trimestersStatus['trimester'+exam.trimester]['published']=exam.published_at ? true : false;
            })
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
.mode-fade-enter-active, .mode-fade-leave-active {
    transition: opacity .5s ease
}

.mode-fade-enter-from, .mode-fade-leave-to {
    opacity: 0
}
.form-control{
    @apply w-40 md:w-full;
}
>>> .p-inputnumber-input{
    @apply w-40 md:w-full;
}
</style>
