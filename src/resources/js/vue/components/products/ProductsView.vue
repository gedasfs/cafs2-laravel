<script setup>
    import axios from 'axios';
    import { onBeforeMount, reactive, ref } from 'vue';
    import { useRoute } from 'vue-router';

    const route = useRoute();

    const productApiUrl = `/api/v1/products/${route.params.product}`;

    const product = ref(null);
    const styles = reactive({
        fontSize: 1,
        isBold: false,
        isItalic: false,
        color: '#000000',
    });

    const loadProduct = async () => {
        let productResponse = await axios.get(productApiUrl);

        product.value = productResponse.data.data;
    };

    onBeforeMount(() => {
        loadProduct();
    });
</script>

<template>
    <div class="d-flex gap-3 ms-auto align-items-center">
        <p class="p-0 m-0">Description styles:</p>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="switchBold" :checked="styles.isBold" v-model="styles.isBold">
            <label class="form-check-label" for="switchBold"><strong>Bold</strong></label>
        </div>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" role="switch" id="switchItalic" :checked="styles.isItalic" v-model="styles.isItalic">
            <label class="form-check-label" for="switchItalic"><i>Italic</i></label>
        </div>
        <div class="d-flex">
            <button class="btn btn-sm btn-outline-dark me-2" @click="styles.fontSize += 0.25">A+</button>
            <button class="btn btn-sm btn-outline-dark" @click="styles.fontSize < 0.75 ? styles.fontSize = 0.5 : styles.fontSize -= 0.25">A-</button>
            <input class="form-control form-control-sm ms-2 border-dark p-1" type="color" id="switchColor" :value="styles.color" @input="event => styles.color = event.target.value">
        </div>
    </div>
    <div v-if="product" class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                <svg class="bd-placeholder-img img-fluid rounded-start" width="100%" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Image" preserveAspectRatio="xMidYMid slice" focusable="false">
                    <title>Placeholder</title>
                    <rect width="100%" height="100%" fill="#868e96"></rect>
                    <text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image</text>
                </svg>
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{ product.name }}</h5>
                    <p
                        class="card-text"
                        :class="{'fw-bold': styles.isBold, 'fst-italic': styles.isItalic}"
                        :style="{ fontSize: styles.fontSize + 'rem', color: styles.color }"
                    >
                        {{ product.description }}
                    </p>
                    <p class="card-text"><small>€ {{ product.price }}</small></p>
                    <RouterLink :to="{name: 'products.edit', params: {product: product.id} }" class="btn btn-primary">Edit</RouterLink>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
    #switchColor{
        width: 30px;
    }
</style>
