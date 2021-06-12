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
                        1 ere Trimestre
                    </template>
                    <template #content>
                        <img src="images/exam.png">
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
                        <button :disabled="trimestersStatus.trimester1.started && !trimestersStatus.trimester1.stopped" @click="startTrimester(1)" class="rounded-full text-success-500 font-medium mr-4 hover:text-success-800  active:text-primary-800 p-0 inline-flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                        <button :disabled="trimestersStatus.trimester1.stopped || !trimestersStatus.trimester1.started" @click="stopTrimester(1)" class="rounded-full text-danger-500 font-medium mr-4 hover:text-danger-800  active:text-danger-800 p-0 inline-flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 10a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z" />
                            </svg>
                        </button>
                        <button :disabled="!trimestersStatus.trimester1.published" @click="publishTrimester(1)" class="rounded-full text-info-500 font-medium hover:text-info-800  active:text-info-800 p-0 inline-flex justify-center items-center">
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
                        2 ème Trimestre
                    </template>
                    <template #content>
                        <img src="images/exam.png">
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
                        <button :disabled="trimestersStatus.trimester2.started && !trimestersStatus.trimester2.stopped" @click="startTrimester(2)" class="rounded-full text-success-500 font-medium mr-4 hover:text-success-00  active:text-success-800 p-0 inline-flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                        <button :disabled="trimestersStatus.trimester2.stopped || !trimestersStatus.trimester2.started" @click="stopTrimester(2)" class="rounded-full text-danger-500 font-medium mr-4 hover:text-danger-800  active:text-danger-800 p-0 inline-flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 10a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z" />
                            </svg>
                        </button>
                        <button :disabled="!trimestersStatus.trimester2.published" @click="publishTrimester(2)" class="rounded-full text-info-500 font-medium hover:text-info-800  active:text-info-800 p-0 inline-flex justify-center items-center">
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
                <div v-show="!trimestersStatus.trimester1.published" class="bg-white opacity-75 absolute top-0 left-0 w-full h-full flex items-center justify-center">
                    <p class="p-2 text-danger-800 font-semibold">S'il vous plaît compléter et publier Trimestre 1</p>
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
                        <img src="images/exam.png">
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
                        <button :disabled="trimestersStatus.trimester3.started && !trimestersStatus.trimester3.stopped" @click="startTrimester(3)" class="rounded-full text-success-500 font-medium mr-4 hover:text-success-200  active:text-success-800 p-0 inline-flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </button>
                        <button :disabled="trimestersStatus.trimester3.stopped || !trimestersStatus.trimester3.started" @click="stopTrimester(3)" class="rounded-full text-danger-500 font-medium mr-4 hover:text-danger-800  active:text-danger-800 p-0 inline-flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 10a1 1 0 011-1h4a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 01-1-1v-4z" />
                            </svg>
                        </button>
                        <button :disabled="!trimestersStatus.trimester3.published" @click="publishTrimester(3)" class="rounded-full text-info-500 font-medium hover:text-info-800  active:text-info-800 p-0 inline-flex justify-center items-center">
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
                <div v-show="!trimestersStatus.trimester2.published" class="bg-white opacity-75 absolute top-0 left-0 w-full h-full flex items-center justify-center">
                    <p class="p-2 text-danger-800 font-semibold">S'il vous plaît compléter et publier Trimestre 2</p>
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
        name: "Index",
        components: {Button, Card},
        layout: DashLayout,
        props: {
            errors: Object,
            exams: Array,
            academicYear: Object,
            totalNotes: Number,
        },
        methods:{
            initTrimester: function(tri,exam){
                let i = this.exams.findIndex(e => e.id === exam.id);
                this.exams[i]=exam;
                this.trimestersStatus['trimester'+tri]['id']=exam.id;
                this.trimestersStatus['trimester'+tri]['numNotes']=exam.num_notes ?? 0;
                this.trimestersStatus['trimester'+tri]['started']=exam.started_at ? true : false;
                this.trimestersStatus['trimester'+tri]['stopped']=exam.stopped_at ? true : false;
                this.trimestersStatus['trimester'+tri]['published']=exam.published_at ? true : false;
            },
            triStatus: function(tri){
                if(!tri.started){
                    return "Pas commencé";
                }
                if(!tri.stopped){
                    return "En cours";
                }else{
                    if(tri.published){
                        return " Terminé et publié";
                    }else{
                        return " Terminé";

                    }
                }

            },
            processResponse(response,tri){
                this.isSubmitting[tri] = false;
                if(response.data.type === 'error'){
                    this.$toast.add({severity:'error', summary: response.data.toast.summary, detail:response.data.toast.detail, life: 5000});
                }else if (response.data.type === 'success'){
                    this.$toast.add({severity:'success', summary: response.data.toast.summary, detail:response.data.toast.detail, life: 5000});
                    this.initTrimester(tri,response.data.exam);
                }


            },
            handleError(error,tri){
                this.isSubmitting[tri] = false;
                const errorResponse = this.handleFetchError(error)
                this.$toast.add({severity:'error', summary : 'L\'opération a échoué!',detail:errorResponse.message, life: 5000});
            },
            startTrimester: function(tri){
                if(this.isSubmitting[tri]){
                    return;
                }
                this.isSubmitting[tri] = true;
                const self = this;
                axios.post(this.route('exam.update'),{'trimester': tri,'academicYear': this.academicYear.id,'method':'start'})
                    .then((response)=>{
                        self.processResponse(response,tri)
                    }).catch(function (error) {
                        self.handleError(error,tri);
                });
            },
            stopTrimester: function(tri){
                if(this.isSubmitting[tri]){
                    return;
                }
                this.isSubmitting[tri] = true;
                axios.post(this.route('exam.update'),{'trimester': tri,'academicYear': this.academicYear.id,'method':'stop'})
                    .then((response)=>{
                        this.processResponse(response,tri)
                    }).catch(function(err){
                    this.handleError(err);
                });
            },
            publishTrimester: function(tri){
                if(this.isSubmitting[tri]){
                    return;
                }
                this.isSubmitting[tri] = true;
                axios.post(this.route('exam.update'),{'trimester': tri,'academicYear': this.academicYear.id,'method':'publish'})
                    .then((response)=>{
                        this.processResponse(response,tri)
                    }).catch(function(err){
                    this.handleError(err);
                });
            }
        },
        data(){
            return{
                trimestersStatus:{
                    'trimester1':{'id':null,'started':false,'stopped':false,'published':false,'numNotes':0},
                    'trimester2':{'id':null,'started':false,'stopped':false,'published':false,'numNotes':0},
                    'trimester3':{'id':null,'started':false,'stopped':false,'published':false,'numNotes':0},
                },
                isSubmitting: {
                    1:false,2:false,3:false
                },
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
