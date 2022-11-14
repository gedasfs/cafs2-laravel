<script setup>
    import axios from 'axios';
    import { ref, onBeforeMount } from 'vue';
    import FilterProducts from './partials/FilterProducts.vue';

    const productsIndexApiUrl = '/api/v1/products';
    const categoriesIndexApiUrl = '/api/v1/categories';

    const products = ref([]);
    const categories = ref([]);

    const loadProducts = async (filters = {}) => {
        let productsIndexApiUrlWithFilters = productsIndexApiUrl;

        productsIndexApiUrlWithFilters += filters.category ?  `?category_id=${filters.category}&` : '?' ;
        productsIndexApiUrlWithFilters += filters.priceFrom ?  `price_from=${filters.priceFrom}&` : '' ;
        productsIndexApiUrlWithFilters += filters.priceTo ?  `price_to=${filters.priceTo}&` : '' ;
        productsIndexApiUrlWithFilters += filters.orderBy ? `order_by=${filters.orderBy}&` : '';

        let productsResponse = await axios.get(productsIndexApiUrlWithFilters);

        products.value = productsResponse.data.data;
    }

    const loadCategories = async () => {
        let categoriesResponse = await axios.get(categoriesIndexApiUrl);

        categories.value = categoriesResponse.data.data;
    }

    onBeforeMount(() => {
        loadProducts();
        loadCategories();
    });

</script>

<template>
    <FilterProducts :categories="categories" @onFiltersChange="loadProducts"/>
    <div class="d-flex mt-4">
        <h2>Products</h2>
        <RouterLink :to="{ name: 'products.create' }" class="btn btn-success ms-auto align-self-center">Create</RouterLink>
    </div>
    <div class="list-group mt-2" v-if="products?.length > 0">
        <div v-for="prod in products">
            <RouterLink :to="{name: 'products.view', params: {product: prod.id} }" class="list-group-item list-group-item-action" aria-current="true">
                <small># {{ prod.id }}</small>
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{ prod.name }}</h5>
                    <small>€ {{ prod.price }}</small>
                </div>
                <p class="mb-1">{{ prod.description }}</p>
            </RouterLink>
        </div>
    </div>
    <div class="mt-4 text-danger" v-else>No Products Found</div>
</template>
