require('./bootstrap');

// Import modules...
import {createApp, h} from 'vue';
import {App as InertiaApp, plugin as InertiaPlugin} from '@inertiajs/inertia-vue3';
import {InertiaProgress} from '@inertiajs/progress';
import PrimeVue from 'primevue/config';
import ToastService from 'primevue/toastservice';

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
        }
    })
    .use(InertiaPlugin)
    .use(PrimeVue)
    .use(ToastService)
    .mount(el);

InertiaProgress.init({color: '#4B5563'});
