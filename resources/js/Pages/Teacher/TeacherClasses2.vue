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
        <form  @submit.prevent="onSubmit()">

        <div class="bg-white shadow-md rounded my-6">
                <table class="w-full table-fixed">
                    <thead>
                    <tr class="bg-primary-200 text-white uppercase text-sm leading-normal">
                        <th class="py-3 w-1/3 px-6 text-left">Matières</th>
                        <th class="py-3 px-6 w-2/3 text-left">Enseignants</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                    <tr v-for="subject in subjects" class="border-b border-gray-200 hover:bg-gray-100" >
                        <td class="py-3 px-6">
                            {{subject.name}}
                        </td>
                        <td class="py-3 px-6">
                            <Dropdown class="w-full form-control" :class="{ 'is-invalid': validationErrors[subject.id]  }" v-model="selectedTeachers[subject.id]" optionValue="id" :options="subject.teachers" optionLabel="first_name" :filter="true" :filterFields="['first_name','last_name']"  placeholder="Sélectionner un Enseignant">
                                <template #value="slotProps">
                                    <div v-if="slotProps.value">
                                        {{teacherFullName(slotProps.value,subject.id)}}
                                    </div>
                                    <span v-else>
                                        {{slotProps.placeholder}}
                                    </span>
                                </template>
                                <template #option="slotProps">
                                    {{slotProps.option.last_name+' '+slotProps.option.first_name}}
                                </template>
                            </Dropdown>
                            <span class="text-danger-500">{{ validationErrors[subject.id] }}</span>

                        </td>
                    </tr>
                    </tbody>
                </table>
        </div>
            <div class="flex py-4">
                <button type="submit" :disabled="isSubmitting" class="inline-flex items-center py-3 px-6 rounded-md text-white font-semibold bg-primary-500 border border-primary-500 mr-4 focus:bg-primary-600 focus:outline-none active:bg-primary-600">
                    <svg v-show="isSubmitting" class="animate-spin h-5 w-5 mr-3 text-white" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Save
                </button>
                <button type="reset" class="py-3 px-6 rounded-md text-secondary-500 font-semibold border border-secondary-500 hover:bg-secondary-500 hover:bg-opacity-5 active:bg-secondary-500 active:bg-opacity-20 focus:outline-none focus:bg-secondary-500 focus:bg-opacity-20">Cancel</button>
            </div>
        </form>
    </div>
</template>

<script>
    import DashLayout from '@/Layouts/DashLayout';
    import Card from 'primevue/card';
    import Dropdown from 'primevue/dropdown';
    import { useForm, useField,Form, ErrorMessage } from 'vee-validate';
    import * as yup from "yup";
    import { reactive } from 'vue';
    export default {
        name: "TeacherClasses2",
        layout: DashLayout,
        components: {Card,Dropdown},
        setup(props) {
            const selectedTeachers = reactive({});
            props.teachersClass.forEach( tc => {
                let s = props.subjects.find(element => element.id ==tc.subject_id);
                let t =s.teachers.find(element => element.id ==tc.teacher_id);
                selectedTeachers[s.id] =  t.id;
            });
            return {selectedTeachers};
        },
        data: function () {
            return {
                validationErrors: new Object(),
                isSubmitting: false,
            }
        },
        props: {
            errors: Object,
            classe: Object,
            subjects: Array,
            academicYear: Object,
            teachersClass: Array,
        },
        methods: {
            teacherFullName: function (teacherId,subjectId){
                let s = this.subjects.find(element => element.id ==subjectId);
                let t =s.teachers.find(element => element.id == teacherId);
                return t.last_name+' '+t.first_name;
            },
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
            },
            onSubmit(){
                this.validationErrors = {};
                this.subjects.forEach(subject => {
                    if(subject.id in this.selectedTeachers  === false){
                        this.validationErrors[subject.id] = 'veuillez sélectionner un enseignant pour cette matière';
                    }
                });
                if(Object.keys(this.validationErrors).length === 0){
                    let postValues =[];
                    for(const st in this.selectedTeachers){
                        let c = this.teachersClass.find(element => element.subject_id == st )
                        postValues.push({'subject_id':st,'teacher_id': this.selectedTeachers[st],'id':c?.id ?? null});
                    }
                    this.$inertia.post(this.route('teacher-class.storeUpdate',{'class_id': this.classe.id}), {'selectedTeachers': postValues}, {
                        onStart: (visit) => {
                            this.isSubmitting = true;
                        },
                        onFinish: visit => {
                            this.isSubmitting = false;
                        },

                        onError: (errors) => {},
                        onCancel: () => {},
                    })
                }else{
                    //this.isSubmitting = false;
                }
            }
        }
    }
</script>

<style scoped>

</style>
