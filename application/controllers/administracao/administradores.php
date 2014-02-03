<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *---------------------------------------------------------------------------
 * CONTROLLER ADMINISTRADORES
 *---------------------------------------------------------------------------
 * 
 * Responsável por controlar toda a lógica computacional das funções 
 * relacionadas as telas de administração. Tem a função de se comunicar
 * com as models e as views, fazendo as chamadas nos momentos necessários.
 *
 */

class Administradores extends CI_Controller {

	/**
	 * Construtor
	 */
	function __construct() {

	 	// Chama todas as models e bibliotecas necessárias no controller
        parent::__construct();
        $this->load->model('Administrador_model');
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
        $data['administradores'] = $this->Administrador_model->listarAdministradores();
		 
	 	// Carrega a view que lista todos os administradores na tela
    	$this->load->view('administracao/administradores/administracao_list_view', $data);
    }

    /** 
	* Função que controla a inserção de um administrador no banco de dados
	*/
    public function inserirAdministrador(){
        $this->load->library('form_validation');

	 	// Controla a inserção de dados nos campos de acordo com as regras estabelecidas para cada campo
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[administrador.email]');
        $this->form_validation->set_rules('senha', 'Senha', 'trim|required|min_length[6]|matches[senhaconf]|md5');
		$this->form_validation->set_rules('senhaconf', 'Confirmação de senha', 'trim|required|');

	 	// Se a inserção de dados não for bem sucedida, carrega novamente a view de edição de administradores
        if ($this->form_validation->run() == FALSE)
        {
			$data = array(
				'nome' 				=> $this->input->post('nome'),
				'email' 			=> $this->input->post('email'),
				'senha' 			=> ''
			);
            $this->load->view('administracao/administradores/administracao_edit_view', $data);
        }
 
	 	// Caso os dados estiverem de acordo com as regras estabelecidas, insere o administrador
	 	// no banco de dados por meio da chamada de uma função da model
        else
        {
			$data = new Administrador(NULL, $this->input->post('email'), $this->input->post('senha'), $this->input->post('nome'));
			$resultado = $this->Administrador_model->inserirAdministrador($data);
			
	 		// Informa ao usuário que a inserção ocorreu com sucesso e retorna a tela principal da administração
			//$this->session->set_flashdata('result', 'inserirSucesso');
			redirect('administracao/administradores', 'refresh');
        }  
    }

    /** 
	* Função que controla a edição de um administrador no banco de dados. A função recebe
	* como parâmetro um código do administrador que será editado
	*/
    public function editarAdministrador($idAdministrador){
        $this->load->library('form_validation');
		
		// Busca por meio de uma função da model o administrador desejado e guarda na variável $administrador
        $administrador = $this->Administrador_model->getAdministrador($idAdministrador);

	 	// Controla a inserção de dados nos campos de acordo com as regras estabelecidas para cada campo
        $this->form_validation->set_rules('nome', 'Nome', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		 
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
				'nome' => $administrador->getNome(),
				'email' => $administrador->getEmail(),
				'senha' => $administrador->getSenha(),
			);
			
	 		// Se a inserção dos novos valores não for bem sucedida, atribui os valores da variável $administrador
	 		// à variável $dados. Caso a variável $dados esteja vazia, ele a elimina
            $dados['administrador'] = $administrador;
            if($dados['administrador'] == NULL) {
                unset($dados['administrador']);
			}

	 		// Carrega a view de edição de administradores passando o valor que está na variável $data
            $this->load->view('administracao/administradores/administracao_edit_view', $data);
        }
        else {

	 		// Se o campo senha não for alterado a senha do administrador continua a mesma
			if ($this->input->post('senha') == '')
				$senha = '';

	 		// Se a senha informada for diferente da anterior, o programa codifica a nova senha
			else if ($this->input->post('senha') != $administrador->getSenha())
				$senha = md5($this->input->post('senha'));
 
	 		// Se a senha informada for igual a anterior, a senha continua a mesma
			else
				$senha = $this->input->post('senha');
			
	 		// Cria um novo administrador com as informações editadas e grava na variável $data
			$data = new Administrador($administrador->getIdAdministrador(), $this->input->post('email'), $senha, $this->input->post('nome'));
             
	 		// Chama a model de edição de administrador passando como parâmetro os dados editados
			$result = $this->Administrador_model->editarAdministrador($data);
			
            if($result === FALSE)
                echo "fail";
            else
            {	
	 			// Se toda a operação ocorrer corretamente, o sistema exibe uma mensagem de sucesso e retorna a página principal da administração			
				//$this->session->set_flashdata('result', 'editarSucesso');
				redirect('administracao/administradores', 'refresh');
            }
        }
    }

    /** 
	* Função que controla a remoção de um administrador do banco de dados. A função recebe
	* como parâmetro o código do administrador que será removido
	*/
    public function removerAdministrador($idAdministrador){

		// Se o usuário logado tentar se auto remover, o sistema exibe uma mensagem de erro e carrega a página principal da administração
		if ($this->session->userdata('idAdministrador') == $idAdministrador) {
			//$this->session->set_flashdata('result', 'removerErro');
			redirect('administracao/administradores', 'refresh');						
		}

		$result = $this->Administrador_model->deleteAdministrador($idAdministrador);

		if($result === FALSE)
			echo "fail";
		else
		{		
	 		// Se toda a operação ocorrer corretamente, o sistema exibe uma mensagem de sucesso e retorna a página principal da administração		
			//$this->session->set_flashdata('result', 'removerSucesso');
			redirect('administracao/administradores', 'refresh');
		}
	}

	public function exportar() {
		$this->load->helper('download');
		
		// Prepara os dados para exportação chamando uma função de auxílio presente na model de administração
		$data = $this->Administrador_model->exportar();

		// Inicia o download dos dados exportados
		force_download('Administradores.csv', $data);
	}
}

/* End of file administrador.php */
/* Location: ./application/controllers/administracao/administrador.php */
