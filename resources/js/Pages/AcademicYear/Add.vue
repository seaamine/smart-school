<template>
<p>hello</p>
    <div class="content-header mb-5">
        <h2>New Academic Year</h2>
    </div>
    <div class="card p-6">
        <form @submit.prevent="onSubmit">
            <div class="form-group">
                <Label>Titre</Label>
                <input name="title" v-model="title" class="form-control" :class="{ 'is-invalid': errors.title }" type="text" placeholder="Titre">
                <span class="text-danger-500">{{ errors.title }}</span>
            </div>
            <div class="form-group">
                <Label>Start Date</Label>
                <Calendar :monthNavigator="true" :yearNavigator="true" yearRange="2015:2040" name="sdate" v-model="sdate" class="w-full" :inputClass="['form-control',{ 'is-invalid': errors.sdate }]" />
                <span class="text-danger-500">{{ errors.sdate }}</span>
            </div>
            <div class="form-group">
                <Label>End Date</Label>
                <Calendar :minDate="sdate" :maxDate="maxEndDate" :monthNavigator="true" :yearNavigator="true" :yearRange="maxEndYear" name="edate" v-model="edate" class="w-full" :inputClass="['form-control',{ 'is-invalid': errors.edate }]" />
                <span class="text-danger-500">{{ errors.edate }}</span>
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
            title: yup.string().required().min(3),
            sdate: yup.date(),
            edate: yup.string().required().min(8),
        });
        const { errors,handleSubmit,isSubmitting } = useForm({
            validationSchema: schema,
        });
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
        return {errors, title, onSubmit, edate, sdate,isSubmitting,maxEndDate,maxEndYear};
    },
    data() {
        return {
        }
    },
    methods: {

    },


}
</script>

<style scoped>

</style>
