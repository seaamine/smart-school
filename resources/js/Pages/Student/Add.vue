<template>
    <div class="content-header mb-5">
        <h2>Nouveau Etudiant</h2>
    </div>
    <div v-if="Object.keys(errors).length" class="card card-danger p-6 mb-4 text-white">
        <ul class="list-disc">
            <li v-for="error in errors">
                {{error}}
            </li>
        </ul>
    </div>
    <div class="card p-6">

        <form class="divide-y" @submit.prevent="onSubmit">
            <div>
                <h4 class="mb-2">Info de l'étudiant:</h4>
                <div class="flex gap-x-7 flex-col md:flex-row">
                    <div class="form-group w-full">
                        <Label>Nom</Label>
                        <input name="last_name" v-model="lastName" class="form-control" :class="{ 'is-invalid': veeErrors.lastName }" type="text" placeholder="Last Name">
                        <span class="text-danger-500">{{ veeErrors.lastName }}</span>
                    </div>
                    <div class="form-group w-full">
                        <Label>Prenom</Label>
                        <input name="first_name" v-model="firstName" class="form-control" :class="{ 'is-invalid': veeErrors.firstName }" type="text" placeholder="First Name">
                        <span class="text-danger-500">{{ veeErrors.firstName }}</span>
                    </div>
                    <div class="form-group w-full">
                        <Label>Sexe</Label>
                        <select name="gender" v-model="gender" class="form-control" :class="{ 'is-invalid': veeErrors.gender }" type="text" placeholder="Gender">
                            <option value="m">Male</option>
                            <option value="f">Female</option>
                        </select>
                        <span class="text-danger-500">{{ veeErrors.gender }}</span>
                    </div>
                </div>
                <div class="flex gap-x-7 flex-col md:flex-row">
                    <div id="p12345" class="form-group w-full p12345">
                        <Label>Date de naissaince</Label>
                        <Calendar :monthNavigator="true" :yearNavigator="true" :yearRange="dobRange()" name="sdate" v-model="dob" class="w-full" :inputClass="['form-control',{ 'is-invalid': errors.dob }]" placeholder="Date de naissaince"/>
                        <span class="text-danger-500">{{ veeErrors.dob }}</span>
                    </div>
                    <div class="form-group w-full">
                        <Label>Commune</Label>
                        <input name="commune" v-model="commune" class="form-control" :class="{ 'is-invalid': veeErrors.commune }" type="text" placeholder="Commune">
                        <span class="text-danger-500">{{ veeErrors.commune }}</span>
                    </div>
                    <div class="form-group w-full">
                        <Label>Willaya</Label>
                        <input name="willaya" v-model="willaya" class="form-control" :class="{ 'is-invalid': veeErrors.willaya }" type="text" placeholder="Willaya">
                        <span class="text-danger-500">{{ veeErrors.willaya }}</span>
                    </div>
                    <div class="form-group w-full">
                        <Label>Paye</Label>
                        <input name="paye" v-model="paye" class="form-control" :class="{ 'is-invalid': veeErrors.paye }" type="text" placeholder="Paye">
                        <span class="text-danger-500">{{ veeErrors.paye }}</span>
                    </div>
                </div>
                <div class="flex gap-x-7 flex-col md:flex-row">
                    <div class="form-group md:w-1/3">
                        <Label>Photo</Label>
                        <input type="file" class="form-control" @change="onFileSelect" accept="image/*">
                        <span class="text-danger-500">{{ veeErrors.photo }}</span>
                    </div>
                    <div class="form-group md:w-1/3">
                        <Label>Email</Label>
                        <input name="email" v-model="email" class="form-control" :class="{ 'is-invalid': veeErrors.email }" type="email" placeholder="Email">
                        <span class="text-danger-500">{{ veeErrors.email }}</span>
                    </div>
                </div>
                <div class="flex gap-x-7 flex-col md:flex-row">
                    <div class="form-group md:w-1/3">
                        <Label>Note</Label>
                        <textarea v-model="note" class="form-control h-auto" rows="2"></textarea>
                        <span class="text-danger-500">{{ veeErrors.note }}</span>
                    </div>
                </div>
            </div>
            <div>
                <h4 class="my-4">Infos sur le gardien:</h4>
                <div class="flex gap-x-7 flex-col md:flex-row">
                    <div class="form-group md:w-1/3">
                        <Label>Le nom du père</Label>
                        <input name="first_name" v-model="fatherFirstName" class="form-control" :class="{ 'is-invalid': veeErrors.fatherFirstName }" type="text" placeholder="Nom du père">
                        <span class="text-danger-500">{{ veeErrors.fatherFirstName }}</span>
                    </div>
                    <div class="form-group md:w-1/3">
                        <Label>No de téléphone du père</Label>
                        <input name="first_name" v-model="fatherPhone" class="form-control" :class="{ 'is-invalid': veeErrors.fatherPhone }" type="text" placeholder="No de téléphone">
                        <span class="text-danger-500">{{ veeErrors.fatherPhone }}</span>
                    </div>
                </div>
                <div class="flex gap-x-7 flex-col md:flex-row">
                    <div class="form-group md:w-1/3">
                        <Label>Le nom complet de mère</Label>
                        <input name="first_name" v-model="motherName" class="form-control" :class="{ 'is-invalid': veeErrors.motherName }" type="text" placeholder="Nom et Prénom de mère">
                        <span class="text-danger-500">{{ veeErrors.motherName }}</span>
                    </div>
                    <div class="form-group md:w-1/3">
                        <Label>No de téléphone de mère</Label>
                        <input name="first_name" v-model="motherPhone" class="form-control" :class="{ 'is-invalid': veeErrors.motherPhone }" type="text" placeholder="No de téléphone de mère">
                        <span class="text-danger-500">{{ veeErrors.motherPhone }}</span>
                    </div>
                </div>
                <div class="flex gap-x-7 flex-col md:flex-row">
                    <div class="form-group md:w-1/3">
                        <Label>Adresse</Label>
                        <textarea v-model="address" class="form-control h-auto" rows="2"></textarea>
                        <span class="text-danger-500">{{ veeErrors.address }}</span>
                    </div>
                </div>
            </div>
            <div>
                <h4 class="my-4">informations Academeics</h4>
                <div class="flex gap-x-7 flex-col md:flex-row">
                    <div class="form-group md:w-1/4">
                        <Label>N° d'enregistrement</Label>
                        <input disabled="disabled" class="form-control" type="text" placeholder="N° d'enregistrement">
                    </div>
                    <div class="form-group md:w-1/4">
                        <Label>Niveau</Label>
                        <select name="level" v-model="level" class="form-control">
                            <option value="1">
                                1<sup>er</sup> année
                            </option>
                            <option value="2">
                                2<sup>éme</sup> année
                            </option>
                            <option value="3">
                                3<sup>éme</sup> année
                            </option>
                            <option value="4">
                                4<sup>éme</sup> année
                            </option>
                        </select>
                    </div>
                    <div class="form-group md:w-1/4">
                        <Label>Classe</Label>
                        <select name="classR" :disabled="level == null" v-model="classR" class="form-control">
                            <option v-for="classe in levelClasses" :value="classe" :key="classe.id">
                                {{classe.name}}
                            </option>
                        </select>
                    </div>
                    <div class="form-group md:w-1/4">
                        <Label>Groupe</Label>
                        <select name="group" v-model="group" :disabled="classR == null" class="form-control">
                            <option v-for="g in classGroups" :value="g" :key="'g'+g">
                                {{'Groupe '+g}}
                            </option>
                        </select>
                    </div>
                </div>
            </div>
            <div>
                <h4 class="my-4">informations d'identification</h4>
                <div class="flex gap-x-7 flex-col md:flex-row">
                    <div class="form-group md:w-1/2">
                        <Label>Nom d'utilisateur</Label>
                        <input name="username" v-model="username" class="form-control" :class="{ 'is-invalid': veeErrors.username }" type="text" placeholder="Nom d'utilisateur">
                        <span class="text-danger-500">{{ veeErrors.username }}</span>
                    </div>
                    <div class="form-group md:w-1/2">
                        <Label>Mot de pass</Label>
                        <input name="password" v-model="password" class="form-control" :class="{ 'is-invalid': veeErrors.password }" type="text" placeholder="Mot de pass">
                        <span class="text-danger-500">{{ veeErrors.password }}</span>
                    </div>
                </div>
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
import Label from "@/Jetstream/Label";
import { Inertia } from '@inertiajs/inertia';
import RadioButton from 'primevue/radiobutton';
import Calendar from 'primevue/calendar';

