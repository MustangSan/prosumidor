<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *---------------------------------------------------------------------------
 * CONTROLLER PRODUTOS
 *---------------------------------------------------------------------------
 * 
 * Responsável por controlar toda a lógica computacional das funções 
 * relacionadas as telas de cadastro. Tem a função de se comunicar
 * com as models e as views, fazendo as chamadas nos momentos necessários.
 *
 */

class Produtos extends CI_Controller {

	/**
	 * Construtor
	 */
	function __construct() {

	 	// Chama todas as models e bibliotecas necessárias no controller
        parent::__construct();
        $this->load->model('Produto_model');
        $this->load->model('Categoria_model');
        $this->load->model('Classificacao_model');
        $this->load->library('Dominio');
    }
	
	/**
	 * Carrega a página inicial da tela de produtos
	 */
    public function verMais($idProduto) {		
 
	 	// Salva na variável $data os itens que serão carregados
	 	$produtos = $this->Produto_model->getProduto($idProduto);
        $data['produtos'] = $produtos;
        $data['categoria'] = $this->Categoria_model->getCategoria($produtos->getIdCategoria());

        $class = $this->Classificacao_model->listarClassificacoes();
		$idsClass = $this->Produto_model->listarClassificacoes($idProduto);
		$i = 0;
		$classificacoes = array();
		if(isset($class) && isset($idsClass)){
			foreach ($class as $key) {
				foreach ($idsClass as $c) {
					if($key->getIdClassificacao() == $c['idClassificacao']){
						$classificacoes[] = $key;
						$i++;
					}
				}
			}
		}
		$data['numClass'] = $i;
		$data['class'] = $classificacoes;
		 
	 	// Carrega a view que lista todas as categorias na tela
    	$this->load->view('prosumidor/produtos/produto_info_view', $data);
    }
}