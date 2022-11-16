<script setup>
    import { onBeforeMount } from 'vue';
    import { useCategoriesStore } from '@/stores/categories.js'
    import { useRoute, useRouter } from 'vue-router';
    import { useProductStore } from '@/stores/product.js'
    import EditorView from '@/partials/EditorView.vue';

    const categoriesStore = useCategoriesStore();
    const productStore = useProductStore();
    const route = useRoute();
    const router = useRouter();

    const formSubmit = () => {
        // emit('onFormSubmit', props.product);
        productStore.save().then(() => {
            router.push({name: 'products.view', params: {product: productStore.id}});
        });
    };

    onBeforeMount(async () => {
        if(route.params.product) {
            await productStore.find(route.params.product);
        } else {
            productStore.$reset();
        }

        await categoriesStore.load();
    });

</script>

<template>
    <div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input name="name" type="text" class="form-control" id="name" v-model="productStore.name">
        </div>
        <div class="mb-3">
            <label for="code" class="form-label">Code</label>
            <input name="code" type="text" class="form-control" id="code" v-model="productStore.code">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input name="price" type="numeric" class="form-control" id="price" v-model="productStore.price">
        </div>
        <div class="mb-3">
            <label for="categoryId" class="form-label">Product category</label>
            <select class="form-select" aria-label="category_id" name="category_id" id="categoryId" v-model="productStore.category_id">
                <option value="null" disabled>Select Category</option>
                <option v-for="category in categoriesStore.categories" :value="category.id" :key="category.id">{{ category.name }}</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <!-- <textarea name="description" class="form-control" id="description" rows="3" v-model="product.description"></textarea> -->
            <EditorView v-model="productStore.description"/>
        </div>

        <div class="mb-3">
            <button type="button" class="btn btn-primary" @click="formSubmit">Submit</button>
        </div>
    </div>


</template>
