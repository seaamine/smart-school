<template>
    <div class="content-header mb-5">
        <h2>Mettre à jour l'enseignant</h2>
    </div>
    <div v-if="Object.keys(errors).length" class="card card-danger p-6 mb-4 text-white">
        <ul class="list-disc">
            <li v-for="error in errors">
                {{error}}
            </li>
        </ul>
    </div>
    <div class="card p-6">
        <form class="divide-y" @submit.prevent="onSubmit" enctype="multipart/form-data">
            <div>
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
                        <select name="gender" v-model="gender" class="form-control" :class="{ 'is-invalid': veeErrors.gender }">
                            <option value="m">Male</option>
                            <option value="f">Female</option>
                        </select>
                        <span class="text-danger-500">{{ veeErrors.gender }}</span>
                    </div>
                </div>
                <div class="flex gap-x-7 flex-col md:flex-row">
                    <div id="p12345" class="form-group w-full p12345">
                        <Label>Date de naissaince</Label>
                        <Calendar dateFormat="dd/mm/yy" :monthNavigator="true" :yearNavigator="true" :yearRange="dobRange()" name="sdate" v-model="dob" class="w-full" :inputClass="['form-control',{ 'is-invalid': errors.dob }]" placeholder="Date de naissaince"/>
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
                        <Label>Date de join</Label>
                        <Calendar :monthNavigator="true" :yearNavigator="true" :yearRange="dobRange()" name="join" v-model="join" class="w-full" :inputClass="['form-control',{ 'is-invalid': errors.join }]" placeholder="Date de join"/>
                        <span class="text-danger-500">{{ veeErrors.join }}</span>
                    </div>
                    <div class="form-group md:w-1/3">
                        <Label>Qualification</Label>
                        <select name="qualification" v-model="qualification" class="form-control" :class="{ 'is-invalid': veeErrors.qualification }">
                            <option value="B">Bac</option>
                            <option value="L">licence</option>
                            <option value="M">Master</option>
                        </select>
                        <span class="text-danger-500">{{ veeErrors.qualification }}</span>
                    </div>
                    <div class="form-group md:w-1/3">
                        <Label>Matière</Label>
                        <select :class="{ 'is-invalid': veeErrors.subject }" name="subject" v-model="subject" class="form-control">
                            <option v-for="sub in subjects" :value="sub.id" :key="sub.id">
                                {{sub.name}}
                            </option>
                        </select>
                        <span class="text-danger-500">{{ veeErrors.subject }}</span>
                    </div>
                </div>
                <div class="form-group md:w-1/3">
                    <Label>Adresse</Label>
                    <textarea :class="{ 'is-invalid': veeErrors.address }" v-model="address" class="form-control h-auto" rows="2"></textarea>
                    <span class="text-danger-500">{{ veeErrors.address }}</span>
                </div>
            </div>
            <div class="flex py-4">
                <button type="submit" :disabled="isSubmitting" class="inline-flex items-center py-3 px-6 rounded-md text-white font-semibold bg-primary-500 border border-primary-500 mr-4 focus:bg-primary-600 focus:outline-none active:bg-primary-600">
                    <svg v-show="isSubmitting" class="animate-spin h-5 w-5 mr-3 text-white" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Sauvegarder
                </button>
                <inertia-link :href="route('teacher.index')" method="get" as="button" class="py-3 px-6 rounded-md text-secondary-500 font-semibold border border-secondary-500 hover:bg-secondary-500 hover:bg-opacity-5 active:bg-secondary-500 active:bg-opacity-20 focus:outline-none focus:bg-secondary-500 focus:bg-opacity-20" type="button">Annuler</inertia-link>
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

        name: "Edit",
        layout: DashLayout,
        props: {
            errors: Object,
            subjects: Array,
            teacher: Object,
        },
        setup(props) {
            // Initial values
            const formValues = {
                lastName: props.teacher.last_name,
                firstName: props.teacher.first_name,
                gender: props.teacher.gender,
                dob: new Date(props.teacher.dob),
                join: new Date(props.teacher.joining_date),
                commune: props.teacher.commune,
                willaya: props.teacher.willaya,
                paye: props.teacher.paye,
                email: props.teacher.email,
                address: props.teacher.address,
                subject: props.teacher.subject_id,
                qualification: props.teacher.qualification,

        };
            const schema = yup.object({
                lastName: yup.string().required(),
                firstName: yup.string().required(),
                gender: yup.string().required().oneOf(['m', 'f']),
                dob: yup.date().required(),
                join: yup.date().required(),
                commune: yup.string().required(),
                willaya: yup.string().required(),
                paye: yup.string().required(),
                email: yup.string().required().email(),
                address: yup.string().required(),
                subject: yup.string().required(),
                qualification: yup.string().required().oneOf(['B', 'L', 'M']),
            });
            const { errors,handleSubmit,isSubmitting } = useForm({
                validationSchema: schema,initialValues: formValues,
            });
            const veeErrors = errors;
            const onSubmit = handleSubmit(values => {
                return Inertia.post(route('teacher.patch',{'id': props.teacher.id}), values);
            });
            const { value: lastName } = useField('lastName');
            const { value: firstName } = useField('firstName');
            const { value: gender } = useField('gender');
            const { value: dob } = useField('dob');
            const { value: commune } = useField('commune');
            const { value: willaya } = useField('willaya');
            const { value: paye } = useField('paye');
            const { value: email } = useField('email');
            const { value: address } = useField('address');
            const { value: username } = useField('username');
            const { value: password } = useField('password');
            const { value: photo } = useField('photo');
            const { value: subject } = useField('subject');
            const { value: qualification } = useField('qualification');
            const { value: join } = useField('join');

            return {veeErrors, lastName, onSubmit,isSubmitting,firstName,gender,dob,commune,willaya,
                paye,email,address,username,password,photo,subject,qualification,join
            };
        },
        data(){
            return{
            }
        },
        methods:{
            dobRange: function(){
                let date = new Date();
                let maxY = date.getFullYear();
                let minY = maxY - 60;
                return minY + ':' + maxY;
            },
            onFileSelect(event) {
                this.photo = event.target.files[0];
            }
        },
}
</script>

<style scoped>

</style>
