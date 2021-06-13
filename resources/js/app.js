require('./bootstrap');

// Import modules...
import {createApp, h} from 'vue';
import {App as InertiaApp, plugin as InertiaPlugin} from '@inertiajs/inertia-vue3';
import {InertiaProgress} from '@inertiajs/progress';
import PrimeVue from 'primevue/config';
import ToastService from 'primevue/toastservice';
import Vue2Editor from "vue2-editor";

//import Quasar from 'quasar/dist/quasar.umd.prod.js';
const el = document.getElementById('app');

createApp({
    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: (name) => require(`./Pages/${name}`).default,
        }),
})
    .mixin({
        methods: {
            route,
            formatDate(value) {
                return new Date(value).toLocaleDateString('tzm-Latn-DZ', {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric',
                });
            },
            handleFetchError(error, customMessages = {}){
                const errorResponse = {
                    isValidationError: false,
                    message: 'Network Error.',
                    type: 'error',
                    errors: [],
                    timeout: 2500,
                }
                const ErrorMessages = {
                    400: 'Il y a eu un problème lors du traitement de votre demande', // not being used currently
                    401: 'Non autorisé, vous n\'êtes pas autorisé',
                    403: 'Désolé, vous n\'êtes pas autorisé pour cette action',
                    404: 'La route API est manquante ou indéfinie',
                    405: 'Méthode de routage API non autorisée',
                    500: 'Erreur de serveur, veuillez réessayer plus tard',
                    request:
                        'Il y a un problème avec nos serveurs, veuillez réessayer plus tard',
                    other:
                        'Il y a eu un problème avec votre demande, veuillez réessayer plus tard',
                }
                if (Object.prototype.hasOwnProperty.call(customMessages, '400')) {
                    ErrorMessages['400'] = customMessages['400']
                }
                if (Object.prototype.hasOwnProperty.call(customMessages, '401')) {
                    ErrorMessages['401'] = customMessages['401']
                }
                if (Object.prototype.hasOwnProperty.call(customMessages, '403')) {
                    ErrorMessages['403'] = customMessages['403']
                }
                if (Object.prototype.hasOwnProperty.call(customMessages, '404')) {
                    ErrorMessages['404'] = customMessages['404']
                }
                if (Object.prototype.hasOwnProperty.call(customMessages, '405')) {
                    ErrorMessages['405'] = customMessages['405']
                }
                if (Object.prototype.hasOwnProperty.call(customMessages, '500')) {
                    ErrorMessages['500'] = customMessages['500']
                }
                if (Object.prototype.hasOwnProperty.call(customMessages, 'request')) {
                    ErrorMessages.request = customMessages.request
                }
                if (Object.prototype.hasOwnProperty.call(customMessages, 'other')) {
                    ErrorMessages.other = customMessages.other
                }
                if (error && error.response) {
                    // client received an error response (5xx, 4xx)
                    if (error.response.status === 400) {
                        // console.log('unauthorized, logging out ...');
                        errorResponse.message = error.response.data.message
                    } else if (error.response.status === 401) {
                        // console.log('unauthorized, logging out ...');
                        errorResponse.message = ErrorMessages['401']
                    } else if (error.response.status === 403) {
                        errorResponse.message = ErrorMessages['403']
                    } else if (error.response.status === 404) {
                        errorResponse.message = ErrorMessages['404']
                    } else if (error.response.status === 422) {
                        errorResponse.isValidationError = true
                        errorResponse.errors = error.response.data.errors
                        errorResponse.message = error.response.data.message
                    } else if (error.response.status === 405) {
                        errorResponse.message = ErrorMessages['405']
                    } else if (error.response.status >= 500) {
                        errorResponse.message = ErrorMessages['500']
                    } else if (error.response.status === 429) {
                    }
                } else if (error && error.request) {
                    errorResponse.message = ErrorMessages.request
                    // client never received a response, or request never left
                } else if (error instanceof Error) {
                    errorResponse.message = error.message
                } else if (typeof error === 'string') {
                    errorResponse.message = error
                } else {
                    //this.$buefy.toast.open({
                    //  message: 'Going Too Fast hun?, Please Slow Down',
                    // type: 'is-danger',
                    // })
                    // anything else
                    errorResponse.message = ErrorMessages.other
                }
                return errorResponse
            }
        }
    })
    .use(InertiaPlugin)
    .use(PrimeVue)
    .use(ToastService)
    .mount(el);

InertiaProgress.init({color: '#4B5563'});
