<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *---------------------------------------------------------------------------
 * MODEL LOGIN ADMINISTRAÇÃO
 *---------------------------------------------------------------------------
 * 
 * Model que trata as funções relacionadas ao login na área de administração.
 * Todas as funções que necessitam de acessos ao banco de dados,
 * estão descritas neste arquivo.
 *
 */

class Login_administracao_model extends CI_Model {

    /**
     * Função que valida se os dados inseridos são válidos e o usuário pode logar no sistema
     */
    function validate() {
    	$this->db->trans_start();
		
        // Verifica se já existe os dados cadastrados no banco
        $this->db->where('email', $this->input->post('email')); 
        $this->db->where('senha', md5($this->input->post('senha')));

        // Grava todos os dados anteriores na query
        $query = $this->db->get('administrador'); 
	   
        // Finaliza a transação e fecha a conexão
		$this->db->trans_complete();
		$this->db->close();

        // Se a query possuir uma linha quer dizer que o usuário está cadastrado no banco de dados e pode logar
        if ($query->num_rows == 1) { 
            return $query->row();
        }

        // Caso contrário, é negada a autenticação
		return NULL;
    }

    /**
     * Função que verifica se o usuário já está logado no sistema
     */
    function logged() {

        // Verifica o nome do usuário logado no sistema
        $logged = $this->session->userdata('nome');

        // Se o nome for nulo, quer dizer que o usuário não está logado e é redirecionado para a página de login da administracao
        if ($logged == '') {
			redirect('administracao/login', 'refresh');
        }
    }
}

/* End of file login_administracao_model.php */
/* Location: ./application/controllers/administracao/login_administracao_model.php */