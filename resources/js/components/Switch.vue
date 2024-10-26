<script setup>
    defineProps({
        id: {
            type: String,
            required: true
        },
        defaultChecked: {
            type: Boolean,
            default: false
        }
    });
</script>

<template>
    <div class="absolute flex justify-center w-full">
        <label :for="`switch-${id}`" class="switch">
            <input type="checkbox" :id="`switch-${id}`" class="hidden" :checked="defaultChecked" />
        </label>
    </div>
</template>