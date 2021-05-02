<template>
<p>hello</p>
    <div class="content-header mb-5">
        <h2>New Academic Year</h2>
    </div>
    <div class="card p-6">
        <Form @submit.prevent="onSubmit">
            <div class="form-group">
                <Label>Titre</Label>
                <input name="title" v-model="title" class="form-control" :class="{ 'is-invalid': errors.title }" type="text" placeholder="Titre" required>
                <span class="text-danger-500">{{ errors.title }}</span>
            </div>
            <div class="form-group">
                <Label>Start Date</Label>
                <Calendar name="sDate" v-model="sDate" class="w-full" :inputClass="'form-control'" />
            </div>
            <div class="form-group">
                <Label>End Date</Label>
                <input name="eDate" v-model="eDate" class="form-control" type="text" placeholder="Titre">
            </div>
            <div>
                <button type="submit" class="py-3 px-6 rounded-md text-white font-semibold bg-primary-500 border border-primary-500 mr-4 hover:bg-primary-500 hover:bg-opacity-40">Save</button>
                <button type="reset" class="py-3 px-6 rounded-md text-secondary-500 font-semibold border border-secondary-500 hover:bg-secondary-500 hover:bg-opacity-40 active:bg-secondary-500 active:bg-opacity-20">Cancel</button>
            </div>
        </Form>
    </div>
</template>

<script>
import DashLayout from '@/Layouts/DashLayout';
import Label from "@/Jetstream/Label";
import Button from "@/Jetstream/Button";
import Calendar from 'primevue/calendar';
import { useForm, useField,Form } from 'vee-validate';
import * as yup from "yup";

export default {
    components:{Button, Label, Calendar, Form},
    // Using the shorthand
    layout: DashLayout,
    setup() {
        const schema = yup.object({
            title: yup.string().required().min(3),
            eDate: yup.string().required().min(8),
        });
        const { errors } = useForm({
            validationSchema: schema,
        });
        return {errors};
    },
}
</script>

<style scoped>

</style>
