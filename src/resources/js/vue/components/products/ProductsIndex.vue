<script setup>
import axios from 'axios';
import { ref, onBeforeMount } from 'vue';

import FilterProducts from './partials/FilterProducts.vue';

const productsIndexApiUrl = '/api/v1/products';
const categoriesIndexApiUrl = '/api/v1/categories';

const products = ref([]);
const categories = ref([]);

const getProducts = async (filters = {}) => {
    let productsIndexApiUrlWithFilters = productsIndexApiUrl;

    productsIndexApiUrlWithFilters += filters.category ?  `?category_id=${filters.category}&` : '?' ;
    productsIndexApiUrlWithFilters += filters.priceFrom ?  `price_from=${filters.priceFrom}&` : '' ;
    productsIndexApiUrlWithFilters += filters.priceTo ?  `price_to=${filters.priceTo}&` : '' ;
    productsIndexApiUrlWithFilters += filters.orderBy ? `order_by=${filters.orderBy}&` : '';

    let productsResponse = await axios.get(productsIndexApiUrlWithFilters);

    return productsResponse.data.data;
}

const getCategories = async () => {
    let categoriesResponse = await axios.get(categoriesIndexApiUrl);

    return categoriesResponse.data.data;
}

const loadProducts = async (filters = {}) => {
    products.value = await getProducts(filters);
};

const loadCategories = async () => {
    categories.value = await getCategories();
};

onBeforeMount(() => {
    loadProducts();
    loadCategories();
});

</script>

<template>
    <FilterProducts :categories="categories" @onFiltersChange="loadProducts"/>
    <div class="list-group mt-4" v-if="products?.length > 0">
        <a v-for="prod in products" href="#" class="list-group-item list-group-item-action" aria-current="true">
            <small># {{ prod.id }}</small>
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">{{ prod.name }}</h5>
                <small>€ {{ prod.price }}</small>
            </div>
            <p class="mb-1">{{ prod.description }}</p>
        </a>
    </div>
    <div class="mt-4 text-danger" v-else>No Products Found</div>
</template>
