import './bootstrap';

import { createApp } from 'vue'
import Router from './router';

import Shop from './ShopMain.vue';

const app = createApp(Shop);

app.use(Router);

app.mount('#shop');
