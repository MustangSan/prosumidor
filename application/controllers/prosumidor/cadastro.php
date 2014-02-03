<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *---------------------------------------------------------------------------
 * CONTROLLER ADMINISTRADORES
 *---------------------------------------------------------------------------
 * 
 * Responsável por controlar toda a lógica computacional das funções 
 * relacionadas as telas de cadastro. Tem a função de se comunicar
 * com as models e as views, fazendo as chamadas nos momentos necessários.
 *
 */

class Cadastro extends CI_Controller {

	/**
	 * Construtor
	 */
	function __construct() {

	 	// Chama todas as models e bibliotecas necessárias no controller
        parent::__construct();
        $this->load->model('Prosumidor_model');
        $this->load->library('Dominio');
    }

    /** 
	* Função que controla a inserção de um prosumidor no banco de dados
	*/
    public function index(){
        $this->load->library('form_validation');

	 	// Controla a inserção de dados nos campos de acordo com as regras estabelecidas para cada campo
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[prosumidor.email]');
        $this->form_validation->set_rules('senha', 'Senha', 'trim|required|min_length[6]|matches[senhaconf]|md5');
		$this->form_validation->set_rules('senhaconf', 'Confirmação de senha', 'trim|required|');
		$this->form_validation->set_rules('nome', 'Nome', 'trim|required');
		$this->form_validation->set_rules('cpf', 'CPF', 'trim|required');
		$this->form_validation->set_rules('telefone', 'Telefone', 'trim|required');
		$this->form_validation->set_rules('endereco', 'Endereco', 'trim|required');

	 	// Se a inserção de dados não for bem sucedida, carrega novamente a view de edição de administradores
        if ($this->form_validation->run() == FALSE)
        {
			$data = array(
				'email' 			=> $this->input->post('email'),
				'senha' 			=> '',
				'nome' 				=> $this->input->post('nome'),
				'cpf'				=> $this->input->post('cpf'),
				'telefone'			=> $this->input->post('telefone'),
				'endereco'			=> $this->input->post('endereco'),
				'sexo'				=> $this->input->post('sexo'),
				'tipo'				=> $this->input->post('tipo')
			);
            $this->load->view('prosumidor/cadastro/cadastro_edit_view', $data);
        }
 
	 	// Caso os dados estiverem de acordo com as regras estabelecidas, insere o prosumidor
	 	// no banco de dados por meio da chamada de uma função da model
        else
        {
			$data = new Prosumidor(NULL, $this->input->post('email'), $this->input->post('senha'), $this->input->post('nome'),
									$this->input->post('cpf'), $this->input->post('telefone'), $this->input->post('endereco'), 
									$this->input->post('sexo'), 1, $this->input->post('tipo'), 0);
			$result = $this->Prosumidor_model->inserirProsumidor($data);
			
	 		// Informa ao usuário que a inserção ocorreu com sucesso e retorna a tela principal da administração
			//$this->session->set_flashdata('result', 'inserirSucesso');
			redirect('prosumidor/login', 'refresh');
        }  
    }
}

/* End of file cadastro.php */
/* Location: ./application/controllers/prosumidor/cadastro.php */
