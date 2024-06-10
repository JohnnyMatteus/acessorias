import { createApp } from 'vue';
import { createPinia } from 'pinia';
import App from './App.vue';
import router  from './router';
import vuetify from './plugins/vuetify';
import './scss/style.scss';
import PerfectScrollbar from 'vue3-perfect-scrollbar';
import VueTablerIcons from 'vue-tabler-icons';
import Maska from 'maska';
import Toast from 'vue-toastification';
import 'vue-toastification/dist/index.css';
import { VueQueryPlugin } from '@tanstack/vue-query';
import queryClient from './api/queryClient';

const app = createApp(App);

app.use(VueQueryPlugin, {
    queryClient,
});

app.use(router);
app.use(PerfectScrollbar);
app.use(createPinia());
app.use(VueTablerIcons);
app.use(Maska);
app.use(Toast);
app.use(VueQueryPlugin);
app.use(vuetify).mount('#app');