<template>
    <div class="content-header mb-5">
        <h2>Nouveau Classe</h2>
    </div>
    <div v-if="Object.keys(errors).length" class="card card-danger p-6 mb-4 text-white">
        <ul class="list-disc">
            <li v-for="error in errors">
                {{error}}
            </li>
        </ul>
    </div>
    <div class="card p-6">

        <form @submit.prevent="onSubmit">
            <div class="" :class="{ 'is-invalid': veeErrors.level }">
                <h5>Niveau</h5>
                <div class="form-group">
                    <RadioButton name="level" value="1" v-model="level" />
                    <Label class="inline ml-3.5">1<sup>er</sup> année</Label>
                </div>
                <div class="form-group">
                    <RadioButton name="level" value="2" v-model="level" />
                    <Label class="inline ml-3.5">2<sup>eme</sup> année</Label>
                </div>
                <div class="form-group">
                    <RadioButton name="level" value="3" v-model="level" />
                    <Label class="inline ml-3.5">3<sup>eme</sup> année</Label>
                </div>
                <div class="form-group">
                    <RadioButton  name="level" value="4" v-model="level" />
                    <Label class="inline ml-3.5">4<sup>eme</sup> année</Label>
                </div>
                <span class="text-danger-500">{{ veeErrors.level }}</span>
            </div>
            <div class="form-group">
                <Label>Nom de Class</Label>
                <input name="name" v-model="name" class="form-control" :class="{ 'is-invalid': veeErrors.name }" type="text" placeholder="Titre">
                <span class="text-danger-500">{{ veeErrors.name }}</span>
            </div>
            <div class="form-group">
                <Label>Nombre des Groupes</Label>
                <input name="groups" v-model="groups" class="form-control" :class="{ 'is-invalid': veeErrors.groups }" type="text" placeholder="Titre" disabled="disabled">
                <span class="text-danger-500">{{ veeErrors.groups }}</span>
            </div>

            <div>
                <button type="submit" :disabled="isSubmitting" class="py-3 px-6 rounded-md text-white font-semibold bg-primary-500 border border-primary-500 mr-4 focus:bg-primary-600 focus:outline-none active:bg-primary-600">Save</button>
                <button type="reset" class="py-3 px-6 rounded-md text-secondary-500 font-semibold border border-secondary-500 hover:bg-secondary-500 hover:bg-opacity-5 active:bg-secondary-500 active:bg-opacity-20 focus:outline-none focus:bg-secondary-500 focus:bg-opacity-20">Cancel</button>
            </div>
        </form>
    </div>
</template>

<script>
import DashLayout from '@/Layouts/DashLayout';
import Label from "@/Jetstream/Label";
import { Inertia } from '@inertiajs/inertia'
import RadioButton from 'primevue/radiobutton';
import Dropdown from 'primevue/dropdown';

import { useForm, useField,Form, ErrorMessage } from 'vee-validate';
import * as yup from "yup";
import {watchEffect} from "vue";

export default {
    components:{ Label, RadioButton, Dropdown, Form,ErrorMessage},
    // Using the shorthand
    layout: DashLayout,
    setup() {
        const schema = yup.object({
            name: yup.string().required(),
            level: yup.number().required(),
            groups: yup.number().required(),
        });
        const { errors,handleSubmit,isSubmitting } = useForm({
            validationSchema: schema, initialValues: {'groups':2,'name':''}
        });
        const veeErrors = errors;
        const onSubmit = handleSubmit(values => {
            Inertia.post(route('class.store'), values);
        });
        const { value: name } = useField('name');
        const { value: level } = useField('level')
        const { value: groups } = useField('groups')
        watchEffect(() => {
            let lv = level.value ||'?'
            let startStr = lv + 'AM';
            if(!name.value.startsWith(startStr)){
                let value = name.value.startsWith('AM',1) ? name.value.substring(3,name.value.length) : name.value;
                name.value = startStr  + value;
            }
        });


        return {veeErrors, name, onSubmit,isSubmitting,level,groups};
    },
    data() {
        return {
            types: [
                {name: 'essentiel', value: '1'},
                {name: 'Cours au choix', value: '2'},
            ]
        }
    },
    methods: {

    },

        props: {
        errors: Object,
    },


}
</script>

<style scoped>



</style>
