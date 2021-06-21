<template>
    <div class="content-header mb-5">
        <h2>nouvelle année académique</h2>
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
            <div class="form-group">
                <Label>Titre</Label>
                <input name="title" v-model="title" class="form-control" :class="{ 'is-invalid': veeErrors.title }" type="text" placeholder="Titre">
                <span class="text-danger-500">{{ veeErrors.title }}</span>
            </div>
            <div class="form-group">
                <Label>Date de début</Label>
                <Calendar :monthNavigator="true" :yearNavigator="true" yearRange="2015:2040" name="sdate" v-model="sdate" class="w-full" :inputClass="['form-control',{ 'is-invalid': veeErrors.sdate }]" />
                <span class="text-danger-500">{{ veeErrors.sdate }}</span>
            </div>
            <div class="form-group">
                <Label>Date de fin</Label>
                <Calendar :minDate="sdate" :maxDate="maxEndDate" :monthNavigator="true" :yearNavigator="true" :yearRange="maxEndYear" name="edate" v-model="edate" class="w-full" :inputClass="['form-control',{ 'is-invalid': veeErrors.edate }]" />
                <span class="text-danger-500">{{ veeErrors.edate }}</span>
            </div>
            <div>
                <button type="submit" :disabled="isSubmitting" class="py-3 px-6 rounded-md text-white font-semibold bg-primary-500 border border-primary-500 mr-4 focus:bg-primary-600 focus:outline-none active:bg-primary-600">Save</button>
                <button @click="resetForm()" class="py-3 px-6 rounded-md text-secondary-500 font-semibold border border-secondary-500 hover:bg-secondary-500 hover:bg-opacity-5 active:bg-secondary-500 active:bg-opacity-20 focus:outline-none focus:bg-secondary-500 focus:bg-opacity-20">Cancel</button>
            </div>
        </form>
    </div>
</template>

<script>
import DashLayout from '@/Layouts/DashLayout';
import Label from "@/Jetstream/Label";
import Button from "@/Jetstream/Button";
import Calendar from 'primevue/calendar';
import { Inertia } from '@inertiajs/inertia'
import { useForm, useField,Form, ErrorMessage } from 'vee-validate';
import * as yup from "yup";
import {computed} from "vue";

export default {
    components:{Button, Label, Calendar, Form,ErrorMessage},
    // Using the shorthand
    layout: DashLayout,
    setup() {
        const schema = yup.object({
            title: yup.string().required().min(3).label('Titre'),
            sdate: yup.date().required().label('Date de début'),
            edate: yup.date().required().label('Date de fin'),
        });
        const { errors,handleSubmit,isSubmitting,resetForm  } = useForm({
            validationSchema: schema,
        });
        const veeErrors = errors;
        const onSubmit = handleSubmit(values => {
            Inertia.post(route('academicYear.create'), values)
        });
        const { value: title } = useField('title')
        const { value: sdate } = useField('sdate')
        const { value: edate } = useField('edate')
        const maxEndDate = computed(()=>{
            let max = (sdate.value) ? new Date(sdate.value.getFullYear() + 1, sdate.value.getMonth(), sdate.value.getDay()) : null;
            return max;
        });
        const maxEndYear = computed(()=>{
            let maxY = (sdate.value) ? `${sdate.value.getFullYear() + 1}:${sdate.value.getFullYear() + 1}`: "2015:2040";
            return maxY;
        });
        return {resetForm ,veeErrors, title, onSubmit, edate, sdate,isSubmitting,maxEndDate,maxEndYear};
    },
    data() {
        return {
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
