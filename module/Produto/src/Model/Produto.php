<?php
namespace Produto\Model;

class Produto implements \Zend\Stdlib\ArraySerializableInterface {

    private $id;
    private $nome;
    private $descricao;
    private $quantidade;
    private $preco;

    public function exchangeArray(array $data) {
        $this->id = !empty($data['id']) ? $data['id'] : null;
        $this->nome = !empty($data['nome']) ? $data['nome'] : null;
        $this->descricao = !empty($data['descricao']) ? $data['descricao'] : null;
        $this->quantidade = !empty($data['quantidade']) ? $data['quantidade'] : null;
        $this->preco = !empty($data['preco']) ? $data['preco'] : null;
    }

    public function setId($id) {
        $this->id = $id;
    }    

    public function getId() {
        return $this->id;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function getDescricao() {
        return $this->descricao;
    }
    
    public function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

    public function getQuantidade() {
        return $this->quantidade;
    }
    
    public function setPreco($preco) {
        $this->preco = $preco;
    }

    public function getPreco() {
        return $this->preco;
    }    

    public function getArrayCopy() : array {
        return [
            'id' => $this->id,
            'descricao' => $this->descricao,
            'quantidade' => $this->quantidade,
            'preco' => $this->preco
        ];
    }
}