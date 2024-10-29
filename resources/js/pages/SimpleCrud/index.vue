<script setup>
import Input from '@/components/Input.vue';
import Switch from '@/components/Switch.vue';
import Layout from '@/layouts/Layout.vue';
import { formatMoney } from '@/utils';
import axios from 'axios';
import { ref } from 'vue';

const isLoading = ref(false);

const nomeProduto = ref('');
const valorProduto = ref(0);

const idEditarProduto = ref(null);

const cadastrarProduto = () => {
    isLoading.value = true;
    axios.post('/produto/cadastrar', {
        nome: nomeProduto.value,
        valor: valorProduto.value
    }).then(response => {
        window.location.reload();
    }).catch(error => {
        alert(error.response.data?.msg);
        isLoading.value = false;
    });
};

const setProdutoDisponivel = (id, switchId) => {
    isLoading.value = true;
    axios.post(`/produto/${id}/disponivel`, {
        disponivel: document.querySelector(`#switch-${switchId}`).checked
    }).catch(error => {
        alert(error.response.data?.msg)
    }).finally(() => {
        isLoading.value = false;
    });
};

const excluirProduto = (id) => {
    isLoading.value = true;
    axios.post(`/produto/${id}/excluir`, {
    }).then(response => {
        window.location.reload();
    }).catch(error => {
        alert(error.response.data?.msg)
        isLoading.value = false;
    });
};

const editarProduto = () => {
    isLoading.value = true;
    axios.post(`/produto/${idEditarProduto.value}/editar`, {
        nome: nomeProduto.value,
        valor: valorProduto.value
    }).then(response => {
        window.location.reload();
    }).catch(error => {
        alert(error.response.data?.msg)
        isLoading.value = false;
    });
};

const prepareEditarProduto = (id, nome, valor) => {
    idEditarProduto.value = id;
    nomeProduto.value = nome;
    valorProduto.value = valor;

    document.querySelector('#btn-cadastrar-produto').classList.add('hidden');
    document.querySelector('#btn-editar-produto').classList.remove('hidden');
};

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
        <h4 class="mb-4">> Produtos</h4>
        <div class="flex justify-between gap-4 flex-col md:flex-row mb-5">
            <div class="flex gap-2 w-full md:gap-4 flex-col md:flex-row mb-5 md:mb-0">
                <Input label="Nome do produto" class="w-full md:max-w-[250px]" v-model="nomeProduto" />
                <Input type="money" class="w-full md:max-w-[250px] text-right" v-model="valorProduto" />
            </div>
            <button id="btn-cadastrar-produto" @click="cadastrarProduto" class="whitespace-nowrap">Cadastrar produto</button>
            <button id="btn-editar-produto" @click="editarProduto" class="whitespace-nowrap hidden">Editar produto</button>
        </div>
        <div class="wrapper-table">
            <table>
                <tr>
                    <th class="w-[10%]">ID</th>
                    <th class="w-[40%]">Nome</th>
                    <th class="w-[20%]">Valor atual</th>
                    <th class="w-[10%]">Disponível</th>
                    <th class="w-[20%]">Ações</th>
                </tr>
                <tr v-for="(produto, id) in produtos">
                    <td class="w-[10%] text-center">{{ produto.id }}</td>
                    <td class="w-[40%] max-w-0 truncate" :title="produto.nome">{{ produto.nome }}</td>
                    <td class="w-[20%] text-center">{{ formatMoney(produto.valor_atual) }}</td>
                    <td class="w-[10%] text-center px-0 relative">
                        <Switch :id="`switch-${id}`" @click="setProdutoDisponivel(produto.id, `switch-${id}`)" :defaultChecked="produto.disponivel" />
                    </td>
                    <td class="w-[20%] text-center [&_span]:underline [&_span]:cursor-pointer [&_span:hover]:font-bold">
                        <span @click="prepareEditarProduto(produto.id, produto.nome, produto.valor_atual)">Editar</span>
                        /
                        <span @click="excluirProduto(produto.id)">Excluir</span>
                    </td>
                </tr>
            </table>
        </div>
    </Layout>
</template>