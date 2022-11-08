<script setup>
    import axios from 'axios';
    import { ref, onBeforeMount } from 'vue';

    const productsIndexUrl = '/api/v1/products';
    const categoriesIndexUrl = '/api/v1/categories';

    const products = ref();
    const categories = ref();

    const categorySelect = ref();
    const orderBySelect = ref();
    const priceFrom = ref();
    const priceTo = ref();

    const orderBy = {
        'date-asc': 'Oldest first',
        'name-asc': 'Name Asc',
        'name-desc': 'Name Desc',
        'price-asc': 'Price Asc',
        'price-desc': 'Price Desc',
        'date-desc': 'Newest first',
    };


    async function getProducts() {
        let productsIndexUrlWithFilters = productsIndexUrl;

        productsIndexUrlWithFilters += categorySelect.value != 0  ?  `?category_id=${categorySelect.value}&` : '?' ;
        productsIndexUrlWithFilters += priceFrom.value      != '' ?  `price_from=${priceFrom.value}&`        : '' ;
        productsIndexUrlWithFilters += priceFrom.value      != '' ?  `price_to=${priceTo.value}&`            : '' ;
        productsIndexUrlWithFilters += `order_by=${orderBySelect.value}&`;

        let productsResponse = await axios.get(productsIndexUrlWithFilters);

        products.value = productsResponse.data.data;
    }

    async function getCategories() {
        let categoriesResponse = await axios.get(categoriesIndexUrl);
        categories.value = categoriesResponse.data.data;
    }

    function fetchData() {
        getCategories();
        getProducts();
    }

    function initFormFields() {
        categorySelect.value = 0;
        orderBySelect.value = 'date-desc';
        priceFrom.value = '';
        priceTo.value = '';
    }

    function submitForm(event) {
        getProducts();
    }

    function clearForm(event){
        initFormFields();
        fetchData();
    }

    onBeforeMount(() => {
        initFormFields();
        fetchData();
    });
</script>

<template>

    <form @submit.prevent="submitForm">
        <div class="mb-3">
            <select class="form-select" aria-label="category_id" name="category_id" v-model="categorySelect">
                <option value="0" selected>Select Category</option>
                <option v-for="category in categories" :value="category.id">{{ category.name }}</option>
            </select>
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text">Filter by price</span>
            <input type="text" name="price_from" placeholder="from" aria-label="from" class="form-control" v-model="priceFrom">
            <input type="text" name="price_to" placeholder="to" aria-label="to" class="form-control" v-model="priceTo">
        </div>

        <div class="mb-3">
            <span class="">Order By</span>
            <select class="form-select" name="order_by" aria-label="Default select example" v-model="orderBySelect">
                    <option v-for="(ordering, key) in orderBy" :value="key">{{ ordering }}</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary me-2">Submit</button>
        <button type="button" class="btn btn-success me-2" @click="clearForm">Clear</button>
    </form>

    <div class="list-group mt-4" v-if="products.length > 0">
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
