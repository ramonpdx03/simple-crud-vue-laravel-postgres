<script setup>
    import { Head } from '@inertiajs/vue3';

    defineProps({
        title: String
    });
</script>

<template>
    <Head :title="title" />
    <slot />
</template>