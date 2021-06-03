<template>
    <div class="h-screen flex-wrap  flex justify-center content-center">
        <div class="card p-6">
            <div class="flexmb-10 flex-wrap mb-8 flex justify-center content-center">
                <img class="mr-5" style="width: 75px; height: 75px;" width="75" height="75" src="images/logo.png">
                <h2 style=" margin: auto 0px auto 0;" class="text-primary-500 align-middle font-semibold">Smart School</h2>
            </div>

            <h4 class="mb-4">bienvenue à smart school un projet de licence</h4>
            <p class="mb-6">Connectez-vous à votre compte s'il vous plaît</p>
            <jet-validation-errors class="mb-4" />

            <form @submit.prevent="submit">
                <div class="form-group">
                    <Label>Nom d'Utilisateur</Label>
                    <input name="username" v-model="form.username" class="form-control" :class="{ 'is-invalid': veeErrors?.userName }" type="text" placeholder="Nom d'Utilisateur">
                    <span class="text-danger-500">{{ veeErrors?.username }}</span>
                </div>
                <div class="form-group">
                    <Label>mot de pass</Label>
                    <input name="password" v-model="form.password" class="form-control" :class="{ 'is-invalid': veeErrors?.password }" type="password" placeholder="mot de pass">
                    <span class="text-danger-500">{{ veeErrors?.password }}</span>
                </div>
                <div class="form-group">
                    <Checkbox name="remember_me" value="3" v-model="form.remember" />
                    <Label class="inline ml-3.5">Souviens-toi de moi</Label>
                </div>
                <button type="submit" class="w-full	py-3 px-6 rounded-md text-white font-semibold bg-primary-500 border border-primary-500 mr-4 focus:bg-primary-600 focus:outline-none active:bg-primary-600" :class="{ 'opacity-25': form.processing }" :disabled="form.processing || btnDisabled">Se connecter</button>
            </form>
        </div>
    </div>

</template>

<script>
    import Checkbox from 'primevue/checkbox';
    import Label from "@/Jetstream/Label";
    import JetValidationErrors from '@/Jetstream/ValidationErrors'
    import { watchEffect,ref} from "vue";
    import { Inertia } from '@inertiajs/inertia';

    export default {
        components:{ Label, Checkbox, JetValidationErrors},
        name: "Login",
        setup() {
            const form = Inertia.form({
                username: '',
                password: '',
                remember: false
            });
            const btnDisabled = ref(true);
            watchEffect(()=>{
                if(form.username.trim().length > 0 && form.password.trim().length > 0){
                    btnDisabled.value = false;
                }else{
                    btnDisabled.value = true;
                }
            });
            return { form,btnDisabled};
        },
        data() {
            return {

            }
        },
        methods: {
            submit() {
                this.form
                    .transform(data => ({
                        ... data,
                        remember: this.form.remember ? 'on' : ''
                    }))
                    .post(this.route('login'), {
                        onFinish: () => this.form.reset('password'),
                    })
            }
        }
    }
</script>

<style scoped>

</style>
