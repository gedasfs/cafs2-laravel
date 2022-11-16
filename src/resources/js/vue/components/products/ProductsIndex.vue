<script setup>
import { onBeforeMount } from 'vue';
import { useCategoriesStore } from '@/stores/categories.js'
import { useProductsStore } from '@/stores/products.js'
import FilterProducts from './partials/FilterProducts.vue';

const categoriesStore = useCategoriesStore();
const productsStore = useProductsStore();

const loadProducts = async (filters = {}) => {
    let queryString = '';

    queryString += filters.category ? `category_id=${filters.category}&` : '' ;
    queryString += filters.priceFrom ? `price_from=${filters.priceFrom}&` : '' ;
    queryString += filters.priceTo ? `price_to=${filters.priceTo}&` : '' ;
    queryString += filters.orderBy ? `order_by=${filters.orderBy}&` : '';

    await productsStore.load(queryString);
}

onBeforeMount(async () => {
    await loadProducts();
    await categoriesStore.load();
});

</script>

<template>
    <FilterProducts :categories="categoriesStore.categories" @onFiltersChange="loadProducts"/>
    <div class="d-flex mt-4">
        <h2>Products</h2>
        <RouterLink :to="{ name: 'products.create' }" class="btn btn-success ms-auto align-self-center">Create</RouterLink>
    </div>
    <div class="list-group mt-2" v-if="productsStore.products?.length > 0">
        <div v-for="prod in productsStore.products">
            <RouterLink :to="{name: 'products.view', params: {product: prod.id} }" class="list-group-item list-group-item-action" aria-current="true">
                <small># {{ prod.id }}</small>
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{ prod.name }}</h5>
                    <small>€ {{ prod.price }}</small>
                </div>
                <p class="mb-1" v-html="prod.description"></p>
            </RouterLink>
        </div>
    </div>
    <div class="mt-4 text-danger" v-else>No Products Found</div>
</template>
