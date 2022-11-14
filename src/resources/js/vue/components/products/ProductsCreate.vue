<script setup>
    import axios from 'axios';
    import { onBeforeMount, ref }  from 'vue';
    import { useRouter } from 'vue-router';
    import ProductForm from './partials/ProductForm.vue';

    const router = useRouter();
    const categories = ref([]);

    const categoriesIndexApiUrl = '/api/v1/categories';
    const productStoreApiUrl = '/api/v1/products/store';

    const loadCategories = async () => {
        let categoriesResponse = await axios.get(categoriesIndexApiUrl);

        categories.value = categoriesResponse.data.data;
    };

    const createProduct = async (product) => {
        let createResponse = await axios.post(productStoreApiUrl, product);
        let response = createResponse.data.data;

        router.push({ name: 'products.view', params: {product: response.id} });
    };

    onBeforeMount(() => {
        loadCategories();
    });


</script>

<template>
    <ProductForm :product="{}" :categories="categories" @onFormSubmit="createProduct"/>
</template>

