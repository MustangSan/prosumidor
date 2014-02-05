<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *---------------------------------------------------------------------------
 * CONTROLLER PROSUMIDORES
 *---------------------------------------------------------------------------
 * 
 * Responsável por controlar toda a lógica computacional das funções 
 * relacionadas as telas de prosumidor. Tem a função de se comunicar
 * com as models e as views, fazendo as chamadas nos momentos necessários.
 *
 */

class Prosumidores extends CI_Controller {

	/**
	 * Construtor
	 */
	function __construct() {

	 	// Chama todas as models e bibliotecas necessárias no controller
        parent::__construct();
        $this->load->model('Prosumidor_model');
        $this->load->model('Propriedade_model');
        $this->load->model('Login_administracao_model', 'Login');
        $this->load->library('Dominio');
		
	 	// O usuário só podera executar alguma função na área de administradores se o mesmo estiver logado.
        $this->Login->logged();
    }
	
	/**
	 * Carrega a página inicial da tela de administradores
	 */
    public function index() {		
 
	 	// Salva na variável $data os itens que serão carregados
        $data['prosumidor'] = $this->Prosumidor_model->listarProsumidor();
		 
	 	// Carrega a view que lista todos os administradores na tela
    	$this->load->view('administracao/prosumidores/prosumidor_list_view', $data);
    }

    public function listarPropriedades($idProsumidor){

    	$data['prosumidor'] = $this->Prosumidor_model->getProsumidor($idProsumidor);
    	$data['propriedades'] = $this->Propriedade_model->listarPropriedadesIdProsumidor($idProsumidor);
		 
	 	// Carrega a view que lista todos as propriedades na tela
    	$this->load->view('administracao/prosumidores/propriedades_list_view', $data);
    }

    public function desbloquear($idProsumidor){

    	$prosumidor = $this->Prosumidor_model->getProsumidor($idProsumidor);

		$prosumidor->setStatus(1);

		$result = $this->Prosumidor_model->editarProsumidor($prosumidor);

        if($result === FALSE)
            echo "fail";
        else
        {	
 			// Se toda a operação ocorrer corretamente, o sistema exibe uma mensagem de sucesso e retorna a página principal da administração			
			//$this->session->set_flashdata('result', 'editarSucesso');
			redirect('administracao/prosumidores', 'refresh');
        }
    }

    public function bloquear($idProsumidor){

    	$prosumidor = $this->Prosumidor_model->getProsumidor($idProsumidor);

		$prosumidor->setStatus(2);

		$result = $this->Prosumidor_model->editarProsumidor($prosumidor);

        if($result === FALSE)
            echo "fail";
        else
        {	
 			// Se toda a operação ocorrer corretamente, o sistema exibe uma mensagem de sucesso e retorna a página principal da administração			
			//$this->session->set_flashdata('result', 'editarSucesso');
			redirect('administracao/prosumidores', 'refresh');
        }
    }
}

/* End of file prosumidores.php */
/* Location: ./application/controllers/administracao/prosumidores.php */
