import './bootstrap';
import '../css/app.css';

import {createApp, h, VueElement} from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
//import App from "@inertiajs/vue3/types/app.js";
import moment from 'moment';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';
//const appVue = createApp()

//criando filtro para formatar data e hora usando momentjs
moment.locale('pt-br');

//appVue.config.globalProperties.$filters = {
//    formatDate(value){
//        if(value){
//            return moment(value).format('LLL')
//        }
//    }
//}

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const appVue = createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            //.mount(el);

        appVue.config.globalProperties.$filters = {
            formatDate(value){
                if(value){
                    return moment(value).format('LLL')
                }
            }
        }

        appVue.mount(el)
        //return appVue.mount(el)
    },
    progress: {
        color: '#4B5563',
    },
});
