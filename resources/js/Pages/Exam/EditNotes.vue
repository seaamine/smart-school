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
        <div class="flex flex-row gap-6 flex-wrap items-center justify-center">
            <div class="relative">
                <Card class="w-52 relative">
                    <template #header>
                    </template>
                    <template class="h-10" #title>
                        1 ere Semestre
                    </template>
                    <template #content>
                        <img :src="$page.props.appUrl+'/images/exam.png'">
                        <div  class="relative pt-1">
                            <div class="flex mb-2 items-center justify-between">
                                <div>
                              <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-white bg-primary-200">
                                {{semStatus(semestersStatus.semester1)}}
                              </span>
                                </div>
                                <div class="text-right">
                              <span class="text-xs font-semibold inline-block text-emerald-600">
                                {{semestersStatus.semester1.numNotes}}/{{totalNotes}}
                              </span>
                                </div>
                            </div>
                            <div v-if="semestersStatus.semester1.started" class="overflow-hidden h-2 text-xs flex rounded bg-info-200">
                                <div :style="{width: (semestersStatus.semester1.numNotes/totalNotes *100) +'%',}" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-info-500"></div>
                            </div>
                        </div>
                    </template>
                    <template #footer>
                        <button :disabled="semestersStatus.semester1.started && !semestersStatus.semester1.stopped" @click="startSemester(1)" class="rounded-full text-success-500 font-medium mr-4 hover:text-primary-200  focus:text-primary-800 p-0 inline-flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                        <button :disabled="semestersStatus.semester1.stopped || !semestersStatus.semester1.started" @click="stopSemester(1)" class="rounded-full text-danger-500 font-medium mr-4 hover:text-danger-800  focus:text-danger-800 p-0 inline-flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 10a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z" />
                            </svg>
                        </button>
                        <button :disabled="!semestersStatus.semester1.published" @click="publishSemester(1)" class="rounded-full text-info-500 font-medium hover:text-info-800  focus:text-info-800 p-0 inline-flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                        </button>
                    </template>
                </Card>

                <div v-show="isSubmitting[1]" class="bg-white opacity-75 absolute top-0 left-0 w-full h-full flex items-center justify-center">
                    <svg class="animate-spin h-24 w-24 mr-3 text-warning-500" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-100" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
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
                        2 ème Semestre
                    </template>
                    <template #content>
                        <img :src="$page.props.appUrl+'/images/exam.png'">
                        <div  class="relative pt-1">
                            <div class="flex mb-2 items-center justify-between">
                                <div>
                              <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-white bg-primary-200">
                                {{semStatus(semestersStatus.semester2)}}
                              </span>
                                </div>
                                <div class="text-right">
                              <span class="text-xs font-semibold inline-block text-emerald-600">
                                {{semestersStatus.semester2.numNotes}}/{{totalNotes}}
                              </span>
                                </div>
                            </div>
                            <div v-if="semestersStatus.semester2.started" class="overflow-hidden h-2 text-xs flex rounded bg-info-200">
                                <div :style="{width: (semestersStatus.semester2.semestersStatus.semester2.numNotes/totalNotes *100) +'%',}" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-info-500"></div>
                            </div>
                        </div>
                    </template>
                    <template #footer>
                        <button :disabled="semestersStatus.semester2.started && !semestersStatus.semester2.stopped" @click="startSemester(2)" class="rounded-full text-success-500 font-medium mr-4 hover:text-primary-200  focus:text-primary-800 p-0 inline-flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                        <button :disabled="semestersStatus.semester2.stopped || !semestersStatus.semester2.started" @click="stopSemester(2)" class="rounded-full text-danger-500 font-medium mr-4 hover:text-danger-800  focus:text-danger-800 p-0 inline-flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 10a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z" />
                            </svg>
                        </button>
                        <button :disabled="!semestersStatus.semester2.published" @click="publishSemester(2)" class="rounded-full text-info-500 font-medium hover:text-info-800  focus:text-info-800 p-0 inline-flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                        </button>
                    </template>
                </Card>

                <div v-show="isSubmitting[2]" class="bg-white opacity-75 absolute top-0 left-0 w-full h-full flex items-center justify-center">
                    <svg class="animate-spin h-24 w-24 mr-3 text-warning-500" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-100" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
                <div v-show="!semestersStatus.semester1.published" class="bg-white opacity-75 absolute top-0 left-0 w-full h-full flex items-center justify-center">
                    <p class="p-2 text-danger-800 font-semibold">S'il vous plaît compléter et publier semeter 1</p>
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
                        3 éme Semestre
                    </template>
                    <template #content>
                        <img :src="$page.props.appUrl+'/images/exam.png'">
                        <div  class="relative pt-1">
                            <div class="flex mb-2 items-center justify-between ">
                                <div>
                              <span class="text-xs font-semibold inline-block py-1 px-2 uppercase rounded-full text-white bg-primary-200">
                                {{semStatus(semestersStatus.semester3)}}
                              </span>
                                </div>
                                <div class="text-right">
                              <span class="text-xs font-semibold inline-block text-emerald-600">
                                {{semestersStatus.semester3.numNotes}}/{{totalNotes}}
                              </span>
                                </div>
                            </div>
                            <div v-if="semestersStatus.semester3.started" class="overflow-hidden h-2 text-xs flex rounded bg-info-200">
                                <div :style="{width: (semestersStatus.semester3.numNotes/totalNotes *100) +'%',}" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-info-500"></div>
                            </div>
                        </div>
                    </template>
                    <template #footer>
                        <button :disabled="semestersStatus.semester3.started && !semestersStatus.semester3.stopped" @click="startSemester(3)" class="rounded-full text-success-500 font-medium mr-4 hover:text-primary-200  focus:text-primary-800 p-0 inline-flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                        <button :disabled="semestersStatus.semester3.stopped || !semestersStatus.semester3.started" @click="stopSemester(3)" class="rounded-full text-danger-500 font-medium mr-4 hover:text-danger-800  focus:text-danger-800 p-0 inline-flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 10a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z" />
                            </svg>
                        </button>
                        <button :disabled="!semestersStatus.semester3.published" @click="publishSemester(3)" class="rounded-full text-info-500 font-medium hover:text-info-800  focus:text-info-800 p-0 inline-flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                        </button>
                    </template>
                </Card>

                <div v-show="isSubmitting[3]" class="bg-white opacity-75 absolute top-0 left-0 w-full h-full flex items-center justify-center">
                    <svg class="animate-spin h-24 w-24 mr-3 text-warning-500" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-100" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </div>
                <div v-show="!semestersStatus.semester2.published" class="bg-white opacity-75 absolute top-0 left-0 w-full h-full flex items-center justify-center">
                    <p class="p-2 text-danger-800 font-semibold">S'il vous plaît compléter et publier semeter 2</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import DashLayout from '@/Layouts/DashLayout';
    import Card from 'primevue/card';
    import Button from "@/Jetstream/Button";

    export default {
        name: "EditNotes",
        components: {Button, Card},
        layout: DashLayout,
        props: {
            errors: Object,
            exams: Array,
            academicYear: Object,
            totalNotes: Number,
        },
        methods:{
            initSemester: function(sem,exam){
                let i = this.exams.findIndex(e => e.id === exam.id);
                this.exams[i]=exam;
                this.semestersStatus['semester'+sem]['id']=exam.id;
                this.semestersStatus['semester'+sem]['numNotes']=exam.num_notes ?? 0;
                this.semestersStatus['semester'+sem]['started']=exam.started_at ? true : false;
                this.semestersStatus['semester'+sem]['stopped']=exam.stopped_at ? true : false;
                this.semestersStatus['semester'+sem]['published']=exam.published_at ? true : false;
            },
            semStatus: function(sem){
                if(!sem.started){
                    return "Pas commencé";
                }
                if(!sem.stopped){
                    return "En cours";
                }else{
                    if(sem.published){
                        return " Terminé et publié";
                    }else{
                        return " Terminé";

                    }
                }

            },
            startSemester: function(sem){
                if(this.isSubmitting[sem]){
                    return;
                }
                this.isSubmitting[sem] = true;
                axios.post(this.route('exam.update'),{'semester': sem,'academicYear': this.academicYear.id,'method':'start'})
                    .then((response)=>{
                        this.isSubmitting[sem] = false;
                        this.initSemester(sem,response.data.exam)
                    });
            },
            stopSemester: function(sem){
                if(this.isSubmitting[sem]){
                    return;
                }
                this.isSubmitting[sem] = true;
                axios.post(this.route('exam.update'),{'semester': sem,'academicYear': this.academicYear.id,'method':'stop'})
                    .then((response)=>{
                        this.isSubmitting[sem] = false;
                        this.initSemester(sem,response.data.exam)
                    });
            },
            publishSemester: function(sem){
                if(this.isSubmitting[sem]){
                    return;
                }
                this.isSubmitting[sem] = true;
                axios.post(this.route('exam.update'),{'semester': sem,'academicYear': this.academicYear.id,'method':'publish'})
                    .then((response)=>{
                        this.isSubmitting[sem] = false;
                        this.initSemester(sem,response.data.exam)
                    });
            }
        },
        data(){
            return{
                semestersStatus:{
                    'semester1':{'id':null,'started':false,'stopped':false,'published':false,'numNotes':0},
                    'semester2':{'id':null,'started':false,'stopped':false,'published':false,'numNotes':0},
                    'semester3':{'id':null,'started':false,'stopped':false,'published':false,'numNotes':0},
                },
                isSubmitting: {
                    1:false,2:false,3:false
                },
            };
        },
        created() {
            this.exams.forEach(exam => {
                this.semestersStatus['semester'+exam.semester]['id']=exam.id;
                this.semestersStatus['semester'+exam.semester]['numNotes']=exam.num_notes ?? 0;
                this.semestersStatus['semester'+exam.semester]['started']=exam.started_at ? true : false;
                this.semestersStatus['semester'+exam.semester]['stopped']=exam.stopped_at ? true : false;
                this.semestersStatus['semester'+exam.semester]['published']=exam.published_at ? true : false;
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
