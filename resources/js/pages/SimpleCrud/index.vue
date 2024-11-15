<script setup>
    import Layout from '@/layouts/Layout.vue';
    import Produtos from './components/Produtos.vue';
    import { isLoading } from '@/utils';

    defineProps({
        produtos: {
            type: Array,
            default: () => []
        },
    });
</script>

<template>
    <Layout title="Simple CRUD" :isLoading="isLoading">
        <h1 class="w-full text-center">Simple CRUD</h1>
        <h5 class="w-full text-center mb-4">VueJs + Laravel + Postgres</h5>
        <Produtos :produtos="produtos" />
    </Layout>
</template>