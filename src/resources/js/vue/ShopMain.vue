<script setup>
    import Header from './partials/Header.vue';
    import Footer from './partials/Footer.vue';
</script>


<template>
    <div class="container d-flex flex-column min-vh-100">
        <Header class="mb-4" />
        <RouterView></RouterView>
        <Footer />
    </div>
</template>
