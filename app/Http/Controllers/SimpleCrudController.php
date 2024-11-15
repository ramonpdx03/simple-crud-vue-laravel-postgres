<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Exception;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SimpleCrudController extends Controller
{
    public function index() {
        $produtos = Produto::orderBy('disponivel', 'desc')
            ->orderBy('nome', 'asc')
            ->get();

        return Inertia::render('SimpleCrud/index', [
            'produtos' => $produtos
        ]);
    }

    public function cadastrarProduto(Request $req) {
        try {
            $produto = $req->all();
    
            $errors = $this->validaDadosProduto($produto);
            if (!empty($errors)) {
                return response()->json([ 'msg' => implode(' / ', $errors) ], 400);
            }
    
            $produto['valor'] = floatval($produto['valor']);
    
            if ($produto['valor'] == 0) $produto['valor'] = null;
    
            Produto::insert([
                'nome' => $produto['nome'],
                'valor_atual' => $produto['valor']
            ]);
    
            return response()->json('success');
        } catch (Exception $err) {
            return response()->json([ 'msg' => 'Erro: '.$err->getMessage() ], 500);
        }
    }

    public function excluirProduto(Request $req, $id) {
        try {
            $errors = $this->validaProdutoExiste($id);
            if (!empty($errors)) {
                return response()->json([ 'msg' => implode(' / ', $errors) ], 400);
            }

            Produto::find($id)->delete();

            return response()->json('success');
        } catch (Exception $err) {
            return response()->json([ 'msg' => 'Erro: '.$err->getMessage() ], 500);
        }
    }

    public function editarProduto(Request $req, $id) {
        try {
            $produto = $req->all();

            $errors = $this->validaDadosProduto($produto);
            $errors += $this->validaProdutoExiste($id);
            if (!empty($errors)) {
                return response()->json([ 'msg' => implode(' / ', $errors) ], 400);
            }

            $produto['valor'] = floatval($produto['valor']);

            if ($produto['valor'] == 0) $produto['valor'] = null;

            Produto::where('id', $id)->update([
                'nome' => $produto['nome'],
                'valor_atual' => $produto['valor']
            ]);

            return response()->json('success');
        } catch (Exception $err) {
            return response()->json([ 'msg' => 'Erro: '.$err->getMessage() ], 500);
        }
    }

    public function setProdutoDisponivel(Request $req, $id) {
        try {
            $disponivel = $req->get('disponivel');

            $errors = $this->validaProdutoExiste($id);
            if (!empty($errors)) {
                return response()->json([ 'msg' => implode(' / ', $errors) ], 400);
            }

            Produto::where('id', $id)->update([
                'disponivel' => $disponivel
            ]);

            return response()->json('success');
        } catch (Exception $err) {
            return response()->json([ 'msg' => 'Erro: '.$err->getMessage() ], 500);
        }
    }

    ##

    private function validaDadosProduto($produto) {
        $errors = [];

        if (empty($produto['nome'])) {
            $errors[] = 'Preencha o nome do produto';

            if (strlen($produto['nome']) > 256) {
                $errors[] = 'Limite de caracteres excedido no nome do produto';
            }
        }

        if (empty($produto['valor'])) {
            $errors[] = 'Preencha o valor do produto';
        }

        return $errors;
    }

    private function validaProdutoExiste($id) {
        $errors = [];

        if (Produto::find($id) == null) {
            $errors[] = 'Produto não encontrado';
        }

        return $errors;
    }
}