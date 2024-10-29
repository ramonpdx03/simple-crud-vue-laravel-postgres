<script setup>
    import Loading from '@/components/Loading.vue';
    import { Head } from '@inertiajs/vue3';

    defineProps({
        title: String,
        isLoading: Boolean
    });

    const emit = defineEmits(['update:isLoading']);
</script>

<template>
    <Head :title="title" />
    <Loading
        :model-value="isLoading"
        @update:modelValue="newValue => emit('update:isLoading', newValue)"
    />
    <slot />
</template>