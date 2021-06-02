<template>
    <div class="h-screen flex-wrap  flex justify-center content-center">
        <div class="card p-6">
            <h2 class="text-primary-500 mb-10 text-center font-semibold">Smart School</h2>
            <h4 class="mb-4">bienvenue à smart school un projet de licence</h4>
            <p class="mb-6">Connectez-vous à votre compte s'il vous plaît</p>
            <form>
                <div class="form-group">
                    <Label>Nom d'Utilisateur</Label>
                    <input name="username" v-model="userName" class="form-control" :class="{ 'is-invalid': veeErrors?.userName }" type="text" placeholder="Nom d'Utilisateur">
                    <span class="text-danger-500">{{ veeErrors?.userName }}</span>
                </div>
                <div class="form-group">
                    <Label>mot de pass</Label>
                    <input name="password" v-model="password" class="form-control" :class="{ 'is-invalid': veeErrors?.password }" type="password" placeholder="mot de pass">
                    <span class="text-danger-500">{{ veeErrors?.password }}</span>
                </div>
                <div class="form-group">
                    <Checkbox name="remember_me" value="3" v-model="rememberMe" />
                    <Label class="inline ml-3.5">Souviens-toi de moi</Label>
                </div>
                <button type="submit" class="w-full	py-3 px-6 rounded-md text-white font-semibold bg-primary-500 border border-primary-500 mr-4 focus:bg-primary-600 focus:outline-none active:bg-primary-600" disabled="disabled">Se connecter  </button>
            </form>
        </div>
    </div>

</template>

<script>
    import Checkbox from 'primevue/checkbox';
    import Label from "@/Jetstream/Label";
    export default {
        components:{ Label, Checkbox},
        name: "Login",
        data() {
            return {
                userName: '',
                password: '',
                veeErrors: null,
                rememberMe: false,
            }
        },
    }
</script>

<style scoped>

</style>
