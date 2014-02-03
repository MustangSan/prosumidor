<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *---------------------------------------------------------------------------
 * CONTROLLER EDITAR
 *---------------------------------------------------------------------------
 * 
 * Responsável por controlar toda a lógica computacional das funções 
 * relacionadas as telas de editar o prosumidor. Tem a função de se comunicar
 * com as models e as views, fazendo as chamadas nos momentos necessários.
 *
 */

class Editar extends CI_Controller {

	/**
	 * Construtor
	 */
	function __construct() {

	 	// Chama todas as models e bibliotecas necessárias no controller
        parent::__construct();
        $this->load->model('Prosumidor_model');
        $this->load->model('Login_prosumidor_model', 'Login');
        $this->load->library('Dominio');
        $this->load->helper('url');
		
	 	// O usuário só podera executar alguma função na área de administradores se o mesmo estiver logado.
        $this->Login->logged();
    }
	
    /** 
	* Função que controla a edição de um administrador no banco de dados. A função recebe
	* como parâmetro um código do administrador que será editado
	*/
    public function index(){


        $this->load->library('form_validation');
		
		// Busca por meio de uma função da model o administrador desejado e guarda na variável $administrador
        $prosumidor = $this->Prosumidor_model->getProsumidor($this->session->userdata('idProsumidor'));

	 	// Controla a inserção de dados nos campos de acordo com as regras estabelecidas para cada campo
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('cpf', 'CPF', 'trim|require');
		$this->form_validation->set_rules('telefone', 'Telefone', 'trim|required');
		$this->form_validation->set_rules('endereco', 'Endereco', 'trim|required');

	 	// Se o campo senha estiver vazio, confere se a senha atual confere com a anterior
		if ($this->input->post('senha') == '') {
			$this->form_validation->set_rules('senha', 'Senha', 'matches[senhaconf]');
		}

	 	// Caso o usuário informe outra senha, ele valida o campo e faz a comparação com o campo de confirmação da senha
		else {
			$this->form_validation->set_rules('senha', 'Senha', 'trim|required|min_length[6]|matches[senhaconf]');
			$this->form_validation->set_rules('senhaconf', 'Confirmação de senha', 'trim|required');
		}	

        if($this->form_validation->run() == FALSE)
        {
			$data = array(
				'nome' 		=> $prosumidor->getNome(),
				'email' 	=> $prosumidor->getEmail(),
				'senha' 	=> $prosumidor->getSenha(),
				'cpf'		=> $prosumidor->getCPF(),
				'telefone'	=> $prosumidor->getTelefone(),
				'endereco'	=> $prosumidor->getEndereco(),
				'sexo'		=> $prosumidor->getSexo()
			);

	 		// Carrega a view de edição de administradores passando o valor que está na variável $data
            $this->load->view('prosumidor/editar/editar_view', $data);
        }
        else {

	 		// Se o campo senha não for alterado a senha do administrador continua a mesma
			if ($this->input->post('senha') == '')
				$senha = '';

	 		// Se a senha informada for diferente da anterior, o programa codifica a nova senha
			else if ($this->input->post('senha') != $prosumidor->getSenha())
				$senha = md5($this->input->post('senha'));
 
	 		// Se a senha informada for igual a anterior, a senha continua a mesma
			else
				$senha = $this->input->post('senha');
			
	 		// Cria um novo administrador com as informações editadas e grava na variável $data
			$data = new Prosumidor($prosumidor->getIdProsumidor(), $this->input->post('email'), $senha, $this->input->post('nome'), 
				$this->input->post('cpf'), $this->input->post('telefone'), $this->input->post('endereco'), $this->input->post('sexo'), 
				$prosumidor->getStatus(), $prosumidor->getTipo(), $prosumidor->getSaldoConsumidor()	);
             
	 		// Chama a model de edição de administrador passando como parâmetro os dados editados
			$result = $this->Prosumidor_model->editarProsumidor($data);
			
            if($result === FALSE)
                echo "fail";
            else
            {	
	 			// Se toda a operação ocorrer corretamente, o sistema exibe uma mensagem de sucesso e retorna a página principal da administração			
				//$this->session->set_flashdata('result', 'editarSucesso');
				redirect('prosumidor/editar', 'refresh');
            }
        }
    }


}

/* End of file editar.php */
/* Location: ./application/controllers/prosumidor/editar.php */