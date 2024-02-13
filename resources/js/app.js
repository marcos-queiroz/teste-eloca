import './bootstrap';

import { createApp } from 'vue';
import BaseComponent from './components/BaseComponent.vue';

createApp({
    components: {
        BaseComponent
    }
}).mount('#app');
