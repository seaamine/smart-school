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
                                        <div class="text-right">
                              <span class="text-xs font-semibold inline-block text-emerald-600">
                                {{trimestersStatus.trimester1.numNotes}}/{{totalNotes}}
                              </span>
                                        </div>
                                    </div>
                                    <div v-if="trimestersStatus.trimester1.started" class="overflow-hidden h-2 text-xs flex rounded bg-info-200">
                                        <div :style="{width: (trimestersStatus.trimester1.numNotes/totalNotes *100) +'%',}" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-info-500"></div>
                                    </div>
                                </div>
                            </template>
                            <template #footer>
                                <button :disabled="!trimestersStatus.trimester1.started || trimestersStatus.trimester1.stopped" @click="selectTrimester(1)" class="text-white rounded-md font-medium bg-primary-500 py-2 px-4 hover:bg-primary-800 hover:ring hover:ring-primary-200 inline-flex justify-center items-center">
                                    Saisir
                                </button>
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
                                2 ème Trimestre
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
                                        <div class="text-right">
                              <span class="text-xs font-semibold inline-block text-emerald-600">
                                {{trimestersStatus.trimester2.numNotes}}/{{totalNotes}}
                              </span>
                                        </div>
                                    </div>
                                    <div v-if="trimestersStatus.trimester2.started" class="overflow-hidden h-2 text-xs flex rounded bg-info-200">
                                        <div :style="{width: (trimestersStatus.trimester2.trimestersStatus.trimester2.numNotes/totalNotes *100) +'%',}" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-info-500"></div>
                                    </div>
                                </div>
                            </template>
                            <template #footer>
                                <button :disabled="!trimestersStatus.trimester2.started || trimestersStatus.trimester2.stopped" @click="selectTrimester(2)" class="text-white rounded-md font-medium bg-primary-500 py-2 px-4 hover:bg-primary-800 hover:ring hover:ring-primary-200 inline-flex justify-center items-center">
                                    Saisir
                                </button>
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
                                    <div class="flex mb-2 items-center justify-between ">
                                        <div>
                              <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-white bg-primary-200">
                                {{triStatus(trimestersStatus.trimester3)}}
                              </span>
                                        </div>
                                        <div class="text-right">
                              <span class="text-xs font-semibold inline-block text-emerald-600">
                                {{trimestersStatus.trimester3.numNotes}}/{{totalNotes}}
                              </span>
                                        </div>
                                    </div>
                                    <div v-if="trimestersStatus.trimester3.started" class="overflow-hidden h-2 text-xs flex rounded bg-info-200">
                                        <div :style="{width: (trimestersStatus.trimester3.numNotes/totalNotes *100) +'%',}" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-info-500"></div>
                                    </div>
                                </div>
                            </template>
                            <template #footer>
                                <button :disabled="!trimestersStatus.trimester3.started || trimestersStatus.trimester3.stopped" @click="selectTrimester(3)" class="text-white rounded-md font-medium bg-primary-500 py-2 px-4 hover:bg-primary-800 hover:ring hover:ring-primary-200 inline-flex justify-center items-center">
                                    Saisir
                                </button>
                            </template>
                        </Card>
                        <div v-show="!trimestersStatus.trimester3.started" class="bg-white opacity-75 absolute top-0 left-0 w-full h-full flex items-center justify-center">
                            <p class="p-2 text-danger-800 font-semibold text-3xl">Inactif</p>
                        </div>
                    </div>
                </div>
                <div class="" v-else-if="step === 'class'">
                    <div v-for="levelclasses in classes" class="pb-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-4 gap-4 justify-items-center">
                        <Card v-for="classe in levelclasses" :key="'class-'+classe.id" @click="selectClass(classe)" class="click-card w-52">
                            <template #header>
                            </template>
                            <template class="h-10" #title>
                                {{levelName(classe.level)}}
                            </template>
                            <template #content>
                                <span class="pb-2 text-2xl	">{{classe.name}}</span>
                            </template>
                            <template #footer>
                                <span :class=" 1> 0 ? 'badge-secondary' : 'badge-success'" class="badge">{{1> 0 ? 'Non attribué': 'Complété'}}</span>
                            </template>
                        </Card>
                    </div>
                </div>
                <div class="overflow-x-auto	" v-else-if="step === 'notes'">
                    <p class="mb-2"><b>Class:</b> {{selectedClass?.name}}</p>
                    <p class="mb-4"><b>Nombres des étudiants:</b> {{classesStudents[selectedClass.id].length ?? 0}}</p>
                    <DataTable responsiveLayout="stack" breakpoint="768px" :value="classesStudents[selectedClass.id]" dataKey="id" class="p-datatable-sm">
                        <Column :style="{width:'150px'}" field="regi_no" header="N d'enregistrement"></Column>
                        <Column :style="{width:'200px'}" header="nom et prénom">
                            <template #body="slotProps">
                                {{slotProps.data.last_name}} {{slotProps.data.first_name}}
                            </template>
                        </Column>
                        <Column :style="{width:'80px'}" field="note_eval" header="Evaluation" :exportable="false">
                            <template #body="slotProps">
                                <input type="text" class="form-control " v-model="slotProps.data.note_eval" />
                            </template>
                        </Column>
                        <Column :style="{width:'80px'}" field="note_devoir" header="Devoir" :exportable="false">
                            <template #body="slotProps">
                                <input type="text" class="form-control w-4" v-model="slotProps.data.note_devoir" />
                            </template>
                        </Column>
                        <Column :style="{width:'80px'}" field="note_exam" header="Exam" :exportable="false">
                            <template #body="slotProps">
                                <InputNumber v-model="slotProps.data.note_exam" :min="0" :max="20" :useGrouping="false" locale="ar-DZ" mode="decimal" :minFractionDigits="2" :maxFractionDigits="2" />

                            </template>
                        </Column>
                        <Column :style="{width:'250px'}" field="note" header="Remarque" :exportable="false">
                            <template #body="slotProps">
                                <input type="text" class="form-control w-4" v-model="slotProps.data.note" />
                            </template>
                        </Column>
                    </DataTable>
                    <div class="flex justify-evenly mt-4">
                        <button @click="submitNotes()" class=" mr-4 w-1/3 py-4 text-white rounded-md font-medium bg-primary-500 py-2 px-4 hover:bg-primary-800 hover:ring hover:ring-primary-200 inline-flex justify-center items-center">
                            Save
                        </button>
                        <button @click="" class="text-white py-4 w-1/3 rounded-md font-medium bg-warning-500 py-2 px-4 hover:bg-primary-800 hover:ring hover:ring-primary-200 inline-flex justify-center items-center">
                            Cancel
                        </button>
                    </div>

                </div>
            </transition>

        </div>
        <button @click="step = 'class'" class="rounded-full text-info-500 font-medium hover:text-info-800  focus:text-info-800 p-0 inline-flex justify-center items-center">
            step2
        </button>
        <button @click="step = 'trimester'" class="rounded-full text-info-500 font-medium hover:text-info-800  focus:text-info-800 p-0 inline-flex justify-center items-center">
            step1
        </button>
    </div>
