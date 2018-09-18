<?php
namespace Produto\Form;

use Zend\Form\Form;

class ProdutoForm extends Form {

    public function __construct($name = null, $options = array()) {
        parent::__construct('produto', array());

        $this->add( new \Zend\Form\Element\Hidden('id') );
        $this->add( new \Zend\Form\Element\Text('nome', ['label' => 'Nome']));
        $this->add( new \Zend\Form\Element\Text('descricao', ['label' => 'Descrição']));
        $this->add( new \Zend\Form\Element\Text('quantidade', ['label' => 'Quantidade']));
        $this->add( new \Zend\Form\Element\Text('preco', ['label' => 'Preço']));

        $submit = new \Zend\Form\Element\Submit('submit');
        $submit->setAttributes(['class' => 'btn btn-success', 'value' => 'Salvar', 'id' => 'submit']);

        $this->add( $submit );
    }
    
}