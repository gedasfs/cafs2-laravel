import './bootstrap';

import { createApp } from 'vue'
import { createPinia } from 'pinia';
import Router from './router';

import Shop from './ShopMain.vue';

const pinia = createPinia();
const app = createApp(Shop);

app.use(pinia);
app.use(Router);

app.mount('#shop');
