<script setup>
    import { ref } from 'vue';
    import Input from '@/components/Input.vue';
    import Switch from '@/components/Switch.vue';
    import { formatMoney } from '@/utils';
    import { cadastrarProduto, editarProduto, excluirProduto, setProdutoDisponivel } from '../services/cadastro';

    const nomeProduto = ref('');
    const valorProduto = ref(0);

    const idEditarProduto = ref(null);

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
        }
    });
</script>

<template>
    <h4 class="mb-4">> Produtos</h4>
    <div class="flex justify-between gap-4 flex-col md:flex-row mb-5">
        <div class="flex gap-2 w-full md:gap-4 flex-col md:flex-row mb-5 md:mb-0">
            <Input label="Nome do produto" class="w-full md:max-w-[250px]" v-model="nomeProduto" />
            <Input type="money" class="w-full md:max-w-[250px] text-right" v-model="valorProduto" />
        </div>
        <button id="btn-cadastrar-produto" @click="cadastrarProduto(nomeProduto, valorProduto)" class="whitespace-nowrap">Cadastrar produto</button>
        <button id="btn-editar-produto" @click="editarProduto(idEditarProduto, nomeProduto, valorProduto)" class="whitespace-nowrap hidden">Editar produto</button>
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
            <tr v-for="(produto, key) in produtos">
                <td class="w-[10%]">{{ produto.id }}</td>
                <td class="w-[40%] text-left max-w-0 truncate" :title="produto.nome">{{ produto.nome }}</td>
                <td class="w-[20%]">{{ produto.valor_atual !== null ? formatMoney(produto.valor_atual) : 'Gratuito' }}</td>
                <td class="w-[10%] px-0 relative">
                    <Switch :id="`switch-${key}`" @click="setProdutoDisponivel(produto.id, `switch-${key}`)" :defaultChecked="produto.disponivel" />
                </td>
                <td class="w-[20%] [&_span]:underline [&_span]:cursor-pointer [&_span:hover]:font-bold">
                    <span @click="prepareEditarProduto(produto.id, produto.nome, produto.valor_atual)">Editar</span>
                    /
                    <span @click="excluirProduto(produto.id)">Excluir</span>
                </td>
            </tr>
        </table>
    </div>
</template>