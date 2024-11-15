import axios from "axios";
import { isLoading } from "@/utils";

export const cadastrarProduto = (nomeProduto, valorProduto) => {
    isLoading.value = true;
    axios.post('/produto/cadastrar', {
        nome: nomeProduto,
        valor: valorProduto
    }).then(response => {
        window.location.reload();
    }).catch(error => {
        alert(error.response.data?.msg);
        isLoading.value = false;
    });
};

export const setProdutoDisponivel = (id, switchId) => {
    isLoading.value = true;
    axios.post(`/produto/${id}/disponivel`, {
        disponivel: document.querySelector(`#switch-${switchId}`).checked
    }).catch(error => {
        alert(error.response.data?.msg);
    }).finally(() => {
        isLoading.value = false;
    });
};

export const excluirProduto = (id) => {
    isLoading.value = true;
    axios.post(`/produto/${id}/excluir`, {
    }).then(response => {
        window.location.reload();
    }).catch(error => {
        alert(error.response.data?.msg);
        isLoading.value = false;
    });
};

export const editarProduto = (id, nomeProduto, valorProduto) => {
    isLoading.value = true;
    axios.post(`/produto/${id}/editar`, {
        nome: nomeProduto,
        valor: valorProduto
    }).then(response => {
        window.location.reload();
    }).catch(error => {
        alert(error.response.data?.msg);
        isLoading.value = false;
    });
};