<template>
    <div class="content-header mb-5">
        <h2>Identifiants de l'utilisateur</h2>
    </div>
    <div v-if="Object.keys(errors).length" class="card card-danger p-6 mb-4 text-white">
        <ul class="list-disc">
            <li v-for="error in errors">
                {{error}}
            </li>
        </ul>
    </div>
    <div class="card p-6">
        <form @submit.prevent="onSubmit" enctype="multipart/form-data">
            <div class="form-group">
                <Label>Nom</Label>
                <input name="name" v-model="name" class="form-control"  type="text" placeholder="Nom" disabled readonly>
            </div>
            <div class="form-group">
                <Label>Email</Label>
                <input name="email" v-model="email" class="form-control"  type="email" placeholder="Email" disabled readonly>
            </div>
            <div class="form-group">
                <Label>Nom d'utilisateur</Label>
                <input name="username" v-model="username" class="form-control"  type="email" placeholder="Nom d'utilisateur" disabled readonly>
            </div>
            <div class="form-group">
                <Label>Mot de Passe</Label>
                <input name="password" v-model="password" class="form-control" :class="{ 'is-invalid': veeErrors.password }" type="password" placeholder="mot de pass">
                <span class="text-danger-500">{{ veeErrors.password }}</span>
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
import { Inertia } from '@inertiajs/inertia';
import { useForm, useField,Form, ErrorMessage } from 'vee-validate';
import * as yup from "yup";
export default {
    name: "Credentials",
    components:{ Label, Form, ErrorMessage},

    layout: DashLayout,
    props: {
        errors: Object,
        userC: Object,
    },
    setup(props) {
        const formValues = {
            name: props.userC.name,
            email: props.userC.email,
            username: props.userC.username,
        };
        const schema = yup.object({
            password: yup.string().required().min(6),
        });
        const { errors,handleSubmit,isSubmitting } = useForm({
            validationSchema: schema,initialValues: formValues,
        });
        const veeErrors = errors;
        const onSubmit = handleSubmit(values => {
            return Inertia.post(route('user.update',{'id':props.userC.id}), {
                _method: 'patch',
            ...values
            });
        });
        const { value: name } = useField('name');
        const { value: email } = useField('email');
        const { value: username } = useField('username');
        const { value: password } = useField('password');
        return {veeErrors, onSubmit,isSubmitting,name,
            email,username,password
        };
    },
}
</script>

<style scoped>

</style>
