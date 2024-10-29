<script setup>
    import { Money } from 'v-money3';

    const value = defineModel();

    defineProps({
        type: {
            type: String,
            default: 'text'
        },
        class: String,
        label: String,
    });
</script>

<template>
    <input v-if="type === 'text'"
        type="text"
        :placeholder="label"
        :class="class"
        v-model="value"
    >
    <Money v-if="type === 'money'"
        v-model="value"
        v-bind="{
            decimal: ',',
            thousands: '.',
            prefix: 'R$ ',
            precision: 2,
            masked: false,
            focusOnRight: true
        }"
        :class="class"
    />
</template>