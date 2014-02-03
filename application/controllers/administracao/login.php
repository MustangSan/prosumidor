<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *---------------------------------------------------------------------------------
 * CONTROLLER LOGIN ADMINISTRAÇÃO
 *---------------------------------------------------------------------------------
 * 
 * Responsável por controlar toda a lógica computacional das funções 
 * relacionadas as telas de login da administração. Tem a função de se 
 * comunicar com as models e as views, fazendo as chamadas nos momentos necessários.
 *
 */

class Login extends CI_Controller {

    /**
     * Construtor
     */
    function __construct() {
        parent::__construct();
		$this->load->library('session');
    }

    /**
     * Carrega a página inicial do painel de login da administração
     */
    function index() {

        // Controla a inserção de dados nos campos de acordo com as regras estabelecidas para cada campo
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email');
        $this->form_validation->set_rules('senha', 'Senha', 'trim|required');

        // Se a inserção de dados não for bem sucedida, carrega novamente a view de login
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('administracao/login/login_view');

        // Caso a inserção dos dados por parte do usuário esteja de acordo com as regras estabelecidas
        } else {

            // Carrega a model de login
			$this->load->model('Login_administracao_model', 'Login');

            // Verifica se o usuário está informando os dados corretos por meio de uma função da model
            // e grava o resultado na variável $query
			$query = $this->Login->validate();			
			
            // Se a variável possuir algo gravado nela, o usuário está validado
            if (isset($query)) {
                $data = array(
                    'nome'					=> $query->nome,
                    'email'					=> $query->email,
                    'idAdministrador'		=> $query->idAdministrador,
                );
                $this->session->set_userdata($data);
				
                // Caso tudo esteja correto, direciona o usuário para a tela de início do painel de administração
				redirect('administracao/administradores', 'refresh');

            // Se o usuário não for validado
            } else {

                // O sistema informa uma mensagem de erro de login
				$data['result'] = 'loginErro';

                // Carrega a view de login 
                $this->load->view('administracao/login/login_view', $data);
            }
        }
    }
}

/* End of file login.php */
/* Location: ./application/controllers/administracao/login.php */
