<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *---------------------------------------------------------------------------
 * CONTROLLER INÍCIO PROSUMIDOR
 *---------------------------------------------------------------------------
 * 
 * Responsável por controlar toda a lógica computacional da função index
 * relacionada a tela inicial do painel do prosumidor. Tem a função 
 * de se comunicar com as models e as views, fazendo as chamadas nos 
 * momentos necessários.
 *
 */

class Inicio extends CI_Controller {

	/**
     * Construtor
     */
	function __construct() {
		
        // Chama todas as models e bibliotecas necessárias no controller
        parent::__construct();
        $this->load->model('Login_administracao_model', 'Login');
        $this->load->model('Prosumidor_model');
        $this->load->model('Produto_model');
        $this->load->model('Categoria_model');
        $this->load->model('Classificacao_model');
        $this->load->library('Dominio');

        // O usuário só podera executar alguma função na área do prosumidor se o mesmo estiver logado.
        $this->Login->logged();
    }

    /**
     * Carrega a página inicial do painel do prosumidor
     */
    public function index() {

        // Salva na variável $data os itens que serão carregados
        $data['prosumidor'] = $this->Prosumidor_model->record_count();
        $data['produtos'] = $this->Produto_model->record_count();
        $data['categorias'] = $this->Categoria_model->record_count();
        $data['class'] = $this->Classificacao_model->record_count();
        
        // Carrega a respectiva view de início do painel do prosumidor
    	$this->load->view('administracao/inicio/inicio_view', $data);
    }
}

/* End of file inicio.php */
/* Location: ./application/controllers/prosumidor/inicio.php */