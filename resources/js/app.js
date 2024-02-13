import './bootstrap';

import { createApp } from 'vue';
import router from './router';

import 'bootstrap/dist/css/bootstrap.min.css';

import BaseTemplate from './components/template/BaseTemplate.vue';

const app = createApp({});

app.component('base-template', BaseTemplate);

app.use(router);

app.mount('#app');
