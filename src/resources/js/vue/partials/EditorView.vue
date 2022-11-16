<script setup>
    import { reactive } from 'vue';

    const styles = reactive({
        color: '#ff0000',
    });

    defineProps({
        modelValue: String
    });
    const emit = defineEmits(['update:modelValue']);

    const changeColor = function(event) {
        styles.color = event.target.value;
    };

    const applyBold = function () {
        document.execCommand('bold');
    };
    const applyItalic = function () {
        document.execCommand('italic');
    };
    const applyColor = function () {
        document.execCommand('foreColor', false, styles.color);
    };

    const onInput = function(event) {
        emit('update:modelValue', event.target.innerHTML);
    };

    // TO-DO: fix automatical cursor return to the start of the div whenever any input is inputed.

</script>

<template>
    <div class="border rounded p-2">
        <div class="d-flex mb-2">
            <button class="me-2 btn btn-sm btn-outline-dark fw-bold" @click="applyBold">B</button>
            <button class="me-2 btn btn-sm btn-outline-dark fst-italic" @click="applyItalic">I</button>
            <input role="button" class="form-control form-control-sm border-dark p-1" type="color" id="switchColor" :value="styles.color" @input="changeColor">
            <button class="px-2 btn btn-sm btn-outline-dark" :style="{color: styles.color}" @click="applyColor">A</button>

        </div>
        <div @input="onInput" v-html="modelValue" contenteditable="true" class="border rounded p-2"></div>
        <!-- <textarea class="form-control" v-html="innerValue" name="editable" id="editable" cols="30" rows="10"></textarea> -->
    </div>

</template>

<style>
    #switchColor {
        width: 30px !important;
    }
</style>