import { useForm, useField,Form, ErrorMessage } from 'vee-validate';
import * as yup from "yup";
export default {
    components:{ Label, RadioButton, Form, ErrorMessage, Calendar},
    layout: DashLayout,
    name: "Add",
    setup() {
        const schema = yup.object({
            lastName: yup.string().required(),
            firstName: yup.string().required(),
            gender: yup.string().required().oneOf(['m', 'f']),
            dob: yup.date().required(),
            commune: yup.string().required(),
            willaya: yup.string().required(),
            paye: yup.string().required(),
            email: yup.string().email(),
            fatherFirstName: yup.string().required(),
            fatherPhone: yup.number().required().positive().integer(),
            motherName: yup.string().required(),
            motherPhone: yup.number().required().positive().integer(),
            address: yup.string().required(),
            level: yup.number().required().oneOf([1, 2, 3, 4]),
            classR: yup.mixed().required(),
            group: yup.number().required().positive().integer(),
            username: yup.string().required(),
            password: yup.string().required().min(6),
        });
        const { errors,handleSubmit,isSubmitting } = useForm({
            validationSchema: schema,
        });
        const veeErrors = errors;
        const onSubmit = handleSubmit(values => {
            return Inertia.post(route('student.store'), values);
        });
        const { value: lastName } = useField('lastName');
        const { value: firstName } = useField('firstName');
        const { value: gender } = useField('gender');
        const { value: level } = useField('level');
        const { value: group } = useField('group');
        const { value: classR } = useField('classR');
        const { value: dob } = useField('dob');
        const { value: commune } = useField('commune');
        const { value: willaya } = useField('willaya');
        const { value: paye } = useField('paye');
        const { value: email } = useField('email');
        const { value: note } = useField('note');
        const { value: fatherFirstName } = useField('fatherFirstName');
        const { value: fatherPhone } = useField('fatherPhone');
        const { value: motherName } = useField('motherName');
        const { value: motherPhone } = useField('motherPhone');
        const { value: address } = useField('address');
        const { value: username } = useField('username');
        const { value: password } = useField('password');
        const { value: photo } = useField('photo');
        return {veeErrors, lastName, onSubmit,isSubmitting,firstName,level,group,classR,gender,dob,commune,willaya,
            paye,email,note,fatherFirstName,fatherPhone,motherName,motherPhone,address,username,password,photo
        };
    },
    computed:{
        levelClasses: function(){
            return this.classes.filter(classe => classe.level === this.level );
        },
        classGroups: function(){
            return this.classR?.groups;
        },
    },
    methods:{
        dobRange: function(){
            let date = new Date();
            let maxY = date.getFullYear();
            let minY = maxY - 20;
            return minY + ':' + maxY;
        },
        onFileSelect(event) {
            this.photo = event.target.files[0];
        }
    },
    props: {
        errors: Object,
        classes: Array,
    },
}
</script>

<style scoped>

</style>
