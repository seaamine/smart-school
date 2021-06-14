<template>
    <div class="content-header mb-5">
        <h2>Demande de certificat scolaire</h2>
    </div>
    <div v-if="Object.keys(errors).length" class="card card-danger p-6 mb-4 text-white">
        <ul class="list-disc">
            <li v-for="error in errors">
                {{error}}
            </li>
        </ul>
    </div>
    <div class="card p-6" >
        <p>Veuillez cliquer sur le bouton pour demander et télécharger votre certificat de scolarité.</p>
        <div class="flex justify-evenly mt-4">
            <a :disabled="isSubmitting" :href="route('school-certificate.download')" class=" mr-4 w-1/3 py-4 text-white rounded-md font-medium bg-primary-500 py-2 px-4 hover:bg-primary-800 hover:ring hover:ring-primary-200 inline-flex justify-center items-center">
                <svg v-show="isSubmitting" class="animate-spin h-6 w-6 mr-3 text-warning-500" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-100" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Télécharger
            </a>
        </div>
    </div>
</template>

<script>
import DashLayout from '@/Layouts/DashLayout';

export default {
    name: "Request",
    layout: DashLayout,
    props:{
        errors: Object,
    },
    data(){
        return {
            isSubmitting:false,
        };
    }
}
</script>

<style scoped>

</style>