</template>

<script>
    import DashLayout from '@/Layouts/DashLayout';
    import Card from 'primevue/card';
    import Button from "@/Jetstream/Button";
    import DataTable from 'primevue/datatable';
    import Column from 'primevue/column';
    import InputNumber from 'primevue/inputnumber';

    export default {
        name: "EditNotes",
        components: {InputNumber,Button, Card, DataTable, Column},
        layout: DashLayout,
        props: {
            errors: Object,
            exams: Array,
            academicYear: Object,
            totalNotes: Number,
            classes: Array,
            classesStudents: Object,
        },
        methods:{
            submitNotes(){
                this.isSubmitting[this.selectedClass.id] = true;
                axios.post(this.route('teacher.update-exam-notes'),{'trimester': this.selectedTrimester,
                    'academicYear': this.academicYear.id, 'class':this.selectedClass.id, 'exam': this.exam.id,'examNotes': this.classesStudents[this.selectedClass.id]})
                    .then((response)=>{
                        this.isSubmitting[this.selectedClass.id] = false;
                        //this.initTrimester(tri,response.data.exam)
                    });
            },
            selectTrimester(tri){
                this.selectedTrimester = tri;
                this.step = 'class';
            },
            selectClass(cla){
                this.selectedClass = cla;
                this.step = 'notes';
            },
            levelName(level){
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
                        return "Arrêté";

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
                isSubmitting: {},
                step: 'trimester',
                selectedTrimester: null,
                selectedClass: null,
            };
        },
        created() {
            this.exams.forEach(exam => {
                this.trimestersStatus['trimester'+exam.trimester]['id']=exam.id;
                this.trimestersStatus['trimester'+exam.trimester]['numNotes']=exam.num_notes ?? 0;
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
