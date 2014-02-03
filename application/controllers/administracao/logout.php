<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 *---------------------------------------------------------------------------------
 * CONTROLLER LOGOUT ADMINISTRAÇÃO
 *---------------------------------------------------------------------------------
 * 
 * Responsável por controlar toda a lógica computacional das funções 
 * relacionadas ao logout da área de administração. 
 *
 */

class Logout extends CI_Controller {

	/**
     * Construtor
     */
    function __construct() {
        parent::__construct();
		$this->load->library('session');
    }

    /**
     * Função responsável por encerrar a sessão do usuário corrente
     */
    function index() {

    	// Destroi a sessão do usuário
        $this->session->sess_destroy();

        // Redireciona para a tela de login da administração	
		redirect('administracao/login', 'refresh');
    }
}


/* End of file logout.php */
/* Location: ./application/controllers/administracao/logout.php */
