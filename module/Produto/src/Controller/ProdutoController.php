<?php

namespace Produto\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Produto\Model\Produto;
use Produto\Model\ProdutoTable;

use Produto\Form\ProdutoForm;

class ProdutoController extends AbstractActionController {
    private $table;

    public function __construct(ProdutoTable $table) {
        $this->table = $table;
    }

    public function indexAction() {
        return $this->redirect()->toRoute('produto', ['action' => 'listar']);
    }

    public function listarAction() {
        return new ViewModel( [
            'produtos' => $this->table->lista(),
            'produtos_alterados' => $this->table->ultimos_alterados(),
            'produtos_pouco_estoque' => $this->table->menos_estoque(),
        ] );
    }

    public function cadastrarAction() {
        $form = new ProdutoForm();

        $form->get('submit')->setValue('Adicionar');
        $request = $this->getRequest();

        if(! $request->isPost()) {
            return new ViewModel( ['form' => $form] );
        } else {

            $produto = new Produto();
            $form->setData($request->getPost());

            if(!$form->isValid()) {
                return new ViewModel( ['form' => $form] );
            } else {
                $produto->exchangeArray( $form->getData() );
                $this->table->salva($produto);
    
                return $this->redirect()->toRoute('produto', ['action' => 'listar']);
            }
        }
    }

    public function editarAction() {
        $id = (int) $this->params()->fromRoute('id', 0);

        if($id === 0) {
            return $this->redirect()->toRoute('produto', ['action' => 'cadastrar']);
        } else {

            try {
                $produto = $this->table->info($id);
            } catch(Exception $e) {
                print_r($e); 
                exit;
            }

            $form = new ProdutoForm();
            $form->bind($produto);

            $form->get('submit')->setAttribute('value', 'Salvar');
            $request = $this->getRequest();

            if(! $request->isPost()) {
                return new ViewModel( ['form' => $form, 'id' => $id, 'nome_e' => $produto->getNome()] );
            } else {

                $produto = new \Produto\Model\Produto();
                $form->setData($request->getPost());
    
                if(!$form->isValid()) {
                    return new ViewModel( ['form' => $form, 'id' => $id] );
                } else {
                    // $produto->exchangeArray( $form->getData() );

                    $this->table->salva( $form->getData() );
        
                    return $this->redirect()->toRoute('produto');
                }
            }
        }
    }

    public function deletarAction() {
        $id = (int) $this->params()->fromRoute('id', 0);

        if(0 === $id) {
            return $this->redirect()->toRoute('produto');
        } else {
            $request = $this->getRequest();
            $this->table->deleta($id);
            return $this->redirect()->toRoute('produto');
        }
    }    

    public function incrementarAction() {
        $id = (int) $this->params()->fromRoute('id', 0);

        if(0 === $id) {
            return $this->redirect()->toRoute('produto');
        }

        $produto = $this->table->info($id);

        $produto->setQuantidade($produto->getQuantidade() + 1);
        $this->table->salva( $produto );
        return $this->redirect()->toRoute('produto');
    }

    public function decrementarAction() {
        $id = (int) $this->params()->fromRoute('id', 0);

        if(0 === $id) {
            return $this->redirect()->toRoute('produto');
        }

        $produto = $this->table->info($id);

        if($produto->getQuantidade()) {
            $produto->setQuantidade($produto->getQuantidade() - 1);
            $this->table->salva( $produto );
        }

        return $this->redirect()->toRoute('produto');        
    } 
}
