<script setup>

    import { reactive, computed } from 'vue';

    const greetings = 'Hello World.';
    const state = reactive({
        count: 0,
    });

    function increment() {
        state.count++;
    }

    const user = reactive({
        firstName: 'John',
        lastName: 'Doe',
    });

    // const fullName = computed(() => user.firstName + ' ' + user.lastName);
    const fullName = computed({
        get() {
            return user.firstName + ' ' + user.lastName;
        },

        set(value) {
            let splitted = value.split(' ');

            user.firstName = splitted[0];
            user.lastName = splitted[1];
        }
    });

</script>

<template>
    <p>{{ greetings }}</p>
    <button @click="increment">Count: {{ state.count }}</button>
    <p>User: {{ fullName }}</p>

    <input type="text" placeholder="first name" @input="event => user.firstName = event.target.value">
    <input type="text" placeholder="last name" @input="event => user.lastName = event.target.value">
    <br /><br />
    <input type="text" placeholder="full name" @input="event => fullName = event.target.value">
</template>
