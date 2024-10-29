<script setup>
    import { ref } from 'vue';

    defineProps({
        id: {
            required: true
        },
        defaultChecked: {
            type: Boolean,
            default: false
        }
    });

    const checked = defineModel();
</script>

<template>
    <div class="absolute flex justify-center w-full">
        <label :for="`switch-${id}`" class="switch">
            <input type="checkbox" :id="`switch-${id}`" class="hidden" v-model="checked" :checked="defaultChecked" />
        </label>
    </div>
</template>