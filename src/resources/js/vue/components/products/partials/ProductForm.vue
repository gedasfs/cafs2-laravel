<script setup>

    const props = defineProps({
        product: {
            type: Object,
        },
        categories: {
            type: Array,
        },
    });

    if (!props.product.category_id) {
        props.product.category_id = 0;
    }

    const emit = defineEmits(['onFormSubmit']);

    const formSubmit = () => {
        emit('onFormSubmit', props.product);
    };

</script>

<template>
    <div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input name="name" type="text" class="form-control" id="name" v-model="product.name">
        </div>
        <div class="mb-3">
            <label for="code" class="form-label">Code</label>
            <input name="code" type="text" class="form-control" id="code" v-model="product.code">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input name="price" type="numeric" class="form-control" id="price" v-model="product.price">
        </div>
        <div class="mb-3">
            <label for="categoryId" class="form-label">Product category</label>
            <select class="form-select" aria-label="category_id" name="category_id" id="categoryId" v-model="product.category_id">
                <option value="0" disabled>Select Category</option>
                <option v-for="category in categories" :value="category.id" :key="category.id" :selected="category.id == product.category_id ? true : false">{{ category.name }}</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" id="description" rows="3" v-model="product.description"></textarea>
        </div>

        <div class="mb-3">
            <button type="button" class="btn btn-primary" @click="formSubmit">Submit</button>
        </div>
    </div>
</template>
