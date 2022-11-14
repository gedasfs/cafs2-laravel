<script setup>
import { onBeforeMount, onMounted, reactive } from 'vue';

const orderBy = {
    'date-desc': 'Newest first',
    'date-asc': 'Oldest first',
    'name-desc': 'Name Desc',
    'name-asc': 'Name Asc',
    'price-desc': 'Price Desc',
    'price-asc': 'Price Asc',
};

const props = defineProps({
    categories: {
        type: Array,
    },
});

const emit = defineEmits(['onFiltersChange']);

const defaultFormFields = {
    categorySelect: 0,
    priceFromInput: '',
    priceToInput: '',
    orderBySelect: Object.keys(orderBy)[0],
}

const selectedFilters = reactive({
    category: null,
    priceFrom: null,
    priceTo: null,
    orderBy: null,
});

const initDefaultFilters = () => {
    selectedFilters.category = defaultFormFields.categorySelect;
    selectedFilters.priceFrom = defaultFormFields.priceFromInput;
    selectedFilters.priceTo = defaultFormFields.priceToInput;
    selectedFilters.orderBy = defaultFormFields.orderBySelect;
};

const onFiltersSubmit = () => {
    emit('onFiltersChange', selectedFilters);
};

const onFiltersClear = () => {
    initDefaultFilters();
    onFiltersSubmit();
};

onBeforeMount(() => {
    initDefaultFilters();
    onFiltersSubmit();
});

</script>

<template>
    <div>
        <div class="mb-3">
            <select class="form-select" aria-label="category_id" name="category_id" v-model="selectedFilters.category">
                <option value="0" selected>Select Category</option>
                <option v-for="category in categories" :value="category.id" :key="category.id">{{ category.name }}</option>
            </select>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text">Filter by price</span>
            <input type="text" name="price_from" placeholder="from" aria-label="from" class="form-control" v-model="selectedFilters.priceFrom">
            <input type="text" name="price_to" placeholder="to" aria-label="to" class="form-control" v-model="selectedFilters.priceTo">
        </div>
        <div class="mb-3">
            <span class="">Order By</span>
            <select class="form-select" name="order_by" aria-label="Default select example" v-model="selectedFilters.orderBy">
                    <option v-for="(ordering, key) in orderBy" :value="key">{{ ordering }}</option>
            </select>
        </div>
        <button type="button" class="btn btn-primary me-2" @click="onFiltersSubmit">Submit</button>
        <button type="button" class="btn btn-success me-2" @click="onFiltersClear">Clear</button>
    </div>
</template>
