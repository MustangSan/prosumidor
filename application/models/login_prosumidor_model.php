<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 *---------------------------------------------------------------------------
 * MODEL LOGIN PROSUMIDOR
 *---------------------------------------------------------------------------
 * 
 * Model que trata as funções relacionadas ao login na área do prosumidor.
 * Todas as funções que necessitam de acessos ao banco de dados,
 * estão descritas neste arquivo.
 *
 */

class Login_prosumidor_model extends CI_Model {

    /**
     * Função que valida se os dados inseridos são válidos e o usuário pode logar no sistema
     */
    function validate() {
    	$this->db->trans_start();
		
        // Verifica se já existe os dados cadastrados no banco realizando uma consulta e gravando os dados na query
		$query = $this->db->query('SELECT * FROM prosumidor WHERE email = "'.$this->input->post('email').'" AND senha = "'.md5($this->input->post('senha')).'"');
		
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
        $logged = $this->session->userdata('email');

        // Se o nome for nulo, quer dizer que o usuário não está logado e é redirecionado para a página de login do prosumidor
        if ($logged == '') {
			redirect('/prosumidor/login', 'refresh');
        }
    }
}

/* End of file login_prosumidor_model.php */
/* Location: ./application/models/login_prosumidor_model.php */