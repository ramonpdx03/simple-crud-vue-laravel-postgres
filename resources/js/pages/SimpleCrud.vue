<script setup>
import Input from '@/components/Input.vue';
import Switch from '@/components/Switch.vue';
import Layout from '@/layouts/Layout.vue';
import { formatMoney } from '@/utils';
</script>

<template>
    <Layout title="Simple CRUD">
        <h1 class="w-full text-center">Simple CRUD</h1>
        <h5 class="w-full text-center mb-4">VueJs + Laravel + Postgres</h5>
        <h4 class="mb-4">> Produtos</h4>
        <div class="flex justify-between gap-4 flex-col md:flex-row mb-5">
            <div class="flex gap-2 w-full md:gap-4 flex-col md:flex-row mb-5 md:mb-0">
                <Input label="Nome do produto" class="w-full md:max-w-[250px]" />
                <Input type="money" class="w-full md:max-w-[250px] text-right" />
            </div>
            <button class="whitespace-nowrap">Cadastrar produto</button>
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
                <tr>
                    <td class="w-[10%] text-center">1</td>
                    <td class="w-[40%] max-w-0 truncate" title="Camisa de anime legal do Naruto na batalha da vila da folha da arvore">Camisa de anime legal do Naruto na batalha da vila da folha da arvore</td>
                    <td class="w-[20%] text-center">{{ formatMoney(40) }}</td>
                    <td class="w-[10%] text-center px-0 relative">
                        <Switch id="1" :defaultChecked="true" />
                    </td>
                    <td class="w-[20%] text-center [&_span]:underline [&_span]:cursor-pointer [&_span:hover]:font-bold">
                        <span>Editar</span>
                        /
                        <span>Excluir</span>
                    </td>
                </tr>
                <tr>
                    <td class="w-[10%] text-center">2</td>
                    <td class="w-[40%] max-w-0 truncate" title="Chaveiro sasuke">Chaveiro sasuke</td>
                    <td class="w-[20%] text-center">{{ formatMoney(12) }}</td>
                    <td class="w-[10%] text-center px-0 relative">
                        <Switch id="2" :defaultChecked="true" />
                    </td>
                    <td class="w-[20%] text-center [&_span]:underline [&_span]:cursor-pointer [&_span:hover]:font-bold">
                        <span>Editar</span>
                        /
                        <span>Excluir</span>
                    </td>
                </tr>
                <tr>
                    <td class="w-[10%] text-center">3</td>
                    <td class="w-[40%] max-w-0 truncate" title="Pamonha">Pamonha</td>
                    <td class="w-[20%] text-center">{{ formatMoney(6) }}</td>
                    <td class="w-[10%] text-center px-0 relative">
                        <Switch id="3" :defaultChecked="false" />
                    </td>
                    <td class="w-[20%] text-center [&_span]:underline [&_span]:cursor-pointer [&_span:hover]:font-bold">
                        <span>Editar</span>
                        /
                        <span>Excluir</span>
                    </td>
                </tr>
            </table>
        </div>
    </Layout>
</template>