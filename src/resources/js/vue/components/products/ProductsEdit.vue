<script setup>
    import axios from 'axios';
    import { onBeforeMount, ref }  from 'vue';
    import { useRoute, useRouter } from 'vue-router';
    import ProductForm from './partials/ProductForm.vue';

    const route = useRoute();
    const router = useRouter();

    const productUpdateApiUrl = `/api/v1/products/${route.params.product}/update`;
    const productApiUrl = `/api/v1/products/${route.params.product}`;
    const categoriesIndexApiUrl = '/api/v1/categories';

    const product = ref(null);
    const categories = ref([]);

    const loadCategories = async () => {
        let categoriesResponse = await axios.get(categoriesIndexApiUrl);

        categories.value = categoriesResponse.data.data;
    };

    const loadProduct = async () => {
        let productResponse = await axios.get(productApiUrl);

        product.value = productResponse.data.data;
    };

    const updateProduct = async (product) => {
        let createResponse = await axios.post(productUpdateApiUrl, product);
        let response = createResponse.data.data;

        router.push({ name: 'products.view', params: {product: response.id} });
    };

    onBeforeMount(() => {
        loadCategories();
        loadProduct();
    });


</script>

<template>
    <ProductForm :product="product" :categories="categories" @onFormSubmit="updateProduct"/>

</template>
