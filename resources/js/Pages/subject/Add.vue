<template>
    <p>hello</p>
    <div class="content-header mb-5">
        <h2>New Academic Year</h2>
    </div>
    <div class="card p-6">
        <form @submit.prevent="onSubmit">
            <div class="form-group">
                <Label>Nom de Matière</Label>
                <input name="name" v-model="name" class="form-control" :class="{ 'is-invalid': errors.name }" type="text" placeholder="Titre">
                <span class="text-danger-500">{{ errors.name }}</span>
            </div>
            <div class="">
                <h5>Niveau</h5>
                <div class="form-group">
                    <Checkbox name="level" value="1" v-model="levels" />
                    <Label class="inline ml-3.5">1<sup>er</sup> année</Label>
                </div>
                <div class="form-group">
                    <Checkbox name="level" value="2" v-model="levels" />
                    <Label class="inline ml-3.5">2<sup>eme</sup> année</Label>
                </div>
                <div class="form-group">
                    <Checkbox name="level" value="3" v-model="levels" />
                    <Label class="inline ml-3.5">3<sup>eme</sup> année</Label>
                </div>
                <div class="form-group">
                    <Checkbox name="level" value="4" v-model="levels" />
                    <Label class="inline ml-3.5">4<sup>eme</sup> année</Label>
                </div>
                <span class="text-danger-500">{{ errors.levels }}</span>
            </div>
            <div class="form-group">
                <Label>Type de Matière</Label>
                <Dropdown v-model="selectedType" :options="types" optionValue="value" optionLabel="name" placeholder="Sélectionnez un type" />
                <span class="text-danger-500">{{ errors.type }}</span>
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
import Checkbox from 'primevue/checkbox';
import Dropdown from 'primevue/dropdown';

import { useForm, useField,Form, ErrorMessage } from 'vee-validate';
import * as yup from "yup";
import {computed} from "vue";

export default {
    components:{ Label, Checkbox, Dropdown, Form,ErrorMessage},
    // Using the shorthand
    layout: DashLayout,
    setup() {
        const schema = yup.object({
            name: yup.string().required().min(3),
            levels: yup.array().min(1).max(2),
        });
        const { errors,handleSubmit,isSubmitting } = useForm({
            validationSchema: schema,
        });
        const onSubmit = handleSubmit(values => {
            Inertia.post(route('academicYear.create'), values);
        });
        const { value: name } = useField('name');
        const { value: levels } = useField('levels')

        return {errors, name, onSubmit,isSubmitting,levels};
    },
    data() {
        return {
            types: [
                {name: 'essentiel', value: '0'},
                {name: 'Cours au choix', value: '1'},
            ]
        }
    },
    methods: {

    },


}
</script>

<style scoped>

</style>
