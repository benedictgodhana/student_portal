    // resources/js/app.js
    import './bootstrap';
    import '../css/app.css';

    import { createApp, h } from 'vue';
    import { createInertiaApp } from '@inertiajs/vue3';
    import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
    import { ZiggyVue } from '../../vendor/tightenco/ziggy';
    import vuetify from './plugins/vuetify'; // Import Vuetify
    import '@mdi/font/css/materialdesignicons.css'; // Import mdi icons
    import HighchartsVue from 'highcharts-vue';

    import VueApexCharts from 'vue3-apexcharts'; // Import Vue3-ApexCharts

    const appName = import.meta.env.VITE_APP_NAME || 'SUBF';

    createInertiaApp({
        title: (title) => `${title} - ${appName}`,
        resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
        setup({ el, App, props, plugin }) {
            const app = createApp({ render: () => h(App, props) })
                .use(plugin)
                .use(ZiggyVue)
                .use(HighchartsVue)
                .use(vuetify) // Use Vuetify
                .use(VueApexCharts); // Use Vue3-ApexCharts

            // Additional setup if needed

            return app.mount(el);
        },
        progress: {
            color: '#4B5563',
        },
    });
