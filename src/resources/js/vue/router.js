import { createRouter, createWebHistory } from 'vue-router';

import ProductsIndex from './components/products/ProductsIndex.vue';
// import ProductsView from './components/products/ProductsView.vue';
// import ProductsCreate from './components/products/ProductsCreate.vue';
// import ProductsEdit from './components/products/ProductsEdit.vue';

const router = createRouter({
    history: createWebHistory('/vue'),

    routes: [
        {
            path: '/',
            component: ProductsIndex,
            name: 'products.index'
        },
        // {
        //     path: '/products/:product',
        //     component: ProductsView,
        //     name: 'products.view'
        // },
        // {
        //     path: '/products/:product/create',
        //     component: ProductsCreate,
        //     name: 'products.create'
        // },
        // {
        //     path: '/products/:product/edit',
        //     component: ProductsEdit,
        //     name: 'products.edit'
        // }
    ]
});

export default router;
