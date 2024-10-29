<script setup>
    defineProps(['modelValue']);
    const emit = defineEmits(['update:modelValue']);
</script>

<template>
    <div
        class="fixed top-0 left-0 w-full h-full z-50 flex justify-center items-center bg-black bg-opacity-50"
        v-if="modelValue"
    >
        <div class="loader"></div>
    </div>
</template>