import { createRouter, createWebHistory } from 'vue-router';

import ProductsIndex from './components/products/ProductsIndex.vue';
import ProductsView from './components/products/ProductsView.vue';
import ProductsForm from './components/products/ProductsForm.vue';

const router = createRouter({
    history: createWebHistory('/vue'),

    routes: [
        {
            path: '/',
            component: ProductsIndex,
            name: 'products.index'
        },
        {
            path: '/products/create',
            component: ProductsForm,
            name: 'products.create'
        },
        {
            path: '/products/:product',
            component: ProductsView,
            name: 'products.view'
        },
        {
            path: '/products/:product/edit',
            component: ProductsForm,
            name: 'products.edit'
        }
    ]
});

export default router;
